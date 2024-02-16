<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableKecamatan extends Migration
{
    public function up()
    {
        $this->forge->addField([ // tambahkan untuk menyimpan id kab 
            'id_kab' => [
                'type' => 'VARCHAR',
                'constraint' => 3,
            ],
            'id_kec' => [
                'type'       => 'VARCHAR',
                'constraint' => 3,
            ],
            'nama_kec' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addForeignKey('id_kab', 'kabupaten', 'id_kab', 'CASCADE', 'CASCADE');
        // primary key tabel kecamatan adalah id kabupaten dan id kecematan
        $this->forge->addKey(['id_kab', 'id_kec'], true);

        $this->forge->createTable('kecamatan');
    }
    public function down()
    {
        $this->forge->dropTable('kecamatan');
    }
}
