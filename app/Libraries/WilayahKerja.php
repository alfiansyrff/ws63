<?php

namespace App\Libraries;

class WilayahKerja
{
    public $noBS;
    public $idKel;
    public $namaKel;
    public $idKec;
    public $namaKec;
    public $idKab;
    public $namaKab;
    public int $jmlKlg;
    public int  $jmlKlgEgb;
    public int $jmlRuta;
    public int $jmlRutaEgb;

    public $tglListing;
    public $tglPeriksa;
    public $catatan;
    public $status;
    public array $keluarga;

    public function __construct(
        $noBS,
        $idKel,
        $namaKel,
        $idKec,
        $namaKec,
        $idKab,
        $namaKab,
        $jmlKlg,
        $jmlKlgEgb,
        $jmlRuta,
        $jmlRutaEgb,
        $tglListing,
        $tglPeriksa,
        $status,
        $catatan,
        array $keluarga
    ) {
        $this->noBS = $noBS;
        $this->idKel = $idKel;
        $this->namaKel = $namaKel;
        $this->idKec = $idKec;
        $this->namaKec = $namaKec;
        $this->idKab = $idKab;
        $this->namaKab = $namaKab;
        $this->jmlKlg = $jmlKlg;
        $this->jmlKlgEgb = $jmlKlgEgb;
        $this->jmlRuta = $jmlRuta;
        $this->jmlRutaEgb = $jmlRutaEgb;
        $this->tglListing = $tglListing;
        $this->tglPeriksa = $tglPeriksa;
        $this->status = $status;
        $this->catatan = $catatan;
        $this->keluarga = $keluarga;
    }
}
