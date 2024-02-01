<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PosisiPclSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nim' => '222112224',
                'lokus' => 'Gianyar',
                'latitude' => -6.9175,
                'longitude' => 107.6098,
                'akurasi' => 23.0,
            ],
            [
                'nim' => '222112384',
                'lokus' => 'Gianyar',
                'latitude' => -6.9175,
                'longitude' => 107.6098,
                'akurasi' => 23.0,
            ],
            [
                'nim' => '222111992',
                'lokus' => 'Gianyar',
                'latitude' => -6.9175,
                'longitude' => 107.6098,
                'akurasi' => 23.0,
            ],
            [
                'nim' => '222111908',
                'lokus' => 'Gianyar',
                'latitude' => -6.9175,
                'longitude' => 107.6098,
                'akurasi' => 23.0,
            ],
            [
                'nim' => '222112133',
                'lokus' => 'Gianyar',
                'latitude' => -6.9175,
                'longitude' => 107.6098,
                'akurasi' => 23.0,
            ],
            [
                'nim' => '222112359',
                'lokus' => 'Gianyar',
                'latitude' => -6.9175,
                'longitude' => 107.6098,
                'akurasi' => 23.0,
            ],
            [
                'nim' => '212111897',
                'lokus' => 'Gianyar',
                'latitude' => -6.9175,
                'longitude' => 107.6098,
                'akurasi' => 23.0,
            ],
            [
                'nim' => '212112124',
                'lokus' => 'Gianyar',
                'latitude' => -6.9175,
                'longitude' => 107.6098,
                'akurasi' => 23.0,
            ],
            [
                'nim' => '212112316',
                'lokus' => 'Denpasar',
                'latitude' => -6.9175,
                'longitude' => 107.6098,
                'akurasi' => 23.0,
            ],
            [
                'nim' => '212111915',
                'lokus' => 'Denpasar',
                'latitude' => -6.9175,
                'longitude' => 107.6098,
                'akurasi' => 23.0,
            ],
            [
                'nim' => '212112257',
                'lokus' => 'Denpasar',
                'latitude' => -6.9175,
                'longitude' => 107.6098,
                'akurasi' => 23.0,
            ],
            [
                'nim' => '222111912',
                'lokus' => 'Denpasar',
                'latitude' => -6.9175,
                'longitude' => 107.6098,
                'akurasi' => 23.0,
            ],  [
                'nim' => '222111942',
                'lokus' => 'Denpasar',
                'latitude' => -6.9175,
                'longitude' => 107.6098,
                'akurasi' => 23.0,
            ],
            [
                'nim' => '222112915',
                'lokus' => 'Denpasar',
                'latitude' => -6.9175,
                'longitude' => 107.6098,
                'akurasi' => 23.0,
            ],
        ];
        $this->db->table('posisi_pcl')->insertBatch($data);
    }
}
