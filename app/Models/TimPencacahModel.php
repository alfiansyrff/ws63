<?php

namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\Tim;


class TimPencacahModel extends Model
{
    protected $table            = 'timpencacah';
    protected $primaryKey       = 'id_tim';
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

    public function getTim($id_tim): Tim
    {
        $result = $this->find($id_tim);
        $mahasiswaModel = new MahasiswaModel();
        $tim = new Tim(
            $result['id_tim'],
            $result['nama_tim'],
            $mahasiswaModel->getMahasiswa($result['nim_pml']),
            $this->getAnggotaTim($id_tim)
        );
        return $tim;
    }

    public function getAnggotaTim($id_tim): array
    {
        $mahasiswaModel = new MahasiswaModel();
        $list_anggota = $this->getAllAnggota($id_tim);
        $result = $this->find($id_tim);
        $anggota_tim = array();
        foreach ($list_anggota as $anggota) {
            if ($anggota['nim'] != $result['nim_pml']){
                array_push($anggota_tim, $mahasiswaModel->getMahasiswa($anggota['nim']));
            }
        }



        return $anggota_tim;
    }

    public function getAllAnggota($id_tim): array
    {
        $mahasiswaModel = new MahasiswaModel();
        $result = $mahasiswaModel->where('id_tim', $id_tim)->findAll();

        return $result;
    }
}
