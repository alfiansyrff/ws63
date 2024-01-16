<?php

namespace App\Libraries;
use App\Libraries\Tim;
use App\Libraries\WilayahKerja;

class Mahasiswa
{
    public string $nim;
    public string $nama;
    public string $no_hp;
    public string $alamat;
    public string $email;

    public string $password;
    public string $foto;
    public string $id_tim;
    public  $wilayah_kerja;
    // public int $total_progress;
    public bool $isKoor;
    public string $token;

    public function __construct($nim, $nama, $no_hp, $alamat, $email, $password, $foto, $id_tim, $wilayah_kerja, $isKoor, $token)
    {
        $this->nim = $nim;
        $this->nama = $nama;
        $this->no_hp = $no_hp;
        $this->alamat = $alamat;
        $this->email = $email;
        $this->password = $password;
        $this->foto = $foto;
        $this->id_tim = $id_tim;
        $this->wilayah_kerja = $wilayah_kerja;
        // $this->total_progress = $total_progress;
        $this->isKoor = $isKoor;
        $this->token = $token;
    }
}
