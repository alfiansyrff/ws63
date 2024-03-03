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
    protected $allowedFields    = ['kode_ruta', 'no_urut_ruta', 'kk_or_rt', 'nama_krt', 'jml_genz_ruta', 'jml_genz_ortu', 'kat_genz', 'no_urut_ruta_egb', 'long', 'lat', 'catatan', 'no_segmen', 'is_enable'];


    public function parseToArray($ruta): array
    {
        $data = [
            'kode_ruta' => $ruta->kodeRuta,
            'no_urut_ruta' => $ruta->noUrutRuta,
            'kk_or_krt' => $ruta->kkOrKrt,
            'nama_krt' => $ruta->namaKrt,
            'jml_genz_anak' => $ruta->jmlGenzAnak,
            'jml_genz_dewasa' => $ruta->jmlGenzDewasa,
            'kat_genz' => $ruta->katGenz,
            'long' => $ruta->long,
            'lat' => $ruta->lat,
            'catatan' => $ruta->catatan,
            'id_bs' => $ruta->idBS,
            'nim_pencacah' => $ruta->nimPencacah,
            'no_segmen' => $ruta->noSegmen,
            'is_enable' => $ruta->isEnable,
            "created_at" => $ruta->createdAt
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

    public function getAllRutaOrderedByKatGenZ($idBS): array
    {
        $results = $this->where('id_bs', $idBS)
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
    // public function addRuta(Rumahtangga $ruta): bool
    // {
    //     $data = $this->parseToArray($ruta);
    //     $existingRuta = $this->find($ruta->kodeRuta);
    //     // $nimPencacahMatches = $this->keluargaModel->isNimPencacahMatch($ruta->nimPencacah, $ruta->kodeRuta);

    //     if ($existingRuta) {
    //         // jika nim pencacah kosong masih bisa insert, tapi kalo semua false gagal insert
    //         $nimPencacahMatches = empty($existingRuta->nimPencacah) || $this->isNimPencacahMatch($ruta->nimPencacah, $kodeRuta);

    //         if (!$nimPencacahMatches) {
    //             // nim_pencacah tidak sama maka gagal
    //             return false;
    //         }

    //         $this->update($existingRuta['kode_ruta'], $data);
    //     } else {
    //         // Insert baru ?
    //         $this->update($existingRuta['kode_ruta'], $data);
    //     }

    //     return true;
    // }

    // private function isNimPencacahMatch($nimPencacah, $kodeRuta): bool
    // {
    //     $ruta = $this->find($kodeRuta);

    //     return $ruta && $ruta['nim_pencacah'] == $nimPencacah;
    // }

    // public function addRutaFromKeluarga(Keluarga $keluarga)
    // {
    //     foreach ($keluarga->ruta as $ruta) {
    //         $this->addRuta($ruta);
    //     }
    // }

    // public function updateRuta(Rumahtangga $ruta): bool
    // {
    //     try {
    //         $data = $this->parseToArray($ruta);
    //         $kodeRuta = $ruta->kodeRuta;

    //         $existingRuta = $this->find($kodeRuta);

    //         if ($existingRuta) {

    //             $nimPencacahMatches = $this->isNimPencacahMatch($ruta->nimPencacah, $kodeRuta);

    //             if (!$nimPencacahMatches) {

    //                 return false;
    //             }

    //             $this->update($existingRuta['kode_ruta'], $data);
    //         } else {
    //             // data tidak ditemukan
    //             return false;
    //         }

    //         return true;
    //     } catch (\Throwable $th) {
    //         return $this->respond->fail('Terjadi error saat melakukan update ruta');
    //     }
    // }

    // public function deleteRuta(Rumahtangga $ruta): bool
    // {
    //     $kodeRuta = $ruta->kodeRuta;

    //     $existingRuta = $this->find($kodeRuta);

    //     if ($existingRuta) {
    //         // cek nim pencacah
    //         $nimPencacahMatches = $this->isNimPencacahMatch($ruta->nimPencacah, $kodeRuta);

    //         if (!$nimPencacahMatches) {
    //             // nim_pencacah tidak sama maka gagal
    //             return false;
    //         }

    //         return $this->delete(['kode_ruta' => $kodeRuta]);
    //     } else {

    //         return false;
    //     }

    // }

    public function updateRuta(Rumahtangga $ruta): bool
    {
        try {
            $data = $this->parseToArray($ruta);
            // $check = $this->where('kode_ruta', $ruta->kodeRuta)->first();
            if (true) {
                $bool = $this->db->table('rumahtangga')->replace($data);
            }
            return true;
        } catch (\Throwable $th) {
            return $this->respond->fail('Terjadi error saat melakukan update ruta');
        }
    }

    public function addRutaFromKeluarga(Keluarga $keluarga)
    {
        // foreach ($keluarga->ruta as $ruta) {
        //     $this->addRuta($ruta);
        // }
        try {
            foreach ($keluarga->ruta as $ruta) {
                if (!isset($ruta->createdAt)) {
                    $ruta->createdAt = date('Y-m-d H:i:s');
                }
                $this->addRuta($ruta);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error adding ruta from keluarga: ' . $e->getMessage());
            // Handle the error as needed
        }
    }

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
                $this->delete(['kode_ruta' => $ruta->kodeRuta]);
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
            ->whereNotIn('jml_genz_anak', [0])
            ->whereNotIn('jml_genz_dewasa', [0])
            ->orderBy('no_urut_rt_egb', 'DESC')
            ->first(); // mendapatkan no_urut_rt_egb terakhir di blok sensus yang bersangkutan
        return $data['no_urut_rt_egb'] + 1;
    }


    public function getSampelBS($idBS, $sampleSize) // Circular sistematic 
    {

        try {
            // mengambail semua ruta eligible dari BS yang bersangkutan
            $keluargaModel = new KeluargaModel();
            $listRuta = [];
            $listRuta = $this->where('id_bs', $idBS)->where('no_urut_ruta_egb IS NOT NULL')->whereNotIn('no_urut_ruta_egb', [0])->orderBy('no_urut_ruta_egb', 'ASC')->findAll();
            if (!$listRuta || count($listRuta) == 0) {
                return [];
            }

            if (count($listRuta) <= $sampleSize) { // jika  jumlah ruta eligible kurang dari sampel size, maka ambil semua 
                return $listRuta;
            }

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
        } catch (\Throwable $th) {
            echo json_encode($th->getMessage());
            die;
        }
    }


    public function addStringNoUrutBangunan($noUrut, $shifter)
    {
        $angka = intval($noUrut) + $shifter;
        $non_numeric = preg_replace('/[0-9]/', '', $noUrut);
        $hasil = str_pad($angka, 3, '0', STR_PAD_LEFT); // Format 3 digit dengan leading zero
        return $hasil . $non_numeric;
    }

    public function processSegmentNumberRuta($idBS)
    {
        try {
            $query = $this->db->query("SELECT DISTINCT no_segmen FROM rumahtangga WHERE id_bs = ? ORDER BY no_segmen", [$idBS]);
            $result = $query->getResult();
            $no_segmen_array = array_column($result, 'no_segmen');
            // clear
            $shifter_urut = 0;
            if ($no_segmen_array && count($no_segmen_array) > 0) {
                foreach ($no_segmen_array as $segmen) {
                    $data_segmen = $this->where('id_bs', $idBS)->where('no_segmen', $segmen)->orderBy('no_urut_ruta')->findAll();
                    // clear
                    if ($shifter_urut != 0) {
                        foreach ($data_segmen as $data) {
                            $data['no_urut_ruta'] = $this->addStringNoUrutBangunan($data['no_urut_ruta'], $shifter_urut);
                            $this->replace($data);
                        }
                    }
                    $query = $this->where('id_bs', $idBS)->where('no_segmen', $segmen)->orderBy('no_urut_ruta', 'DESC')->select('no_urut_ruta')->first();
                    $add_shifter_urut = (int) $query['no_urut_ruta'];
                    $shifter_urut = $add_shifter_urut;
                }
                $rutaTemp = $this->where('id_bs', $idBS)
                    ->where('kat_genz IS NOT NULL')
                    ->whereNotIn('kat_genz', ['0'])
                    ->orderBy('kat_genz', 'ASC')
                    ->orderBy('no_segmen', 'ASC')
                    ->findAll();
                $no_urut_ruta_egb = 0;
                foreach ($rutaTemp as $ruta) {
                    $no_urut_ruta_egb += 1;
                    $ruta['no_urut_ruta_egb'] = $no_urut_ruta_egb;
                    $this->replace($ruta);
                }
            }
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
