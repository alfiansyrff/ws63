<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableKeluargaRuta extends Migration
{
    public function up()
    {
        $this->forge->addField([ // tambahkan untuk menyimpan id kab 
            'kode_klg' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'kode_ruta' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addForeignKey('kode_klg', 'keluarga', 'kode_klg', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('kode_ruta', 'rumahtangga', 'kode_ruta', 'CASCADE', 'CASCADE');
        $this->forge->addPrimaryKey(['kode_klg', 'kode_ruta']);
        $this->forge->createTable('keluarga_ruta');
    }

    public function down()
    {
        $this->forge->dropTable('keluarga_ruta');
    }
}
