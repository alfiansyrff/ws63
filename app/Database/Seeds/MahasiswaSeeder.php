<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\MahasiswaModel;


class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        $csvFile = fopen(APPPATH . 'Database/Seeds/mhs_seeder_fix.csv', "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                $object = new MahasiswaModel;
                $object->insert([
                    "nim" => $data[2],
                    "email" => $data[2] . '@stis.ac.id',
                    "nama" => $data[1],
                    "no_hp" => $data[5],
                    "alamat" => $data[6],
                    "foto" => $data[7],
                    "plain_password" => $data[8],
                    "password" => password_hash($data[8], PASSWORD_BCRYPT),
                    "id_tim" => $data[0],
                    "token" => $data[10]
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
        // $data = [
        //     [
        //         'nim' => '222112217',
        //         'nama' => 'Nuhammad Julian Firdaus',
        //         'no_hp' => '08123456789',
        //         'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
        //         'email' => '222112217@stis.ac.id',
        //         'plain_password' => 'muhjulian123',
        //         'foto' => 'foto Muhammad Julian FIrdaus',
        //         'password' => password_hash('muhjulian123', PASSWORD_BCRYPT),
        //         'id_tim' => 5,
        //     ],
        //     [
        //         'nim' => '222111975',
        //         'nama' => 'Danang Wisnu Prabowo',
        //         'no_hp' => '08234567890',
        //         'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
        //         'email' => '222111975@stis.ac.id',
        //         'plain_password' => 'danang123',
        //         'foto' => 'foto Danang Wisnu Prabowo',
        //         'password' => password_hash('danang123', PASSWORD_BCRYPT),
        //         'id_tim' => 5,
        //     ],
        //     [
        //         'nim' => '222112210',
        //         'nama' => 'Muhammad Diva Amrullah',
        //         'no_hp' => '08234567890',
        //         'email' => '222112210@stis.ac.id',
        //         'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
        //         'plain_password' => 'muhdiva123',
        //         'foto' => 'foto Muhammad Diva Amrullah',
        //         'password' => password_hash('muhdiva123', PASSWORD_BCRYPT),
        //         'id_tim' => 5,
        //     ],
        //     [
        //         'nim' => '222112224',
        //         'nama' => 'Muhammad Sultan Hafiz',
        //         'no_hp' => '08234567890',
        //         'email' => '222112224@stis.ac.id',
        //         'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
        //         'plain_password' => 'sultanhafiz123',
        //         'foto' => 'foto Hafiz',
        //         'password' => password_hash('sultanhafiz123', PASSWORD_BCRYPT),
        //         'id_tim' => 1,
        //     ],
        //     [
        //         'nim' => '222111908',
        //         'nama' => 'Annisa Rahma',
        //         'no_hp' => '08234567890',
        //         'email' => '222111908@stis.ac.id',
        //         'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
        //         'plain_password' => 'annisarah123',
        //         'foto' => 'foto Annisa Rahma',
        //         'password' => password_hash('annisarah123', PASSWORD_BCRYPT),
        //         'id_tim' => 1,

        //     ],
        //     [
        //         'nim' => '222111912',
        //         'nama' => 'Anugerah Surya Atmaja',
        //         'no_hp' => '08234567890',
        //         'email' => '222111912@stis.ac.id',
        //         'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
        //         'plain_password' => 'nugrahsu123',
        //         'foto' => 'foto Annugrah Surya Atmaja',
        //         'password' => password_hash('nugrahsu123', PASSWORD_BCRYPT),
        //         'id_tim' => 3,
        //     ],
        //     [
        //         'nim' => '222112359',
        //         'nama' => 'Shabrina Alfira Nisa',
        //         'no_hp' => '08234567890',
        //         'email' => '222112359@stis.ac.id',
        //         'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
        //         'plain_password' => 'shabrina123',
        //         'foto' => 'foto Shabrina',
        //         'password' => password_hash('shabrina123', PASSWORD_BCRYPT),
        //         'id_tim' => 2,
        //     ],
        //     [
        //         'nim' => '212112257',
        //         'nama' => 'Ni Putu Lidya Pramesty',
        //         'no_hp' => '08234567890',
        //         'email' => '212112257@stis.ac.id',
        //         'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
        //         'plain_password' => 'putulidya123',
        //         'foto' => 'foto Ni Putu Lidya Pramesty',
        //         'password' => password_hash('putulidya123', PASSWORD_BCRYPT),
        //         'id_tim' => 3,
        //     ],
        //     [
        //         'nim' => '212111915',
        //         'nama' => 'Ardian Putra Wardana',
        //         'no_hp' => '08234567890',
        //         'email' => '212111915@stis.ac.id',
        //         'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
        //         'plain_password' => 'ardianput123',
        //         'foto' => 'foto Ardian Putra Wardana',
        //         'password' => password_hash('ardianput123', PASSWORD_BCRYPT),
        //         'id_tim' => 3,
        //     ],
        //     [
        //         'nim' => '212111897',
        //         'nama' => 'Angga Prayoga',
        //         'no_hp' => '08234567890',
        //         'email' => '212111897@stis.ac.id',
        //         'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
        //         'plain_password' => 'anggapra123',
        //         'foto' => 'foto Angga Prayoga',
        //         'password' => password_hash('anggapra123', PASSWORD_BCRYPT),
        //         'id_tim' => 2,
        //     ],
        //     [
        //         'nim' => '212112316',
        //         'nama' => 'Ria Dini Hanifah',
        //         'no_hp' => '08234567890',
        //         'email' => '212112316@stis.ac.id',
        //         'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
        //         'plain_password' => 'riadinihan123',
        //         'foto' => 'foto Ria Dini Hanifah',
        //         'password' => password_hash('riadinihan123', PASSWORD_BCRYPT),
        //         'id_tim' => 3,
        //     ],
        //     [
        //         'nim' => '222112915',
        //         'nama' => 'Muh Farhan',
        //         'no_hp' => '08234567890',
        //         'email' => '222112915@stis.ac.id',
        //         'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
        //         'plain_password' => 'muhfarhan123',
        //         'foto' => 'foto Muh Farhan',
        //         'password' => password_hash('muhfarhan123', PASSWORD_BCRYPT),
        //         'id_tim' => 4,
        //     ],
        //     [
        //         'nim' => '222112133',
        //         'nama' => 'Kevin Ananda Puspita',
        //         'no_hp' => '08234567890',
        //         'email' => '222112133@stis.ac.id',
        //         'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
        //         'plain_password' => 'kevinan123',
        //         'foto' => 'foto Kevin Ananda Puspita',
        //         'password' => password_hash('kevinan123', PASSWORD_BCRYPT),
        //         'id_tim' => 2,
        //     ],
        //     [
        //         'nim' => '212112124',
        //         'nama' => 'Kadek Agus Dwi Candra',
        //         'no_hp' => '08234567890',
        //         'email' => '212112124@stis.ac.id',
        //         'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
        //         'plain_password' => 'agusdwi123',
        //         'foto' => 'foto Kadek Agus Dwi Candra',
        //         'password' => password_hash('agusdwi123', PASSWORD_BCRYPT),
        //         'id_tim' => 2,
        //     ],
        //     [
        //         'nim' => '222111992',
        //         'nama' => 'Dina Yanti Nainggolan',
        //         'no_hp' => '08234567890',
        //         'email' => '222111992@stis.ac.id',
        //         'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
        //         'plain_password' => 'dinayanti123',
        //         'foto' => 'foto Dina Yanti Nainggolan',
        //         'password' => password_hash('dinayanti123', PASSWORD_BCRYPT),
        //         'id_tim' => 1,
        //     ],
        //     [
        //         'nim' => '222111942',
        //         'nama' => 'Azwar Muhtar',
        //         'no_hp' => '08234567890',
        //         'email' => '222111942@stis.ac.id',
        //         'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
        //         'plain_password' => 'azwarmuh123',
        //         'foto' => 'foto Azwar Muhtar',
        //         'password' => password_hash('azwarmuh123', PASSWORD_BCRYPT),
        //         'id_tim' => 4,
        //     ],
        //     [
        //         'nim' => '222112384',
        //         'nama' => 'Sultan Hadi Prabowo',
        //         'no_hp' => '08234567890',
        //         'email' => '222112384@stis.ac.id',
        //         'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
        //         'plain_password' => 'sultanhadi123',
        //         'foto' => 'foto Sultan Hadi Prabowo',
        //         'password' => password_hash('sultanhadi123', PASSWORD_BCRYPT),
        //         'id_tim' => 1,
        //     ],
        // ];
        // $this->db->table('mahasiswa')->insertBatch($data);
    }
}
