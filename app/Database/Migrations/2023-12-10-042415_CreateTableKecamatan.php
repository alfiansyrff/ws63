<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableKecamatan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kec' => [
                'type'       => 'VARCHAR',
                'constraint' => 3,
            ],
            'nama_kec' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addKey('id_kec', true);
        $this->forge->createTable('kecamatan');
    }

    public function down()
    {
        $this->forge->dropTable('kecamatan');
    }
}
