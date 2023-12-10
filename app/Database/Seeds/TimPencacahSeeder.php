<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TimPencacahSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_tim' => 'Tim PKL 63_1',
                'nim_pml' => '222111333',
            ],
        ];
        $this->db->table('timpencacah')->insertBatch($data);
    }
}
