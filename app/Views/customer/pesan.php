<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Layanan Laundry - <?= esc($pengaturan['nama_laundry'] ?? 'Laras Laundry') ?></title>
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
            <a href="<?= base_url('customer/dashboard') ?>" class="flex items-center gap-2 text-gray-600 hover:text-blue-600 transition-colors font-bold text-sm">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali ke Dashboard
            </a>
            
            <div class="flex items-center gap-4">
                <!-- Cart Link with Badge -->
                <?php $cartCount = (new \App\Libraries\Cart())->totalItems(); ?>
                <a href="<?= base_url('customer/cart') ?>" class="relative text-gray-600 hover:text-blue-600 font-bold py-2 px-3 rounded-xl transition-all text-sm flex items-center gap-2 border border-gray-100 bg-gray-50 hover:bg-white">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>Keranjang</span>
                    <?php if ($cartCount > 0): ?>
                        <span class="bg-red-500 text-white font-extrabold text-[10px] w-5 h-5 flex items-center justify-center rounded-full border border-white"><?= $cartCount ?></span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <main class="flex-1 max-w-7xl w-full mx-auto p-6 space-y-6">

        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-6 md:p-8 text-white shadow-xl shadow-blue-100">
            <h2 class="text-2xl md:text-3xl font-black">Pilih Layanan Laundry</h2>
            <p class="text-blue-100 text-sm font-semibold mt-1">Tambahkan layanan laundry yang Anda butuhkan ke keranjang belanja, Anda dapat menggabungkan beberapa layanan sekaligus!</p>
        </div>

        <!-- Alerts -->
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

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (!empty($layanan)): ?>
                <?php foreach ($layanan as $l): ?>
                    <div class="bg-white rounded-3xl border border-gray-100 p-6 shadow-xl shadow-gray-100/50 flex flex-col justify-between hover:scale-[1.02] transition-all duration-300">
                        <div class="space-y-3">
                            <div class="flex justify-between items-start">
                                <span class="bg-blue-50 text-blue-600 font-extrabold text-[10px] uppercase tracking-wider px-2.5 py-1 rounded-full">
                                    <?= esc($l['kode_layanan']) ?>
                                </span>
                                <span class="text-xs text-gray-400 font-bold">
                                    Est. <?= esc($l['estimasi_hari']) ?> Hari
                                </span>
                            </div>
                            
                            <div>
                                <h3 class="text-lg font-black text-gray-900 leading-tight"><?= esc($l['nama_layanan']) ?></h3>
                                <p class="text-2xl font-black text-blue-600 mt-2">
                                    Rp <?= number_format($l['harga_per_kg'], 0, ',', '.') ?> <span class="text-xs text-gray-400 font-bold">/ kg</span>
                                </p>
                            </div>
                        </div>

                        <!-- Add to Cart Form -->
                        <form action="<?= base_url('customer/cart/add') ?>" method="POST" class="mt-6 pt-6 border-t border-gray-50 flex flex-col gap-4">
                            <?= csrf_field() ?>
                            <input type="hidden" name="layanan_id" value="<?= $l['id'] ?>">
                            
                            <div class="flex items-center gap-3">
                                <div class="w-24">
                                    <label class="block text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">Qty (Kg)</label>
                                    <input type="number" id="qty_<?= $l['id'] ?>" name="qty" value="1" min="1" max="100" class="w-full bg-gray-50 border border-gray-100 rounded-xl px-3 py-2 text-sm font-bold text-gray-800 text-center focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none" required>
                                </div>

                                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-xl shadow-md shadow-blue-100 hover:shadow-none transition-all text-xs flex items-center justify-center gap-1.5 self-end h-[38px]">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Keranjang
                                </button>
                            </div>

                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="timbang_<?= $l['id'] ?>" name="timbang_di_toko" value="1" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500" onchange="toggleQtyInput(<?= $l['id'] ?>)">
                                <label for="timbang_<?= $l['id'] ?>" class="text-xs font-semibold text-gray-500 select-none cursor-pointer">Belum tahu berat (Timbang di workshop)</label>
                            </div>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full bg-white rounded-3xl p-12 text-center text-gray-400 font-semibold border border-gray-100">
                    <svg class="h-12 w-12 mx-auto text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                    Belum ada layanan laundry aktif yang tersedia saat ini.
                </div>
            <?php endif; ?>
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 py-6 mt-12">
        <div class="max-w-7xl mx-auto px-6 text-center text-xs text-gray-400 font-semibold">
            &copy; <?= date('Y') ?> <?= esc($pengaturan['nama_laundry'] ?? 'Laras Laundry') ?>. All rights reserved.
        </div>
    </footer>

    <script>
        function toggleQtyInput(id) {
            const checkbox = document.getElementById('timbang_' + id);
            const qtyInput = document.getElementById('qty_' + id);
            if (checkbox.checked) {
                qtyInput.disabled = true;
                qtyInput.value = '';
                qtyInput.removeAttribute('required');
                qtyInput.classList.add('opacity-50');
            } else {
                qtyInput.disabled = false;
                qtyInput.value = '1';
                qtyInput.setAttribute('required', 'required');
                qtyInput.classList.remove('opacity-50');
            }
        }
    </script>
</body>
</html>
