<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIsEnableColumnToRutaMigration extends Migration
{
    public function up()
    {
        $fields = [
            'is_enable' => [
                'type'    => 'VARCHAR',
                'constraint' => '1'
            ],
        ];

        $this->forge->addColumn('rumahtangga', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('rumahtangga', $fields);
    }
}
