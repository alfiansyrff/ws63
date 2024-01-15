<?php

namespace App\Libraries;

class Keluarga
{
    public $kodeKlg;
    public $SLS;
    public int $noSegmen;
    public int $noBgFisik;
    public int $noBgSensus;
    public int $noUrutKlg;
    public $namaKK;
    public $alamat;
    public int $isGenzOrtu;
    public ?int $noUrutKlgEgb;
    public int $penglMkn;
    public $noBS;
    public array $ruta;

    public function __construct(
        $kodeKlg,
        $SLS,
        int $noSegmen,
        int $noBgFisik,
        int $noBgSensus,
        int $noUrutKlg,
        $namaKK,
        $alamat,
        int $isGenzOrtu,
        ?int $noUrutKlgEgb,
        int $penglMkn,
        $noBS,
        array $ruta
    ) {
        $this->kodeKlg = $kodeKlg;
        $this->SLS = $SLS;
        $this->noSegmen = $noSegmen;
        $this->noBgFisik = $noBgFisik;
        $this->noBgSensus = $noBgSensus;
        $this->noUrutKlg = $noUrutKlg;
        $this->namaKK = $namaKK;
        $this->alamat = $alamat;
        $this->isGenzOrtu = $isGenzOrtu;
        $this->noUrutKlgEgb = $noUrutKlgEgb ?? null;
        $this->penglMkn = $penglMkn;
        $this->noBS = $noBS;
        $this->ruta = $ruta;
    }

    public static function createFromArray(array $data): self
    {

        $listRuta = [];
        if (count($data['ruta']) > 0) {
            $ruta_array = $data['ruta'];
            foreach ($ruta_array as $rutaTemp) {
                array_push($listRuta, Rumahtangga::createFromArray($rutaTemp));
            }
        }

        return new self(
            $data['kode_klg'],
            $data['SLS'],
            $data['no_segmen'],
            $data['no_bg_fisik'],
            $data['no_bg_sensus'],
            $data['no_urut_klg'],
            $data['nama_kk'],
            $data['alamat'],
            $data['is_genz_ortu'],
            $data['no_urut_klg_egb'] ?? 0,
            $data['pengl_mkn'] ?? 0,
            $data['no_bs'],
            $listRuta ?? []
        );
    }
}
