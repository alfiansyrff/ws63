<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KabupatenSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_kab'   => '01',
                'nama_kab' => 'Jembrana',
            ],
            [
                'id_kab'   => '02',
                'nama_kab' => 'Tabanan',
            ],
            [
                'id_kab'   => '03',
                'nama_kab' => 'Badung',
            ],
            [
                'id_kab'   => '04',
                'nama_kab' => 'Gianyar',
            ],
            [
                'id_kab'   => '05',
                'nama_kab' => 'Klungkung',
            ],
        ];

        // Insert data ke dalam tabel
        $this->db->table('kabupaten')->insertBatch($data);
    }
}
