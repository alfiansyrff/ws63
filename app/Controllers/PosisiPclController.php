<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\LokasiModel;
use App\Models\PosisiPclModel;

class PosisiPclController extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        if (isset($_POST['nim'])) {
            $PosisiPclModel = new PosisiPclModel();
            $nim = (string) $this->request->getPost('nim');
            $existingData = $PosisiPclModel->find($nim);

            if (!$existingData) {
                // Jika NIM tidak ditemukan, kembalikan respons 404
                return $this->failNotFound('NIM tidak ditemukan');
            } else {
                $object = $PosisiPclModel->getPosisiPcl($nim);
                return $this->respond($object, 200);
            }
        } else {
            return $this->fail("Internal server error.");
        }
    }

    public function updateLokasiPcl()
    {
        $jsonBody = $this->request->getJSON();
        $nim = (string) $jsonBody->nim;
        $latitude = (float) $jsonBody->latitude;
        $longitude = (float) $jsonBody->longitude;
        $akurasi = (float) $jsonBody->akurasi;
        if ($nim) {
            $model = new PosisiPclModel();
            // $existingData = $model->find($nim);

            // if (!$existingData) {
            //     // Jika NIM tidak ditemukan, kembalikan respons 404
            //     return $this->failNotFound('NIM tidak ditemukan');
            // }

            if ($model->updateLokasiPcl($nim, $latitude, $longitude, $akurasi)) {
                return $this->respond("Lokasi berhasil diupdate.", 200);
            }
        }
        // die;
        return $this->fail("Internal server error.");
    }
}
