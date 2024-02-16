<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableDataSt extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_bs' => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
            ],
            'kode_ruta' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '1',
                'default' => '1' // 1 (belum cacah), 2(sudah cacah)
            ],
        ]);
        $this->forge->addForeignKey('kode_ruta', 'rumahtangga', 'kode_ruta','CASCADE','CASCADE');
        $this->forge->addForeignKey('id_bs', 'bloksensus', 'id_bs','CASCADE','CASCADE');
        $this->forge->addKey('kode_ruta', true);
        $this->forge->createTable('datast');
    }

    public function down()
    {
        $this->forge->dropTable('datast');
    }
}
