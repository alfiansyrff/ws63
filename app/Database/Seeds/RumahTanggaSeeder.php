<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RumahTanggaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kodeRuta'       => 'RT001',
                'no_segmen'      => 1,
                'no_bg_fisik'    => 1,
                'no_bg_sensus'   => 1,
                'no_urut_rt'     => 1,
                'nama_krt'       => 'KH Ahmad Syamsuri',
                'alamat'         => 'Gentan, Sidorejo, Lendah, Kulon Progo',
                'no_bs'          => '444A',
                'is_genz_ortu'   => '1',
                'jml_genz'       => 2,
                'no_urut_rt_egb' => 1,
                'long'           => 107.6098,
                'lat'            => -6.9175,
                'catatan'        => 'Catatan Rumah Tangga 1',
            ],
            [
                'kodeRuta'       => 'RT002',
                'no_segmen'      => 1,
                'no_bg_fisik'    => 2,
                'no_bg_sensus'   => 2,
                'no_urut_rt'     => 2,
                'nama_krt'       => 'Gus Hilmy Yahya',
                'alamat'         => 'Krapayak, Bantul, DIY',
                'no_bs'          => '444A',
                'is_genz_ortu'   => '1',
                'jml_genz'       => 2,
                'no_urut_rt_egb' => 2,
                'long'           => 108.1234,
                'lat'            => -7.4321,
                'catatan'        => 'Catatan Rumah Tangga 2',
            ],
        ];
        $this->db->table('rumahtangga')->insertBatch($data);
    }
}
