<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableKecamatan extends Migration
{
    public function up()
    {
        $this->forge->addField([ // tambahkan untuk menyimpan id kab 
            'id_kec' => [
                'type'       => 'VARCHAR',
                'constraint' => 3,
            ],
            'nama_kec' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addKey('id_kec', true); // primary key adalah id kab  + id kec
        $this->forge->createTable('kecamatan');
    }

    public function down()
    {
        $this->forge->dropTable('kecamatan');
    }
}
