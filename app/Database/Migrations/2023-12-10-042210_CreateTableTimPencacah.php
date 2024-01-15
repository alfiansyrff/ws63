<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableTimPencacah extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tim' => [
                'type' => 'SERIAL',
                'unsigned' => true,
            ],
            'nama_tim' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nim_pml' => [
                'type' => 'VARCHAR',
                'constraint' => '9'
            ],
        ]);

        $this->forge->addPrimaryKey('id_tim');
        $this->forge->addKey('nim_pml', true);
        $this->forge->createTable('timpencacah');
    }

    public function down()
    {
        $this->forge->dropTable('timpencacah');
    }
}
