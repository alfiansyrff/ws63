<?php

namespace App\Models;

use App\Libraries\Rumahtangga;
use App\Libraries\WilayahKerja;
use CodeIgniter\Model;
use PhpParser\Node\Stmt\TryCatch;

class WilayahKerjaModel extends Model
{
    protected $table            = 'bloksensus';
    protected $primaryKey       = 'no_bs';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $protectFields    = false;
    protected $allowedFields    = ["id_bs", "no_bs", "nama_sls", "id_kab", "id_kec", "id_kel", "id_tim", "catatan", "status"];

    public function getWilayahKerjaNoDataRuta($nim)
    {
        $mahasiswaModel = new MahasiswaModel();

        $idTim = $mahasiswaModel->getIdTimMahasiswa($nim);
        if ($idTim == null) {
            return null;
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
            ->where('id_tim', $idTim)
            ->findAll();

        $listWilayahKerja = [];
        if ($results != NULL) {
            $rumahTanggaModel = new RutaModel();
            $keluargaModel = new KeluargaModel();
            try {
                foreach ($results as $result) {
                    $wilayah_kerja = new WilayahKerja(
                        $result['id_bs'],
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
                        []
                    );
                    array_push($listWilayahKerja, $wilayah_kerja);
                }
            } catch (\Throwable $th) {
                echo json_encode($th->getMessage());
                die;
            }
        };
        return $listWilayahKerja;
    }

    public function getWilayahKerja($nim)
    {
        $mahasiswaModel = new MahasiswaModel();

        $idTim = $mahasiswaModel->getIdTimMahasiswa($nim);
        if ($idTim == null) {
            return null;
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
            ->where('id_tim', $idTim)
            ->findAll();

        $listWilayahKerja = [];
        if ($results != NULL) {
            $rumahTanggaModel = new RutaModel();
            $keluargaModel = new KeluargaModel();
            try {
                foreach ($results as $result) {
                    $wilayah_kerja = new WilayahKerja(
                        $result['id_bs'],
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
                        (array) $keluargaModel->getAllKeluarga($result['id_bs'])
                    );
                    array_push($listWilayahKerja, $wilayah_kerja);
                }
            } catch (\Throwable $th) {
                echo json_encode($th->getMessage());
                die;
            }
        };
        return $listWilayahKerja;
    }

    public function updateRekapitulasiBs($idBS)
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
                WHERE id_bs = ' . $this->db->escape($idBS) . ' AND (no_urut_klg  != ' . $this->db->escape('000') . ')
            ),
            jml_klg_egb = (
                SELECT COUNT(*)
                FROM keluarga 
                WHERE id_bs = ' . $this->db->escape($idBS) . ' AND (is_genz_ortu != 0) AND (no_urut_klg  != ' . $this->db->escape('000') . ')
            ),
            jml_rt = (
                SELECT COUNT(*)
                FROM rumahtangga 
                WHERE id_bs = ' . $this->db->escape($idBS) . '
            ),
            jml_rt_egb = (
                SELECT COUNT(*)
                FROM rumahtangga 
                WHERE id_bs = ' . $this->db->escape($idBS) . ' AND (jml_genz_anak != 0 OR jml_genz_dewasa != 0)
            )
        WHERE id_bs = ' . $this->db->escape($idBS));

        return $query;
    }

    public function updateStatusBs($idBS, $status)
    {
        $query = $this->db->query("UPDATE bloksensus SET status = '{$status}' WHERE id_bs = " . $this->db->escape($idBS));

        $result = ($query)
            ? ['status' => 'success', 'message' => 'Berhasil update status BS']
            : ['status' => 'error', 'message' => 'Gagal update status BS'];

        return $result;
    }

    public function getInfoBS($idBS)
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
            ->where('id_bs', $idBS)
            ->first();

        if ($result) {
            $keluargaModel = new KeluargaModel();
            $wilayah_kerja = new WilayahKerja(
                $result['id_bs'],
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
                (array) $keluargaModel->getAllKeluarga($result['id_bs'])
            );
            return $wilayah_kerja;
        } else {
            return "empty";
        }
    }

    public function getWilayahKerjaTim($idTim)
    {
        $result  =  $this->where('id_tim', $idTim)->findAll();
        return $result;
    }

    public function isWilayahKerjaFinalisasi($idBS)
    {
        $result = $this->where('id_bs', $idBS)->first();
        if ($result['status'] == 'listing') {
            return false;
        } else {
            return true;
        }
    }
}
