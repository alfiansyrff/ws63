<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PosisiPclSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nim' => '222112975',
                'nama' => 'Imalia Rosyida',
                'no_hp' => '082334907089',
                'id_tim' => '44',
                'lokus' => 'Jakarta Timur',
                'latitude' => '12345678',
                'longitude' => '12345678',
                'akurasi' => '12345678',
            ],
        ];
        $this->db->table('posisi_pcl')->insertBatch($data);
    }
}
