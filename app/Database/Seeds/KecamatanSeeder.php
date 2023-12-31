<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_kec' => '001',
                'nama_kec' => 'Kecamatan A',
            ],
            [
                'id_kec' => '002',
                'nama_kec' => 'Kecamatan B',
            ],
            // Tambahkan data lainnya sesuai kebutuhan
        ];

        // Uncomment line berikut jika ingin mengosongkan tabel sebelum menambahkan data
        // $this->db->table('kecamatan')->truncate();

        // Tambahkan data ke dalam tabel
        $this->db->table('kecamatan')->insertBatch($data);
    }
}
