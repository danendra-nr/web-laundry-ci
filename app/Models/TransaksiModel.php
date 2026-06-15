<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'transaksi_laundry';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'invoice', 
        'pelanggan_id', 
        'layanan_id', 
        'berat_kg', 
        'harga_per_kg', 
        'total_harga', 
        'tanggal_masuk', 
        'tanggal_selesai', 
        'status', 
        'catatan'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getTransactionsDetail($id = null)
    {
        $builder = $this->select('transaksi_laundry.*, pelanggan.nama as nama_pelanggan, pelanggan.no_hp as no_hp_pelanggan, pelanggan.alamat as alamat_pelanggan, layanan_laundry.nama_layanan, layanan_laundry.kode_layanan')
            ->join('pelanggan', 'pelanggan.id = transaksi_laundry.pelanggan_id', 'left')
            ->join('layanan_laundry', 'layanan_laundry.id = transaksi_laundry.layanan_id', 'left');

        if ($id === null) {
            return $builder->orderBy('transaksi_laundry.id', 'DESC');
        }

        return $builder->where('transaksi_laundry.id', $id)->first();
    }
}
