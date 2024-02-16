<?php

namespace App\Libraries;

class Tim
{
    public string $id_tim;
    public string $nama_tim;
    public  $nim_pml;
    public array $anggota;

    public function __construct($id_tim, $nama_tim, $nim_pml, $anggota)
    {
        $this->id_tim = $id_tim;
        $this->nama_tim = $nama_tim;
        $this->nim_pml = $nim_pml;
        $this->anggota = $anggota;
    }

    public function getNimAnggota()
    {
        $nim_anggota = array();
        foreach ($this->anggota as $anggota_item) {
            array_push($nim_anggota, $anggota_item->nim);
        }
        return $nim_anggota;
    }
}
