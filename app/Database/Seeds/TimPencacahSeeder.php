<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\TimPencacahModel;

class TimPencacahSeeder extends Seeder
{
    public function run()
    {
        $csvFile = fopen(APPPATH . 'Database/Seeds/tim_seeder_fix.csv', "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
            $object = new TimPencacahModel;
            $object->insert([
                "nama_tim" => $data[1],
                "nim_pml" => $data[2],
                "token" => $data[3],
            ]);
            }
            $firstline = false;
        }
        
        fclose($csvFile);
        // $data = [
        //     [
        //         'nama_tim' => 'Tim SP_1',
        //         'nim_pml' => '222112384',
        //         'token' =>  'fKaPJ9kmrHUJsZ0mv2jx3dQir4SygjeDHgfByQIjyidK12HALTvTrrzek5VlC$qq'
        //     ],
        //     [
        //         'nama_tim' => 'Tim SP_2',
        //         'nim_pml' => '222112133',
        //         'token' =>  'fKaPJ9kmrHUJsZ0mv2jx3dQir4SygjeDHgfByQIjyidK12HALTvTrrzek5VlC$qq'
        //     ],
        //     [
        //         'nama_tim' => 'Tim SP_3',
        //         'nim_pml' => '212112316',
        //         'token' =>  'fKaPJ9kmrHUJsZ0mv2jx3dQir4SygjeDHgfByQIjyidK12HALTvTrrzek5VlC$qq'
        //     ],
        //     [
        //         'nama_tim' => 'Tim SP_4',
        //         'nim_pml' => '222111942',
        //         'token' =>  'fKaPJ9kmrHUJsZ0mv2jx3dQir4SygjeDHgfByQIjyidK12HALTvTrrzek5VlC$qq'
        //     ],  [
        //         'nama_tim' => 'Tim SP_5 DEMO',
        //         'nim_pml' => '222112217',
        //         'token' =>  'fKaPJ9kmrHUJsZ0mv2jx3dQir4SygjeDHgfByQIjyidK12HALTvTrrzek5VlC$qq'
        //     ],
        // ];
        // $this->db->table('timpencacah')->insertBatch($data);
    }
}
