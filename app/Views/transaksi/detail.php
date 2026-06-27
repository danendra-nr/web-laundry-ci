<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    @media print {
        body {
            background-color: #ffffff !important;
            color: #000000 !important;
        }
        aside, header, button, a, nav, .alert {
            display: none !important;
        }
        main {
            padding: 0 !important;
        }
        #invoice-card {
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
        }
    }
</style>

<div class="mb-6 flex items-center justify-between">
    <a href="<?= base_url('transaksi') ?>" class="text-sm font-bold text-gray-600 hover:text-gray-900 flex items-center gap-1">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        Kembali ke Daftar Transaksi
    </a>
    
    <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-xl shadow-md shadow-blue-100 hover:shadow-none transition-all text-sm flex items-center gap-2">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4" /></svg>
        Cetak Invoice (PDF)
    </button>
</div>

<!-- Invoice Container -->
<div id="invoice-card" class="max-w-3xl bg-white rounded-3xl border border-gray-150 shadow-sm overflow-hidden p-8">
    <!-- Invoice Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between items-start sm:items-center gap-4 pb-6 border-b border-gray-100">
        <div>
            <div class="flex items-center gap-3">
                <?php if (!empty($pengaturan['logo']) && file_exists(FCPATH . 'uploads/logo/' . $pengaturan['logo'])): ?>
                    <img src="<?= base_url('uploads/logo/' . $pengaturan['logo']) ?>" alt="Logo" class="h-10 w-10 object-contain">
                <?php else: ?>
                    <div class="h-10 w-10 rounded-xl bg-blue-600 flex items-center justify-center text-white font-bold text-xl">L</div>
                <?php endif; ?>
                <div>
                    <h2 class="text-xl font-extrabold text-gray-900 leading-tight"><?= htmlspecialchars($pengaturan['nama_laundry'] ?? 'LMS') ?></h2>
                    <span class="text-xs font-semibold text-gray-500">WhatsApp: <?= htmlspecialchars($pengaturan['whatsapp'] ?? '-') ?></span>
                </div>
            </div>
            <p class="text-xs text-gray-500 font-medium max-w-sm mt-2"><?= htmlspecialchars($pengaturan['alamat'] ?? '-') ?></p>
        </div>

        <div class="text-left sm:text-right">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Nomor Invoice</span>
            <span class="text-2xl font-black text-blue-600 block"><?= htmlspecialchars($transaksi['invoice']) ?></span>
            
            <?php
                $statusClasses = [
                    'Menunggu' => 'bg-gray-100 text-gray-700',
                    'Diproses' => 'bg-blue-50 text-blue-700 border border-blue-100',
                    'Selesai'  => 'bg-amber-50 text-amber-700 border border-amber-100',
                    'Diambil'  => 'bg-emerald-50 text-emerald-700 border border-emerald-100',
                ];
                $class = $statusClasses[$transaksi['status']] ?? 'bg-gray-100 text-gray-700';
            ?>
            <span class="inline-block mt-2 px-3 py-1 rounded-full text-xs font-extrabold <?= $class ?>"><?= $transaksi['status'] ?></span>
        </div>
    </div>

    <!-- Client / Dates Info -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 py-6 border-b border-gray-100 text-sm">
        <div>
            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Pelanggan</h4>
            <div class="space-y-1 font-bold text-gray-700">
                <p class="text-gray-900 font-extrabold"><?= htmlspecialchars($transaksi['nama_pelanggan'] ?? 'Pelanggan Umum') ?></p>
                <p class="text-xs font-semibold text-gray-500">HP: <?= htmlspecialchars($transaksi['no_hp_pelanggan'] ?? '-') ?></p>
                <p class="text-xs font-medium text-gray-500 max-w-xs leading-relaxed">Alamat: <?= htmlspecialchars($transaksi['alamat_pelanggan'] ?? '-') ?></p>
                <?php if (!empty($transaksi['opsi_pengiriman']) && $transaksi['opsi_pengiriman'] !== 'Kirim Sendiri'): ?>
                    <div class="mt-4 pt-4 border-t border-gray-150 text-xs font-semibold text-gray-500">
                        <span class="font-bold text-gray-400 uppercase tracking-wider block mb-1">Informasi Pengiriman (<?= esc($transaksi['opsi_pengiriman']) ?>)</span>
                        <p class="text-gray-700 font-bold">Status: <?= esc($transaksi['status_pengiriman']) ?></p>
                        <p class="text-gray-600 mt-0.5 leading-relaxed">Alamat Kirim: <?= esc($transaksi['alamat_pengiriman']) ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="sm:text-right space-y-3">
            <div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Tanggal Masuk</span>
                <span class="font-bold text-gray-700"><?= date('d M Y', strtotime($transaksi['tanggal_masuk'])) ?></span>
            </div>
            <div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Estimasi Selesai</span>
                <span class="font-bold text-gray-700"><?= date('d M Y', strtotime($transaksi['tanggal_selesai'])) ?></span>
            </div>
        </div>
    </div>

    <!-- Bill Details -->
    <div class="py-6 border-b border-gray-100">
        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Rincian Pembayaran</h4>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm font-semibold text-gray-700 border-collapse">
                <thead>
                    <tr class="text-xs text-gray-400 border-b border-gray-100 uppercase">
                        <th class="py-2">Item Layanan</th>
                        <th class="py-2 text-center">Berat</th>
                        <th class="py-2 text-right">Harga / Kg</th>
                        <th class="py-2 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr>
                        <td class="py-4 font-bold text-gray-900">
                            <?= htmlspecialchars($transaksi['nama_layanan'] ?? 'Layanan Umum') ?>
                            <span class="block text-xs text-gray-400 font-semibold uppercase mt-0.5"><?= htmlspecialchars($transaksi['kode_layanan'] ?? 'GEN') ?></span>
                        </td>
                        <td class="py-4 text-center"><?= floatval($transaksi['berat_kg']) ?> Kg</td>
                        <td class="py-4 text-right">Rp <?= number_format($transaksi['harga_per_kg'], 0, ',', '.') ?></td>
                        <td class="py-4 text-right text-gray-900 font-extrabold">Rp <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer Summary / Catatan -->
    <div class="pt-6 flex flex-col sm:flex-row sm:justify-between items-start gap-6">
        <div class="text-xs font-semibold text-gray-500 max-w-sm">
            <span class="font-bold text-gray-400 uppercase tracking-wider block mb-1">Catatan Transaksi</span>
            <p class="leading-relaxed"><?= !empty($transaksi['catatan']) ? nl2br(htmlspecialchars($transaksi['catatan'])) : 'Tidak ada catatan.' ?></p>
        </div>

        <div class="w-full sm:w-64 text-right space-y-1.5">
            <div class="flex items-center justify-between text-sm font-bold text-gray-400">
                <span>Total Tagihan:</span>
                <span class="text-gray-700">Rp <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></span>
            </div>
            <div class="flex items-center justify-between text-base font-extrabold text-blue-600 border-t border-dashed border-gray-200 pt-2">
                <span>Grand Total:</span>
                <span class="text-xl font-black">Rp <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></span>
            </div>
        </div>
    </div>

    <!-- Thank you msg -->
    <div class="mt-12 text-center text-xs font-bold text-gray-400 uppercase tracking-widest pt-6 border-t border-dashed border-gray-100">
        Terima Kasih Atas Kepercayaan Anda!
    </div>
