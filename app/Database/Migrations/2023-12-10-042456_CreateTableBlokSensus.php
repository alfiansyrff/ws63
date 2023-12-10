<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableBlokSensus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'no_bs' => [
                'type' => 'VARCHAR',
                'constraint' => 4,
            ],
            'nama_sls' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'id_kab' => [
                'type' => 'VARCHAR',
                'constraint' => 3,
            ],
            'id_kec' => [
                'type' => 'VARCHAR',
                'constraint' => 3,
            ],
            'id_kelurahan' => [
                'type' => 'VARCHAR',
                'constraint' => 3,
            ],
            'jml_art' => [
                'type' => 'INT',
                'constraint' => 3,
                'default' => 0
            ],
            'jml_artz' => [
                'type' => 'INT',
                'constraint' => 3,
                'default' => 0
            ],
            'jml_genz' => [
                'type' => 'INT',
                'constraint' => 3,
                'default' => 0
            ],
            'jml_genz_dewasa' => [
                'type' => 'INT',
                'constraint' => 3,
                'default' => 0
            ],
            'jml_genz_anak' => [
                'type' => 'INT',
                'constraint' => 3,
                'default' => 0
            ],
            'nim_pencacah' => [
                'type' => 'VARCHAR',
                'constraint' => '9',
            ],
            'tim_pencacah' => [
                'type' => 'VARCHAR',
                'constraint' => '9',
            ],
            'tgl_listing' => [
                'type' => 'DATE',
                'null'=>true
            ],
            'tgl_periksa' => [
                'type' => 'DATE',
                'null'=>true
            ],
            'catatan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
        ]);
        $this->forge->addKey('no_bs', true);
        $this->forge->createTable('bloksensus');
    }

    public function down()
    {
        $this->forge->dropTable('bloksensus');
    }
}
