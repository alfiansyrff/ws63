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
        // Fungsi ini digunakna untuk mendapatkan wilayah kerja dari mahasiswa tertentu, wilayah kerja adalah blok sensus yang menjadi beban kerja dari mahasiswa yang bersangkutan
        $results = $this
            ->join(
                'kelurahan',
                'bloksensus.id_kelurahan = kelurahan.id_kelurahan',
                'inner'
            )
            // ->join(
            //     'kecamatan',
            //     'bloksensus.id_kec = kecamatan.id_kec',
            //     'inner'
            // )
            ->join(
                'kecamatan',
                'bloksensus.id_kab = kecamatan.id_kab AND bloksensus.id_kec = kecamatan.id_kec',
                'inner'
            )
            ->join('kabupaten', 'bloksensus.id_kab = kabupaten.id_kab', 'inner')
            ->where('nim_pencacah', $nim)
            ->findAll();

        $listWilayahKerja = [];
        if ($results != NULL) {
            $rumahTanggaModel = new RutaModel(); //untuk menggunakan fungsi getAllRuta yang ada di rumah tangga model
            // $sampelModel = new SampelModelR1(); // ini  untuk memanggil model sampel
            // $result['beban_cacah'] = $sampelModel->getBebanKerja($id);
            // $result['jumlah'] = $this->getJumlahTerkirim($id);

            foreach ($results as $result) {
                $wilayah_kerja = new WilayahKerja(
                    $result['no_bs'],
                    $result['id_kelurahan'],
                    $result['nama_kelurahan'],
                    $result['id_kec'],
                    $result['nama_kec'],
                    $result['id_kab'],
                    $result['nama_kab'],
                    $result['jml_rt'],
                    $result['jml_rt_genz'],
                    $result['jml_genz'],
                    $result['tgl_listing'],
                    $result['tgl_periksa'],
                    $result['status'],
                    $result['catatan'],
                    $rumahTanggaModel->getAllRuta($result['no_bs']) // mendapatkan seluruh ruta yang tersimpan dalam blok sensus
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
}
