<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KelurahanSeeder extends Seeder
{
    public function run()
    {
        // Tambahkan data kelurahan ke dalam tabel
        $data = [ // tambahkan id kab, dan id kec
            [
                'id_kelurahan'   => '001',
                'nama_kelurahan' => 'Kelurahan A',
            ],
            [
                'id_kelurahan'   => '002',
                'nama_kelurahan' => 'Kelurahan B',
            ],
            // Tambahkan data kelurahan lainnya sesuai kebutuhan
        ];

        // Insert data ke dalam tabel
        $this->db->table('kelurahan')->insertBatch($data); // pk adalah id kab + ida kec + id kel
    }
}
