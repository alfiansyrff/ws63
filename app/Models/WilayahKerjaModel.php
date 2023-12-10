<?php

namespace App\Models;

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
        $result = $this
            ->join(
                'kelurahan',
                'bloksensus.id_kelurahan = kelurahan.id_kelurahan',
                'inner'
            )
            ->join(
                'kecamatan',
                'bloksensus.id_kec = kecamatan.id_kec',
                'inner'
            )
            ->join('kabupaten', 'bloksensus.id_kab = kabupaten.id_kab', 'inner')
            ->where('nim_pencacah', $nim)
            ->first();

        global $wilayah_kerja;

        if ($result != NULL) {
            // $rumahTanggaModel = new RutaModel(); //ini nanti untu memanggil model ruta
            // $sampelModel = new SampelModelR1(); // ini nanti untuk memanggil model sampel
            // $result['beban_cacah'] = $sampelModel->getBebanKerja($id);
            // $result['jumlah'] = $this->getJumlahTerkirim($id);

            $ruta = [];  // ini masih belum benar --> ruta harusnya di dapatkan dari rumah tanggal model->get all ruta berdasrkan blok sensus
            $wilayah_kerja = new WilayahKerja(
                $result['no_bs'],
                $result['id_kelurahan'],
                $result['nama_kelurahan'],
                $result['id_kec'],
                $result['nama_kec'],
                $result['id_kab'],
                $result['nama_kab'],
                $result['jml_art'],
                $result['jml_artz'],
                $result['jml_genz'],
                $result['jml_genz_dewasa'],
                $result['jml_genz_anak'],
                $result['tgl_listing'],
                $result['tgl_periksa'],
                $result['status'],
                // $rumahTanggaModel->getAllRuta($result['kode_bs'])
                $ruta,
            );
        };

        return $wilayah_kerja;
    }


    public function updateRekapitulasiBSyInsert($noBS, $jmlRuta, $jmlRutaZ, $jmlGenZ, $jmlGenZAnak, $jmlGenZDewasa)
    {
        $result = $this->where('no_bs', $noBS)
            ->first();

        if ($result) {
            // return true;
            // Melakukan pembaruan rekapitulasi
            $result['jml_art'] += $jmlRuta;

            $result['jml_artz'] += $jmlRutaZ;
            $result['jml_genz'] += $jmlGenZ;
            $result['jml_genz_anak'] += $jmlGenZAnak;
            $result['jml_genz_dewasa'] += $jmlGenZDewasa;
            $this->save($result);
            return true;
        }
        return false;
    }  // FUNGSI INI MASIH SALAH, BEKERJA TAPI SEHARUSNYA BUKAN GINI

    public function updateRekapitulasiBs($noBS)
    {
        $query = $this->db->query('UPDATE bloksensus 
                                   SET jml_art = (
                                       SELECT COUNT(*) 
                                       FROM rumahtangga 
                                       WHERE no_bs = ' . $this->db->escape($noBS) . '
                                   ) 
                                   WHERE no_bs = ' . $this->db->escape($noBS));  // KUERI INI BERLUM SELESAI KARENA BARU UPDATE JUMLAH RUTA, NANTI LENGKAPI KETIKA KUISISONER LISTING SUDAH COMPLETE

        return $query;
    }
}
