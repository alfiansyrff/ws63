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
