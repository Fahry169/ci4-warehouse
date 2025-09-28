<?php


namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barangs';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'kode_barang', 'nama', 'kategori', 'jumlah', 'satuan',
        'lokasi', 'keterangan', 'gambar', 'created_at', 'updated_at'
    ];

    public function getDatatables($postData)
    {
        $builder = $this->builder();
        $searchable = ['kode_barang', 'nama', 'kategori', 'lokasi'];

        if (!empty($postData['search']['value'])) {
            $search = $postData['search']['value'];
            $builder->groupStart();
            foreach ($searchable as $column) {
                $builder->orLike($column, $search);
            }
            $builder->groupEnd();
        }

        if (!empty($postData['order'])) {
            $orderCol = $postData['columns'][$postData['order'][0]['column']]['data'];
            $orderDir = $postData['order'][0]['dir'];
            $builder->orderBy($orderCol, $orderDir);
        } else {
            $builder->orderBy('id', 'DESC');
        }
        if ($postData['length'] != -1) {
            $builder->limit($postData['length'], $postData['start']);
        }

        $query = $builder->get();
        return $query->getResultArray();
    }

    public function countAllData()
    {
        return $this->countAll();
    }

    public function countFilteredData($postData)
    {
        $builder = $this->builder();
        if (!empty($postData['search']['value'])) {
            $search = $postData['search']['value'];
            $builder->groupStart()
                    ->like('kode_barang', $search)
                    ->orLike('nama', $search)
                    ->orLike('kategori', $search)
                    ->groupEnd();
        }
        return $builder->countAllResults();
    }
}