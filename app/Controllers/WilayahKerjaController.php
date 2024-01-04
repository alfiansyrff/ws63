<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\WilayahKerjaModel;
use CodeIgniter\API\ResponseTrait;

class WilayahKerjaController extends BaseController
{
    use ResponseTrait;

    public function index()  // FUNGSI INI HNAYA DIGUNAKAN UNTUK TESTING ROUTE check-danang
    {
        $wilayahKerjaModel = new WilayahKerjaModel();
        $result = $wilayahKerjaModel->getWilayahKerja('222111975'); 
        return $this->respond($result, 200);
    }
}
