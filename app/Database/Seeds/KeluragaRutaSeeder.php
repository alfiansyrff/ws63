<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KeluragaRutaSeeder extends Seeder
{
    public function run()
    {

        $data = [
            [
                'kode_klg'     => 'K007B001',
                'kode_ruta'  => 'R007B001',
            ],
            [
                'kode_klg'     => 'K007B002',
                'kode_ruta'  => 'R007B002',
            ],
            [
                'kode_klg'     => 'K007B003',
                'kode_ruta'  => 'R007B003',
            ],
            [
                'kode_klg'     => 'K007B003',
                'kode_ruta'  => 'R007B004',
            ],
            [
                'kode_klg'     => 'K007B004',
                'kode_ruta'  => 'R007B005',
            ],
            [
                'kode_klg'     => 'K007B005',
                'kode_ruta'  => 'R007B005',
            ]

        ];
        $this->db->table('keluarga_ruta')->insertBatch($data);
    }
}
