<?php

namespace App\Models;

use CodeIgniter\Model;

class VersionModel extends Model
{
    protected $table            = 'versions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['riset', 'latest_version', 'latest_version_code', 'url', 'release_notes'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getLatestVersion(string $riset)
    {
        $result = $this->where('riset', $riset)->first();

        if ($result === null) {
            return json_encode([
                'status' => 404,
                'message' => 'Data tidak ditemukan',
            ]);
        }

        return json_encode([
            'status' => 200,
            'latestVersion' => $result['latest_version'],
            'latestVersionCode' => $result['latest_version_code'],
            'url' => $result['url'],
            'releaseNotes' => [
                'Versi terbaru : ' . $result['latest_version'],
                'Pengguna dihimbau untuk mengupdate aplikasi ini demi kenyamanan pada waktu pencacahan!',
                $result['release_notes']
            ]
        ]);
    }
}
