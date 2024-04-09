<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\WilayahKerja;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\KeluargaModel;
use App\Models\RutaModel;
use App\Models\WilayahKerjaModel;

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
        // $fileName = 'Data_BS_' . $idBs;

        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        // header('Cache-Control: max-age=0');

        $writer->save('php://output');
        // exit;
    }


    public function exportAll()
    {
        $wkModel = new WilayahKerjaModel();
        $listBs = $wkModel->getAllBS();

        // Inisialisasi objek ZipArchive
        $zip = new \ZipArchive();
        $zipFileName = 'Listing PKL 63 Politeknik Statistika STIS.zip';

        // Buat file ZIP
        if ($zip->open($zipFileName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
            foreach ($listBs as $bs) {
                // Generate nama file Excel untuk setiap ID BS
                $excelFileName = 'Data_BS_' . $bs['id_bs'] . '.xlsx';

                // Buat file Excel untuk setiap ID BS
                ob_start(); // Mulai output buffering agar hasil ekspor masuk ke memori
                $this->index($bs['id_bs']); // Panggil method index() untuk menghasilkan file Excel
                $excelData = ob_get_clean(); // Ambil hasil output buffering (file Excel) dari memori

                // Tambahkan file Excel ke dalam ZIP
                $zip->addFromString($excelFileName, $excelData);
            }

            // Tutup proses ZIP
            $zip->close();
        }

        // Set header untuk file ZIP
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment;filename=' . $zipFileName);
        header('Cache-Control: max-age=0');

        // Keluarkan file ZIP
        readfile($zipFileName);

        // Hapus file ZIP setelah dikirim
        unlink($zipFileName);

        exit;
    }
}
