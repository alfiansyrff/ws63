<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BlokSensusSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'no_bs' => '001A',
                'nama_sls' => 'Banjar Percobaan',
                'id_kab' => '71',
                'id_kec' => '010',
                'id_kel' => '001',
                'tim' => '5',
                'catatan' => '',
                'status' => 'listing',
            ],
            [
                'no_bs' => '007B',
                'nama_sls' => 'Banjar Bon Nyuh',
                'id_kab' => '04',
                'id_kec' => '030',
                'id_kel' => '014',
                'tim' => '1',
                'catatan' => '',
                'status' => 'listing',
            ],
            [
                'no_bs' => '004B',
                'nama_sls' => 'Banjar Tengah',
                'id_kab' => '04',
                'id_kec' => '020',
                'id_kel' => '007',
                'tim' => '2',
                'catatan' => '',
                'status' => 'listing',
            ],
            [
                'no_bs' => '001B',
                'nama_sls' => 'Dusun Margaya',
                'id_kab' => '71',
                'id_kec' => '030',
                'id_kel' => '002',
                'tim' => '3',
                'catatan' => '',
                'status' => 'listing',
            ],
            [
                'no_bs' => '057B',
                'nama_sls' => 'Dusun Tohpati',
                'id_kab' => '71',
                'id_kec' => '020',
                'id_kel' => '005',
                'tim' => '4',
                'catatan' => '',
                'status' => 'listing',
            ],
        ];

        // Insert data into bloksensus table
        $this->db->table('bloksensus')->insertBatch($data);
    }
}
