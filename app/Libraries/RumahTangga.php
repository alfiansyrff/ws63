<?php

namespace App\Libraries;

class Rumahtangga
{

    public ?string $kodeRuta;
    public ?int $noUrutRuta;
    public ?string $kkOrKrt;
    public ?string $namaKrt;
    public ?int $isGenzOrtu;
    public ?int $katGenz;
    public ?int $noUrutEgb;
    public ?float $long;
    public ?float $lat;
    public ?string $catatan;
    public ?string $noBS;
    public ?string $nimPencacah;

    public function __construct(
        ?string $kodeRuta,
        ?int $noUrutRuta,
        ?string $kkOrKrt,
        ?string $namaKrt,
        ?int $isGenzOrtu,
        ?int $katGenz,
        ?int $noUrutEgb,
        ?float $long,
        ?float $lat,
        ?string $catatan,
        ?string $noBS,
        ?string $nimPencacah
    ) {
        $this->kodeRuta = $kodeRuta;
        $this->noUrutRuta = $noUrutRuta;
        $this->kkOrKrt = $kkOrKrt;
        $this->namaKrt = $namaKrt;
        $this->isGenzOrtu = $isGenzOrtu;
        $this->katGenz = $katGenz;
        $this->noUrutEgb = $noUrutEgb;
        $this->long = $long;
        $this->lat = $lat;
        $this->catatan = $catatan;
        $this->noBS = $noBS;
        $this->nimPencacah = $nimPencacah;
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
            $data['no_urut_ruta_egb'] ?? null,
            $data['long'] ?? null,
            $data['lat'] ?? null,
            $data['catatan'] ?? null,
            $data['no_bs'] ?? null,
            $data['nim_pencacah'] ?? null,  
        );
    }
}
