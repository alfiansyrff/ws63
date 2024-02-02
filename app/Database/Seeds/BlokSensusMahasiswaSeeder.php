<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BlokSensusMahasiswaSeeder extends Seeder
{
    public function run()
    {
        
        $data = [
            [
                'no_bs'     => '007B',
                'nim'  => '222112224',
            ],
            [
                'no_bs'     => '007B',
                'nim'  => '222112384',
            ],
            [
                'no_bs'     => '007B',
                'nim'  => '222111992',
            ], [
                'no_bs'     => '007B',
                'nim'  => '222111908',
            ], [
                'no_bs'     => '004B',
                'nim'  => '222112133',
            ], [
                'no_bs'     => '004B',
                'nim'  => '222112359',
            ], [
                'no_bs'     => '004B',
                'nim'  => '212111897',
            ], [
                'no_bs'     => '004B',
                'nim'  => '212112124',
            ],
            [
                'no_bs'     => '001B',
                'nim'  => '212112316',
            ],  [
                'no_bs'     => '001B',
                'nim'  => '212111915',
            ],  [
                'no_bs'     => '001B',
                'nim'  => '212112257',
            ],  [
                'no_bs'     => '001B',
                'nim'  => '222111912',
            ],  [
                'no_bs'     => '057B',
                'nim'  => '222111942',
            ], [
                'no_bs'     => '057B',
                'nim'  => '222112915',
            ], 

        ];
        // $this->db->table('bloksensus_mahasiswa')->insertBatch($data);
    }
}
