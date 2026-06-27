<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\PelangganModel;
use App\Models\LayananModel;
use App\Models\PengaturanModel;

class TransaksiController extends BaseController
{
    public function index()
    {
        $transaksiModel = new TransaksiModel();
        $search = $this->request->getVar('search') ?? '';
        $status = $this->request->getVar('status') ?? '';

        $builder = $transaksiModel->select('transaksi_laundry.*, pelanggan.nama as nama_pelanggan, layanan_laundry.nama_layanan')
            ->join('pelanggan', 'pelanggan.id = transaksi_laundry.pelanggan_id', 'left')
            ->join('layanan_laundry', 'layanan_laundry.id = transaksi_laundry.layanan_id', 'left');

        if (!empty($search)) {
            $builder->groupStart()
                    ->like('transaksi_laundry.invoice', $search)
                    ->orLike('pelanggan.nama', $search)
                    ->groupEnd();
        }

        if (!empty($status)) {
            $builder->where('transaksi_laundry.status', $status);
        }

        $transaksi = $builder->orderBy('transaksi_laundry.id', 'DESC')->paginate(10, 'transaksi');
        $pager = $transaksiModel->pager;

        $pengaturan = (new PengaturanModel())->first();

        return view('transaksi/index', [
            'transaksi'  => $transaksi,
            'pager'      => $pager,
            'search'     => $search,
            'status'     => $status,
            'pengaturan' => $pengaturan,
        ]);
    }

    public function create()
    {
        $pelangganModel = new PelangganModel();
        $layananModel = new LayananModel();
        $pengaturan = (new PengaturanModel())->first();

        return view('transaksi/create', [
            'pelanggan'  => $pelangganModel->findAll(),
            'layanan'    => $layananModel->where('status', 'Aktif')->findAll(),
            'pengaturan' => $pengaturan,
        ]);
    }

