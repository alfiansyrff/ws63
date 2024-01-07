<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VersionModel;

class LatestVersionController extends BaseController
{
    public function index()
    {
        $riset = $this->request->getGet('riset');
        $model = new VersionModel();
        return $model->getLatestVersion($riset);
    }
}
