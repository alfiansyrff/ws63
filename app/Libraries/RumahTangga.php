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
        $noUrutRuta,
        $namaKrt,
        $alamat,
        $noBS
    ) {
        $this->kodeRuta = $kodeRuta;
        $this->noSegmen = $noSegmen;
        $this->noBgFisik = $noBgFisik;
        $this->noBgSensus = $noBgSensus;
        $this->namaKrt = $namaKrt;
        $this->noUrutRuta = $noUrutRuta;
        $this->alamat = $alamat;
        $this->noBS = $noBS;
    }
}
