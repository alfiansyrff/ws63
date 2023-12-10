<?php

namespace App\Models;

use CodeIgniter\Model;

class RutaModel extends Model
{
    protected $table            = 'rutas';
    protected $primaryKey       = 'kodeRuta';
    // protected $useAutoIncrement = true;
    // protected $returnType       = 'array';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    // protected $allowedFields    = [];


    public function getAllRuta($noBS): array
    {
        $result = $this
            ->where('no_bs', $noBS)
            ->findAll();
        return $result;
    }

    public function addRuta(Rumahtangga $ruta): bool
    {
        $ruta = (array) $ruta;
        unset($ruta['status']);
        return $this->replace($ruta);
    }
}
