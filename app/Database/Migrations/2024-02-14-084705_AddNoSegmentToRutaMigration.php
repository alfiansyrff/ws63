<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNoSegmentToRutaMigration extends Migration
{
    public function up()
    {
        $fields = [
            'no_segmen' => [
                'type'    => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
        ];

        $this->forge->addColumn('rumahtangga', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('rumahtangga', 'no_segmen');
    }
}
