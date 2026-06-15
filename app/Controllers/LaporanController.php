<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\PengaturanModel;

class LaporanController extends BaseController
{
    public function index()
    {
        $transaksiModel = new TransaksiModel();

        $filter = $this->request->getVar('filter') ?? 'hari_ini';
        $startDate = $this->request->getVar('start_date') ?? '';
        $endDate = $this->request->getVar('end_date') ?? '';

        $builder = $transaksiModel->select('transaksi_laundry.*, pelanggan.nama as nama_pelanggan, layanan_laundry.nama_layanan')
            ->join('pelanggan', 'pelanggan.id = transaksi_laundry.pelanggan_id', 'left')
            ->join('layanan_laundry', 'layanan_laundry.id = transaksi_laundry.layanan_id', 'left');

        $today = date('Y-m-d');

        switch ($filter) {
            case 'hari_ini':
                $builder->where('transaksi_laundry.tanggal_masuk', $today);
                break;
            case 'minggu_ini':
                $startOfWeek = date('Y-m-d', strtotime('monday this week'));
                $endOfWeek = date('Y-m-d', strtotime('sunday this week'));
                $builder->where('transaksi_laundry.tanggal_masuk >=', $startOfWeek);
                $builder->where('transaksi_laundry.tanggal_masuk <=', $endOfWeek);
                break;
            case 'bulan_ini':
                $startOfMonth = date('Y-m-01');
                $endOfMonth = date('Y-m-t');
                $builder->where('transaksi_laundry.tanggal_masuk >=', $startOfMonth);
                $builder->where('transaksi_laundry.tanggal_masuk <=', $endOfMonth);
                break;
            case 'custom':
                if (!empty($startDate) && !empty($endDate)) {
                    $builder->where('transaksi_laundry.tanggal_masuk >=', $startDate);
                    $builder->where('transaksi_laundry.tanggal_masuk <=', $endDate);
                }
                break;
        }

        $transaksi = $builder->orderBy('transaksi_laundry.tanggal_masuk', 'ASC')->findAll();

        // Calculate statistics
        $totalPendapatan = 0;
        $totalTransaksi = count($transaksi);
        foreach ($transaksi as $t) {
            $totalPendapatan += (float)$t['total_harga'];
        }

        $pengaturan = (new PengaturanModel())->first();
        $export = $this->request->getVar('export');

        if ($export === 'csv') {
            return $this->exportCSV($transaksi, $filter);
        } elseif ($export === 'print') {
            return view('laporan/print', [
                'transaksi'       => $transaksi,
                'filter'          => $filter,
                'startDate'       => $startDate,
                'endDate'         => $endDate,
                'totalPendapatan' => $totalPendapatan,
                'totalTransaksi'  => $totalTransaksi,
                'pengaturan'      => $pengaturan,
            ]);
        } elseif ($export === 'pdf') {
            $dompdf = new \Dompdf\Dompdf();
            $options = new \Dompdf\Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);
            $dompdf->setOptions($options);

            $html = view('laporan/print_pdf', [
                'transaksi'       => $transaksi,
                'filter'          => $filter,
                'startDate'       => $startDate,
                'endDate'         => $endDate,
                'totalPendapatan' => $totalPendapatan,
                'totalTransaksi'  => $totalTransaksi,
                'pengaturan'      => $pengaturan,
            ]);

            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();

            $filename = "Laporan_Transaksi_{$filter}_" . date('Ymd_His') . ".pdf";
            $dompdf->stream($filename, ["Attachment" => true]);
            exit;
        }

        return view('laporan/index', [
            'transaksi'       => $transaksi,
            'filter'          => $filter,
            'startDate'       => $startDate,
            'endDate'         => $endDate,
            'totalPendapatan' => $totalPendapatan,
            'totalTransaksi'  => $totalTransaksi,
            'pengaturan'      => $pengaturan,
        ]);
    }

    private function exportCSV($transaksi, $filter)
    {
        $filename = "Laporan_Transaksi_{$filter}_" . date('Ymd_His') . ".csv";

        header('Content-Type: text/csv; charset=utf-8');
        header("Content-Disposition: attachment; filename={$filename}");

        $output = fopen('php://output', 'w');

        // Add headers
        fputcsv($output, ['No', 'Invoice', 'Tanggal Masuk', 'Pelanggan', 'Layanan', 'Berat (Kg)', 'Harga/Kg', 'Total Harga', 'Status', 'Catatan']);

        $no = 1;
        foreach ($transaksi as $t) {
            fputcsv($output, [
                $no++,
                $t['invoice'],
                $t['tanggal_masuk'],
                $t['nama_pelanggan'],
                $t['nama_layanan'],
                $t['berat_kg'],
                $t['harga_per_kg'],
                $t['total_harga'],
                $t['status'],
                $t['catatan']
            ]);
        }

        fclose($output);
        exit;
    }
}
