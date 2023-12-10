<?php

namespace App\Controllers;

use App\Libraries\PosisiPcl;
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
            $object = $PosisiPclModel->getPosisiPcl($nim);

            return $this->respond($object, 200);
        } else {
            return $this->failNotFound('NIM tidak ditemukan');
        }
    }

    public function updateLokasiPcl(){
        
        if (isset($_POST['nim'])) {
            $model = new PosisiPclModel();
			
            $nim = (string) $this->request->getPost('nim');
            $latitude = (float) $this->request->getPost('latitude');
            $longitude = (float) $this->request->getPost('longitude');
            $lokus = (string) $this->request->getPost('lokus');

            $existingData = $model->find($nim);

        if (!$existingData) {
            // Jika NIM tidak ditemukan, kembalikan respons 404
            return $this->failNotFound('NIM tidak ditemukan');
        }

            if ($model->updateLokasiPcl($nim, $latitude, $longitude, $lokus)) {
                return $this->respond("Lokasi berhasil diupdate.", 200);
            }
        }
        return $this->fail("Internal server error.");
    }
}
