<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan - <?= esc($pengaturan['nama_laundry'] ?? 'Laras Laundry') ?></title>
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
            <div class="flex items-center gap-3">
                <?php if (!empty($pengaturan['logo']) && file_exists(FCPATH . 'uploads/logo/' . $pengaturan['logo'])): ?>
                    <img src="<?= base_url('uploads/logo/' . $pengaturan['logo']) ?>" alt="Logo" class="h-8 w-8 object-contain">
                <?php else: ?>
                    <div class="h-8 w-8 rounded-lg bg-blue-600 flex items-center justify-center text-white font-bold text-lg">L</div>
                <?php endif; ?>
                <span class="font-extrabold text-xl text-blue-600 tracking-tight"><?= esc($pengaturan['nama_laundry'] ?? 'Laras Laundry') ?></span>
                <span class="bg-blue-50 text-blue-600 font-extrabold text-[10px] uppercase tracking-wider px-2 py-0.5 rounded-md ml-1">Portal Pelanggan</span>
            </div>
            
            <div class="flex items-center gap-4">
                <span class="text-sm font-semibold text-gray-600 hidden sm:inline">Halo, <?= esc(session()->get('username')) ?></span>
                
                <!-- Cart Link with Badge -->
                <?php $cartCount = (new \App\Libraries\Cart())->totalItems(); ?>
                <a href="<?= base_url('customer/cart') ?>" class="relative text-gray-600 hover:text-blue-600 font-bold py-2 px-3 rounded-xl transition-all text-sm flex items-center gap-2 border border-transparent hover:border-blue-50 bg-gray-50 hover:bg-white">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="hidden md:inline">Keranjang</span>
                    <?php if ($cartCount > 0): ?>
                        <span class="bg-red-500 text-white font-extrabold text-[10px] w-5 h-5 flex items-center justify-center rounded-full border border-white"><?= $cartCount ?></span>
                    <?php endif; ?>
                </a>

                <a href="<?= base_url('logout') ?>" class="text-red-600 hover:bg-red-50 font-bold py-2 px-4 rounded-xl transition-all text-sm flex items-center gap-2 border border-transparent hover:border-red-100">
                    Keluar
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <main class="flex-1 max-w-7xl w-full mx-auto p-6 space-y-6">

        <!-- Welcome Banner & Call-To-Action -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-6 md:p-8 text-white relative overflow-hidden shadow-xl shadow-blue-100">
            <!-- Decorative circle -->
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-xl"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="space-y-2 text-center md:text-left">
                    <h2 class="text-2xl md:text-3xl font-black">Mau Laundry Baju Dari Rumah?</h2>
                    <p class="text-blue-100 text-sm md:text-base font-semibold max-w-md">Pesan layanan laundry jarak jauh secara praktis. Pilih opsi antar-jemput dan kurir kami akan segera meluncur!</p>
                </div>
                <a href="<?= base_url('customer/pesan') ?>" class="bg-white text-blue-600 font-extrabold py-3.5 px-8 rounded-2xl shadow-lg hover:bg-blue-50 hover:shadow-none hover:scale-105 transition-all text-sm flex items-center gap-2 whitespace-nowrap">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    Pesan Laundry Sekarang
                </a>
            </div>
        </div>

        <!-- Success/Error Messages -->
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

        <!-- Active Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm flex items-center gap-4">
                <div class="h-12 w-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                </div>
                <div>
                    <span class="text-xs text-gray-400 font-bold uppercase tracking-wider">Total Laundry</span>
                    <h3 class="text-2xl font-black text-gray-900"><?= count($transaksi) ?></h3>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm flex items-center gap-4">
                <div class="h-12 w-12 rounded-2xl bg-yellow-50 text-yellow-600 flex items-center justify-center flex-shrink-0">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                </div>
                <div>
                    <?php
                        $proses = array_filter($transaksi, function($t) { return in_array($t['status'], ['Menunggu', 'Diproses']); });
                    ?>
                    <span class="text-xs text-gray-400 font-bold uppercase tracking-wider">Cucian Aktif</span>
                    <h3 class="text-2xl font-black text-gray-900"><?= count($proses) ?></h3>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm flex items-center gap-4">
                <div class="h-12 w-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <?php
                        $selesai = array_filter($transaksi, function($t) { return in_array($t['status'], ['Selesai', 'Diambil']); });
                    ?>
                    <span class="text-xs text-gray-400 font-bold uppercase tracking-wider">Cucian Selesai</span>
                    <h3 class="text-2xl font-black text-gray-900"><?= count($selesai) ?></h3>
                </div>
            </div>
        </div>

        <!-- Order List Table -->
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Riwayat Pesanan Anda</h3>
                    <p class="text-xs text-gray-400 font-semibold mt-0.5">Daftar cucian jarak jauh maupun langsung</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm font-medium">
                    <thead class="bg-gray-50 text-gray-500 font-bold text-xs uppercase tracking-wider border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4">Invoice</th>
                            <th class="px-6 py-4">Layanan</th>
                            <th class="px-6 py-4">Tgl Masuk</th>
                            <th class="px-6 py-4">Berat</th>
                            <th class="px-6 py-4">Total Biaya</th>
                            <th class="px-6 py-4">Opsi Kirim</th>
                            <th class="px-6 py-4">Status Pengiriman</th>
                            <th class="px-6 py-4 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php if (!empty($transaksi)): ?>
                            <?php foreach ($transaksi as $t): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 font-bold text-blue-600"><?= esc($t['invoice']) ?></td>
                                    <td class="px-6 py-4 text-gray-900 font-semibold"><?= esc($t['nama_layanan'] ?? 'Custom') ?></td>
                                    <td class="px-6 py-4 text-gray-500 font-semibold"><?= date('d M Y', strtotime($t['tanggal_masuk'])) ?></td>
                                    <td class="px-6 py-4 text-gray-900 font-bold">
                                        <?php if ($t['berat_kg'] > 0): ?>
                                            <?= number_format($t['berat_kg'], 1) ?> kg
                                        <?php else: ?>
                                            <span class="text-xs text-yellow-500 bg-yellow-50 px-2 py-1 rounded-lg">Menunggu Timbang</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 text-gray-900 font-bold">
                                        <?php if ($t['total_harga'] > 0): ?>
                                            Rp <?= number_format($t['total_harga'], 0, ',', '.') ?>
                                        <?php else: ?>
                                            <span class="text-gray-400 font-medium">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-slate-100 text-slate-700">
                                            <?= esc($t['opsi_pengiriman'] ?? 'Kirim Sendiri') ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-600">
                                        <?php if ($t['status_pengiriman'] === 'None'): ?>
                                            <span class="text-gray-400">-</span>
                                        <?php else: ?>
                                            <?php
                                                $shippingColor = 'bg-slate-50 text-slate-600 border border-slate-200';
                                                if (strpos($t['status_pengiriman'], 'Penjemputan') !== false) {
                                                    $shippingColor = 'bg-yellow-50 text-yellow-600 border border-yellow-200';
                                                } elseif (strpos($t['status_pengiriman'], 'Pengantaran') !== false) {
                                                    $shippingColor = 'bg-blue-50 text-blue-600 border border-blue-200';
                                                } elseif (strpos($t['status_pengiriman'], 'Selesai') !== false) {
                                                    $shippingColor = 'bg-emerald-50 text-emerald-600 border border-emerald-200';
                                                }
                                            ?>
                                            <span class="text-[11px] font-bold px-2 py-0.5 rounded-full <?= $shippingColor ?>">
                                                <?= esc($t['status_pengiriman']) ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <?php
                                            $statusColor = 'bg-gray-100 text-gray-800';
                                            if ($t['status'] === 'Menunggu') $statusColor = 'bg-yellow-50 text-yellow-600 border border-yellow-100';
                                            elseif ($t['status'] === 'Diproses') $statusColor = 'bg-blue-50 text-blue-600 border border-blue-100';
                                            elseif ($t['status'] === 'Selesai') $statusColor = 'bg-emerald-50 text-emerald-600 border border-emerald-100';
                                            elseif ($t['status'] === 'Diambil') $statusColor = 'bg-purple-50 text-purple-600 border border-purple-100';
                                        ?>
                                        <span class="text-xs font-bold px-3 py-1 rounded-full border <?= $statusColor ?>">
                                            <?= esc($t['status']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-12 text-gray-400 font-semibold">
                                    <svg class="h-12 w-12 mx-auto text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2" /></svg>
                                    Belum ada transaksi laundry.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 py-6 mt-12">
        <div class="max-w-7xl mx-auto px-6 text-center text-xs text-gray-400 font-semibold">
            &copy; <?= date('Y') ?> <?= esc($pengaturan['nama_laundry'] ?? 'Laras Laundry') ?>. All rights reserved.
        </div>
    </footer>

</body>
</html>
