<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KeluragaRutaSeeder extends Seeder
{
    public function run()
    {

        $data = [
            [
                'kode_klg'     => 'K444A001',
                'kode_ruta'  => 'R444A001',
            ],
            [
                'kode_klg'     => 'K444A002',
                'kode_ruta'  => 'R444A002',
            ],
            [
                'kode_klg'     => 'K444A003',
                'kode_ruta'  => 'R444A003',
            ],
            [
                'kode_klg'     => 'K444A003',
                'kode_ruta'  => 'R444A004',
            ],
            [
                'kode_klg'     => 'K444A004',
                'kode_ruta'  => 'R444A005',
            ],
            [
                'kode_klg'     => 'K444A005',
                'kode_ruta'  => 'R444A005',
            ]

        ];
        $this->db->table('keluarga-ruta')->insertBatch($data);
    }
}
