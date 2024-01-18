<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_kab' => '01',
                'id_kec' => '010',
                'nama_kec' => 'Malaya',
            ],
            [
                'id_kab' => '01',
                'id_kec' => '020',
                'nama_kec' => 'Negara',
            ],
            [
                'id_kab' => '01',
                'id_kec' => '021',
                'nama_kec' => 'Jembrana',
            ],
            [
                'id_kab' => '01',
                'id_kec' => '030',
                'nama_kec' => 'Mendoyo',
            ],
            [
                'id_kab' => '01',
                'id_kec' => '040',
                'nama_kec' => 'Pekutatan',
            ],
            [
                'id_kab' => '02',
                'id_kec' => '010',
                'nama_kec' => 'Selemadeg',
            ],
            [
                'id_kab' => '02',
                'id_kec' => '011',
                'nama_kec' => 'Selemadeg Timur',
            ],
            [
                'id_kab' => '02',
                'id_kec' => '012',
                'nama_kec' => 'Selemadeg Barat',
            ],
            [
                'id_kab' => '02',
                'id_kec' => '020',
                'nama_kec' => 'Kerambitan',
            ],
            [
                'id_kab' => '02',
                'id_kec' => '030',
                'nama_kec' => 'Tabanan',
            ],
            [
                'id_kab' => '02',
                'id_kec' => '040',
                'nama_kec' => 'Kediri',
            ],
            [
                'id_kab' => '02',
                'id_kec' => '050',
                'nama_kec' => 'Marga',
            ],
            [
                'id_kab' => '02',
                'id_kec' => '060',
                'nama_kec' => 'Batubiri',
            ],
            [
                'id_kab' => '02',
                'id_kec' => '070',
                'nama_kec' => 'Penebel',
            ],
            [
                'id_kab' => '02',
                'id_kec' => '080',
                'nama_kec' => 'Pupuan',
            ],
            [
                'id_kab' => '03',
                'id_kec' => '010',
                'nama_kec' => 'Kuta Selatan',
            ],
            [
                'id_kab' => '03',
                'id_kec' => '020',
                'nama_kec' => 'Kuta',
            ],
            [
                'id_kab' => '03',
                'id_kec' => '030',
                'nama_kec' => 'Kuta Utara',
            ],
            [
                'id_kab' => '03',
                'id_kec' => '040',
                'nama_kec' => 'Mengwi',
            ],
            [
                'id_kab' => '03',
                'id_kec' => '050',
                'nama_kec' => 'Abiansemal',
            ],
            [
                'id_kab' => '03',
                'id_kec' => '060',
                'nama_kec' => 'Petang',
            ],
            [
                'id_kab' => '04',
                'id_kec' => '010',
                'nama_kec' => 'Sukawati',
            ],
            [
                'id_kab' => '04',
                'id_kec' => '020',
                'nama_kec' => 'Blahbatuh',
            ],
            [
                'id_kab' => '04',
                'id_kec' => '030',
                'nama_kec' => 'Gianyar',
            ],
            [
                'id_kab' => '04',
                'id_kec' => '040',
                'nama_kec' => 'Tampaksiring',
            ],
            [
                'id_kab' => '04',
                'id_kec' => '050',
                'nama_kec' => 'Ubud',
            ],
            [
                'id_kab' => '04',
                'id_kec' => '060',
                'nama_kec' => 'Tegallalang',
            ],
            [
                'id_kab' => '04',
                'id_kec' => '070',
                'nama_kec' => 'Payangan',
            ],
            [
                'id_kab' => '05',
                'id_kec' => '010',
                'nama_kec' => 'Nusa Penida',
            ],
            [
                'id_kab' => '05',
                'id_kec' => '020',
                'nama_kec' => 'Banjarangkan',
            ],
            [
                'id_kab' => '05',
                'id_kec' => '030',
                'nama_kec' => 'Klungkung',
            ],
            [
                'id_kab' => '05',
                'id_kec' => '040',
                'nama_kec' => 'Dawan',
            ],
        ];
        $this->db->table('kecamatan')->insertBatch($data);
    }
}
