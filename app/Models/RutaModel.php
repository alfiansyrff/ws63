<?php

namespace App\Models;

use App\Libraries\Rumahtangga;
use CodeIgniter\Model;

class RutaModel extends Model
{
    protected $table            = 'rumahtangga';
    protected $primaryKey       = 'kodeRuta';
    // protected $useAutoIncrement = true;
    // protected $returnType       = 'array';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    // protected $allowedFields    = [];


    public function parseToArray($ruta): array
    {
        $data = [
            'kodeRuta' => $ruta->kodeRuta,
            'no_segmen' => $ruta->noSegmen,
            'no_bg_fisik' => $ruta->noBgFisik,
            'no_bg_sensus' => $ruta->noBgSensus,
            'no_urut_rt' => $ruta->noUrutRuta,
            'nama_krt' => $ruta->namaKrt,
            'alamat' => $ruta->alamat,
            'no_bs' => $ruta->noBS,
        ];

        return $data;
    }

    public function getAllRuta($noBS): array
    {
        $result = $this
            ->where('no_bs', $noBS)
            ->findAll();
        return $result;
    }

    public function addRuta(Rumahtangga $ruta): bool
    {
        $data = $this->parseToArray($ruta);
        $bool = $this->db->table('rumahtangga')->replace($data);
        if ($bool) {
            $wilayahKerjaModel = new WilayahKerjaModel();
            // $boolUpdateRekapitulasiBS = $wilayahKerjaModel->updateRekapitulasiBSyInsert($data['no_bs'], 1, 0, 0, 0, 0); // masih perlu disesuaikan
            $boolUpdateRekapitulasiBS = $wilayahKerjaModel->updateRekapitulasiBs($data['no_bs']);
            if ($boolUpdateRekapitulasiBS) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function updateRuta(Rumahtangga $ruta): bool
    {
        $data = $this->parseToArray($ruta);
        return $this->db->table('rumahtangga')->replace($data);
    }

    public function deleteRuta(Rumahtangga $ruta): bool
    {
        return $this->delete(['kodeRuta' => $ruta->kodeRuta]);
    }

    public function getRuta($kodeRuta): Rumahtangga
    {
        $result = $this->find($kodeRuta);

        if (!$result) {
            return null;
        }

        $ruta = new Rumahtangga(
            $result['kodeRuta'],
            $result['noSegmen'],
            $result['noBgFisik'],
            $result['noBgSensus'],
            $result['noUrutRuta'],
            $result['namaKrt'],
            $result['alamat'],
            $result['noBS']
        );

        return $ruta;
    }
}
