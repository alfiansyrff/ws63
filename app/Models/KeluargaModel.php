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
            'id_bs' => $keluarga->idBS,
            'nim_pencacah' => $keluarga->nimPencacah
        ];
    }


    public function addKeluarga(Keluarga $keluarga): bool
    {
        // simpan data keluarga ke database keluarga
        $data = $this->parseToArray($keluarga);
        return  $this->db->table('keluarga')->insert($data);
    }
    // public function addKeluarga(Keluarga $keluarga): bool
    // {
    //     $data = $this->parseToArray($keluarga);
    //     $kodeKlg = $keluarga->kodeKlg;

    //     $existingKeluarga = $this->find($kodeKlg);

    //     if ($existingKeluarga) {
    //         $nimPencacahMatches = empty($existingKeluarga->nimPencacah) || $this->isNimPencacahMatch($keluarga->nimPencacah, $kodeKlg);

    //         if (!$nimPencacahMatches) {
    //             return false;
    //         }

    //         $this->update($existingKeluarga['kode_klg'], $data);
    //     } else {
    //         return false;
    //     }

    //     return true;
    // }


    // public function updateKeluarga(Keluarga $keluarga): bool
    // {
    //     $data = $this->parseToArray($keluarga);
    //     $kodeKlg = $keluarga->kodeKlg;

    //     $existingKeluarga = $this->find($kodeKlg);

    //     if ($existingKeluarga) {
    //         $nimPencacahMatches = $this->isNimPencacahMatch($keluarga->nimPencacah, $kodeKlg);

    //         if (!$nimPencacahMatches) {
    //             return false;
    //         }

    //         $this->update($existingKeluarga['kode_klg'], $data);
    //     } else {
    //         return false;
    //     }

    //     return true;
    // }

    // public function deleteRuta(Keluarga $keluarga): bool
    // {
    //     $data = $this->parseToArray($keluarga);
    //     $kodeKlg = $keluarga->kodeKlg;

    //     $existingKeluarga = $this->find($kodeKlg);

    //     if ($existingKeluarga) {
    //         $nimPencacahMatches = $this->isNimPencacahMatch($keluarga->nimPencacah, $kodeKlg);

    //         if (!$nimPencacahMatches) {
    //             return false;
    //         }

    //         return $this->delete(['kode_ruta' => $kodeRuta]);
    //     } else {
    //         return false;
    //     }

    // }

    // private function isNimPencacahMatch($nimPencacah, $kodeKlg): bool
    // {
    //     $keluarga = $this->find($kodeKlg);

    //     return $keluarga && $keluarga['nim_pencacah'] == $nimPencacah;
    // }

    public function updateKeluarga(Keluarga $keluarga)
    {
        $data = $this->parseToArray($keluarga);
        $check = $this->where('kode_klg', $keluarga->kodeKlg)->first();
        if ($check) {
            return  $this->db->table('keluarga')->replace($data);
        } else {
            return true;
        }
    }

    public function deleteKeluarga(Keluarga $keluarga)
    {
        return $this->delete(['kode_ruta' => $keluarga->kodeKlg]);
    }

    public function getAllKeluarga($id_bs)
    {
        $listKeluarga = [];
        $listKeluarga = $this->where('id_bs', $id_bs)->findAll();
        $listKeluargaObject = [];
        $keluargaRutaModel = new KeluargaRutaModel();
        $rutaModel = new RutaModel();
        if (sizeof($listKeluarga) != 0) {
            foreach ($listKeluarga as $keluarga) {
                $keluargaRutaTemp = $keluargaRutaModel->getKeluargaRutaByKodeKlg($keluarga['kode_klg']);
                // lalu ambil semua ruta dari keluarga ruta temp
                $keluarga['ruta'] = [];
                foreach ($keluargaRutaTemp as $keluargaRuta) {
                    array_push($keluarga['ruta'], $rutaModel->getRutaReturnArray($keluargaRuta['kode_ruta']));
                }
                array_push($listKeluargaObject, Keluarga::createFromArray($keluarga));
            }
        }
        return $listKeluargaObject;
    }

    public function getKeluargaByRuta($kodeRuta)
    {

        $keluargaRutaModel = new KeluargaRutaModel();
        $keluargaRuta = $keluargaRutaModel->getKeluargaRutaByKodeRuta($kodeRuta);
        $listKodeKeluarga = [];

        foreach ($keluargaRuta as $temp) {
            array_push($listKodeKeluarga, $temp['kode_klg']);
        };

        $listKeluarga = $this->whereIn('kode_klg', $listKodeKeluarga)->findAll();
        return $listKeluarga;
    }
}
