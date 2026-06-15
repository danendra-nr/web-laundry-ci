<?php

namespace App\Controllers;

use App\Models\PelangganModel;
use App\Models\LayananModel;
use App\Models\TransaksiModel;
use App\Models\PengaturanModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $pelangganModel = new PelangganModel();
        $layananModel = new LayananModel();
        $transaksiModel = new TransaksiModel();
        $pengaturanModel = new PengaturanModel();

        // 1. Stats
        $stats = [
            'total_pelanggan' => $pelangganModel->countAllResults(),
            'total_layanan'   => $layananModel->countAllResults(),
            'total_transaksi' => $transaksiModel->countAllResults(),
            'laundry_proses'  => $transaksiModel->where('status', 'Diproses')->countAllResults(),
            'laundry_selesai' => $transaksiModel->where('status', 'Selesai')->countAllResults(),
            'pendapatan_hari' => $transaksiModel->selectSum('total_harga')
                                                ->where('tanggal_masuk', date('Y-m-d'))
                                                ->first()['total_harga'] ?? 0,
        ];

        // 2. Recent Transactions (last 10)
        $recentTransactions = $transaksiModel->getTransactionsDetail()->limit(10)->get()->getResultArray();

        // 3. 7 Days Revenue Chart Data
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $dayName = date('d M', strtotime($date));
            $revenue = $transaksiModel->selectSum('total_harga')
                                      ->where('tanggal_masuk', $date)
                                      ->first()['total_harga'] ?? 0;
            $chartData[] = [
                'day'     => $dayName,
                'revenue' => (float)$revenue
            ];
        }

        // Get laundry profile for layout
        $pengaturan = $pengaturanModel->first();

        return view('dashboard/index', [
            'stats'              => $stats,
            'recentTransactions' => $recentTransactions,
            'chartData'          => $chartData,
            'pengaturan'         => $pengaturan,
        ]);
    }
}
