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
        $result = $rutaModel->getSampelBS('444B',5); 
        return $this->respond($result, 200);
        // echo json_encode($boolUpdateRekapitulasiBS);
        // die();
    }
}
