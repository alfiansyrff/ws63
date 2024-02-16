<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class VersionInfoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'riset' => '1',
                'latest_version' => 'Versi Terakhir 10 Des 2023',
                'latest_version_code' => 1,
                'url' => 'https://google.com',
                'release_notes' => 'https://github.com'
            ],
        ];

        $this->db->table('versions')->insertBatch($data);
    }
}
