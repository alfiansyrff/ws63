<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\PosisiPcl;

class PosisiPclModel extends Model

{

    protected $table                = 'posisi_pcl';
    protected $primaryKey           = 'nim';
    protected $protectFields        = false;
    protected $allowedFields        = ['latitude', 'longitude', 'akurasi', 'time_created'];

    public function getPosisiPcl($nim) :PosisiPcl
    {    
        $result = $this->find($nim);

        $posisipcl = new PosisiPcl(
            $result['nim'],
            $result['latitude'],
            $result['longitude'],
            $result['akurasi'],
        );

        return $posisipcl;
    }    

    public function updateLokasiPcl(string $nim, float $latitude, float $longitude, float $akurasi): bool
    {
        $jakartaTimezone = new \DateTimeZone('Asia/Jakarta');
        $now = new \DateTime('now', $jakartaTimezone);
        $data = [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'akurasi' => $akurasi,
            'time_created' => $now->format('Y-m-d H:i:s')
        ];
        $this->update($nim, $data);
        return true;
    }
}
