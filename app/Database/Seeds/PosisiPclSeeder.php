<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PosisiPclSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nim' => '222111975',
                'lokus' => 'Jakarta Timur',
                'latitude' => -6.9175,
                'longitude' => 107.6098,
                'akurasi' => 23.0,
            ],
        ];
        $this->db->table('posisi_pcl')->insertBatch($data);
    }
}
