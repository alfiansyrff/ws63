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
    protected $allowedFields    = ['kode_ruta', 'no_urut_ruta', 'kk_or_rt', 'nama_krt', 'is_genz_ortu', 'kat_genz', 'no_urut_ruta_egb', 'long', 'lat', 'catatan'];


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

    public function addRutaFromKeluarga(Keluarga $keluarga)
    {
        foreach ($keluarga->ruta as $ruta) {
            $this->addRuta($ruta);
        }
    }

    public function updateRuta(Rumahtangga $ruta): bool
    {
        try {
            $data = $this->parseToArray($ruta);
            $check = $this->where('kode_ruta', $ruta->kodeRuta)->first();
            if ($check) {
                $bool = $this->db->table('rumahtangga')->replace($data);
            }
            return true;
        } catch (\Throwable $th) {
            return $this->respond->fail('Terjadi error saat melakukan update ruta');
        }
    }

    // public function addRutaFromKeluarga(Keluarga $keluarga)
    // {
    //     foreach ($keluarga->ruta as $ruta) {
    //         $this->addRuta($ruta);
    //     }
    // }

    public function deleteRuta($kodeRuta): bool
    {
        return $this->delete(['kode_ruta' => $kodeRuta]);
    }

    public function deletedRutaBatch(Keluarga $keluarga)
    {
        $keluargaRutaModel = new KeluargaRutaModel();
        foreach ($keluarga->ruta as $ruta) {
            if (!$keluargaRutaModel->isRutaInAnotherKeluarga($keluarga->kodeKlg, $ruta->kodeRuta)) {
                // if digunakan untuk mengecek apakah ruta juga diacu oleh kelaurga lain atau tidak, jika tidak maka ruta akan terhapus
                return $this->delete(['kode_ruta' => $ruta->kodeRuta]);
            }
        }
        return true;
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
        $ruta2 = $this->where('no_bs', $noBS)->whereNotIn('is_genz_ortu', [0])->where('kat_genz', '2')->findAll();
        $ruta3 = $this->where('no_bs', $noBS)->whereNotIn('is_genz_ortu', [0])->where('kat_genz', '3')->findAll();
        $listRuta = array_merge($ruta1, $ruta2, $ruta3);

        // Hitung interval sampling
        $interval = count($listRuta) / $sampleSize;
        // Inisialisasi array untuk menyimpan posisi sampel yang sudah dipilih
        $selectedPositions = [];
        // Pilih posisi awal dimulai dari data pertama
        $startPosition = mt_rand(0, count($listRuta) - 1);
        // Inisialisasi array untuk menyimpan sampel
        $samples = [];
        for ($i = 0; $i < $sampleSize; $i++) {
            // Hitung posisi sampel
            $position = ($startPosition + $i * $interval) % count($listRuta);
            // Pastikan posisi sampel belum terpilih sebelumnya
            while (in_array($position, $selectedPositions)) {
                $position = ($position + 1) % count($listRuta); // Pindah ke posisi berikutnya jika sudah terpilih
            }
            // Tandai posisi sampel sebagai terpilih
            $selectedPositions[] = $position;
            // Ambil sampel pada posisi
            $samples[] = $listRuta[$position];
        }
        // karena sampling dengan circular, maka sampel harus diurutkan lagi
        $noUrutRt = array_column($samples, 'no_urut_ruta');
        array_multisort($noUrutRt, SORT_ASC, $samples);

        $semiResult = [];
        foreach ($samples as $sample) {
            $sample['keluarga'] = $keluargaModel->getKeluargaByRuta($sample['kode_ruta']);
                array_push($semiResult, $sample);
        }
        return $semiResult;
    }
}
