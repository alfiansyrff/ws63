<?php

namespace App\Models;

use App\Libraries\Keluarga;
use App\Libraries\RumahTangga;
use App\Libraries\Sampel;
use CodeIgniter\Model;

class RutaModel extends Model
{
    protected $table            = 'rumahtangga';
    protected $primaryKey       = 'kode_ruta';
    // protected $useAutoIncrement = true;
    // protected $returnType       = 'array';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields    = ['kode_ruta', 'no_urut_ruta', 'kk_or_rt', 'nama_krt', 'is_genz_ortu','kat_genz', 'no_urut_ruta_egb', 'long', 'lat', 'catatan'];


    public function parseToArray($ruta): array
    {
        $data = [
            'kode_ruta' => $ruta->kodeRuta,
            'no_urut_ruta' => $ruta->noUrutRuta,
            'kk_or_krt' => $ruta->kkOrKrt,
            'nama_krt' => $ruta->namaKrt,
            'is_genz_ortu' => $ruta->isGenzOrtu,
            'kat_genz' => $ruta->katGenz,
            'long' => $ruta->long,
            'lat' => $ruta->lat,
            'catatan' => $ruta->catatan,
            'no_bs' => $ruta->noBS,
        ];


        // menambahkan 'no_urut_rt_egb' hanya jika nilainya bukan 0
        // if ($ruta->noUrutRtEgb != 0) {
        //     $data['no_urut_rt_egb'] = $ruta->noUrutRtEgb;
        // }
        //menambahkan jumlah genz jika hanya is_genz_ortu bernilai 1
        // if ($ruta->isGenzOrtu == 1) {
        //     $data['jml_genz'] = $ruta->jmlGenz;
        // }

        return $data;
    }

    public function getAllRuta($noBS): array
    {
        $results = $this->where('no_bs', $noBS)
        // ->orderBy('kat_genz', 'asc')
        ->findAll();

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

    public function getAllRutaOrderedByKatGenZ($noBS): array
    {
        $results = $this->where('no_bs', $noBS)
        ->where('kat_genz IS NOT NULL', null, false)
        ->orderBy('kat_genz', 'asc')
        ->findAll();

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

    public function deletedRutaBatch(Keluarga $keluarga)
    {
        foreach ($keluarga->ruta as $ruta) {
            return $this->delete(['kode_ruta' => $ruta->kodeRuta]);
        }
        return true;
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

    public function getRutaReturnArray($kodeRuta)
    {
        return $this->find($kodeRuta);
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
        $keluargaModel = new KeluargaModel();
        $listRuta = [];
        $ruta1 = [];
        $ruta2 = [];
        $ruta3 = [];
        $ruta1 = $this->where('no_bs', $noBS)->whereNotIn('is_genz_ortu', [0])->where('kat_genz', '1')->findAll();
        // echo "test";
        // die;
  
        $ruta2 = $this->where('no_bs', $noBS)->whereNotIn('is_genz_ortu', [0])->where('kat_genz', '2')->findAll();
        $ruta3 = $this->where('no_bs', $noBS)->whereNotIn('is_genz_ortu', [0])->where('kat_genz', '3')->findAll();
        $listRuta = array_merge($ruta1, $ruta2, $ruta3);

        // Hitung interval sampling
        $interval = count($listRuta) / $sampleSize;
        // Pilih posisi awal dimulai dari data pertama
        $startPosition = 1;
        // Inisialisasi array untuk menyimpan sampel
        $samples = [];
        for ($i = 0; $i < $sampleSize; $i++) {
            // Hitung posisi sampel
            $position = ($startPosition + $i * $interval) % count($listRuta);
            // Ambil sampel pada posisi
            $samples[] = $listRuta[$position];
        }


        // karena sampling dengan circular, maka sampel harus diurutkan lagi
        $noUrutRt = array_column($samples, 'no_urut_ruta');
        array_multisort($noUrutRt, SORT_ASC, $samples);

        $semiResult = [];
        foreach ($samples as $sample) {
            $sample['keluarga'] = $keluargaModel->getKeluargaByRuta($sample['kode_ruta']);
            // $sample['status'] = 'Menunggu';
            array_push($semiResult, $sample);
        }

        // $result = [];
        // foreach ($semiResult as $item) {
        //     array_push($result, Sampel::createFromArrayRutaKeluarga($item));
        // }
        //sample terurut di kembalikan
        return $semiResult;
    }
}
