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
    public $jmlArt;
    public $jmlArtz;
    public $jmlGenZ;
    public $jmlGenZDewasa;
    public $jmlGenZAnak;

    public $tglListing;
    public $tglPeriksa;
    public $catatan;
    public $status;
    public array $ruta;

    public function __construct(
        $noBS,
        $idKel,
        $namaKel,
        $idKec,
        $namaKec,
        $idKab,
        $namaKab,
        $jmlArt,
        $jmlArtz,
        $jmlGenZ,
        $jmlGenZDewasa,
        $jmlGenZAnak,
        $tglListing,
        $tglPeriksa,
        $status,
        array $ruta
    ) {
        $this->noBS = $noBS;
        $this->idKel = $idKel;
        $this->namaKel = $namaKel;
        $this->idKec = $idKec;
        $this->namaKec = $namaKec;
        $this->idKab = $idKab;
        $this->namaKab = $namaKab;
        $this->jmlArt = $jmlArt;
        $this->jmlArtz = $jmlArtz;
        $this->jmlGenZ = $jmlGenZ;
        $this->jmlGenZDewasa = $jmlGenZDewasa;
        $this->jmlGenZAnak = $jmlGenZAnak;
        $this->tglListing = $tglListing;
        $this->tglPeriksa = $tglPeriksa;
        $this->status = $status;
        $this->ruta = $ruta;
    }
}
