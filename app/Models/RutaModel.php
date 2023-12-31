<?php

namespace App\Models;

use App\Libraries\Rumahtangga;
use CodeIgniter\Model;

class RutaModel extends Model
{
    protected $table            = 'rumahtangga';
    protected $primaryKey       = 'kode_ruta';
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
        $results = $this->where('no_bs', $noBS)->findAll();
        if (!$results) {
            return [];
        }

        // ubag dari array biasa menjadi array of objek RumahTangga
        $listRuta = [];
        foreach ($results as $result) {
            $rutaTemp = Rumahtangga::createFromArray($result); // mengembalikan dalam bentuk objek
            array_push($listRuta, $rutaTemp);
        }
        return $listRuta;
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



    public function getNoUrutEgb($noBS)
    {
        //Fungsi untuk memberikan nilai no_urut_rt_egb secara otomatis pada setiap blok sensus
        $data =  $this->where('no_bs', $noBS)
            ->where('is_genz_ortu', '1')
            ->orderBy('no_urut_rt_egb', 'DESC')
            ->first(); // mendapatkan no_urut_rt_egb terakhir di blok sensus yang bersangkutan
        return $data['no_urut_rt_egb'] + 1;
    }


    public function getSampelBS($noBS, $sampleSize) // Circular sistematic 
    {
        // mengambail semua ruta eligible dari BS yang bersangkutan
        $ruta = $this->where('no_bs', $noBS)->where('is_genz_ortu', '1')->orderBy('jml_genz', 'DESC')->orderBy('no_urut_rt_egb', 'asc')->findAll();

        // Hitung interval sampling
        $interval = count($ruta) / $sampleSize;
        // Pilih posisi awal dimulai dari data pertama
        $startPosition = 1;
        // Inisialisasi array untuk menyimpan sampel
        $samples = [];
        for ($i = 0; $i < $sampleSize; $i++) {
            // Hitung posisi sampel
            $position = ($startPosition + $i * $interval) % count($ruta);
            // Ambil sampel pada posisi
            $samples[] = $ruta[$position];
        }

        // karena sampling dengan circular, maka sampel harus diurutkan lagi
        $noUrutRt = array_column($samples, 'no_urut_rt');
        array_multisort($noUrutRt, SORT_ASC, $samples);

        //sample terurut di kembalikan
        return $samples;
    }
}
