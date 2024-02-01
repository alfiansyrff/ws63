<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableBlokSensus extends Migration
{
    public function up()
    {
        $this->forge->addField([ // tambah satu atribut id bs, gabungan id prov, id kab, id kec, id kel, no_bs
            // tambah atribut id tim
            'id_bs' =>[
                'type' => 'VARCHAR',
                'constraint' => '20'
            ],
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
            'id_tim' => [
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
        $this->forge->addKey('id_bs', true);
        $this->forge->addForeignKey(['id_kab', 'id_kec','id_kel'], 'kelurahan', ['id_kab', 'id_kec','id_kel'], 'CASCADE', 'CASCADE');
        $this->forge->createTable('bloksensus');
    }

    public function down()
    {
        $this->forge->dropTable('bloksensus');
    }
}
