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
        $PosisiPclModel = new PosisiPclModel();

        $object = $PosisiPclModel->getPosisiPcl("222112975");

        return $this->respond($object, 200);
    }

    public function updateLokasiPcl(){
        if (isset($_POST['nim'])) {
            $model = new PosisiPclModel();
			
        
            $nim = (string) $this->request->getPost('nim');
            $latitude = (float) $this->request->getPost('latitude');
            $longitude = (float) $this->request->getPost('longitude');
            $lokus = (string) $this->request->getPost('lokus');

            if ($model->updateLokasiPcl($nim, $latitude, $longitude, $lokus)) {
                return $this->respond("Lokasi berhasil diupdate.", 200);
            }
        }
    }
}
