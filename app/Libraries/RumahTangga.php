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

    public float $long;

    public float $lat;

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
        $long,
        $lat,
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
        $this->long = $long;
        $this->lat = $lat;
        $this->catatan = $catatan;
    }
    // public static function createFromArray(array $data): self
    // {
    //     return new self(
    //         $data['kode_ruta'],
    //         $data['no_segmen'],
    //         $data['kode_ruta'],
    //         // inisialisasi parameter lainnya dari $data
    //     );
    // }
}
