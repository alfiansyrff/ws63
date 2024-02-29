<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Database\Seeds\RumahTanggaSeeder;
use App\Libraries\Keluarga;
use App\Libraries\Rumahtangga;
use App\Models\DataStModel;
use App\Models\KeluargaModel;
use App\Models\KeluargaRutaModel;
use CodeIgniter\API\ResponseTrait;
use App\Models\WilayahKerjaModel;
use App\Models\RutaModel;


class ListingController extends BaseController
{
    use ResponseTrait;
    public function sinkronisasiRuta()
    {
        try {
            // fungsi ini mencakup insert, update, dan delete ruta
            $keluargaModel = new KeluargaModel();
            $rutaModel = new RutaModel();
            $wilayahKerjaModel = new WilayahKerjaModel();
            $keluargaRutaModel = new KeluargaRutaModel();
            $jsonBody = $this->request->getJSON();

            $idBS = $jsonBody->id_bs;

            // nim pengirim 
            $nim = $jsonBody->nim;
            $json = $jsonBody->json;
            if ($json) {
                $object_array = $json;
                $success = 0;
                foreach ($object_array as $object) {

                    $object = (array) $object;
                    $keluarga = Keluarga::createFromArray($object);
                    // di setiap object, ada nim pencacah. Cek apakah nim pencacah sama dengan nim pengirim request
                    if ($object['nim_pencacah'] == $nim) {
                        if ($object['status'] == 'delete') {
                            $rutaModel->deletedRutaBatch($keluarga);
                            $keluargaModel->deleteKeluarga($keluarga);
                        } else if ($object['status'] == 'insert') {
                            $keluargaModel->addKeluarga($keluarga);
                            $rutaModel->addRutaFromKeluarga($keluarga);
                            $keluargaRutaModel->addKeluargaRutaBatch($keluarga);
                        } else if ($object['status'] == 'update') {
                            $keluargaModel->updateKeluarga($keluarga);
                            foreach ($object['ruta'] as $ruta) {
                                $rutaObj = Rumahtangga::createFromArray((array) $ruta);
                                if ($ruta->status == 'delete') {
                                    if (!$keluargaRutaModel->isRutaInAnotherKeluarga($keluarga->kodeKlg, $rutaObj->kodeRuta)) {
                                        $rutaModel->deleteRuta($rutaObj->kodeRuta);
                                    }
                                    $keluargaRutaModel->deleteKeluargaRuta($keluarga->kodeKlg, $rutaObj->kodeRuta);
                                } else if ($ruta->status == 'insert') {
                                    $rutaModel->addRuta(Rumahtangga::createFromArray((array) $ruta));
                                    $keluargaRutaModel->addKeluargaRuta($object['kode_klg'], $rutaObj->kodeRuta);
                                } else {
                                    $rutaModel->updateRuta(Rumahtangga::createFromArray((array) $ruta));
                                    $keluargaRutaModel->updateKeluargaRuta($object['kode_klg'], $rutaObj->kodeRuta);
                                }
                            }
                        }
                    }
                }
                $boolUpdateRekapitulasiBS = $wilayahKerjaModel->updateRekapitulasiBs($idBS); // ketika insert batch ruta sukses, maka rekapitulasi BS akan dihitung ulang
                $result = array();
                if ($boolUpdateRekapitulasiBS) {
                    $result = $wilayahKerjaModel->getInfoBS($idBS);
                    if ($result == "empty") {
                        return $this->fail("Data berhasil masuk, tetapi kode BS tidak ditemukan", 404);
                    }
                    return $this->respond($result);
                } else {
                    return $this->fail('Gagal melakukan update rekapitulasi BS');
                }
            } else {
                $result = $wilayahKerjaModel->getInfoBS($idBS);
                return $this->respond($result);
            }
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function generateSampel($idBS)
    {

        $rutaModel = new RutaModel();
        $result = $rutaModel->getSampelBS($idBS, 10);
        if (!$result || count($result) == 0) {
            return $this->fail("Data rumah tangga eligible kosong");
        }
        $dataStModel = new DataStModel();
        try {
            $dataStModel->insertDataST($result);
            $wilayahKerjaModel = new WilayahKerjaModel();
            $wilayahKerjaModel->updateStatusBs($idBS, "telah-disampel");
            return $this->respond("Berhasil mendapatkan sampel"); // jika behasil akan mengembalikan data ruta yang terpilih menjadi sampel
        } catch (\Throwable $th) {
            return $this->fail("Data duplicate atau BS belum di finalisasi", 400); // jika tidak berhasil mengembalikan pesan error
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

    public function getSampelBS($idBS)
    {
        $dataStModel = new DataStModel();
        try {
            $results = $dataStModel->getSampelByNoBS($idBS);
            if ($results == null) {
                return $this->respondNoContent(); // jika data sampel tidak ditemukan, kembalikan kode 204
            }
            return $this->respond($results, 200); // respon berhasil
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage(), 400); // jika tidak berhasil mengembalikan pesan error
        }
    }

    // public function finalisasiBS($idBS)
    // {
    //     $rutaModel = new RutaModel();
    //     $result = $rutaModel->getAllRutaOrderedByKatGenZ($idBS);
    //     $totalResult = count($result);
    //     foreach ($result as $key => $ruta) {
    //         $result[$key]->noUrutEgb = $key + 1;
    //         $rutaModel->update($ruta->kodeRuta, ['no_urut_ruta_egb' => $result[$key]->noUrutEgb]);
    //     }

    //     $wilayahKerjaModel = new WilayahKerjaModel();
    //     $wilayahKerjaModel->updateStatusBs($idBS, "listing-selesai");

    //     $response = $wilayahKerjaModel->getInfoBS($idBS);

    //     return $this->respond($response, 200);
    // }

    public function finalisasiBS2($idBS)
    {
        $klgModel = new KeluargaModel();
        $rutaModel = new RutaModel();
        $wilayahKerjaModel = new WilayahKerjaModel();
        if ($wilayahKerjaModel->isWilayahKerjaFinalisasi($idBS)) { // ketika wilayah kerja sudah pernah dilakukan finaliasasi
            $response = $wilayahKerjaModel->getInfoBS($idBS);
            return $this->respond($response, 200);
        }
        if (!$klgModel->processSegmentNumberKeluarga($idBS)) {
            return $this->fail('Gagal memproses nomor keluarga');
        }
        if (!$rutaModel->processSegmentNumberRuta($idBS)) {
            return $this->fail("Gagal memproses nomor rumah tangga");
        }
        $wilayahKerjaModel = new WilayahKerjaModel();
        $wilayahKerjaModel->updateStatusBs($idBS, "listing-selesai");
        $response = $wilayahKerjaModel->getInfoBS($idBS);
        return $this->respond($response, 200);
    }


    public function confirmSampel($kodeRuta)
    {
        $dataStModel = new DataStModel();
        try {
            $dataStModel->updateStatus($kodeRuta);
            return $this->response->setJSON([
                'status' => 'success',
                'msg' => "Berhasil konfirmasi selesai cacah",
            ]);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage(), 400); // jika tidak berhasil mengembalikan pesan error
        }
    }
}
