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
            $rumahTanggaModel = new RutaModel(); //ini nanti untuk memanggil model ruta (untuk gell all ruta / bs)
            // $sampelModel = new SampelModelR1(); // ini nanti untuk memanggil model sampel
            // $result['beban_cacah'] = $sampelModel->getBebanKerja($id);
            // $result['jumlah'] = $this->getJumlahTerkirim($id);
            $ruta = [];
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
                // $rumahTanggaModel->getAllRuta($result['kode_bs'])
                $ruta // nanti pakai yang dikomen
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
