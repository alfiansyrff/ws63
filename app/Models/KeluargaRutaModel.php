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


    public function addKeluargaRuta($kodeKeluarga, $kodeRuta)
    {
        $temp = [];
        $temp['kode_klg'] = $kodeKeluarga;
        $temp['kode_ruta'] = $kodeRuta;
        $this->db->table('keluarga_ruta')->insert($temp);
    }

    public function updateKeluargaRuta($kodeKeluarga, $kodeRuta)
    {
        $check = $this->where('kode_ruta', $kodeRuta)->where('kode_klg', $kodeKeluarga)->countAllResults();
        if ($check ==0 ) {
            $this->addKeluargaRuta($kodeKeluarga, $kodeRuta);
        }
    }

    public function addKeluargaRutaBatch(Keluarga $keluarga)
    {
        // fungsi ini untuk menambahkan hubungan many to many antra keluarga dan ruta
        // ulang setiap ruta dan dapatkan pasangan kode kaluarga dan kode ruta
        foreach ($keluarga->ruta as $ruta) {
            $check = $this->where('kode_ruta', $ruta->kodeRuta)->where('kode_klg', $keluarga->kodeKlg)->countAllResults();
            if ($check == 0) {
                $this->addKeluargaRuta($keluarga->kodeKlg, $ruta->kodeRuta);
            }
        }
        return true;
    }

    public function deleteKeluargaRuta($kodeKlg, $kodeRuta)
    {
        return $this->where('kode_klg', $kodeKlg)->where('kode_ruta', $kodeRuta)->delete();
    }

    public function getKeluargaRutaByKodeKlg($kodeKlg)
    {
        return  $this->where('kode_klg', $kodeKlg)->findAll();
    }

    public function getKeluargaRutaByKodeRuta($kodeRuta)
    {
        return $this->where('kode_ruta', $kodeRuta)->findAll();
    }


    public function isRutaInAnotherKeluarga($kodeKlg, $kodeRuta)
    {
        return   $this->where('kode_ruta', $kodeRuta)->whereNotIn('kode_klg', [$kodeKlg])->first();
    }
}
