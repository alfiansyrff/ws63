<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\WilayahKerjaModel;

class BlokSensusSeeder extends Seeder
{
    public function run()
    {
        $csvFiles = [
            APPPATH . 'Database/Seeds/bs_tabanan_seeder.csv',
            APPPATH . 'Database/Seeds/bs_klungkung_seeder.csv',
            APPPATH . 'Database/Seeds/bs_karangasem_seeder.csv',
            APPPATH . 'Database/Seeds/bs_badung_seeder.csv',
            APPPATH . 'Database/Seeds/bs_denpasar_seeder.csv',
            APPPATH . 'Database/Seeds/bs_jembrana_seeder.csv',
            APPPATH . 'Database/Seeds/bs_bangli_seeder.csv',
            APPPATH . 'Database/Seeds/bs_gianyar_seeder.csv',
            APPPATH . 'Database/Seeds/bs_buleleng_seeder.csv',
            // Add more file paths as needed
        ];

        foreach ($csvFiles as $csvFile) {
            $this->seedFromFile($csvFile);
        }
        // $csvFile = fopen(APPPATH . 'Database/Seeds/bs_tabanan_seeder.csv', "r");

        // $firstline = true;
        // while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
        //     if (!$firstline) {
        //     $object = new WilayahKerjaModel;
        //     $object->insert([
        //         "id_bs" => $data[8],
        //         "no_bs" => $data[3],
        //         "nama_sls" => "",
        //         "id_kab" => $data[5],
        //         "id_kec" => $data[6],
        //         "id_kel" => $data[7],
        //         "id_tim" => $data[0],
        //         "catatan" => "",
        //         "status" => "listing",
        //     ]);
        //     }
        //     $firstline = false;
        // }
        
        // fclose($csvFile);
        // $data = [
        //     [
        //         'id_bs' => '5171010001001A',
        //         'no_bs' => '001A',
        //         'nama_sls' => 'Banjar Percobaan',
        //         'id_kab' => '71',
        //         'id_kec' => '010',
        //         'id_kel' => '011',
        //         'id_tim' => '115',
        //         'catatan' => '',
        //         'status' => 'listing',
        //     ],
            // [
            //     'id_bs' => '5104030014007B',
            //     'no_bs' => '007B',
            //     'nama_sls' => 'Banjar Bon Nyuh',
            //     'id_kab' => '04',
            //     'id_kec' => '030',
            //     'id_kel' => '014',
            //     'id_tim' => '1',
            //     'catatan' => '',
            //     'status' => 'listing',
            // ],
            // [
            //     'id_bs' => '5104020007004B',
            //     'no_bs' => '004B',
            //     'nama_sls' => 'Banjar Tengah',
            //     'id_kab' => '04',
            //     'id_kec' => '020',
            //     'id_kel' => '007',
            //     'id_tim' => '2',
            //     'catatan' => '',
            //     'status' => 'listing',
            // ],
            // [
            //     'id_bs' => '5171030002001B',
            //     'no_bs' => '001B',
            //     'nama_sls' => 'Dusun Margaya',
            //     'id_kab' => '71',
            //     'id_kec' => '030',
            //     'id_kel' => '002',
            //     'id_tim' => '3',
            //     'catatan' => '',
            //     'status' => 'listing',
            // ],
            // [
            //     'id_bs' => '51710200050057B',
            //     'no_bs' => '057B',
            //     'nama_sls' => 'Dusun Tohpati',
            //     'id_kab' => '71',
            //     'id_kec' => '020',
            //     'id_kel' => '005',
            //     'id_tim' => '4',
            //     'catatan' => '',
            //     'status' => 'listing',
            // ],
        // ];

        // // Insert data into bloksensus table
        // $this->db->table('bloksensus')->insertBatch($data);
    }

    private function seedFromFile($filePath)
{
    $csvFile = fopen($filePath, "r");

    $firstline = true;
    while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
        if (!$firstline) {
            $object = new WilayahKerjaModel;
            $object->insert([
                "id_bs" => $data[8],
                "no_bs" => $data[3],
                "nama_sls" => "",
                "id_kab" => $data[5],
                "id_kec" => $data[6],
                "id_kel" => $data[7],
                "id_tim" => $data[0],
                "catatan" => "",
                "status" => "listing",
            ]);
        }
        $firstline = false;
    }

    fclose($csvFile);
}
}
