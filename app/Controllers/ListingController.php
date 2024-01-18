<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Keluarga;
use App\Libraries\Rumahtangga;
use App\Models\DataStModel;
use App\Models\KeluargaModel;
use App\Models\KeluargaRutaModel;
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
        $keluargaModel = new KeluargaModel();
        $rutaModel = new RutaModel();
        $wilayahKerjaModel = new WilayahKerjaModel();
        $keluargaRutaModel = new KeluargaRutaModel();
        // $mahasiswaModel = new MahasiswaModel();
        // $timModel = new TimPencacahModel();
        // $sampelModel = new SampelModel();
        // $push = new Push();
        $noBS = $this->request->getPost('no_bs');
        $json = $this->request->getPost('json');
        $nim = $this->request->getPost('nim');
        if ($json) {
            $json = str_replace("\n", '', $json);
            $object_array = json_decode($json, true);
            $success = 0;
            foreach ($object_array as $object) {
                $object = (array) $object;
                $keluarga = Keluarga::createFromArray($object);
                if ($object['status'] == 'delete') {
                    $keluargaRutaModel->deletedKeluargaRuta($keluarga); // ini masih salah harusnya delete
                    $rutaModel->deletedRutaBatch($keluarga); 
                    $keluargaModel->deleteKeluarga($keluarga);   
                } else {
                    $keluargaModel->addKeluarga($keluarga);
                    $keluargaRutaModel->addKeluargaRuta($keluarga);
                }
            }
            $wilayahKerjaModel = new WilayahKerjaModel();
            $boolUpdateRekapitulasiBS = $wilayahKerjaModel->updateRekapitulasiBs($noBS); // ketika insert batch ruta sukses, maka rekapitulasi BS akan dihitung ulang
            $result = array();
            if ($boolUpdateRekapitulasiBS) {
                // $data_bs = $rutaModel->getAllRuta($noBS);
                $result = $keluargaModel->getAllKeluarga($noBS);
                // $infoBs = $wilayahKerjaModel->getBSPCLKortim($kodeBs);

                // $data = array(
                //     'type' => 'sams_sync_ruta',
                //     'kodeBs' => $kodeBs
                // );

                // $message = $infoBs['nama_pcl'] . " memperbarui data blok sensus " . $infoBs['nama'];

                // if ($nim != $infoBs['nim_kortim']) {
                //     $push->prepareMessageToNim($infoBs['nim_kortim'], 'Data Blok Sensus Diperbarui', $message, $data);
                // }

                return $this->respond($result);
            } else {
                $result = 'IDK';
            }


            return $this->respond($result);
        }
        return $this->respond(null, null, 'WHAT?');
    }

    public function generateSampel($noBS)
    {

        $rutaModel = new RutaModel();
        $result = $rutaModel->getSampelBS($noBS, 5);
        // memasukkan sampel yang terpilih ke tabel datast
        $dataStModel = new DataStModel();
        try {
            $dataStModel->insertDataST($result);
            return $this->respond("Berhasil mendapatkan sampel"); // jika behasil akan mengembalikan data ruta yang terpilih menjadi sampel
        } catch (\Throwable $th) {
            return $this->fail('Gagal menyimpan sampel [duplicate]', 400); // jika tidak berhasil mengembalikan pesan error
        }
    }

    public function hapusSampelBS($noBS)
    {
        $dataStModel = new DataStModel();
        try {
            $dataStModel->hapusDataST($noBS);
            return $this->respond("Berhasil menghapus sampel", 200); // respon berhasil
        } catch (\Throwable $th) {
            return $this->fail('Gagal menghapus sampel', 400); // jika tidak berhasil mengembalikan pesan error
        }
    }

    public function getSampelBS($noBS)
    {
        $dataStModel = new DataStModel();
        try {
            $results = $dataStModel->getSampelByNoBS($noBS);
            if ($results == null) {
                return $this->respondNoContent(); // jika data sampel tidak ditemukan, kembalikan kode 204
            }
            return $this->respond($results, 200); // respon berhasil
        } catch (\Throwable $th) {
            return $this->fail('Gagal mendapatkan data sampel', 400); // jika tidak berhasil mengembalikan pesan error
        }
    }

    public function finalisasiRuta() 
    {
        $rutaModel = new RutaModel();

        $noBS = $this->request->getPost('no_bs');

        $result = $rutaModel->getAllRutaOrderedByKatGenZ($noBS);
        $totalResult = count($result);

        foreach ($result as $key => $ruta) {
            $result[$key]->noUrutEgb = $key + 1;

            $rutaModel->update($ruta->kodeRuta, ['no_urut_ruta_egb' => $result[$key]->noUrutEgb]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $result,
            'count' => $totalResult,
        ]);
    }
}
