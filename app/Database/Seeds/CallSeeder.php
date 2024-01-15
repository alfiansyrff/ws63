<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CallSeeder extends Seeder
{
    public function run()
    {
        $this->call('MahasiswaSeeder');
        $this->call('TimPencacahSeeder');
        $this->call('KabupatenSeeder');
        $this->call('KecamatanSeeder');
        $this->call('KelurahanSeeder');
        $this->call('BlokSensusSeeder');
        $this->call('KeluargaSeeder');
        $this->call('RumahTanggaSeeder');
        $this->call('KeluragaRutaSeeder');
        $this->call('PosisiPclSeeder');
    }
}
