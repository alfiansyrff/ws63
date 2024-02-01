<?php

namespace App\Models;

use App\Libraries\Rumahtangga;
use App\Libraries\WilayahKerja;
use CodeIgniter\Model;

class WilayahKerjaModel extends Model
{
    protected $table            = 'bloksensus';
    protected $primaryKey       = 'no_bs';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $protectFields    = false;


    public function getWilayahKerja($nim)
    {
        $bloksensusMahasiswa = new BloksensusMahasiswaModel();
        $listBs = $bloksensusMahasiswa->getListBSByNim($nim);
        $listNoBS = [];
        foreach ($listBs as $bs) {
            array_push($listNoBS, $bs['no_bs']);
        }

        // Fungsi ini digunakna untuk mendapatkan wilayah kerja dari mahasiswa tertentu, wilayah kerja adalah blok sensus yang menjadi beban kerja dari mahasiswa yang bersangkutan
        $results = $this
            ->join(
                'kelurahan',
                'bloksensus.id_kel = kelurahan.id_kel AND bloksensus.id_kec = kelurahan.id_kec AND bloksensus.id_kab = kelurahan.id_kab',
                'inner'
            )
            ->join(
                'kecamatan',
                'bloksensus.id_kab = kecamatan.id_kab AND bloksensus.id_kec = kecamatan.id_kec',
                'inner'
            )
            ->join('kabupaten', 'bloksensus.id_kab = kabupaten.id_kab', 'inner')
            ->whereIn('no_bs', $listNoBS)
            ->findAll();



        $listWilayahKerja = [];
        if ($results != NULL) {
            $rumahTanggaModel = new RutaModel(); //untuk menggunakan fungsi getAllRuta yang ada di rumah tangga model
            // $sampelModel = new SampelModelR1(); // ini  untuk memanggil model sampel
            // $result['beban_cacah'] = $sampelModel->getBebanKerja($id);
            // $result['jumlah'] = $this->getJumlahTerkirim($id);

            $keluargaModel = new KeluargaModel();
            foreach ($results as $result) {
                $wilayah_kerja = new WilayahKerja(
                    $result['no_bs'],
                    $result['id_kel'],
                    $result['nama_kel'],
                    $result['id_kec'],
                    $result['nama_kec'],
                    $result['id_kab'],
                    $result['nama_kab'],
                    $result['jml_klg'],
                    $result['jml_klg_egb'],
                    $result['jml_rt'],
                    $result['jml_rt_egb'],
                    $result['tgl_listing'],
                    $result['tgl_periksa'],
                    $result['status'],
                    $result['catatan'],
                    (array) $keluargaModel->getAllKeluarga($result['no_bs'])
                    // $rumahTanggaModel->getAllRuta($result['no_bs']) // mendapatkan seluruh ruta yang tersimpan dalam blok sensus
                );
                array_push($listWilayahKerja, $wilayah_kerja);
            }
        };
        return $listWilayahKerja;
    }

    public function updateRekapitulasiBs($noBS)
    {

        // Fungsi ini digunakan untuk mengupdate rekapitulasi pada BS, panggil fungsi ini ketika ada perubahan data Ruta

        // jml_rt : jumlah semua ruta dalam satu BS
        // jml_rt_genz : jumlah semua ruta yang is_genz_ortu = 1
        // jml_genz : jumlah semua genz dalam satu blok sensus
        $query = $this->db->query('UPDATE bloksensus 
        SET 
            jml_klg = ( 
                SELECT COUNT(*) 
                FROM keluarga 
                WHERE no_bs = ' . $this->db->escape($noBS) . '
            ),
            jml_klg_egb = (
                SELECT COUNT(*)
                FROM keluarga 
                WHERE no_bs = ' . $this->db->escape($noBS) . ' AND is_genz_ortu != 0
            ),
            jml_rt = (
                SELECT COUNT(*)
                FROM rumahtangga 
                WHERE no_bs = ' . $this->db->escape($noBS) . '
            ),
            jml_rt_egb = (
                SELECT COUNT(*)
                FROM rumahtangga 
                WHERE no_bs = ' . $this->db->escape($noBS) . ' AND is_genz_ortu != 0
            )
        WHERE no_bs = ' . $this->db->escape($noBS));

        return $query;
    }

    public function updateStatusBs($noBS, $status)
    {

        $query = $this->db->query("UPDATE bloksensus SET status = '{$status}' WHERE no_bs = " . $this->db->escape($noBS));

        $result = ($query)
            ? ['status' => 'success', 'message' => 'Berhasil update status BS']
            : ['status' => 'error', 'message' => 'Gagal update status BS'];

        return $result;
    }

    public function getInfoBS($noBS)
    {
        $result = $this
            ->join(
                'kelurahan',
                'bloksensus.id_kel = kelurahan.id_kel AND bloksensus.id_kec = kelurahan.id_kec AND bloksensus.id_kab = kelurahan.id_kab',
                'inner'
            )
            ->join(
                'kecamatan',
                'bloksensus.id_kab = kecamatan.id_kab AND bloksensus.id_kec = kecamatan.id_kec',
                'inner'
            )
            ->join('kabupaten', 'bloksensus.id_kab = kabupaten.id_kab', 'inner')
            ->where('no_bs', $noBS)
            ->first();

        if ($result) {
            $keluargaModel = new KeluargaModel();
            $wilayah_kerja = new WilayahKerja(
                $result['no_bs'],
                $result['id_kel'],
                $result['nama_kel'],
                $result['id_kec'],
                $result['nama_kec'],
                $result['id_kab'],
                $result['nama_kab'],
                $result['jml_klg'],
                $result['jml_klg_egb'],
                $result['jml_rt'],
                $result['jml_rt_egb'],
                $result['tgl_listing'],
                $result['tgl_periksa'],
                $result['status'],
                $result['catatan'],
                (array) $keluargaModel->getAllKeluarga($result['no_bs'])
            );
            return $wilayah_kerja;
        } else {
            return "empty";
        }
    }
}
