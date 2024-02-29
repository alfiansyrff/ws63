<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableKeluarga extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kode_klg' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'unique' => true,
            ],
            'SLS' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'no_segmen' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'no_bg_fisik' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'no_bg_sensus' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'no_urut_klg' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'null' => true
            ],
            'nama_kk' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'is_genz_ortu' => [
                'type' => 'INT',
                'constraint' => 3,
            ],
            'no_urut_klg_egb' => [
                'type' => 'INT',
                'constraint' => 3,
                'null' => true,
            ],
            'pengl_mkn' => [
                'type' => 'INT',
                'constraint' => 3,
                'null' => true,
            ],
            'id_bs' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'created_at' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
        ]);
        $this->forge->addKey('kode_klg');
        $this->forge->createTable('keluarga');
    }

    public function down()
    {
        $this->forge->dropTable('keluarga');
    }
}
