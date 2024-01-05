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
            $rumahTanggaModel = new RutaModel(); //nanti untuk memanggil model ruta (untuk gell all ruta / bs)
            // $sampelModel = new SampelModelR1(); // ini  untuk memanggil model sampel
            // $result['beban_cacah'] = $sampelModel->getBebanKerja($id);
            // $result['jumlah'] = $this->getJumlahTerkirim($id);
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
                $rumahTanggaModel->getAllRuta($result['no_bs'])
            );
        };

        return $wilayah_kerja;
    }

    public function updateRekapitulasiBs($noBS)
    {
        $query = $this->db->query('UPDATE bloksensus 
        SET 
            jml_rt = (
                SELECT COUNT(*) 
                FROM rumahtangga 
                WHERE no_bs = ' . $this->db->escape($noBS) . '
            ),
            jml_rt_genz = (
                SELECT COUNT(*)
                FROM rumahtangga 
                WHERE no_bs = ' . $this->db->escape($noBS) . ' AND is_genz_ortu = \'1\'
            ),
            jml_genz = (
                SELECT SUM(jml_genz)
                FROM rumahtangga 
                WHERE no_bs = ' . $this->db->escape($noBS) . ' AND is_genz_ortu =\'1\'
            )
        WHERE no_bs = ' . $this->db->escape($noBS));
        return $query;
    }
}
