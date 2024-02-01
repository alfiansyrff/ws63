<?php

namespace App\Models;

use CodeIgniter\Model;

class BloksensusMahasiswaModel extends Model
{
    protected $table            = 'bloksensus_mahasiswa';
    protected $primaryKey       = ['no_bs','nim'];
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];


    public function getListBSByNim($nim){
        return  $this->where('nim',$nim)->select('no_bs')->findAll();
    }
}
