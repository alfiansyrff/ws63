<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RumahTanggaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kode_ruta'     => 'R007B001',
                'no_urut_ruta'  => '1',
                'kk_or_krt'     => '3',
                'nama_krt'      => 'KH Ahmad Syamsuri',
                'jml_genz_anak'  => 1,
                'jml_genz_dewasa'  => 1,
                'kat_genz'      => '3',
                'long'          => 107.6098,
                'lat'           => -6.9175,
                'catatan'       => 'Catatan Rumah Tangga 1',
                'id_bs'         => '5171030002064B',
                'nim_pencacah'    => '222112915',
                'no_segmen' => 'S010'
            ],
            [
                'kode_ruta'     => 'R007B002',
                'no_urut_ruta'  => '2',
                'kk_or_krt'     => '3',
                'nama_krt'      => 'KH Ahmad Syamsuri',
                'jml_genz_anak'  => 4,
                'jml_genz_dewasa'  => 4,
                'kat_genz'      => '3',
                'long'          => 107.6098,
                'lat'           => -6.9175,
                'catatan'       => 'Catatan Rumah Tangga 1',
                'id_bs'         => '5171030002064B',
                'nim_pencacah'    => '222112915',
                'no_segmen' => 'S010'
            ],
            [
                'kode_ruta'     => 'R007B003',
                'no_urut_ruta'  => '1',
                'kk_or_krt'     => '3',
                'nama_krt'      => 'Oktafiano Asset Pradana',
                'jml_genz_anak'  => 3,
                'jml_genz_dewasa'  => 3,
                'kat_genz'      => '3',
                'long'          => 107.6098,
                'lat'           => -6.9175,
                'catatan'       => 'Catatan Rumah Tangga 1',
                'id_bs'         => '5171030002064B',
                'nim_pencacah'    => '222112915',
                'no_segmen' => 'S011'
            ],
            [
                'kode_ruta'     => 'R007B004',
                'no_urut_ruta'  => '1',
                'kk_or_krt'     => '2',
                'nama_krt'      => 'Yulius Krisna Adhi',
                'jml_genz_anak'  => 3,
                'jml_genz_dewasa'  => 3,
                'kat_genz'      => '3',
                'long'          => 107.6098,
                'lat'           => -6.9175,
                'catatan'       => 'Catatan Rumah Tangga 1',
                'id_bs'         => '5171030002064B',
                'nim_pencacah'    => '222112915',
                'no_segmen' => 'S020'
            ],
            [
                'kode_ruta'     => 'R007B005',
                'no_urut_ruta'  => '2',
                'kk_or_krt'     => '1',
                'nama_krt'      => 'Anang Kurnia Hidayat',
                'jml_genz_anak'  => 1,
                'jml_genz_dewasa'  => 1,
                'kat_genz'      => "3",
                'long'          => 107.6098,
                'lat'           => -6.9175,
                'catatan'       => 'Catatan Rumah Tangga 1',
                'id_bs'         => '5171030002064B',
                'nim_pencacah'    => '222112915',
                'no_segmen' => 'S020'
            ],
          
        ];
        $this->db->table('rumahtangga')->insertBatch($data);
    }
}
