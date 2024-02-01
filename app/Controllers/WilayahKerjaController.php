<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RutaModel;
use App\Models\WilayahKerjaModel;
use CodeIgniter\API\ResponseTrait;

class WilayahKerjaController extends BaseController
{
    use ResponseTrait;

    public function index()  // FUNGSI INI HNAYA DIGUNAKAN UNTUK TESTING ROUTE check-danang
    {
        $wilayahKerjaModel = new WilayahKerjaModel();
        $rutaModel = new RutaModel();
        $result = $rutaModel->getSampelBS('444B', 5);
        return $this->respond($result, 200);
    }

    public function updateStatusBs()
    {
        $wilayahKerjaModel = new WilayahKerjaModel();
        $noBS = $this->request->getPost('no_bs');
        $status = $this->request->getPost('status');

        $result = $wilayahKerjaModel->updateStatusBs($noBS, $status);

        if ($result["status"] == "error") {
            return $this->respond($result, 400);
        }
        return $this->respond($result, 200);
    }


    public function getInfoBS($noBS)
    {
        try {
            $wilayahKerjaModel = new WilayahKerjaModel();
            $result = $wilayahKerjaModel->getInfoBS($noBS);
            if ($result == "empty") {
                return $this->fail("Kode BS tidak ditemukan", 404);
            }
            return $this->respond($result);
        } catch (\Throwable $th) {
            $this->fail($th->getMessage());
        }
    }
}
