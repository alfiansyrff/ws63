<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KeluargaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kode_klg'        => 'K007B001',
                'SLS'             => 'Gentan',
                'no_segmen'       => 'S010',
                'no_bg_fisik'     => '1',
                'no_bg_sensus'    => '1',
                'no_urut_klg'     => '1',
                'nama_kk'         => 'KH Ahmad Syamsuri',
                'alamat'          => 'Gentan, Sidorejo, Lendah, Kulon Progo',
                'is_genz_ortu'    => 1,
                // 'no_urut_klg_egb' => 1,
                'pengl_mkn'       => 1,
                'id_bs'           => '5171030002064B',
                'nim_pencacah'    => '222112915'
            ],
            [
                'kode_klg'        => 'K007B002',
                'SLS'             => 'Krapayak',
                'no_segmen'       => 'S010',
                'no_bg_fisik'     => '2',
                'no_bg_sensus'    => '2',
                'no_urut_klg'     => '2',
                'nama_kk'         => 'Gus Hilmy Yahya',
                'alamat'          => 'Krapyak, Bantul, DIY',
                'is_genz_ortu'    => 1,
                // 'no_urut_klg_egb' => 2,
                'pengl_mkn'       => 1,
                'id_bs'           => '5171030002064B',
                'nim_pencacah'    => '222112915'
            ],
            [
                'kode_klg'        => 'K007B003',
                'SLS'             => 'Krapayak',
                'no_segmen'       => 'S010',
                'no_bg_fisik'     => '3',
                'no_bg_sensus'    => '3',
                'no_urut_klg'     => '3',
                'nama_kk'         => 'Oktafiano Asset Pradana',
                'alamat'          => 'Polstati STIS',
                'is_genz_ortu'    => 3,
                // 'no_urut_klg_egb' => 3,
                'pengl_mkn'       => 2,
                'id_bs'           => '5171030002064B',
                'nim_pencacah'    => '222112915'
            ],
            [
                'kode_klg'        => 'K007B004',
                'SLS'             => 'bantul',
                'no_segmen'       => 'S010',
                'no_bg_fisik'     => '4',
                'no_bg_sensus'    => '4',
                'no_urut_klg'     => '4',
                'nama_kk'         => 'Gavin Atha Wisesa',
                'alamat'          => 'Polstati STIS',
                'is_genz_ortu'    => 1,
                // 'no_urut_klg_egb' => 4,
                'pengl_mkn'       => 1,
                'id_bs'           => '5171030002064B',
                'nim_pencacah'    => '222112915'
            ], [
                'kode_klg'        => 'K007B005',
                'SLS'             => 'bantul',
                'no_segmen'       => 'S010',
                'no_bg_fisik'     => '5',
                'no_bg_sensus'    => '5',
                'no_urut_klg'     => '5',
                'nama_kk'         => 'Rizki Keren',
                'alamat'          => 'Polstati STIS',
                'is_genz_ortu'    => 1,
                // 'no_urut_klg_egb' => 5,
                'pengl_mkn'       => 1,
                'id_bs'           => '5171030002064B',
                'nim_pencacah'    => '222112915'
            ],
        ];
        $this->db->table('keluarga')->insertBatch($data);
    }
}
