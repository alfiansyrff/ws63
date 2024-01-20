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
                'token'=> 'test token 1'
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
                'token'=> 'test token 1'
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
                'token'=> 'test token 1'
            ],
            [
                'nim' => '222112224',
                'nama' => 'Muhammad Sultan Hafiz',
                'no_hp' => '08234567890',
                'email' => '222112224@stis.ac.id',
                'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
                'plain_password' => 'sultanhafiz123',
                'foto' => 'foto Hafiz',
                'password' => password_hash('sultanhafiz123', PASSWORD_BCRYPT),
                'id_tim' => 1,
                'token'=> 'fKaPJ9kmrHUJsZ0mv2jx3dQir4SygjeDHgfByQIjyidK12HALTvTrrzek5VlC$qq'
            ],
            [
                'nim' => '222111908',
                'nama' => 'Annisa Rahma',
                'no_hp' => '08234567890',
                'email' => '222111908@stis.ac.id',
                'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
                'plain_password' => 'annisarah123',
                'foto' => 'foto Annisa Rahma',
                'password' => password_hash('annisarah123', PASSWORD_BCRYPT),
                'id_tim' => 1,
                'token'=> 'a5B67YyHFwwsrQQIchHJcWUv85sIH2P5O0InHjglIkFMRy0nj0Pce0wXDCVk5avX$qq'
            ],
            [
                'nim' => '222111912',
                'nama' => 'Anugerah Surya Atmaja',
                'no_hp' => '08234567890',
                'email' => '222111912@stis.ac.id',
                'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
                'plain_password' => 'nugrahsu123',
                'foto' => 'foto Annugrah Surya Atmaja',
                'password' => password_hash('nugrahsu123', PASSWORD_BCRYPT),
                'id_tim' => 1,
                'token'=> 'uSPkrN3GPpybNxpL3Pp3ZhO05qllSUdDDpjC!!tj6kjR27knX!!1aB7pv5leavNb'
            ],
            [
                'nim' => '222112359',
                'nama' => 'Shabrina Alfira Nisa',
                'no_hp' => '08234567890',
                'email' => '222112359@stis.ac.id',
                'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
                'plain_password' => 'shabrina123',
                'foto' => 'foto Shabrina',
                'password' => password_hash('shabrina123', PASSWORD_BCRYPT),
                'id_tim' => 1,
                'token'=> 'XKsWZ5MDRild0t!S$i2bGYlrHRxutOcv6vZrU49fp8BIyejlSEcJA0kL6QFPJsPx'
            ],            
            [
                'nim' => '212112257',
                'nama' => 'Ni Putu Lidya Pramesty',
                'no_hp' => '08234567890',
                'email' => '212112257@stis.ac.id',
                'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
                'plain_password' => 'putulidya123',
                'foto' => 'foto Ni Putu Lidya Pramesty',
                'password' => password_hash('putulidya123', PASSWORD_BCRYPT),
                'id_tim' => 1,
                'token'=> 'mygEU0bg4CHA970IYahKDqtiX98D4izukL9f6C$L$GH4PkIofSoHyI7NbH7unQxN'
            ],
            [
                'nim' => '212111915',
                'nama' => 'Ardian Putra Wardana',
                'no_hp' => '08234567890',
                'email' => '212111915@stis.ac.id',
                'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
                'plain_password' => 'ardianput123',
                'foto' => 'foto Ardian Putra Wardana',
                'password' => password_hash('ardianput123', PASSWORD_BCRYPT),
                'id_tim' => 1,
                'token'=> 'yWyDo6lcD523Iba$U8rKoaQzGNmyLMlZJOM1Vxg$Qd1x1eJy9bfcZL7P2NLxCFlu'
            ],
            [
                'nim' => '212111897',
                'nama' => 'Angga Prayoga',
                'no_hp' => '08234567890',
                'email' => '212111897@stis.ac.id',
                'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
                'plain_password' => 'anggapra123',
                'foto' => 'foto Angga Prayoga',
                'password' => password_hash('anggapra123', PASSWORD_BCRYPT),
                'id_tim' => 1,
                'token'=> '2idZK7!ktM0KtOfbXJ9jrt1oqPsHmP7eOYY4tEknooHkeCVcfLleOZM$PJsq3WpT'
            ],
            [
                'nim' => '212112316',
                'nama' => 'Ria Dini Hanifah',
                'no_hp' => '08234567890',
                'email' => '212112316@stis.ac.id',
                'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
                'plain_password' => 'riadinihan123',
                'foto' => 'foto Ria Dini Hanifah',
                'password' => password_hash('riadinihan123', PASSWORD_BCRYPT),
                'id_tim' => 1,
                'token'=> 'oqGL0hlX2vFGe$Pc01bDmcxKRKolNh!hPiob6Hjej75TLmi5yNLHoNGO8HBmFivd'
            ],
            [
                'nim' => '222112915',
                'nama' => 'Muh Farhan',
                'no_hp' => '08234567890',
                'email' => '222112915@stis.ac.id',
                'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
                'plain_password' => 'muhfarhan123',
                'foto' => 'foto Muh Farhan',
                'password' => password_hash('muhfarhan123', PASSWORD_BCRYPT),
                'id_tim' => 1,
                'token'=> 'Fzjf2ZpJaHbjEdWg5wlC4$G3!gpylw6fqiqGTZjwTX1FqDSVQzROPD11SwCMnYR5'
            ],
            [
                'nim' => '222112133',
                'nama' => 'Kevin Ananda Puspita',
                'no_hp' => '08234567890',
                'email' => '222112133@stis.ac.id',
                'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
                'plain_password' => 'kevinan123',
                'foto' => 'foto Kevin Ananda Puspita',
                'password' => password_hash('kevinan123', PASSWORD_BCRYPT),
                'id_tim' => 1,
                'token'=> 'MVmlNi2R7mtjs1YauV62k29z4A!yEw!TYXgPs4vLITxI1x9swJ04TutGi7k1gTI3'
            ],
            [
                'nim' => '212112124',
                'nama' => 'Kadek Agus Dwi Candra',
                'no_hp' => '08234567890',
                'email' => '212112124@stis.ac.id',
                'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
                'plain_password' => 'agusdwi123',
                'foto' => 'foto Kadek Agus Dwi Candra',
                'password' => password_hash('agusdwi123', PASSWORD_BCRYPT),
                'id_tim' => 1,
                'token'=> '2atvUuwlwLkGhZ2qU!GLKU4YaO2iux66uxdpyob5Fe5Fr5SQ0jGKlIT6ycUPkPdb'
            ],
            [
                'nim' => '222111992',
                'nama' => 'Dina Yanti Nainggolan',
                'no_hp' => '08234567890',
                'email' => '222111992@stis.ac.id',
                'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
                'plain_password' => 'dinayanti123',
                'foto' => 'foto Dina Yanti Nainggolan',
                'password' => password_hash('dinayanti123', PASSWORD_BCRYPT),
                'id_tim' => 1,
                'token'=> '0GfZnin63AuvtsRGJ1Zd2VcA6jBXIRhxlazUh4eZ9WBOavhIe8X0OeuTYZk$1!yt'
            ],
            [
                'nim' => '222111942',
                'nama' => 'Azwar Muhtar',
                'no_hp' => '08234567890',
                'email' => '222111942@stis.ac.id',
                'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
                'plain_password' => 'azwarmuh123',
                'foto' => 'foto Azwar Muhtar',
                'password' => password_hash('azwarmuh123', PASSWORD_BCRYPT),
                'id_tim' => 1,
                'token'=> 'wZS1qva$!!xyxjSc1SM5WDEVKyBrpNROVFpCZyojYosnwUMmDtJ48$WiR8!6dRSM'
            ],
            [
                'nim' => '222112384',
                'nama' => 'Sultan Hadi Prabowo',
                'no_hp' => '08234567890',
                'email' => '222112384@stis.ac.id',
                'alamat' => 'Badan Pusat Statistik, Jakarta Pusat',
                'plain_password' => 'sultanhadi123',
                'foto' => 'foto Sultan Hadi Prabowo',
                'password' => password_hash('sultanhadi123', PASSWORD_BCRYPT),
                'id_tim' => 1,
                'token'=> 'aE23q!PykCwc24kbiGV$k6n079ZLPjv5k0T70LCjdV2bTGlqzM1asaiTx8vyPMuH'
            ],
        ];
        $this->db->table('mahasiswa')->insertBatch($data);
    }
}
