<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_kab' => '71',
                'id_kec' => '010',
                'nama_kec' => 'Denpasar Selatan',
            ],
            [
                'id_kab' => '71',
                'id_kec' => '020',
                'nama_kec' => 'Denpasar Timur',
            ],
            [
                'id_kab' => '71',
                'id_kec' => '030',
                'nama_kec' => 'Denpasar Barat',
            ],
            [
                'id_kab' => '71',
                'id_kec' => '031',
                'nama_kec' => 'Denpasar Utara',
            ],
            [
                'id_kab' => '06',
                'id_kec' => '010',
                'nama_kec' => 'Susut',
            ],
            [
                'id_kab' => '06',
                'id_kec' => '020',
                'nama_kec' => 'Bangli',
            ],
            [
                'id_kab' => '06',
                'id_kec' => '030',
                'nama_kec' => 'Tembuku',
            ],
            [
                'id_kab' => '06',
                'id_kec' => '040',
                'nama_kec' => 'Kintamani',
            ],
            [
                'id_kab' => '07',
                'id_kec' => '010',
                'nama_kec' => 'Rendang',
            ],
            [
                'id_kab' => '07',
                'id_kec' => '020',
                'nama_kec' => 'Sidemen',
            ],
            [
                'id_kab' => '07',
                'id_kec' => '030',
                'nama_kec' => 'Manggis',
            ],
            [
                'id_kab' => '07',
                'id_kec' => '040',
                'nama_kec' => 'Karangasem',
            ],
            [
                'id_kab' => '07',
                'id_kec' => '050',
                'nama_kec' => 'Abang',
            ],
            [
                'id_kab' => '07',
                'id_kec' => '060',
                'nama_kec' => 'Bebandem',
            ],
            [
                'id_kab' => '07',
                'id_kec' => '070',
                'nama_kec' => 'Selat',
            ],
            [
                'id_kab' => '07',
                'id_kec' => '080',
                'nama_kec' => 'Kubu',
            ],
            [
                'id_kab' => '08',
                'id_kec' => '010',
                'nama_kec' => 'Gerokgak',
            ],
            [
                'id_kab' => '08',
                'id_kec' => '020',
                'nama_kec' => 'Seririt',
            ],
            [
                'id_kab' => '08',
                'id_kec' => '030',
                'nama_kec' => 'Busungbiu',
            ],
            [
                'id_kab' => '08',
                'id_kec' => '040',
                'nama_kec' => 'Banjar',
            ],
            [
                'id_kab' => '08',
                'id_kec' => '050',
                'nama_kec' => 'Sukasada',
            ],
            [
                'id_kab' => '08',
                'id_kec' => '060',
                'nama_kec' => 'Buleleng',
            ],
            [
                'id_kab' => '08',
                'id_kec' => '070',
                'nama_kec' => 'Sawan',
            ],
            [
                'id_kab' => '08',
                'id_kec' => '080',
                'nama_kec' => 'Kubutambahan',
            ],
            [
                'id_kab' => '08',
                'id_kec' => '090',
                'nama_kec' => 'Tejakula',
            ],
            
        ];
        $this->db->table('kecamatan')->insertBatch($data);
    }
}
