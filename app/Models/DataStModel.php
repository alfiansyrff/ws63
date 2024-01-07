<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\API\ResponseTrait;
use PhpParser\Node\Stmt\TryCatch;

class DataStModel extends Model
{
    protected $table            = 'datast';
    protected $primaryKey       = 'kode_ruta';
    // protected $useAutoIncrement = true;
    // protected $returnType       = 'array';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    // protected $allowedFields    = [];


    // Fungsi untuk menyimpan hasil pengambilan sampel dengan argumen array dari ruta terpilih
    public function insertDataST($rutaArray)
    {
        $sampels = [];
        // menyiapkan array untuk insert batch (mengambil kode_ruta dan no_bs dari rutaArray)
        foreach ($rutaArray as $ruta) {
            $arrTemp = [];
            $arrTemp['no_bs'] = $ruta['no_bs'];
            $arrTemp['kode_ruta'] = $ruta['kode_ruta'];
            array_push($sampels, $arrTemp);
        }
        // Menyimpan ke database
        return $this->db->table('datast')->insertBatch($sampels);
    }

    public function hapusDataST($noBS)
    {
        // melakukan penghapusan semua ruta yang memiliki no_bs bersangkutan
        return ($this->db->table('datast')->where('no_bs', $noBS)->delete()); 
    }
}
