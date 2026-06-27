<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\LayananModel;
use App\Models\PengaturanModel;

class CustomerController extends BaseController
{
    public function index()
    {
        $transaksiModel = new TransaksiModel();
        $pengaturan = (new PengaturanModel())->first();
        $pelangganId = session()->get('pelanggan_id');

        $transaksi = $transaksiModel->select('transaksi_laundry.*, layanan_laundry.nama_layanan')
            ->join('layanan_laundry', 'layanan_laundry.id = transaksi_laundry.layanan_id', 'left')
            ->where('pelanggan_id', $pelangganId)
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('customer/dashboard', [
            'transaksi'  => $transaksi,
            'pengaturan' => $pengaturan,
        ]);
    }

    public function createOrder()
    {
        $layananModel = new LayananModel();
        $pengaturan = (new PengaturanModel())->first();

        return view('customer/pesan', [
            'layanan'    => $layananModel->where('status', 'Aktif')->findAll(),
            'pengaturan' => $pengaturan,
        ]);
    }

    public function storeOrder()
    {
        $rules = [
            'layanan_id'      => 'required|numeric',
            'opsi_pengiriman' => 'required|in_list[Kirim Sendiri,Jemput Saja,Antar Saja,Jemput dan Antar]',
            'alamat_pengiriman' => 'permit_empty|string',
        ];

        // Custom validation check: if shipping needs address
        $opsi = $this->request->getPost('opsi_pengiriman');
        if (in_array($opsi, ['Jemput Saja', 'Antar Saja', 'Jemput dan Antar'])) {
            $rules['alamat_pengiriman'] = 'required|min_length[5]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $layananModel = new LayananModel();
        $layanan = $layananModel->find($this->request->getPost('layanan_id'));

        if (!$layanan) {
            return redirect()->back()->withInput()->with('error', 'Layanan tidak valid.');
        }

        $tanggalMasuk = date('Y-m-d');
        $estimasiHari = (int)$layanan['estimasi_hari'];
        $tanggalSelesai = date('Y-m-d', strtotime($tanggalMasuk . " + $estimasiHari days"));

        // Setup status_pengiriman based on delivery options
        $statusPengiriman = 'None';
        if (in_array($opsi, ['Jemput Saja', 'Jemput dan Antar'])) {
            $statusPengiriman = 'Menunggu Penjemputan';
        }

        $invoice = $this->generateInvoice();

        $transaksiModel = new TransaksiModel();
        $transaksiModel->save([
            'invoice'           => $invoice,
            'pelanggan_id'      => session()->get('pelanggan_id'),
            'layanan_id'        => $this->request->getPost('layanan_id'),
            'berat_kg'          => 0.00, // Default 0 as it's remote booking, admin will weigh it
            'harga_per_kg'      => $layanan['harga_per_kg'],
            'total_harga'       => 0.00,
            'tanggal_masuk'     => $tanggalMasuk,
            'tanggal_selesai'   => $tanggalSelesai,
            'status'            => 'Menunggu',
            'catatan'           => $this->request->getPost('catatan'),
            'opsi_pengiriman'   => $opsi,
            'alamat_pengiriman' => $this->request->getPost('alamat_pengiriman') ?: null,
            'status_pengiriman' => $statusPengiriman,
        ]);

        return redirect()->to('/customer/dashboard')->with('success', 'Pesanan Anda berhasil dibuat! Invoice: ' . $invoice . '. Silakan serahkan pakaian Anda atau tunggu penjemputan sesuai opsi.');
    }

    private function generateInvoice()
    {
        $dateStr = date('Ymd');
        $transaksiModel = new TransaksiModel();
        $latest = $transaksiModel->select('invoice')
                                 ->like('invoice', "INV-{$dateStr}-", 'after')
                                 ->orderBy('invoice', 'DESC')
                                 ->first();
        if ($latest) {
            $parts = explode('-', $latest['invoice']);
            $num = (int)end($parts);
            $nextNum = str_pad($num + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $nextNum = '0001';
        }
        return "INV-{$dateStr}-{$nextNum}";
    }
}
