<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNimPencacahToKeluarga extends Migration
{
    public function up()
    {
        $fields = [
            'nim_pencacah' => [
                'type'    => 'VARCHAR',
                'constraint' => '9',
                'null' => true,
            ],
        ];
        
        $this->forge->addColumn('keluarga', $fields);
        $this->forge->addForeignKey('nim', 'mahasiswa', 'nim_pencacah','CASCADE','CASCADE');
    }

    public function down()
    {
        $this->forge->dropForeignKey('nim_pencacah');
        $this->forge->dropColumn('keluarga', 'nim_pencacah');
    }
}
