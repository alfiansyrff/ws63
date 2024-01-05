<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Rumahtangga;
use CodeIgniter\API\ResponseTrait;
use App\Models\MahasiswaModel;
use App\Models\WilayahKerjaModel;
use App\Models\TimPencacahModel;
use App\Models\RutaModel;


class ListingController extends BaseController
{
    use ResponseTrait;
    public function sinkronisasiRuta()
    {
        // fungsi ini mencakup insert, update, dan delete ruta

        $rutaModel = new RutaModel();
        $wilayahKerjaModel = new WilayahKerjaModel();
        // $mahasiswaModel = new MahasiswaModel();
        // $timModel = new TimPencacahModel();
        // $sampelModel = new SampelModel();
        // $push = new Push();
        $noBS = $this->request->getPost('no_bs');
        $json = $this->request->getPost('json');
        $nim = $this->request->getPost('nim');
        if ($json) {
            $object_array = (array) json_decode($json);
            $success = 0;

            foreach ($object_array as $object) {
                $object = (array) $object;
                $kodeRuta = '';
                if (!isset($object['kode_ruta']) || empty($object['kode_ruta'])) { // ketika insert kode_ruta akan kosong
                    // ketika  $object['kode_ruta'] kosong, nanti buatkan kode ruta berdasarkan nomer BS dan no urut terakhir
                    $kodeRuta = '' . $object['no_bs'] . '' . sprintf('%03d', $object['no_urut_ruta']);
                } else {
                    $kodeRuta = $object['kode_ruta'];
                }
                $jmlGenz = 0;
                if ($object['is_genz_ortu'] == "1") {
                    $jmlGenz = $object['jml_genz'];
                } else {
                    $object['no_urut_rt_egb'] = 0;
                }


                $ruta = new Rumahtangga(
                    $kodeRuta,
                    $object['no_segmen'],
                    $object['no_bg_fisik'],
                    $object['no_bg_sensus'],
                    $object['no_urut_ruta'],
                    $object['nama_krt'],
                    $object['alamat'],
                    $object['no_bs'],
                    $object['is_genz_ortu'],
                    $jmlGenz,
                    $object['no_urut_rt_egb'],
                    $object['catatan']
                );



                if ($object['status'] == 'delete') {
                    if ($rutaModel->deleteRuta($ruta)) {
                        $success++;
                    }
                } else {
                    if ($rutaModel->addRuta($ruta)) {
                        $success++;
                    }
                }
            }

            $wilayahKerjaModel = new WilayahKerjaModel();
            $boolUpdateRekapitulasiBS = $wilayahKerjaModel->updateRekapitulasiBs($noBS); // ketika insert batch ruta sukses, maka rekapitulasi BS akan dihitung ulang

            $result = array();

            if ($success == count($object_array) && $boolUpdateRekapitulasiBS) {
                $data_bs = $rutaModel->getAllRuta($noBS);

                if (is_array($data_bs)) {
                    foreach ($data_bs as $data) {
                        // $data->status = 'uploaded';
                        array_push($result, $data);
                    }
                }

                // $infoBs = $wilayahKerjaModel->getBSPCLKortim($kodeBs);

                // $data = array(
                //     'type' => 'sams_sync_ruta',
                //     'kodeBs' => $kodeBs
                // );

                // $message = $infoBs['nama_pcl'] . " memperbarui data blok sensus " . $infoBs['nama'];

                // if ($nim != $infoBs['nim_kortim']) {
                //     $push->prepareMessageToNim($infoBs['nim_kortim'], 'Data Blok Sensus Diperbarui', $message, $data);
                // }
            } else {
                $result = 'IDK';
            }

            return $this->respond($result);
        }
        return $this->respond(null, null, 'WHAT?');
    }
}
