<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableBlokSensusMahasiswa extends Migration
{
    public function up()    
    {
        $this->forge->addField([ // tambahkan untuk menyimpan id kab 
            'no_bs' => [
                'type' => 'VARCHAR',
                'constraint' => 4,
            ],
            'nim' => [
                'type' => 'VARCHAR',
                'constraint' => '9',
            ],
        ]);
        $this->forge->addForeignKey('no_bs', 'bloksensus', 'no_bs', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('nim', 'mahasiswa', 'nim', 'CASCADE', 'CASCADE');
        $this->forge->addPrimaryKey(['no_bs', 'nim']);
        $this->forge->createTable('bloksensus_mahasiswa');
    }

    public function down()
    {
        $this->forge->dropTable('bloksensus_mahasiswa');
    }
}
