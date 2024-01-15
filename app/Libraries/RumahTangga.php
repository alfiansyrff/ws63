<?php

namespace App\Libraries;

class Rumahtangga
{

    public ?string $kodeRuta;
    public ?int $noUrutRuta;
    public ?string $kkOrKrt;
    public ?string $namaKrt;
    public ?string $isGenzOrtu;
    public ?int $katGenz;
    public ?float $long;
    public ?float $lat;
    public ?string $catatan;
    public ?string $noBS;

    public function __construct(
        ?string $kodeRuta,
        ?int $noUrutRuta,
        ?string $kkOrKrt,
        ?string $namaKrt,
        ?string $isGenzOrtu,
        ?int $katGenz,
        ?float $long,
        ?float $lat,
        ?string $catatan,
        ?string $noBS
    ) {
        $this->kodeRuta = $kodeRuta;
        $this->noUrutRuta = $noUrutRuta;
        $this->kkOrKrt = $kkOrKrt;
        $this->namaKrt = $namaKrt;
        $this->isGenzOrtu = $isGenzOrtu;
        $this->katGenz = $katGenz;
        $this->long = $long;
        $this->lat = $lat;
        $this->catatan = $catatan;
        $this->noBS = $noBS;
    }

    public static function createFromArray(array $data): self
    {
        return new self(
            $data['kode_ruta'] ?? null,
            $data['no_urut_ruta'] ?? null,
            $data['kk_or_krt'] ?? null,
            $data['nama_krt'] ?? null,
            $data['is_genz_ortu'] ?? null,
            $data['kat_genz'] ?? null,
            $data['long'] ?? null,
            $data['lat'] ?? null,
            $data['catatan'] ?? null,
            $data['no_bs'] ?? null
        );
    }
}
