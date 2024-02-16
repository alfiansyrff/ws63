<?php
namespace App\Libraries;
use DateTime;

class PosisiPcl{
    public string $nim;
    public string $nama;
    public string $no_hp;
    public int $id_tim;
    public string $lokus;
    public float $latitude;
    public float $longitude;
    public float $akurasi;
    public DateTime $timeCreated;

    public function __construct($nim, $latitude, $longitude, $akurasi){
        $this->nim = $nim;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->akurasi = $akurasi;
    }
}
?>