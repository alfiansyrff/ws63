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
                'nim_pencacah' => '222111975',
                'tim_pencacah' => '1',
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
                'status' => 'listing',
            ],
        ];

        try {
            $this->db->table('bloksensus')->insertBatch($data);
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}
