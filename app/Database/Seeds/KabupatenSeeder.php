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
            [
                'id_kab' => '06',
                'nama_kab' => 'Bangli'
            ],
            [
                'id_kab' => '07',
                'nama_kab' => 'Karangasem'
            ],
            [
                'id_kab' => '08',
                'nama_kab' => 'Buleleng'
            ],
            [
                'id_kab' => '71',
                'nama_kab' => 'Denpasar'
            ],
            
        ];

        // Insert data ke dalam tabel
        $this->db->table('kabupaten')->insertBatch($data);
    }
}
