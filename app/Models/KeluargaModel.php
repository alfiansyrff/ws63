<?php

namespace App\Models;

use App\Libraries\Keluarga;
use CodeIgniter\Model;
use PhpParser\Node\Stmt\TryCatch;

class KeluargaModel extends Model
{
    protected $table            = 'keluarga';
    protected $primaryKey       = 'kode_klg';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_klg', 'SLS', 'no_segmen', 'no_bg_fisik', 'no_bg_sensus', 'no_urut_klg', 'nama_kk', 'alamat', 'is_genz_ortu', 'no_urut_klg_egb', 'pengl_mkn', 'id_bs', 'nim_pencacah'];


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
        $data = $this->parseToArray($keluarga);
        try {
            $result = $this->db->table('keluarga')->insert($data);

            if ($result) {
                $lastInsertedID = $this->db->insertID();
                // You can use $lastInsertedID as needed
            }

            return $result;
        } catch (\Exception $e) {
            log_message('error', 'Error adding keluarga: ' . $e->getMessage());
            return false;
        }
        
    }


    public function updateKeluarga(Keluarga $keluarga)
    {
        $data = $this->parseToArray($keluarga);
        // $check = $this->where('kode_klg', $keluarga->kodeKlg)->first();
        if (true) {
            return  $this->db->table('keluarga')->replace($data);
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

        try {
            $keluargaRutaModel = new KeluargaRutaModel();
            $keluargaRuta = $keluargaRutaModel->getKeluargaRutaByKodeRuta($kodeRuta);
            $listKodeKeluarga = [];

            foreach ($keluargaRuta as $temp) {
                array_push($listKodeKeluarga, $temp['kode_klg']);
            };

            $listKeluarga = $this->whereIn('kode_klg', $listKodeKeluarga)->findAll();
            return $listKeluarga;
        } catch (\Throwable $th) {
            echo json_encode($th->getMessage());
            die;
        }
    }

    public function addStringNoUrutBangunan($noUrut, $shifter)
    {
        $angka = intval($noUrut);
        $non_numeric = preg_replace('/[0-9]/', '', $noUrut);
        $hasil = (string)($angka + $shifter);
        return $hasil . $non_numeric;;
    }

    public function processSegmentNumberKeluarga($idBS)
    {
        try {
            $query = $this->db->query("SELECT DISTINCT no_segmen FROM keluarga WHERE id_bs = ? ORDER BY no_segmen", [$idBS]);
            $result = $query->getResult();
            $no_segmen_array = array_column($result, 'no_segmen');

            $shifter_fisik = 0;
            $shifter_sensus = 0;
            $shifter_urut = 0;
            foreach ($no_segmen_array as $segmen) {
                $data_segmen = $this->where('id_bs', $idBS)->where('no_segmen', $segmen)->orderBy('no_urut_klg')->findAll();
                $query = $this->db->query("SELECT DISTINCT no_bg_fisik FROM keluarga WHERE id_bs = ? AND no_segmen = ?", [$idBS, $segmen]);
                $lastNoBgFisik = $this->where('id_bs',$idBS)->where('no_segmen', $segmen)->orderBy('no_bg_fisik','DESC')->select('no_bg_fisik')->first();
                echo json_encode($lastNoBgFisik);
                die;
                $add_shifter_fisik = count($query->getResult());
                $query = $this->db->query("SELECT DISTINCT no_bg_sensus FROM keluarga WHERE id_bs = ? AND no_segmen = ?", [$idBS, $segmen]);
                $add_shifter_sensus = count($query->getResult());
                $add_shifter_urut = count($data_segmen);
                if ($shifter_fisik != 0 || $shifter_sensus != 0) {
                    foreach ($data_segmen as $data) {
                        $data['no_bg_fisik'] = $this->addStringNoUrutBangunan($data['no_bg_fisik'], $shifter_fisik);
                        $data['no_bg_sensus'] = $this->addStringNoUrutBangunan($data['no_bg_sensus'], $shifter_sensus);
                        $data['no_urut_klg'] = $this->addStringNoUrutBangunan($data['no_urut_klg'], $shifter_urut);
                        if ($data['no_urut_klg_egb'] != null) {
                            $data['no_urut_klg_egb'] = $this->addStringNoUrutBangunan($data['no_urut_klg_egb'], $shifter_urut);
                        }
                        $this->replace($data);
                    }
                }
                $shifter_fisik += $add_shifter_fisik;
                $shifter_sensus += $add_shifter_sensus;
                $shifter_urut += $add_shifter_urut;
            }
        } catch (\Throwable $th) {
            echo json_encode($th->getMessage());
            die;
        }
    }

    public function getAllKeluargaOrderedByNoKeluarga($id_bs)
    {
        $listKeluarga = [];
        $listKeluarga = $this->where('id_bs', $id_bs)
        ->where('is_genz_ortu !=', 0)
        ->orderBy('no_urut_klg', 'asc')
        ->findAll();
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
        // $listKlg = [];
        // foreach ($results as $result) {
        //     $klg = Keluarga::createFromArray($result); 
        //     array_push($listKlg, $klg);
        // }
        // return $listKlg;
    }
}
