<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\KeluargaModel;
use App\Models\RutaModel;

class ExportRutaController extends BaseController
{
    public function index($idBs)
    {
        $klg = new KeluargaModel();
        $ruta = new RutaModel();
        
        $dataKlg = $klg->getAllKeluarga($idBs);

        $spreadsheet = new Spreadsheet();

        $sheetData = $spreadsheet->getActiveSheet();
        $sheetData->setTitle('Data Listing');
        
        $sheetData->setCellValue('A1', 'SLS');
        $sheetData->setCellValue('B1', 'No Segmen');
        $sheetData->setCellValue('C1', 'No BF');
        $sheetData->setCellValue('D1', 'No BS');
        $sheetData->setCellValue('E1', 'No urut keluarga');
        $sheetData->setCellValue('F1', 'Nama KK');
        $sheetData->setCellValue('G1', 'Alamat');
        $sheetData->setCellValue('H1', 'Keberadaan Gen Z dan Ortu');
        $sheetData->setCellValue('I1', 'No urut keluarga egb');
        $sheetData->setCellValue('J1', 'Jml Pengelolaan Makan/Minum');
        $sheetData->setCellValue('K1', 'Identifikasi KK/KRT');
        $sheetData->setCellValue('L1', 'Nama KRT');
        $sheetData->setCellValue('M1', 'Jml Gen Z anak');
        $sheetData->setCellValue('N1', 'Jml Gen Z dewasa');
        $sheetData->setCellValue('O1', 'Kat RT Gen Z');

        

        $columnRuta = 2;

        foreach ($dataKlg as $data) {
            foreach ($data->ruta as $rutaData) {
                $sheetData->setCellValue('A' . $columnRuta, $data->SLS);
                $sheetData->setCellValue('B' . $columnRuta, $data->noSegmen);
                $sheetData->setCellValue('C' . $columnRuta, $data->noBgFisik);
                $sheetData->setCellValue('D' . $columnRuta, $data->noBgSensus);
                $sheetData->setCellValue('E' . $columnRuta, $data->noUrutKlg);
                $sheetData->setCellValue('F' . $columnRuta, $data->namaKK);
                $sheetData->setCellValue('G' . $columnRuta, $data->alamat);
                $sheetData->setCellValue('H' . $columnRuta, $data->isGenzOrtu);
                $sheetData->setCellValue('I' . $columnRuta, $data->noUrutKlgEgb);
                $sheetData->setCellValue('J' . $columnRuta, $data->penglMkn);
                $sheetData->setCellValue('K' . $columnRuta, $rutaData->kkOrKrt);
                $sheetData->setCellValue('L' . $columnRuta, $rutaData->namaKrt);
                $sheetData->setCellValue('M' . $columnRuta, $rutaData->jmlGenzAnak);
                $sheetData->setCellValue('N' . $columnRuta, $rutaData->jmlGenzDewasa);
                $sheetData->setCellValue('O' . $columnRuta, $rutaData->katGenz);
                $columnRuta++;
            }
          
        }

        

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data_BS_' . $idBs;

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
   
}
