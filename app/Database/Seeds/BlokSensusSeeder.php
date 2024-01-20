<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BlokSensusSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'no_bs' => '444A',
                'nama_sls' => 'Nama SLS 1',
                'id_kab' => '01',
                'id_kec' => '010',
                'id_kel' => '001',
                'nim_pencacah' => '222111975',
                'tim' => '1',
                'catatan' => 'Catatan blok sensus 1',
                'status' => 'listing',
            ],
            [
                'no_bs' => '444B',
                'nama_sls' => 'Nama SLS 2',
                'id_kab' => '01',
                'id_kec' => '010',
                'id_kel' => '002',
                'nim_pencacah' => '222112322',
                'tim' => '1',
                'catatan' => 'Catatan blok sensus 2',
                'status' => 'listing',
            ],
            [
                'no_bs' => '444C',
                'nama_sls' => 'Nama SLS 3',
                'id_kab' => '01',
                'id_kec' => '010',
                'id_kel' => '003',
                'nim_pencacah' => '222111333',
                'tim' => '1',
                'catatan' => 'Catatan blok sensus 3',
                'status' => 'listing',
            ],
            [
                'no_bs' => '444D',
                'nama_sls' => 'Nama SLS 3',
                'id_kab' => '001',
                'id_kec' => '001',
                'id_kel' => '002',
                'nim_pencacah' => '222112224',
                'tim' => '1',
                'catatan' => 'Catatan blok sensus 3',
                'status' => 'listing',
            ],
        ];

        // Insert data into bloksensus table
        $this->db->table('bloksensus')->insertBatch($data);
    }
}
