<?php

namespace App\Libraries;

class Rumahtangga
{

    public ?string $kodeRuta;
    public ?string $noBS;
    public ?int $noSegmen;
    public ?int $noBgFisik;
    public ?int $noBgSensus;
    public ?int $noUrutRuta;
    public ?string $namaKrt;
    public ?string $alamat;

    public ?string $isGenzOrtu; // Jika 1 maka true, jika 0 maka false
    public ?int $jmlGenz;

    public ?int $noUrutRtEgb;

    public ?float $long;

    public ?float $lat;

    public ?string $catatan;


    public function __construct(
        ?string $kodeRuta,
        ?string $noSegmen,
        ?string $noBgFisik,
        ?string $noBgSensus,
        ?string $noUrutRuta,
        ?string $namaKrt,
        ?string $alamat,
        ?string $noBS,
        ?string $isGenzOrtu,
        ?int $jmlGenz,
        ?int $noUrutRtEgb,
        ?float $long,
        ?float $lat,
        ?string $catatan
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

    public static function createFromArray(array $data): self
    {
        return new self(
            $data['kode_ruta'] ?? null,
            $data['no_segmen'] ?? null,
            $data['no_bg_fisik'] ?? null,
            $data['no_bg_sensus'] ?? null,
            $data['no_urut_rt'] ?? null,
            $data['nama_krt'] ?? null,
            $data['alamat'] ?? null,
            $data['no_bs'] ?? null,
            $data['is_genz_ortu'] ?? null,
            $data['jml_genz'] ?? null,
            $data['no_urut_rt_egb'] ?? null,
            $data['long'] ?? null,
            $data['lat'] ?? null,
            $data['catatan'] ?? null,
        );
    }
}
