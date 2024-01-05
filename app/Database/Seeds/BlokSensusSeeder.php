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
                'id_kab' => '001',
                'id_kec' => '001',
                'id_kelurahan' => '001',
                // 'jml_rt' => 2,  ENTAH KENAPA KALAU NILAI NYA MAU LANGSUNG DI COBA DI ISI JADI ERROR
                // 'jml_rt_genz' => 2,
                // 'jml_genz' => 4,
                'nim_pencacah' => '222111975',
                'tim_pencacah' => '1',
                'catatan' => 'Catatan blok sensus 1',
                'status' => 'listing',
            ],
            [
                'no_bs' => '444B',
                'nama_sls' => 'Nama SLS 2',
                'id_kab' => '001',
                'id_kec' => '001',
                'id_kelurahan' => '001',
                'nim_pencacah' => '222112322',
                'tim_pencacah' => '1',
                'catatan' => 'Catatan blok sensus 2',
                'status' => 'listing',
            ],
            [
                'no_bs' => '444C',
                'nama_sls' => 'Nama SLS 3',
                'id_kab' => '001',
                'id_kec' => '001',
                'id_kelurahan' => '002',
                'nim_pencacah' => '222111333',
                'tim_pencacah' => '1',
                'catatan' => 'Catatan blok sensus 3',
                'status' => 'listing',
            ],
        ];

        // Insert data into bloksensus table
        $this->db->table('bloksensus')->insertBatch($data);
    }
}
