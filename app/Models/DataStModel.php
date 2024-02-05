<?php

namespace App\Models;

use App\Libraries\Rumahtangga;
use App\Libraries\Sampel;
use CodeIgniter\Model;
use CodeIgniter\API\ResponseTrait;
use PhpParser\Node\Stmt\TryCatch;

class DataStModel extends Model
{
    protected $table = 'datast';
    protected $primaryKey = 'kode_ruta';
    // protected $useAutoIncrement = true;
    // protected $returnType       = 'array';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields = ['id_bs', 'kode_ruta', 'status'];


    // Fungsi untuk menyimpan hasil pengambilan sampel dengan argumen array dari ruta terpilih
    public function insertDataST($rutaArray)
    {
        $sampels = [];
        // menyiapkan array untuk insert batch (mengambil kode_ruta dan no_bs dari rutaArray)
        foreach ($rutaArray as $ruta) {
            $arrTemp = [];
            $arrTemp['no_bs'] = $ruta['no_bs'];
            $arrTemp['kode_ruta'] = $ruta['kode_ruta'];
            // $arrTemp['status'] = "Menunggu";
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

    public function getSampelByNoBS($noBS)
    {
        ;
        // fungsi untuk mendapatkan list sampel dari suatu BS
        $query = $this->join('rumahtangga', 'datast.kode_ruta = rumahtangga.kode_ruta', 'inner')->where('datast.no_bs', $noBS)->findAll();
        $results = [];
        $keluargaModel = new KeluargaModel();
        foreach ($query as $data) {
            $data['keluarga'] = $keluargaModel->getKeluargaByRuta($data['kode_ruta']);
            array_push($results, Sampel::createFromArrayRutaKeluarga($data));
        }
        return $results;
    }

    public function updateStatus($kodeRuta)
    {
        $existingRuta = $this->find($kodeRuta);

        return $this->update($existingRuta['status'], '2');
    }
}
