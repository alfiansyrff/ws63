<?php

namespace App\Models;

use App\Libraries\Rumahtangga;
use CodeIgniter\Model;

class RutaModel extends Model
{
    protected $table            = 'rumahtangga';
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
        return $this->replace($ruta);
    }

    public function updateRuta(Rumahtangga $ruta): bool
    {
        $ruta = (array) $ruta;
        return $this->replace((array) $ruta);
    }

    public function deleteRuta(Rumahtangga $ruta): bool
    {
        return $this->delete(['kodeRuta' => $ruta->kodeRuta]);
    }
}
