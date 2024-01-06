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
            'kode_ruta' => $ruta->kodeRuta,
            'no_segmen' => $ruta->noSegmen,
            'no_bg_fisik' => $ruta->noBgFisik,
            'no_bg_sensus' => $ruta->noBgSensus,
            'no_urut_rt' => $ruta->noUrutRuta,
            'nama_krt' => $ruta->namaKrt,
            'alamat' => $ruta->alamat,
            'no_bs' => $ruta->noBS,
            'is_genz_ortu' => $ruta->isGenzOrtu,
            'long' => $ruta->long,
            'lat' => $ruta->lat,
            'catatan' => $ruta->catatan
        ];

        // menambahkan 'no_urut_rt_egb' hanya jika nilainya bukan 0
        if ($ruta->noUrutRtEgb != 0) {
            $data['no_urut_rt_egb'] = $ruta->noUrutRtEgb;
        }
        //menambahkan jumlah genz jika hanya is_genz_ortu bernilai 1
        if ($ruta->isGenzOrtu == 1) {
            $data['jml_genz'] = $ruta->jmlGenz;
        }

        return $data;
    }

    public function getAllRuta($noBS): array
    {
        $result = $this->where('no_bs', $noBS)->findAll();
        if (!$result) {
            return [];
        }
        return $result;
    }

    public function addRuta(Rumahtangga $ruta): bool
    {
        $data = $this->parseToArray($ruta);
        $bool = $this->db->table('rumahtangga')->replace($data);
        if ($bool) {
            return true;
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
        return $this->delete(['kode_ruta' => $ruta->kodeRuta]);
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
            $result['noBS'],
            $result['isGenzOrtu'],
            $result['jmlGenz'],
            $result['noUrutRtEgb'],
            $result['long'],
            $result['lat'],
            $result['catatan']
        );

        return $ruta;
    }


    //Fungsi untuk memberikan nilai no_urut_rt_egb secara otomatis pada setiap blok sensus
    public function getNoUrutEgb($noBS)
    {

        $data =  $this->where('no_bs', $noBS)
            ->where('is_genz_ortu', '1')
            ->orderBy('no_urut_rt_egb', 'DESC')
            ->first();
        return $data['no_urut_rt_egb'] + 1;
    }
}
