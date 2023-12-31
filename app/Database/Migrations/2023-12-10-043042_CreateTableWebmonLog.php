<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableWebmonLog extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'email' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
            ],
            'waktu' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
            ],
        ]);

        $this->forge->createTable('webmon_log');
    }

    public function down()
    {
        $this->forge->dropTable('webmon_log');
    }
}