    public function store()
    {
        $rules = [
            'pelanggan_id'  => 'required|numeric',
            'layanan_id'    => 'required|numeric',
            'berat_kg'      => 'required|numeric',
            'tanggal_masuk' => 'required|valid_date[Y-m-d]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $layananModel = new LayananModel();
        $layanan = $layananModel->find($this->request->getPost('layanan_id'));

        if (!$layanan) {
            return redirect()->back()->withInput()->with('error', 'Layanan tidak valid.');
        }

        $berat = (float)$this->request->getPost('berat_kg');
        $hargaPerKg = (float)$layanan['harga_per_kg'];
        $totalHarga = $berat * $hargaPerKg;

        // Calculate Selesai date
        $tanggalMasuk = $this->request->getPost('tanggal_masuk');
        $estimasiHari = (int)$layanan['estimasi_hari'];
        $tanggalSelesai = date('Y-m-d', strtotime($tanggalMasuk . " + $estimasiHari days"));

        $invoice = $this->generateInvoice();

        $transaksiModel = new TransaksiModel();
        $transaksiModel->save([
            'invoice'         => $invoice,
            'pelanggan_id'    => $this->request->getPost('pelanggan_id'),
            'layanan_id'      => $this->request->getPost('layanan_id'),
            'berat_kg'        => $berat,
            'harga_per_kg'    => $hargaPerKg,
            'total_harga'     => $totalHarga,
            'tanggal_masuk'   => $tanggalMasuk,
            'tanggal_selesai' => $tanggalSelesai,
            'status'          => 'Menunggu',
            'catatan'         => $this->request->getPost('catatan'),
        ]);

        return redirect()->to('/transaksi')->with('success', 'Transaksi berhasil ditambahkan dengan Invoice: ' . $invoice);
    }

    public function detail($id)
    {
        $transaksiModel = new TransaksiModel();
        $transaksi = $transaksiModel->getTransactionsDetail($id);

        if (!$transaksi) {
            return redirect()->to('/transaksi')->with('error', 'Transaksi tidak ditemukan.');
        }

        $pengaturan = (new PengaturanModel())->first();

        return view('transaksi/detail', [
            'transaksi'  => $transaksi,
            'pengaturan' => $pengaturan,
        ]);
    }

    public function edit($id)
    {
        $transaksiModel = new TransaksiModel();
        $transaksi = $transaksiModel->find($id);

        if (!$transaksi) {
            return redirect()->to('/transaksi')->with('error', 'Transaksi tidak ditemukan.');
        }

        $pelangganModel = new PelangganModel();
        $layananModel = new LayananModel();
        $pengaturan = (new PengaturanModel())->first();

        return view('transaksi/edit', [
            'transaksi'  => $transaksi,
            'pelanggan'  => $pelangganModel->findAll(),
            'layanan'    => $layananModel->where('status', 'Aktif')->findAll(),
            'pengaturan' => $pengaturan,
        ]);
    }

    public function update($id)
    {
        $rules = [
            'pelanggan_id'  => 'required|numeric',
            'layanan_id'    => 'required|numeric',
            'berat_kg'      => 'required|numeric',
            'tanggal_masuk' => 'required|valid_date[Y-m-d]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $layananModel = new LayananModel();
        $layanan = $layananModel->find($this->request->getPost('layanan_id'));

        if (!$layanan) {
            return redirect()->back()->withInput()->with('error', 'Layanan tidak valid.');
        }

        $berat = (float)$this->request->getPost('berat_kg');
        $hargaPerKg = (float)$layanan['harga_per_kg'];
        $totalHarga = $berat * $hargaPerKg;

        $tanggalMasuk = $this->request->getPost('tanggal_masuk');
        $estimasiHari = (int)$layanan['estimasi_hari'];
        $tanggalSelesai = date('Y-m-d', strtotime($tanggalMasuk . " + $estimasiHari days"));

        $transaksiModel = new TransaksiModel();
        $transaksiModel->update($id, [
            'pelanggan_id'    => $this->request->getPost('pelanggan_id'),
            'layanan_id'      => $this->request->getPost('layanan_id'),
            'berat_kg'        => $berat,
            'harga_per_kg'    => $hargaPerKg,
            'total_harga'     => $totalHarga,
            'tanggal_masuk'   => $tanggalMasuk,
            'tanggal_selesai' => $tanggalSelesai,
            'catatan'         => $this->request->getPost('catatan'),
        ]);

        return redirect()->to('/transaksi')->with('success', 'Transaksi berhasil diupdate.');
    }

    public function status($id)
    {
        $status = $this->request->getPost('status');
        $validStatuses = ['Menunggu', 'Diproses', 'Selesai', 'Diambil'];

        if (in_array($status, $validStatuses)) {
            $transaksiModel = new TransaksiModel();
            $transaksiModel->update($id, ['status' => $status]);
            return redirect()->back()->with('success', 'Status transaksi berhasil diubah menjadi ' . $status);
        }

        return redirect()->back()->with('error', 'Status tidak valid.');
    }

    public function updateDelivery($id)
    {
        $statusPengiriman = $this->request->getPost('status_pengiriman');
        $validStatuses = ['None', 'Menunggu Penjemputan', 'Dalam Penjemputan', 'Selesai Dijemput', 'Menunggu Pengantaran', 'Dalam Pengantaran', 'Selesai Diantar'];

        if (in_array($statusPengiriman, $validStatuses)) {
            $transaksiModel = new TransaksiModel();
            $transaksiModel->update($id, ['status_pengiriman' => $statusPengiriman]);
            return redirect()->back()->with('success', 'Status pengiriman berhasil diubah menjadi ' . $statusPengiriman);
        }

        return redirect()->back()->with('error', 'Status pengiriman tidak valid.');
    }

    public function delete($id)
    {
        $transaksiModel = new TransaksiModel();
        $transaksiModel->delete($id);

        return redirect()->to('/transaksi')->with('success', 'Transaksi berhasil dihapus.');
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
