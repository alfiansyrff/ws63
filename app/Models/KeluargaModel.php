<?php

namespace App\Models;

use App\Libraries\Keluarga;
use CodeIgniter\Model;

class KeluargaModel extends Model
{
    protected $table            = 'keluarga';
    protected $primaryKey       = 'kode_klg';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];


    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks


    public function parseToArray($keluarga): array
    {
        return [
            'kode_klg' => $keluarga->kodeKlg,
            'SLS' => $keluarga->SLS,
            'no_segmen' => $keluarga->noSegmen,
            'no_bg_fisik' => $keluarga->noBgFisik,
            'no_bg_sensus' => $keluarga->noBgSensus,
            'no_urut_klg' => $keluarga->noUrutKlg,
            'nama_kk' => $keluarga->namaKK,
            'alamat' => $keluarga->alamat,
            'is_genz_ortu' => $keluarga->isGenzOrtu,
            'no_urut_klg_egb' => $keluarga->noUrutKlgEgb,
            'pengl_mkn' => $keluarga->penglMkn,
            'no_bs' => $keluarga->noBS,
        ];
    }
    

    public function addKeluarga(Keluarga $keluarga): bool
    {
        // insert ruta terlebih dahulu
        $rutaModel = new RutaModel();
        // Ulang untuk setiap ruta, simpan ke database rumah tangga
        foreach ($keluarga->ruta as $ruta) {
            $rutaModel->addRuta($ruta);
        }
        // simpan data keluarga ke database keluarga
        $data = $this->parseToArray($keluarga);
        return  $this->db->table('keluarga')->replace($data);

    }
}
