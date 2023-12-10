<?php

namespace App\Libraries;

class Rumahtangga
{

    public string $kodeRuta;
    public string $noSegmen;
    public string $noBgFisik;
    public string $noBgSensus;
    public string $noUrutRuta;
    public string $namaKrt;
    public string $alamat;
    // public string $noHp;
    public string $noBS;

    // tambahkan longitude dan latitude

    public function __construct(
        $kodeRuta,
        $noSegmen,
        $noBgFisik,
        $noBgSensus,
        $namaKrt,
        $alamat,
        $noBS
    ) {
        $this->kodeRuta = $kodeRuta;
        $this->noSegmen = $kodeRuta;
        $this->noBgFisik = $kodeRuta;
        $this->noBgSensus = $kodeRuta;
        $this->namaKrt = $kodeRuta;
        $this->alamat = $kodeRuta;
        $this->noBS = $kodeRuta;
    }
}
