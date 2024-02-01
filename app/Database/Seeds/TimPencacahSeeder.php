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
                'token' =>  'fKaPJ9kmrHUJsZ0mv2jx3dQir4SygjeDHgfByQIjyidK12HALTvTrrzek5VlC$qq'
            ],
            [
                'nama_tim' => 'Tim SP_2',
                'nim_pml' => '222112133',
                'token' =>  'fKaPJ9kmrHUJsZ0mv2jx3dQir4SygjeDHgfByQIjyidK12HALTvTrrzek5VlC$qq'
            ],
            [
                'nama_tim' => 'Tim SP_3',
                'nim_pml' => '212112316',
                'token' =>  'fKaPJ9kmrHUJsZ0mv2jx3dQir4SygjeDHgfByQIjyidK12HALTvTrrzek5VlC$qq'
            ],
            [
                'nama_tim' => 'Tim SP_4',
                'nim_pml' => '222111942',
                'token' =>  'fKaPJ9kmrHUJsZ0mv2jx3dQir4SygjeDHgfByQIjyidK12HALTvTrrzek5VlC$qq'
            ],  [
                'nama_tim' => 'Tim SP_5 DEMO',
                'nim_pml' => '222112217',
                'token' =>  'fKaPJ9kmrHUJsZ0mv2jx3dQir4SygjeDHgfByQIjyidK12HALTvTrrzek5VlC$qq'
            ],
        ];
        $this->db->table('timpencacah')->insertBatch($data);
    }
}
