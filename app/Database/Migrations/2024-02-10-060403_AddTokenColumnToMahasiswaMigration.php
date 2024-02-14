<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTokenColumnToMahasiswaMigration extends Migration
{
    public function up()
    {
        $fields = [
            'token' => [
                'type'    => 'TEXT',
                'null' => false,
            ],
        ];

        $this->forge->addColumn('mahasiswa', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('mahasiswa', 'token');
    
    }
}
