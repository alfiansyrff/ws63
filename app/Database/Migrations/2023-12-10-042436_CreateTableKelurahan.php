<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableKelurahan extends Migration
{
    public function up()
    {
        // Definisi kolom tabel kelurahan
        $fields = [
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
            'nama_kel' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ];

        $this->forge->addField($fields);

        // Menambahkan foreign key ke tabel kabupaten
        $this->forge->addForeignKey(['id_kab', 'id_kec'], 'kecamatan', ['id_kab', 'id_kec'], 'CASCADE', 'CASCADE');

        // Menambahkan primary key
        $this->forge->addKey(['id_kab', 'id_kec', 'id_kel'], true);

        // Membuat tabel kelurahan
        $this->forge->createTable('kelurahan');
    }

    public function down()
    {
        // Menghapus tabel kelurahan
        $this->forge->dropTable('kelurahan');
    }
}
