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

        //inisialisasi Wilayah Kerja
        // $riset_Sby = [1, 3];
        // $riset_12 = [4, 62];
        // $riset_3 = [63, 94];
        // $riset_4 = [95, 125];

        // if (((int) $result['id_tim'] >= $riset_12[0] && (int) $result['id_tim'] <= $riset_12[1]) || (int) $result['id_tim'] == 991 || (int) $result['id_tim'] == 992) {
        //     $wilayahKerjaModel = new WilayahKerjaModelR12();
        //     $sampelModel = new SampelModelR12();
        // } else if (((int) $result['id_tim'] >= $riset_3[0] && (int) $result['id_tim'] <= $riset_3[1]) || (int) $result['id_tim'] == 993) {
        //     $wilayahKerjaModel = new WilayahKerjaModelR3();
        //     $sampelModel = new SampelModelR3();
        // } else if (((int) $result['id_tim'] >= $riset_4[0] && (int) $result['id_tim'] <= $riset_4[1]) || (int) $result['id_tim'] == 994 || ((int) $result['id_tim'] >= 441 && (int) $result['id_tim'] <= 444)) {
        //     $wilayahKerjaModel = new WilayahKerjaModelR4_2();
        //     $sampelModel = new SampelModelR4();
        // } else if (((int) $result['id_tim'] >= $riset_Sby[0] && (int) $result['id_tim'] <= $riset_Sby[1]) || (int) $result['id_tim'] == 995) {
        //     $wilayahKerjaModel = new WilayahKerjaModelSby();
        //     $sampelModel = new SampelModelSby();
        // }
    
        
        $wilayahKerjaModel = new WilayahKerjaModel();
        $listWilayahKerja =  $wilayahKerjaModel->getWilayahKerja($result['nim']);
        // $wilayah_kerja = array();
        // // // $total_terkirim = 0;
        // foreach ($listWilayahKerja as $wilayah) {
        //     array_push($wilayah_kerja, $wilayahKerjaModel->getWilayahKerja($wilayah['id']));
        //     // $total_terkirim += $wilayahKerjaModel->getJumlahTerkirim($wilayah['id']);
        // }
   
        $timModel = new TimPencacahModel();
        $isKoor = $timModel->where('nim_pml', $nim)->find() ? true : false;
        // dd($getInfoTim);
        // $beban_kerja = $sampelModel->getBebanKerja($nim);
        // if ($beban_kerja > 0) {
        //     $total_progress = (int) $total_terkirim / $beban_kerja;
        // } else {
        //     $total_progress = 0;
        // }
        // echo json_encode($listWilayahKerja);
        // die();
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
            // $total_progress, 
            $isKoor
        );
    

        return $mahasiswa;
    }
}
