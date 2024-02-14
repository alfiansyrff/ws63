<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Mahasiswa;
use App\Models\TimPencacahModel;
use App\Models\WilayahKerjaModel;

class MahasiswaModel extends Model
{
    protected $table            = 'mahasiswa';
    protected $primaryKey       = 'nim';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];



    public function getMahasiswa($nim)
    {
        $result = $this->find($nim);
        if (!$result) {
            return null;
        }
        $wilayahKerjaModel = new WilayahKerjaModel();
        $listWilayahKerja = [];
        $listWilayahKerja =  $wilayahKerjaModel->getWilayahKerja($result['nim']);
        $timModel = new TimPencacahModel();
        $tim = $timModel->where('id_tim', $result['id_tim'])->first();
        $isKoor = $tim['nim_pml'] == $nim ? true : false;
        $mahasiswa = new Mahasiswa(
            $result['nim'],
            $result['nama'],
            $result['no_hp'],
            $result['alamat'],
            $result['email'],
            $result['password'],
            $result['foto'],
            $result['id_tim'],
            $listWilayahKerja,
            $isKoor,
            $tim['token']
        );
        return $mahasiswa;
    }

    public function getIdTimMahasiswa($nim)
    {
        $mhs =  $this->where('nim', $nim)->first();
        if ($mhs != null) {
            return $mhs['id_tim'];
        } else {
            return null;
        }
    }

    public function getIdTimMahasiswaByEmail($email)
    {
        $mhs =  $this->where('email', $email)->first();
        if ($mhs != null) {
            return $mhs['id_tim'];
        } else {
            return null;
        }
    }

}
