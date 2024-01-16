<?php

namespace App\Models;

use App\Libraries\Keluarga;
use CodeIgniter\Model;

class KeluargaRutaModel extends Model
{
    protected $table            = 'keluarga_ruta';
    protected $primaryKey       = ['kode_klg', 'kode_ruta'];
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];


    public function addKeluargaRuta(Keluarga $keluarga)
    {
        // fungsi ini untuk menambahkan hubungan many to many antra keluarga dan ruta
        // ulang setiap ruta dan dapatkan pasangan kode kaluarga dan kode ruta
        foreach ($keluarga->ruta as $ruta) {
            $temp = [];
            $temp['kode_klg'] = $keluarga->kodeKlg;
            $temp['kode_ruta'] = $ruta->kodeRuta;
            $this->db->table('keluarga_ruta')->replace($temp);
        }

        return true;
    }


    public function deletedKeluargaRuta(Keluarga $keluarga)
    {
        foreach ($keluarga->ruta as $ruta) {
            $this->where('kode_klg', $keluarga->kodeKlg)
            ->where('kode_ruta', $ruta->kodeRuta)
            ->delete();
        }
        return true;
    }

    public function getKeluargaRutaByKodeKlg($kodeKlg){
        return  $this->where('kode_klg',$kodeKlg)->findAll();    
    }
}
