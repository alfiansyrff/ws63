<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\MahasiswaModel;
use App\Models\WilayahKerjaModel;
use App\Models\TimPencacahModel;
use App\Models\RutaModel;


class ListingController extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        //
        $rutaModel = new RutaModel();
        $wilayahKerjaModel = new WilayahKerjaModel();
        $mahasiswaModel = new MahasiswaModel();
        $timModel = new TimPencacahModel();
        // $sampelModel = new SampelModel();
        // $push = new Push();

        $k = $this->request->getPost('k');

        if ($k == 'srp') { //SYNC_RUTA_PCL
            $kodeBs = $this->request->getPost('kodeBs');
            $json = $this->request->getPost('json');
            $nim = $this->request->getPost('nim');

            if ($json) {
                $object_array = (array) json_decode($json);
                $success = 0;

                foreach ($object_array as $object) {
                    $object = (array) $object;

                    $ruta = new Rumahtangga(
                        $object['kodeRuta'],
                        $object['noSegmen'],
                        $object['bf'],
                        $object['bs'],
                        $object['noUrutRuta'],
                        $object['namaKrt'],
                        $object['alamat'],

                        // $object['akurasi'],
                        // $object['noHp'],
                        $object['kodeBs'],
                        // $object['latitude'],
                        // $object['longitude'],

                        // $object['keterangan'],
                      
                        // $object['rutaInternet'],
                        // $object['rutaPergi']
                    );

                    if ($object['status'] == 'insert') {
                        if ($rutaModel->addRuta($ruta)) {
                            $success++;
                        }
                    } else if ($object['status'] == 'update') {
                        if ($rutaModel->updateRuta($ruta)) {
                            $success++;
                        }
                    } else if ($object['status'] == 'delete') {
                        if ($rutaModel->deleteRuta($ruta)) {
                            $success++;
                        }
                    }
                }

                $result = array();

                if ($success == count($object_array)) {
                    $data_bs = $rutaModel->getAllRuta($kodeBs);

                    if (is_array($data_bs)) {
                        foreach ($data_bs as $data) {
                            $data->status = 'uploaded';
                            array_push($result, $data);
                        }
                    }

                    $infoBs = $wilayahKerjaModel->getBSPCLKortim($kodeBs);

                    $data = array(
                        'type' => 'sams_sync_ruta',
                        'kodeBs' => $kodeBs
                    );

                    $message = $infoBs['nama_pcl'] . " memperbarui data blok sensus " . $infoBs['nama'];

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
}
