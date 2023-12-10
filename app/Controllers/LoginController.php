<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use CodeIgniter\API\ResponseTrait;

class LoginController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $mahasiswaModel = new MahasiswaModel();
        $mahasiswa = $mahasiswaModel->getMahasiswa($this->request->getGet('nim'));

        if (!$mahasiswa)
            return $this->failNotFound('NIM tidak ditemukan');

        if (!password_verify($this->request->getGet('password'), $mahasiswa->password))
            return $this->fail('Password Salah');

        return $this->respond($mahasiswa, 200);
    }
}
