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
                'is_genz_ortu'  => 1,
                'kat_genz'      => '1',
                'long'          => 107.6098,
                'lat'           => -6.9175,
                'catatan'       => 'Catatan Rumah Tangga 1',
                'id_bs'         => '007B',
                'nim_pencacah'    => '222112915'
            ],
            [
                'kode_ruta'     => 'R007B002',
                'no_urut_ruta'  => '2',
                'kk_or_krt'     => '3',
                'nama_krt'      => 'KH Ahmad Syamsuri',
                'is_genz_ortu'  => 4,
                'kat_genz'      => '2',
                'long'          => 107.6098,
                'lat'           => -6.9175,
                'catatan'       => 'Catatan Rumah Tangga 1',
                'id_bs'         => '007B',
                'nim_pencacah'    => '222112915'
            ],
            [
                'kode_ruta'     => 'R007B003',
                'no_urut_ruta'  => '3',
                'kk_or_krt'     => '3',
                'nama_krt'      => 'Oktafiano Asset Pradana',
                'is_genz_ortu'  => 3,
                'kat_genz'      => '2',
                'long'          => 107.6098,
                'lat'           => -6.9175,
                'catatan'       => 'Catatan Rumah Tangga 1',
                'id_bs'         => '007B',
                'nim_pencacah'    => '222112915'
            ],
            [
                'kode_ruta'     => 'R007B004',
                'no_urut_ruta'  => '4',
                'kk_or_krt'     => '2',
                'nama_krt'      => 'Yulius Krisna Adhi',
                'is_genz_ortu'  => 3,
                'kat_genz'      => '2',
                'long'          => 107.6098,
                'lat'           => -6.9175,
                'catatan'       => 'Catatan Rumah Tangga 1',
                'id_bs'         => '007B',
                'nim_pencacah'    => '222112915'
            ],
            [
                'kode_ruta'     => 'R007B005',
                'no_urut_ruta'  => '5',
                'kk_or_krt'     => '1',
                'nama_krt'      => 'Anang Kurnia Hidayat',
                'is_genz_ortu'  => 1,
                'kat_genz'      => null,
                'long'          => 107.6098,
                'lat'           => -6.9175,
                'catatan'       => 'Catatan Rumah Tangga 1',
                'id_bs'         => '007B',
                'nim_pencacah'    => '222112915'
            ],
          
        ];
        $this->db->table('rumahtangga')->insertBatch($data);
    }
}
