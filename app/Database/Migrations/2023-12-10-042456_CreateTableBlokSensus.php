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
            'id_prov' =>[
                'type' => 'VARCHAR',
                'constraint' => '2',
                'default' => '51',
            ],
            'id_kab' => [
                'type' => 'VARCHAR',
                'constraint' => 3,
            ],
            'id_kec' => [
                'type' => 'VARCHAR',
                'constraint' => 3,
            ],
            'id_kel' => [
                'type' => 'VARCHAR',
                'constraint' => 3,
            ],
            'nama_sls' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'jml_klg' => [
                'type' => 'INT',
                'constraint' => 3,
                'default' => 0
            ],
            'jml_klg_egb' => [
                'type' => 'INT',
                'constraint' => 3,
                'default' => 0
            ],
            'jml_rt' => [
                'type' => 'INT',
                'constraint' => 3,
                'default' => 0
            ],
           
            'jml_rt_egb' => [
                'type' => 'INT',
                'constraint' => 3,
                'default' => 0
            ],
            'nim_pencacah' => [
                'type' => 'VARCHAR',
                'constraint' => '9',
            ],
            'tim' => [
                'type' => 'int',
                'constraint' => '11',
            ],
            'tgl_listing' => [
                'type' => 'DATE',
                'null' => true
            ],
            'tgl_periksa' => [
                'type' => 'DATE',
                'null' => true
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
        $this->forge->addForeignKey('nim_pencacah', 'mahasiswa', 'nim','CASCADE','CASCADE');
        $this->forge->addForeignKey(['id_kab', 'id_kec','id_kel'], 'kelurahan', ['id_kab', 'id_kec','id_kel'], 'CASCADE', 'CASCADE');
        $this->forge->addKey('no_bs', true);
        $this->forge->createTable('bloksensus');
    }

    public function down()
    {
        $this->forge->dropTable('bloksensus');
    }
}
