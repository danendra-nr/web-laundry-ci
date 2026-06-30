<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - <?= esc($pengaturan['nama_laundry'] ?? 'Laras Laundry') ?></title>
    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts Baloo 2 -->
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563EB',
                        secondary: '#60A5FA',
                        success: '#10B981',
                        warning: '#F59E0B',
                        danger: '#EF4444',
                        dark: '#1F2937',
                    },
                    fontFamily: {
                        baloo: ['"Baloo 2"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Baloo 2', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

    <!-- Top Navbar -->
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            <a href="<?= base_url('customer/pesan') ?>" class="flex items-center gap-2 text-gray-600 hover:text-blue-600 transition-colors font-bold text-sm">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Pilih Layanan Lain
            </a>
            
            <div class="flex items-center gap-3">
                <span class="font-extrabold text-xl text-blue-600 tracking-tight"><?= esc($pengaturan['nama_laundry'] ?? 'Laras Laundry') ?></span>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <main class="flex-1 max-w-7xl w-full mx-auto p-6 space-y-6">

        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-6 md:p-8 text-white shadow-xl shadow-blue-100">
            <h2 class="text-2xl md:text-3xl font-black">Keranjang Belanja Anda</h2>
            <p class="text-blue-100 text-sm font-semibold mt-1">Kelola daftar pesanan laundry Anda sebelum menyelesaikan transaksi.</p>
        </div>

        <!-- Success/Error Alerts -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5 text-emerald-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                    <span class="font-medium text-sm"><?= session()->getFlashdata('success') ?></span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-2xl flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5 text-rose-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                    <span class="font-medium text-sm"><?= session()->getFlashdata('error') ?></span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="bg-rose-50 border border-rose-200 text-rose-800 p-6 rounded-2xl shadow-sm">
                <div class="flex items-start gap-3">
                    <svg class="h-5 w-5 text-rose-500 mt-0.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                    <div>
                        <span class="font-bold text-sm">Gagal melakukan checkout:</span>
                        <ul class="list-disc list-inside mt-1 text-xs space-y-0.5">
                            <?php foreach (session()->getFlashdata('errors') as $err): ?>
                                <li><?= htmlspecialchars($err) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($cartItems)): ?>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items List (Left Column) -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="bg-white rounded-3xl border border-gray-100 shadow-xl shadow-gray-100/50 overflow-hidden">
                        <div class="p-6 border-b border-gray-50 flex items-center justify-between">
                            <h3 class="text-lg font-bold text-gray-900">Daftar Cucian</h3>
                            <form action="<?= base_url('customer/cart/clear') ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengosongkan keranjang?');">
                                <?= csrf_field() ?>
                                <button type="submit" class="text-xs text-red-600 hover:text-red-800 font-bold flex items-center gap-1">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    Kosongkan Keranjang
                                </button>
                            </form>
                        </div>

                        <div class="divide-y divide-gray-100">
                            <?php foreach ($cartItems as $item): ?>
                                <div class="p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                    <div class="space-y-1">
                                        <span class="bg-blue-50 text-blue-600 font-extrabold text-[9px] uppercase tracking-wider px-2 py-0.5 rounded-md">
                                            <?= esc($item['options']['kode_layanan'] ?? 'SERV') ?>
                                        </span>
                                        <h4 class="text-base font-black text-gray-900"><?= esc($item['name']) ?></h4>
                                        <p class="text-xs text-gray-400 font-semibold">
                                            Rp <?= number_format($item['price'], 0, ',', '.') ?> / kg | Est. <?= esc($item['options']['estimasi_hari'] ?? 3) ?> Hari
                                        </p>
                                    </div>

                                    <div class="flex items-center gap-6 w-full sm:w-auto justify-between sm:justify-end">
                                        <!-- Update Qty Form -->
                                        <?php if (isset($item['options']['timbang_di_toko']) && $item['options']['timbang_di_toko'] === true): ?>
                                            <span class="text-xs text-yellow-600 bg-yellow-50 px-3 py-1.5 rounded-xl font-bold border border-yellow-100">Timbang di Toko</span>
                                        <?php else: ?>
                                            <form action="<?= base_url('customer/cart/update') ?>" method="POST" class="flex items-center gap-2">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="rowid" value="<?= $item['rowid'] ?>">
                                                <input type="number" name="qty" value="<?= $item['qty'] ?>" min="1" max="100" class="w-16 bg-gray-50 border border-gray-100 rounded-lg px-2 py-1.5 text-sm font-bold text-gray-800 text-center focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-100 outline-none">
                                                <button type="submit" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold p-2 rounded-lg text-xs transition-all">
                                                    Update
                                                </button>
                                            </form>
                                        <?php endif; ?>

                                        <!-- Subtotal -->
                                        <div class="text-right min-w-[100px]">
                                            <p class="text-xs text-gray-400 font-bold">Subtotal</p>
                                            <p class="text-sm font-black text-gray-900">
                                                <?php if (isset($item['options']['timbang_di_toko']) && $item['options']['timbang_di_toko'] === true): ?>
                                                    <span class="text-xs text-gray-400 font-bold italic">Akan Ditimbang</span>
                                                <?php else: ?>
                                                    Rp <?= number_format($item['price'] * $item['qty'], 0, ',', '.') ?>
                                                <?php endif; ?>
                                            </p>
                                        </div>

                                        <!-- Remove Item Form -->
                                        <form action="<?= base_url('customer/cart/remove/' . $item['rowid']) ?>" method="POST" onsubmit="return confirm('Hapus item ini dari keranjang?');">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="text-red-500 hover:text-red-700 p-2 rounded-lg hover:bg-red-50 transition-colors">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Checkout Form / Order Summary (Right Column) -->
                <div class="space-y-6">
                    <div class="bg-white rounded-3xl border border-gray-100 p-6 shadow-xl shadow-gray-100/50 space-y-6">
                        <h3 class="text-lg font-bold text-gray-900 border-b border-gray-50 pb-4">Ringkasan Belanja</h3>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm text-gray-500 font-semibold">
                                <span>Total Item</span>
                                <span class="text-gray-900 font-bold"><?= $totalItems ?> item</span>
                            </div>
                            <div class="flex justify-between items-center text-base text-gray-900 font-bold border-t border-gray-50 pt-3">
                                <span>Total Tagihan</span>
                                <span class="text-xl font-black text-blue-600">Rp <?= number_format($cartTotal, 0, ',', '.') ?></span>
                            </div>
                        </div>

                        <!-- Checkout Details Form -->
                        <form action="<?= base_url('customer/cart/checkout') ?>" method="POST" class="space-y-4 pt-4 border-t border-gray-50">
                            <?= csrf_field() ?>

                            <!-- Delivery Options -->
                            <div>
                                <label for="opsi_pengiriman" class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wider">Opsi Pengiriman & Penjemputan</label>
                                <select name="opsi_pengiriman" id="opsi_pengiriman" onchange="toggleAddressField()" class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm text-gray-800 font-semibold focus:outline-none focus:border-blue-500 transition-all outline-none" required>
                                    <option value="Kirim Sendiri" <?= old('opsi_pengiriman') == 'Kirim Sendiri' ? 'selected' : '' ?>>Kirim & Ambil Sendiri ke Workshop</option>
                                    <option value="Jemput Saja" <?= old('opsi_pengiriman') == 'Jemput Saja' ? 'selected' : '' ?>>Jemput Saja (Pakaian dijemput, saya ambil sendiri)</option>
                                    <option value="Antar Saja" <?= old('opsi_pengiriman') == 'Antar Saja' ? 'selected' : '' ?>>Antar Saja (Saya kirim ke laundry, pakaian diantar kurir)</option>
                                    <option value="Jemput dan Antar" <?= old('opsi_pengiriman') == 'Jemput dan Antar' ? 'selected' : '' ?>>Jemput dan Antar (Full Kurir Service)</option>
                                </select>
                            </div>

                            <!-- Address Field -->
                            <div id="address_section" class="hidden space-y-1">
                                <label for="alamat_pengiriman" class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Alamat Penjemputan / Pengantaran</label>
                                <textarea name="alamat_pengiriman" id="alamat_pengiriman" rows="3" placeholder="Alamat lengkap lokasi Anda..." class="w-full bg-gray-50 border border-gray-100 rounded-xl p-3 text-sm text-gray-800 font-semibold focus:outline-none focus:border-blue-500 transition-all outline-none"></textarea>
                            </div>

                            <!-- Notes -->
                            <div class="space-y-1">
                                <label for="catatan" class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Catatan Tambahan (Opsional)</label>
                                <textarea name="catatan" id="catatan" rows="2" placeholder="Contoh: Baju putih pisahkan, luntur..." class="w-full bg-gray-50 border border-gray-100 rounded-xl p-3 text-sm text-gray-800 font-semibold focus:outline-none focus:border-blue-500 transition-all outline-none"><?= old('catatan') ?></textarea>
                            </div>

                            <!-- Checkout button -->
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-extrabold py-4 px-4 rounded-xl shadow-lg shadow-blue-100 hover:shadow-none transition-all text-sm flex items-center justify-center gap-2">
                                Proses Checkout Sekarang
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-3xl p-12 text-center text-gray-400 font-semibold border border-gray-100 shadow-xl shadow-gray-100/50">
                <svg class="h-16 w-16 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                <h3 class="text-lg font-bold text-gray-900 mb-1">Keranjang Belanja Kosong</h3>
                <p class="text-sm text-gray-400 mb-6">Anda belum menambahkan layanan apapun ke keranjang.</p>
                <a href="<?= base_url('customer/pesan') ?>" class="inline-flex bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-xl shadow-md shadow-blue-100 transition-all text-sm">
                    Pilih Layanan Laundry
                </a>
            </div>
        <?php endif; ?>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 py-6 mt-12">
        <div class="max-w-7xl mx-auto px-6 text-center text-xs text-gray-400 font-semibold">
            &copy; <?= date('Y') ?> <?= esc($pengaturan['nama_laundry'] ?? 'Laras Laundry') ?>. All rights reserved.
        </div>
    </footer>

    <!-- Interactive script to show/hide address -->
    <script>
        function toggleAddressField() {
            const selectEl = document.getElementById('opsi_pengiriman');
            const addressSection = document.getElementById('address_section');
            const addressInput = document.getElementById('alamat_pengiriman');
            
            if (!selectEl) return;
            
            if (selectEl.value === 'Kirim Sendiri') {
                addressSection.classList.add('hidden');
                addressInput.removeAttribute('required');
            } else {
                addressSection.classList.remove('hidden');
                addressInput.setAttribute('required', 'required');
            }
        }
        
        // Run on load to handle pre-filled old values
        document.addEventListener('DOMContentLoaded', toggleAddressField);
    </script>
</body>
</html>
