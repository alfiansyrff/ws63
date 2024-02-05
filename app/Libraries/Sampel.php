<?php

namespace App\Libraries;

class Sampel
{
    public string $kodeRuta;
    public string $SLS;
    public string $noSegmen;
    public string $noBgFisik;
    public string $noBgSensus;
    public string $noUrutKlg;
    public int $noUrutRuta;

    public int $noUrutRutaEgb;
    public string $isGenzOrtuKeluarga;
    public $alamat;
    public string $namaKrt;
    public int $isGenzOrtuRuta;
    public float  $long;
    public float  $lat;
    public string $status;
    public string $idBS;

    public function __construct($kodeRuta, $SLS, $noSegmen, $noBgFisik, $noBgSensus, $noUrutKlg, $noUrutRuta,$noUrutRutaRgb, $isGenzOrtuKeluarga, $alamat, $namaKrt, $isGenzOrtuRuta, $long, $lat, $status, $idBS)
    {
        $this->kodeRuta = $kodeRuta;
        $this->SLS = $SLS;
        $this->noSegmen = $noSegmen;
        $this->noBgFisik = $noBgFisik;
        $this->noBgSensus = $noBgSensus;
        $this->noUrutKlg = $noUrutKlg;
        $this->noUrutRuta = $noUrutRuta;
        $this->noUrutRutaEgb = $noUrutRutaRgb;
        $this->isGenzOrtuKeluarga = $isGenzOrtuKeluarga;
        $this->alamat = $alamat;
        $this->namaKrt = $namaKrt;
        $this->isGenzOrtuRuta = $isGenzOrtuRuta;
        $this->long = $long;
        $this->lat = $lat;
        $this->status = $status;
        $this->idBS = $idBS;

    }


    public static function createFromArrayRutaKeluarga($data)
    {     
        $noBgFisik = '';
        $noBgSensus = '';
        $noUrutKlg = '';
        $isGenzOrtuKeluarga = '';
        foreach ($data['keluarga'] as $keluarga) {    
            $noBgFisik = $noBgFisik . ", ".str_pad($keluarga['no_bg_fisik'], 3, '0', STR_PAD_LEFT);
            $noBgSensus = $noBgSensus . ", ". str_pad(trim($keluarga['no_bg_sensus']), 3, '0', STR_PAD_LEFT);
            $noUrutKlg = $noUrutKlg . ", " . str_pad(trim($keluarga['no_urut_klg_egb']), 3, '0', STR_PAD_LEFT);
            $isGenzOrtuKeluarga = $isGenzOrtuKeluarga. ", " . $keluarga['is_genz_ortu'];
        }

        $noBgFisik = substr($noBgFisik, 2);
        $noBgSensus = substr($noBgSensus, 2);
        $noUrutKlg = substr($noUrutKlg, 2);
        $isGenzOrtuKeluarga = substr($isGenzOrtuKeluarga, 2);

        return new self(
            $data['kode_ruta'],
            $data['keluarga'][0]['SLS'],
            $data['keluarga'][0]['no_segmen'],
            $noBgFisik,
            $noBgSensus,
            $noUrutKlg,
            $data['no_urut_ruta'],
            $data['no_urut_ruta_egb'],
            $isGenzOrtuKeluarga,
            $data['keluarga'][0]['alamat'],
            $data['nama_krt'],
            $data['is_genz_ortu'],
            $data['long'],
            $data['lat'],
            $data['status'],
            $data['id_bs']
        );
    }
}
