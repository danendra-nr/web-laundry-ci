<?php

namespace App\Controllers;

use App\Libraries\Cart;
use App\Models\LayananModel;
use App\Models\TransaksiModel;
use App\Models\PengaturanModel;

class CartController extends BaseController
{
    protected $cart;

    public function __construct()
    {
        $this->cart = new Cart();
    }

    public function index()
    {
        $pengaturan = (new PengaturanModel())->first();
        
        return view('customer/cart', [
            'cartItems'  => $this->cart->contents(),
            'cartTotal'  => $this->cart->total(),
            'totalItems' => $this->cart->totalItems(),
            'pengaturan' => $pengaturan,
        ]);
    }

    public function add()
    {
        $layananId = $this->request->getPost('layanan_id');
        $qty       = (int)$this->request->getPost('qty') ?: 1;
        $timbang   = $this->request->getPost('timbang_di_toko') === '1';

        $layananModel = new LayananModel();
        $layanan = $layananModel->find($layananId);

        if (!$layanan || $layanan['status'] !== 'Aktif') {
            return redirect()->back()->with('error', 'Layanan tidak valid atau tidak aktif.');
        }

        $item = [
            'id'      => $layanan['id'],
            'name'    => $layanan['nama_layanan'],
            'price'   => (float)$layanan['harga_per_kg'],
            'qty'     => $qty,
            'options' => [
                'kode_layanan'    => $layanan['kode_layanan'],
                'estimasi_hari'   => $layanan['estimasi_hari'],
                'timbang_di_toko' => $timbang,
            ]
        ];

        $this->cart->insert($item);

        return redirect()->to('/customer/cart')->with('success', 'Layanan berhasil ditambahkan ke keranjang belanja.');
    }

    public function update()
    {
        $rowid = $this->request->getPost('rowid');
        $qty   = (int)$this->request->getPost('qty');

        if ($this->cart->update($rowid, $qty)) {
            return redirect()->to('/customer/cart')->with('success', 'Keranjang berhasil diperbarui.');
        }

        return redirect()->to('/customer/cart')->with('error', 'Gagal memperbarui keranjang.');
    }

    public function remove($rowid)
    {
        if ($this->cart->remove($rowid)) {
            return redirect()->to('/customer/cart')->with('success', 'Item berhasil dihapus dari keranjang.');
        }

        return redirect()->to('/customer/cart')->with('error', 'Gagal menghapus item.');
    }

    public function clear()
    {
        $this->cart->destroy();
        return redirect()->to('/customer/cart')->with('success', 'Keranjang belanja berhasil dikosongkan.');
    }

    public function checkout()
    {
        $items = $this->cart->contents();
        if (empty($items)) {
            return redirect()->to('/customer/cart')->with('error', 'Keranjang belanja Anda kosong.');
        }

        $rules = [
            'opsi_pengiriman'   => 'required|in_list[Kirim Sendiri,Jemput Saja,Antar Saja,Jemput dan Antar]',
            'alamat_pengiriman' => 'permit_empty|string',
        ];

        $opsi = $this->request->getPost('opsi_pengiriman');
        if (in_array($opsi, ['Jemput Saja', 'Antar Saja', 'Jemput dan Antar'])) {
            $rules['alamat_pengiriman'] = 'required|min_length[5]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $tanggalMasuk = date('Y-m-d');
        $invoice = $this->generateInvoice();

        $statusPengiriman = 'None';
        if (in_array($opsi, ['Jemput Saja', 'Jemput dan Antar'])) {
            $statusPengiriman = 'Menunggu Penjemputan';
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $transaksiModel = new TransaksiModel();
        foreach ($items as $item) {
            $estimasiHari = (int)($item['options']['estimasi_hari'] ?? 3);
            $tanggalSelesai = date('Y-m-d', strtotime($tanggalMasuk . " + $estimasiHari days"));

            $isTimbangDiToko = isset($item['options']['timbang_di_toko']) && $item['options']['timbang_di_toko'] === true;
            $berat = $isTimbangDiToko ? 0.00 : (float)$item['qty'];
            $totalHarga = $isTimbangDiToko ? 0.00 : ($item['price'] * $item['qty']);

            $transaksiModel->save([
                'invoice'           => $invoice,
                'pelanggan_id'      => session()->get('pelanggan_id'),
                'layanan_id'        => $item['id'],
                'berat_kg'          => $berat,
                'harga_per_kg'      => $item['price'],
                'total_harga'       => $totalHarga,
                'tanggal_masuk'     => $tanggalMasuk,
                'tanggal_selesai'   => $tanggalSelesai,
                'status'            => 'Menunggu',
                'catatan'           => $this->request->getPost('catatan') ?: '',
                'opsi_pengiriman'   => $opsi,
                'alamat_pengiriman' => $this->request->getPost('alamat_pengiriman') ?: null,
                'status_pengiriman' => $statusPengiriman,
            ]);
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->to('/customer/cart')->with('error', 'Terjadi kesalahan saat memproses checkout.');
        }

        // Kosongkan keranjang setelah checkout sukses
        $this->cart->destroy();

        return redirect()->to('/customer/dashboard')->with('success', 'Pesanan Anda berhasil dibuat dengan Invoice: ' . $invoice . '.');
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
