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
    public int $jmlRt;
    public int  $jmlRtGenz;
    public int $jmlGenZ;

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
        $jmlRt,
        $jmlRtGenz,
        $jmlGenZ,
        $tglListing,
        $tglPeriksa,
        $status,
        $catatan,
        array $ruta
    ) {
        $this->noBS = $noBS;
        $this->idKel = $idKel;
        $this->namaKel = $namaKel;
        $this->idKec = $idKec;
        $this->namaKec = $namaKec;
        $this->idKab = $idKab;
        $this->namaKab = $namaKab;
        $this->jmlRt = $jmlRt;
        $this->jmlRtGenz = $jmlRtGenz;
        $this->jmlGenZ = $jmlGenZ;
        $this->tglListing = $tglListing;
        $this->tglPeriksa = $tglPeriksa;
        $this->status = $status;
        $this->catatan = $catatan;
        $this->ruta = $ruta;
    }
}
