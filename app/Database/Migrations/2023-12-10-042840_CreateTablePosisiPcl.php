<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablePosisiPcl extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nim' => [
                'type' => 'VARCHAR',
                'constraint' => 9,
                'null' => false,
            ],
            'lokus' => [
                'type' => 'VARCHAR',
                'constraint' => 256,
                'null' => true,
                'default' => null,
            ],
            'latitude' => [
                'type' => 'DOUBLE PRECISION',
                'null' => true,
                'default' => null,
            ],
            'longitude' => [
                'type' => 'DOUBLE PRECISION',
                'null' => true,
                'default' => null,
            ],
            'akurasi' => [
                'type' => 'DOUBLE PRECISION',
                'null' => true,
            ],
            'time_created' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
                'on_update' => 'CURRENT_TIMESTAMP',
            ],
        ]);
        $this->forge->addForeignKey('nim', 'mahasiswa', 'nim','CASCADE','CASCADE');
        $this->forge->addPrimaryKey('nim');
        $this->forge->createTable('posisi_pcl', true);
    }

    public function down()
    {
        $this->forge->dropTable('posisi_pcl');
    }
}
