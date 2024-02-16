<?php

namespace App\Libraries;

class WilayahKerja
{
    public $idBS;
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

    public ?string $tglListing;
    public ?string $tglPeriksa;
    public ?string $catatan;
    public ?string $status;
    public array $keluarga;

    public function __construct(
        $idBS,
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
        $this->idBS = $idBS;
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
        $this->tglListing = $tglListing ?? null;
        $this->tglPeriksa = $tglPeriksa ?? null;
        $this->status = $status ?? null;
        $this->catatan = $catatan ?? null;
        $this->keluarga = $keluarga;
    }
}
