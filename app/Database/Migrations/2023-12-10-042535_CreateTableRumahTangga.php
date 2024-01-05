<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableRumahTangga extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kodeRuta' => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
            ],
            'no_segmen' => [
                'type' => 'INT',
                'constraint' => 3,
            ],
            'no_bg_fisik' => [
                'type' => 'INT',
                'constraint' => 3,
            ],
            'no_bg_sensus' => [
                'type' => 'INT',
                'constraint' => 3,
            ],
            'no_urut_rt' => [
                'type' => 'INT',
                'constraint' => 3,
            ],
            'nama_krt' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'no_bs' => [
                'type' => 'VARCHAR',
                'constraint' => 4,
            ],
            'is_genz_ortu' => [
                'type' => 'VARCHAR',
                'constraint' => 1,
            ],
            'jml_genz' => [
                'type' => 'INT',
                'constraint' => 3,
                'null' => true,
            ],
            'no_urut_rt_egb' => [
                'type' => 'INT',
                'constraint' => 3,
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
            ]
        ]);
        $this->forge->addKey('kodeRuta', true);
        $this->forge->createTable('rumahtangga');
    }

    public function down()
    {
        $this->forge->dropTable('rumahtangga');
    }
}
