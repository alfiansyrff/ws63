<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableVersionMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'riset' => [
                'type' => 'VARCHAR',
                'constraint' => 3,
            ],
            'latest_version' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'latest_version_code' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'release_notes' => [
                'type' => 'TEXT',
                'null' => false,
            ]
        ]);

        $this->forge->addPrimaryKey('riset');
        $this->forge->createTable('versions');   
    }

    public function down()
    {
        $this->forge->dropTable('versions');
    }
}
