<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableKelurahan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kelurahan' => [
                'type' => 'VARCHAR',
                'constraint' => 3,
            ],
            'nama_kelurahan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ]
        ]);
        $this->forge->addKey('id_kelurahan', true);
        $this->forge->createTable('kelurahan');
    }

    public function down()
    {
        $this->forge->dropTable('desa');
    }
}
