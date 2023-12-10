<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KabupatenSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_kab'   => '001',
                'nama_kab' => 'Buleleng',
            ],
            [
                'id_kab'   => '002',
                'nama_kab' => 'Gianyar',
            ],
        ];

        // Insert data ke dalam tabel
        $this->db->table('kabupaten')->insertBatch($data);
    }
}
