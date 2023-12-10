<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableKabupaten extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kab' => [
                'type'           => 'VARCHAR',
                'constraint'     => '3',
            ],
            'nama_kab' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addKey('id_kab', true);
        $this->forge->createTable('kabupaten');
    }

    public function down()
    {
        $this->forge->dropTable('kabupaten');
    }
}
