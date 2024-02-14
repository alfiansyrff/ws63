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
        // simpan data keluarga ke database keluarga
        $data = $this->parseToArray($keluarga);
        return  $this->db->table('keluarga')->insert($data);
    }


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
        $query = $this->db->query("SELECT DISTINCT no_segmen FROM keluarga WHERE id_bs = ? ORDER BY no_segmen", [$idBS]);
        $result = $query->getResult();
        $no_segmen_array = array_column($result, 'no_segmen');

        $shifter_fisik = 0;
        $shifter_sensus = 0;
        $shifter_urut = 0;
        foreach ($no_segmen_array as $segmen) {
            $data_segmen = $this->where('id_bs', $idBS)->where('no_segmen', $segmen)->orderBy('no_urut_klg')->findAll();
            $query = $this->db->query("SELECT DISTINCT no_bg_fisik FROM keluarga WHERE id_bs = ? AND no_segmen = ?", [$idBS, $segmen]);
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

        echo json_encode("test");
        die;





        // $keluarga_list = $this->where('id_bs', $idBS)->orderBy('no_segmen')->orderBy('no_urut_klg')->findAll();
        // $currentSegment = '';
        // $currentNumber = 1;
        // $currentNumberEgb = 1;
        // $noUrutBangunanFisik = 0;
        // $noUrutBangunanSensus = 0;
        // $prevBgnFisik = 0;
        // $prevBgnSensus = 0;

        // $hasil = [];
        // foreach ($keluarga_list as $row) {
        //     // Menghubungkan nomor urut jika bukan segmen pertama
        //     $row['no_urut_klg'] = (string)$currentNumber;
        //     $currentNumber++;


        //     if ($prevBgnFisik != $row['no_bg_fisik'] || $currentSegment != $row['no_segmen']) {
        //         $noUrutBangunanFisik++;
        //         $prevBgnFisik = $row['no_bg_fisik'];
        //         $row['no_bg_fisik'] = (string)$noUrutBangunanFisik;
        //     } else {
        //         $row['no_bg_fisik'] = (string)$noUrutBangunanFisik;
        //     }


        //     if ($prevBgnSensus != $row['no_bg_sensus'] || $currentSegment != $row['no_segmen']) {
        //         $noUrutBangunanSensus++;
        //         $prevBgnSensus = $row['no_bg_sensus'];
        //         $row['no_bg_sensus'] = (string)$noUrutBangunanSensus;
        //     } else {
        //         $row['no_bg_sensus'] = (string)$noUrutBangunanSensus;
        //     }


        //     if ($row['no_urut_klg_egb'] != null) {
        //         $row['no_urut_klg_egb'] = $currentNumberEgb;
        //         $currentNumberEgb++;
        //     }

        //     if ($currentSegment != $row['no_segmen']) {
        //         $currentSegment = $row['no_segmen'];
        //     }
        //     // Menambahkan data ke array
        //     array_push($hasil, $row);
        // }

        // foreach ($hasil as $row) {
        //     $this->replace($row);
        // }

        echo json_encode($hasil);
        die;
    }
}