</div>

<!-- Delivery Management Card (Admin Panel) -->
<?php if (!empty($transaksi['opsi_pengiriman']) && $transaksi['opsi_pengiriman'] !== 'Kirim Sendiri'): ?>
    <div class="max-w-3xl mt-6 bg-white rounded-3xl border border-gray-150 shadow-sm overflow-hidden p-8 print:hidden">
        <h3 class="text-lg font-black text-gray-950 mb-4 flex items-center gap-2">
            <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1-1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 01.293.707V15a1 1 0 01-1 1h-2" /></svg>
            Kelola Pengiriman & Penjemputan
        </h3>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
            <div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Opsi Pengiriman</span>
                <span class="font-bold text-gray-800"><?= esc($transaksi['opsi_pengiriman']) ?></span>
            </div>
            <div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Status Saat Ini</span>
                <span class="inline-block mt-1 px-3 py-1 rounded-full text-xs font-extrabold bg-blue-50 text-blue-700 border border-blue-100">
                    <?= esc($transaksi['status_pengiriman']) ?>
                </span>
            </div>
            <div class="sm:col-span-2">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Alamat Pengiriman/Penjemputan</span>
                <p class="font-semibold text-gray-700 mt-1"><?= esc($transaksi['alamat_pengiriman']) ?></p>
            </div>
        </div>

        <form action="<?= base_url('transaksi/updateDelivery/' . $transaksi['id']) ?>" method="POST" class="border-t border-gray-100 pt-6 flex flex-col sm:flex-row items-end gap-4">
            <?= csrf_field() ?>
            <div class="flex-1 w-full">
                <label for="status_pengiriman" class="block text-xs font-bold text-gray-400 uppercase mb-2">Update Status Pengiriman</label>
                <select name="status_pengiriman" id="status_pengiriman" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 font-semibold focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none">
                    <option value="Menunggu Penjemputan" <?= $transaksi['status_pengiriman'] === 'Menunggu Penjemputan' ? 'selected' : '' ?>>Menunggu Penjemputan</option>
                    <option value="Dalam Penjemputan" <?= $transaksi['status_pengiriman'] === 'Dalam Penjemputan' ? 'selected' : '' ?>>Dalam Penjemputan</option>
                    <option value="Selesai Dijemput" <?= $transaksi['status_pengiriman'] === 'Selesai Dijemput' ? 'selected' : '' ?>>Selesai Dijemput</option>
                    <option value="Menunggu Pengantaran" <?= $transaksi['status_pengiriman'] === 'Menunggu Pengantaran' ? 'selected' : '' ?>>Menunggu Pengantaran</option>
                    <option value="Dalam Pengantaran" <?= $transaksi['status_pengiriman'] === 'Dalam Pengantaran' ? 'selected' : '' ?>>Dalam Pengantaran</option>
                    <option value="Selesai Diantar" <?= $transaksi['status_pengiriman'] === 'Selesai Diantar' ? 'selected' : '' ?>>Selesai Diantar</option>
                </select>
            </div>
            <button type="submit" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-6 rounded-xl shadow-md transition-all text-sm flex items-center justify-center gap-2">
                Simpan Status
            </button>
        </form>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>
