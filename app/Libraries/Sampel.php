<?php

namespace App\Libraries;

class Sampel
{
    public $SLS;
    public int $noSegmen;
    public array $noBgFisik;
    public array $noBgSensus;
    public array $noUrutKlg;
    public int $noUrutRuta;
    public array $isGenzOrtuKeluarga;
    public $alamat;
    public string $namaKrt;
    public int $isGenzOrtuRuta;

    public function __construct($SLS, $noSegmen, $noBgFisik, $noBgSensus, $noUrutKlg, $noUrutRuta, $isGenzOrtuKeluarga, $alamat, $namaKrt, $isGenzOrtuRuta)
    {
        $this->SLS = $SLS;
        $this->noSegmen = $noSegmen;
        $this->noBgFisik = $noBgFisik;
        $this->noBgSensus = $noBgSensus;
        $this->noUrutKlg = $noUrutKlg;
        $this->noUrutRuta = $noUrutRuta;
        $this->isGenzOrtuKeluarga = $isGenzOrtuKeluarga;
        $this->alamat = $alamat;
        $this->namaKrt = $namaKrt;
        $this->isGenzOrtuRuta = $isGenzOrtuRuta;
    }


    public static function createFromArrayRutaKeluarga($data)
    {

        $noBgFisik = [];
        $noBgSensus = [];
        $noUrutKlg = [];
        $isGenzOrtuKeluarga = [];
        foreach ($data['keluarga'] as $keluarga) {    
            array_push($noBgFisik, intval($keluarga['no_bg_fisik']));
            array_push($noBgSensus, intval($keluarga['no_bg_sensus']));
            array_push($noUrutKlg, intval($keluarga['no_urut_klg']));
            array_push($isGenzOrtuKeluarga, intval($keluarga['is_genz_ortu']));
        }

        return new self(
            $data['keluarga'][0]['SLS'],
            $data['keluarga'][0]['no_segmen'],
            $noBgFisik,
            $noBgSensus,
            $noUrutKlg,
            $data['no_urut_ruta'],
            $isGenzOrtuKeluarga,
            $data['keluarga'][0]['alamat'],
            $data['nama_krt'],
            $data['is_genz_ortu']
        );
    }
}
