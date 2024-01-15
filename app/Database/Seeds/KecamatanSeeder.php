<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_kab' => '001',
                'id_kec' => '001',
                'nama_kec' => 'Kecamatan A',
            ],
            [
                'id_kab' => '001',
                'id_kec' => '002',
                'nama_kec' => 'Kecamatan B',
            ],
        ];
        $this->db->table('kecamatan')->insertBatch($data);
    }
}
