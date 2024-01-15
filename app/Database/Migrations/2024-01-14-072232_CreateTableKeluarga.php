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
                'constraint'     => '20',
            ],
            'SLS' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
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
            'no_urut_klg' => [
                'type' => 'INT',
                'constraint' => 3,
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
            'no_bs' => [
                'type' => 'VARCHAR',
                'constraint' => 4,
            ],
        ]);
        $this->forge->addKey('kode_klg', true);
        $this->forge->createTable('keluarga');
    }

    public function down()
    {
        //
    }
}
