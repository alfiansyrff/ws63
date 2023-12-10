<?php
namespace App\Libraries;
use DateTime;

class PosisiPcl{
    public string $nim;
    public string $nama;
    //public string \$no_hp;
    public int $id_tim;
    public string $lokus;
    public float $latitude;
    public float $longitude;
    //public float $akurasi;
    //public DateTime $timeCreated;

    public function __construct($nim, $nama, $id_tim, $lokus, $latitude, $longitude){
        $this->nim = $nim;
        $this->nama = $nama;
        //$this->noHp = $no_hp;
        $this->id_tim = $id_tim;
        $this->lokus = $lokus;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        //$this->akurasi = $akurasi;
        //$this->timeCreated = $timeCreated;
    }
}
?>