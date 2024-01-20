<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TimPencacahSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_tim' => 'Tim SP_1',
                'nim_pml' => '222112384',
            ],
            [
                'nama_tim' => 'Tim SP_2',
                'nim_pml' => '222112133',
            ],
            [
                'nama_tim' => 'Tim SP_3',
                'nim_pml' => '212112316',
            ],
               [
                'nama_tim' => 'Tim SP_4',
                'nim_pml' => '222111942',
            ],
        ];
        $this->db->table('timpencacah')->insertBatch($data);
    }
}
