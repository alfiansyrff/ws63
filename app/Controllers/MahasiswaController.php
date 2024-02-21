<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class MahasiswaController extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        header('Access-Control-Allow-Origin: *');

        header('Access-Control-Allow-Methods: GET, POST');

        header("Access-Control-Allow-Headers: X-Requested-With");
    }
    public function index()
    {
        //
    }

    public function getPhoto($nim)
    {
        $mahasiswaModel = new MahasiswaModel();
        $mhs = $mahasiswaModel->find($nim);


        if (!$mhs) {
            return $this->failNotFound('NIM mahasiswa tidak ditemukan.');
        }

        $filePhoto = 'images/' . $mhs['foto'];

        if (file_exists($filePhoto)) {
            $mime = mime_content_type($filePhoto);
            header('Content-Length: ' . filesize($filePhoto));
            header("Content-Type: $mime");
            header('Content-Disposition: inline; file$filePhoto="' . $filePhoto . '";');
            readfile($filePhoto);
            exit();
        } else {
            return $this->failNotFound('Foto mahasiswa tidak ditemukan.');
        }
    }
}
