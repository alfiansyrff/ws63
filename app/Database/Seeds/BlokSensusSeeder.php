<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BlokSensusSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // [
            //     'no_bs' => '444A',
            //     'nama_sls' => 'Nama SLS 1',
            //     'id_kab' => '71',
            //     'id_kec' => '010',
            //     'id_kel' => '001',
            //     // 'nim_pencacah' => '222111975',
            //     'tim' => '1',
            //     'catatan' => 'Catatan blok sensus 1',
            //     'status' => 'listing',
            // ],
            // [
            //     'no_bs' => '444B',
            //     'nama_sls' => 'Nama SLS 2',
            //     'id_kab' => '71',
            //     'id_kec' => '010',
            //     'id_kel' => '002',
            //     // 'nim_pencacah' => '222112322',
            //     'tim' => '1',
            //     'catatan' => 'Catatan blok sensus 2',
            //     'status' => 'listing',
            // ],
            // [
            //     'no_bs' => '444C',
            //     'nama_sls' => 'Nama SLS 3',
            //     'id_kab' => '71',
            //     'id_kec' => '010',
            //     'id_kel' => '003',
            //     // 'nim_pencacah' => '222111333',
            //     'tim' => '1',
            //     'catatan' => 'Catatan blok sensus 3',
            //     'status' => 'listing',
            // ],
            // [
            //     'no_bs' => '444D',
            //     'nama_sls' => 'Nama SLS 3',
            //     'id_kab' => '71',
            //     'id_kec' => '010',
            //     'id_kel' => '004',
            //     // 'nim_pencacah' => '222112224',
            //     'tim' => '1',
            //     'catatan' => 'Catatan blok sensus 3',
            //     'status' => 'listing',
            // ],
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
