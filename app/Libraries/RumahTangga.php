<?php

namespace App\Libraries;

class Rumahtangga
{

    public ?string $kodeRuta;
    public ?int $noUrutRuta;
    public ?string $kkOrKrt;
    public ?string $namaKrt;
    public ?int $jmlGenzAnak;
    public ?int $jmlGenzDewasa;
    public ?int $katGenz;
    public ?int $noUrutEgb;
    public ?float $long;
    public ?float $lat;
    public ?string $catatan;
    public ?string $idBS;
    public ?string $nimPencacah;
    public ?string $noBs;

    public ?string $noSegmen; 

    public function __construct(
        ?string $kodeRuta,
        ?int $noUrutRuta,
        ?string $kkOrKrt,
        ?string $namaKrt,
        ?int $jmlGenzAnak,
        ?int $jmlGenzDewasa,
        ?int $katGenz,
        ?int $noUrutEgb,
        ?float $long,
        ?float $lat,
        ?string $catatan,
        ?string $idBS,
        ?string $nimPencacah,
        ?string $noBs,
        ?string $noSegmen
    ) {
        $this->kodeRuta = $kodeRuta;
        $this->noUrutRuta = $noUrutRuta;
        $this->kkOrKrt = $kkOrKrt;
        $this->namaKrt = $namaKrt;
        $this->jmlGenzAnak = $jmlGenzAnak;
        $this->jmlGenzDewasa = $jmlGenzDewasa;
        $this->katGenz = $katGenz;
        $this->noUrutEgb = $noUrutEgb;
        $this->long = $long;
        $this->lat = $lat;
        $this->catatan = $catatan;
        $this->idBS = $idBS;
        $this->nimPencacah = $nimPencacah;
        $this->noBs = $noBs;
        $this->noSegmen = $noSegmen;
    }

    public static function createFromArray(array $data): self
    {
        return new self(
            $data['kode_ruta'] ?? null,
            $data['no_urut_ruta'] ?? null,
            $data['kk_or_krt'] ?? null,
            $data['nama_krt'] ?? null,
            $data['jml_genz_anak'] ?? null,
            $data['jml_genz_dewasa'] ?? null,
            $data['kat_genz'] ?? null,
            $data['no_urut_ruta_egb'] ?? null,
            $data['long'] ?? null,
            $data['lat'] ?? null,
            $data['catatan'] ?? null,
            $data['id_bs'] ?? null,
            $data['nim_pencacah'] ?? null,  
            $data['no_bs'] ?? null,
            $data['no_segmen']
        );
    }
}
