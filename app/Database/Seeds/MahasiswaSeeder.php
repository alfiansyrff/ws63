<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nim' => '222111975',
                'nama' => 'Danang Wisnu Prabowo',
                'no_hp' => '08123456789',
                'alamat' => 'Gentan, Sidorejo, Lendah, Kulon Progo',
                'email' => '222111975@stis.ac.id',
                'plain_password' => 'danang123',
                'foto' => 'foto Danang',
                'password' => password_hash('danang123', PASSWORD_BCRYPT),
                'id_tim' => 1,
            ],
            [
                'nim' => '222112322',
                'nama' => 'Rifky Maulana Putra',
                'no_hp' => '08234567890',
                'alamat' => 'Jatineraga, Jakarta Timur',
                'email' => '222112322@stis.ac.id',
                'plain_password' => 'rifky123',
                'foto' => 'foto RIfky',
                'password' => password_hash('rifky123', PASSWORD_BCRYPT),
                'id_tim' => 1,
            ],
            [
                'nim' => '222111333',
                'nama' => 'Farid Ridho',
                'no_hp' => '08234567890',
                'email' => '222111333@stis.ac.id',
                'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
                'plain_password' => 'farid123',
                'foto' => 'foto Farid',
                'password' => password_hash('farid123', PASSWORD_BCRYPT),
                'id_tim' => 1,
            ],
        ];
        $this->db->table('mahasiswa')->insertBatch($data);
    }
}
