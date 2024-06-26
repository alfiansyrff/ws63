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


    public function exportToZipPerKab($idKab)
    {
        $wkModel = new WilayahKerjaModel();
        // $listBs = $wkModel->getAllBS();
        $listBs = $wkModel->getBsByIdKab($idKab);

        // Inisialisasi objek ZipArchive
        $zip = new \ZipArchive();
        $zipFileName = $idKab . 'Data_Listing.zip';

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


    public function exportAllDataToExcel()
    {
        $klg = new KeluargaModel();
        $ruta = new RutaModel();

        $dataKlg = $klg->getAllKeluargaAll();

        $spreadsheet = new Spreadsheet();

        $sheetData = $spreadsheet->getActiveSheet();
        $sheetData->setTitle('Data Listing');

        $sheetData->setCellValue('A1', 'Blok Sensus');
        $sheetData->setCellValue('B1', 'SLS');
        $sheetData->setCellValue('C1', 'No Segmen');
        $sheetData->setCellValue('D1', 'No BF');
        $sheetData->setCellValue('E1', 'No BS');
        $sheetData->setCellValue('F1', 'No urut keluarga');
        $sheetData->setCellValue('G1', 'Nama KK');
        $sheetData->setCellValue('H1', 'Alamat');
        $sheetData->setCellValue('I1', 'Keberadaan Gen Z dan Ortu');
        $sheetData->setCellValue('J1', 'No urut keluarga egb');
        $sheetData->setCellValue('K1', 'Jml Pengelolaan Makan/Minum');
        $sheetData->setCellValue('L1', 'Identifikasi KK/KRT');
        $sheetData->setCellValue('M1', 'Nama KRT');
        $sheetData->setCellValue('N1', 'Jml Gen Z anak');
        $sheetData->setCellValue('O1', 'Jml Gen Z dewasa');
        $sheetData->setCellValue('P1', 'Kat RT Gen Z');
        $columnRuta = 2;

        foreach ($dataKlg as $data) {
            foreach ($data->ruta as $rutaData) {
                $sheetData->setCellValue('A' . $columnRuta, $data->idBS);
                $sheetData->setCellValue('B' . $columnRuta, $data->SLS);
                $sheetData->setCellValue('C' . $columnRuta, $data->noSegmen);
                $sheetData->setCellValue('D' . $columnRuta, $data->noBgFisik);
                $sheetData->setCellValue('E' . $columnRuta, $data->noBgSensus);
                $sheetData->setCellValue('F' . $columnRuta, $data->noUrutKlg);
                $sheetData->setCellValue('G' . $columnRuta, $data->namaKK);
                $sheetData->setCellValue('H' . $columnRuta, $data->alamat);
                $sheetData->setCellValue('I' . $columnRuta, $data->isGenzOrtu);
                $sheetData->setCellValue('J' . $columnRuta, $data->noUrutKlgEgb);
                $sheetData->setCellValue('K' . $columnRuta, $data->penglMkn);
                $sheetData->setCellValue('L' . $columnRuta, $rutaData->kkOrKrt);
                $sheetData->setCellValue('M' . $columnRuta, $rutaData->namaKrt);
                $sheetData->setCellValue('N' . $columnRuta, $rutaData->jmlGenzAnak);
                $sheetData->setCellValue('O' . $columnRuta, $rutaData->jmlGenzDewasa);
                $sheetData->setCellValue('P' . $columnRuta, $rutaData->katGenz);
                $columnRuta++;
            }
        }



        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data_Hasil_Listing';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    public function exportAllDataToExcelPerKab($idKab)
    {
        $klg = new KeluargaModel();
        $ruta = new RutaModel();


        $dataKlg = [];
        $wkModel = new WilayahKerjaModel();
        $listBs = $wkModel->getBsByIdKab($idKab);
        foreach ($listBs as $bs) {
            $temp = $klg->getAllKeluarga($bs['id_bs']);
            foreach ($temp as $data) {
                array_push($dataKlg, $data);
            }
        }

        $spreadsheet = new Spreadsheet();

        $sheetData = $spreadsheet->getActiveSheet();
        $sheetData->setTitle('Data Listing');

        $sheetData->setCellValue('A1', 'Blok Sensus');
        $sheetData->setCellValue('B1', 'SLS');
        $sheetData->setCellValue('C1', 'No Segmen');
        $sheetData->setCellValue('D1', 'No BF');
        $sheetData->setCellValue('E1', 'No BS');
        $sheetData->setCellValue('F1', 'No urut keluarga');
        $sheetData->setCellValue('G1', 'Nama KK');
        $sheetData->setCellValue('H1', 'Alamat');
        $sheetData->setCellValue('I1', 'Keberadaan Gen Z dan Ortu');
        $sheetData->setCellValue('J1', 'No urut keluarga egb');
        $sheetData->setCellValue('K1', 'Jml Pengelolaan Makan/Minum');
        $sheetData->setCellValue('L1', 'Identifikasi KK/KRT');
        $sheetData->setCellValue('M1', 'Nama KRT');
        $sheetData->setCellValue('N1', 'Jml Gen Z anak');
        $sheetData->setCellValue('O1', 'Jml Gen Z dewasa');
        $sheetData->setCellValue('P1', 'Kat RT Gen Z');
        $columnRuta = 2;
        foreach ($dataKlg as $data) {
            foreach ($data->ruta as $rutaData) {
                $sheetData->setCellValue('A' . $columnRuta, $data->idBS);
                $sheetData->setCellValue('B' . $columnRuta, $data->SLS);
                $sheetData->setCellValue('C' . $columnRuta, $data->noSegmen);
                $sheetData->setCellValue('D' . $columnRuta, $data->noBgFisik);
                $sheetData->setCellValue('E' . $columnRuta, $data->noBgSensus);
                $sheetData->setCellValue('F' . $columnRuta, $data->noUrutKlg);
                $sheetData->setCellValue('G' . $columnRuta, $data->namaKK);
                $sheetData->setCellValue('H' . $columnRuta, $data->alamat);
                $sheetData->setCellValue('I' . $columnRuta, $data->isGenzOrtu);
                $sheetData->setCellValue('J' . $columnRuta, $data->noUrutKlgEgb);
                $sheetData->setCellValue('K' . $columnRuta, $data->penglMkn);
                $sheetData->setCellValue('L' . $columnRuta, $rutaData->kkOrKrt);
                $sheetData->setCellValue('M' . $columnRuta, $rutaData->namaKrt);
                $sheetData->setCellValue('N' . $columnRuta, $rutaData->jmlGenzAnak);
                $sheetData->setCellValue('O' . $columnRuta, $rutaData->jmlGenzDewasa);
                $sheetData->setCellValue('P' . $columnRuta, $rutaData->katGenz);
                $columnRuta++;
            }
        }



        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data_Hasil_Listing_' . $idKab;

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
