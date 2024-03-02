<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use App\Models\TimPencacahModel;
use CodeIgniter\API\ResponseTrait;

class LoginController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        try {
            // KALAU NIM TIDAK MEMPUNYAI WILAYAH KERJA, AKAN 500 ERROR
            $mahasiswaModel = new MahasiswaModel();
            $timModel = new TimPencacahModel();
            $mahasiswa = $mahasiswaModel->getMahasiswaNoDataRuta($this->request->getGet('nim'));
            if (!$mahasiswa)
                return $this->failNotFound('NIM tidak ditemukan');

            if (!password_verify($this->request->getGet('password'), $mahasiswa->password))
                return $this->fail('Password Salah');
            $tim = $timModel->getTim($mahasiswa->id_tim);
            $result = array();
            $dataTim = array();
            $result['nama'] = $mahasiswa->nama;
            $result['nim'] = $mahasiswa->nim;
            $result['isKoor'] = $mahasiswa->isKoor;
            $result['avatar'] = $mahasiswa->foto;
            $result['id_kuesioner'] = 'VKD.PKL56.RT.v1';
            $result['dataTim']['idTim'] = $mahasiswa->id_tim;
            $result['dataTim']['namaTim'] = $tim->nama_tim;
            // $result['isKoor'] ? $result['dataTim']['passPML'] = $tim->nim_pml->password : "";
            $result['wilayah'] = $mahasiswa->wilayah_kerja == null ? "Kosong" : $mahasiswa->wilayah_kerja;
            $result['token'] = $mahasiswa->token;
            if ((!$result['isKoor']) && ($mahasiswa->wilayah_kerja == null)) $result['status'] = 'fail_user';
            else $result['status'] = 'success';

            //Cek apakah merupakan koorTim atau bukan
            if (!$result['isKoor']) {
                $result['dataTim']['nimPML'] = $tim->nim_pml->nim;
                $result['dataTim']['namaPML'] = $tim->nim_pml->nama;
                $result['dataTim']['teleponPML'] = $tim->nim_pml->no_hp;
            } else {
                $result['dataTim']['anggota'] = $tim->anggota;
            }
            return $this->respond($result, 200);
        } catch (\Throwable $th) {
            return  $this->fail($th->getMessage());
        }
    }


    public function getDataTim()
    {
        $timModel = new TimPencacahModel();
        $mahasiswa = new MahasiswaModel();
        $jsonBody = $this->request->getJSON();
        $idTim = $mahasiswa->getIdTimMahasiswaByEmail($jsonBody->email);
        $tim = $timModel->getAllAnggota($idTim);
        return $this->respond($tim, 200);
    }
}
