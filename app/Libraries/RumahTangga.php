<?php

namespace App\Libraries;

class Rumahtangga
{

    public string $kodeRuta;
    public string $noBS;
    public string $noSegmen;
    public string $noBgFisik;
    public string $noBgSensus;
    public string $noUrutRuta;
    public string $namaKrt;
    public string $alamat;

    public string $isGenzOrtu; // Jika 1 maka true, jika 0 maka false
    public int $jmlGenz;

    public int $noUrutRtEgb;

    public string $catatan;



    // tambahkan longitude dan latitude

    public function __construct(
        $kodeRuta,
        $noSegmen,
        $noBgFisik,
        $noBgSensus,
        $noUrutRuta,
        $namaKrt,
        $alamat,
        $noBS,
        $isGenzOrtu,
        $jmlGenz,
        $noUrutRtEgb,
        $catatan
    ) {
        $this->kodeRuta = $kodeRuta;
        $this->noSegmen = $noSegmen;
        $this->noBgFisik = $noBgFisik;
        $this->noBgSensus = $noBgSensus;
        $this->namaKrt = $namaKrt;
        $this->noUrutRuta = $noUrutRuta;
        $this->alamat = $alamat;
        $this->noBS = $noBS;
        $this->isGenzOrtu = $isGenzOrtu;
        $this->jmlGenz = $jmlGenz;
        $this->noUrutRtEgb = $noUrutRtEgb;
        $this->catatan = $catatan;
    }
}
