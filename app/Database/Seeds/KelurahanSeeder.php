<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KelurahanSeeder extends Seeder
{
    public function run()
    {
        // Tambahkan data kelurahan ke dalam tabel
        $data = [
            [
                'id_kab' => '001',
                'id_kec' => '001',
                'id_kel' => '001', // sesuaikan dengan nama kolom yang digunakan di migrasi
                'nama_kel' => 'Kelurahan A',
            ],
            [
                'id_kab' => '001',
                'id_kec' => '001',
                'id_kel' => '002',
                'nama_kel' => 'Kelurahan B',
            ],
            [
                'id_kab' => '001',
                'id_kec' => '002',
                'id_kel' => '003', // pastikan nilai unik
                'nama_kel' => 'Kelurahan C',
            ],
            [
                'id_kab' => '001',
                'id_kec' => '002',
                'id_kel' => '004', // pastikan nilai unik
                'nama_kel' => 'Kelurahan D',
            ],
        ];

        // Insert data ke dalam tabel
        $this->db->table('kelurahan')->insertBatch($data);
    }
}
