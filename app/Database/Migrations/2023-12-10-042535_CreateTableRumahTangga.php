<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableRumahTangga extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kode_ruta' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'no_urut_ruta' => [
                'type' => 'VARCHAR',
                'constraint' => 4,
            ],
            'kk_or_krt' => [
                'type' => 'VARCHAR',
                'constraint' => '1',
            ],
            'nama_krt' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'jml_genz_anak' => [
                'type' => 'INT',
                'constraint' => 3,
            ],
            'jml_genz_dewasa' => [
                'type' => 'INT',
                'constraint' => 3,
            ],
            'kat_genz' => [
                'type' => 'VARCHAR',
                'constraint' => 1,
                'null' => true, // 1 : anak, 2 : dewasa, 3 : anak + dewasa
            ],
            'no_urut_ruta_egb' => [
                'type' => 'INT',
                'constraint' => 3,
                'null' => true,
            ],
            'long' => [
                'type' => 'FLOAT',  
                'null' => true, 
            ],
            'lat' => [
                'type' => 'FLOAT',
                'null' => true,
            ],  
            'catatan' => [
                'type' => 'TEXT',
            ], 
            'id_bs' => [ 
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
        ]);
        $this->forge->addKey('kode_ruta', true);
        $this->forge->createTable('rumahtangga');
    }

    public function down()
    {
        $this->forge->dropTable('rumahtangga');
    }
}
