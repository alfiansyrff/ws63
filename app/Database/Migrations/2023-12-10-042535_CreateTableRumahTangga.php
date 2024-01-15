<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableRumahTangga extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kode_ruta' => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
            ],
            'no_urut_ruta' => [
                'type' => 'INT',
                'constraint' => 3,
            ],
            'kk_or_krt' => [
                'type' => 'VARCHAR',
                'constraint' => '1',
            ],
            'nama_krt' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'is_genz_ortu' => [
                'type' => 'INT',
                'constraint' => 3,
            ],
            'kat_genz' => [
                'type' => 'VARCHAR',
                'constraint' => 1,
                'null' => true,
            ],
            'long' => [
                'type' => 'FLOAT',  
                'null' => true, 
            ],
            'lat' => [
                'type' => 'FLOAT',
                'null' => true,
            ],  
            'catatan' => [
                'type' => 'TEXT',
            ],
            'no_bs' => [
                'type' => 'VARCHAR',
                'constraint' => 4,
            ],
        ]);
        $this->forge->addKey('kode_ruta', true);
        $this->forge->createTable('rumahtangga');
    }

    public function down()
    {
        $this->forge->dropTable('rumahtangga');
    }
}
