<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Laundry Jarak Jauh - <?= esc($pengaturan['nama_laundry'] ?? 'Laras Laundry') ?></title>
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
            
            <div class="flex items-center gap-3">
                <span class="font-extrabold text-xl text-blue-600 tracking-tight"><?= esc($pengaturan['nama_laundry'] ?? 'Laras Laundry') ?></span>
            </div>
        </div>
    </nav>

    <!-- Main Form Container -->
    <main class="flex-1 max-w-2xl w-full mx-auto p-6">

        <div class="bg-white rounded-3xl border border-gray-100 shadow-xl shadow-blue-50 overflow-hidden">
            <div class="p-6 md:p-8 bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                <h2 class="text-2xl font-black">Form Pemesanan Jarak Jauh</h2>
                <p class="text-blue-100 text-sm font-semibold mt-1">Isi formulir berikut untuk memesan laundry. Kurir kami akan mengurus sisanya sesuai dengan opsi Anda.</p>
            </div>

            <div class="p-6 md:p-8">
                <!-- Errors -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-2xl flex items-center gap-3 shadow-sm">
                        <svg class="h-5 w-5 text-rose-500 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                        <span class="font-medium text-sm"><?= session()->getFlashdata('error') ?></span>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('customer/pesan') ?>" method="POST" class="space-y-6">
                    <?= csrf_field() ?>

                    <!-- Select Service -->
                    <div>
                        <label for="layanan_id" class="block text-sm font-bold text-gray-700 mb-2">Pilih Layanan Laundry</label>
                        <select name="layanan_id" id="layanan_id" class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3.5 text-sm text-gray-800 font-semibold focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none" required>
                            <option value="">-- Pilih Layanan --</option>
                            <?php foreach ($layanan as $l): ?>
                                <option value="<?= $l['id'] ?>" <?= old('layanan_id') == $l['id'] ? 'selected' : '' ?>>
                                    <?= esc($l['nama_layanan']) ?> (Rp <?= number_format($l['harga_per_kg'], 0, ',', '.') ?>/kg - Est. <?= esc($l['estimasi_hari']) ?> Hari)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset(session()->getFlashdata('errors')['layanan_id'])): ?>
                            <p class="text-rose-500 text-xs mt-1 font-semibold"><?= session()->getFlashdata('errors')['layanan_id'] ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Shipping options -->
                    <div>
                        <label for="opsi_pengiriman" class="block text-sm font-bold text-gray-700 mb-2">Opsi Pengiriman & Penjemputan</label>
                        <select name="opsi_pengiriman" id="opsi_pengiriman" onchange="toggleAddressField()" class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3.5 text-sm text-gray-800 font-semibold focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none" required>
                            <option value="Kirim Sendiri" <?= old('opsi_pengiriman') == 'Kirim Sendiri' ? 'selected' : '' ?>>Kirim & Ambil Sendiri ke Workshop</option>
                            <option value="Jemput Saja" <?= old('opsi_pengiriman') == 'Jemput Saja' ? 'selected' : '' ?>>Jemput Saja (Pakaian dijemput, saya ambil sendiri)</option>
                            <option value="Antar Saja" <?= old('opsi_pengiriman') == 'Antar Saja' ? 'selected' : '' ?>>Antar Saja (Saya kirim ke laundry, pakaian diantar kurir)</option>
                            <option value="Jemput dan Antar" <?= old('opsi_pengiriman') == 'Jemput dan Antar' ? 'selected' : '' ?>>Jemput dan Antar (Full Kurir Service)</option>
                        </select>
                        <?php if (isset(session()->getFlashdata('errors')['opsi_pengiriman'])): ?>
                            <p class="text-rose-500 text-xs mt-1 font-semibold"><?= session()->getFlashdata('errors')['opsi_pengiriman'] ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Shipping Address (Show/hide dynamically) -->
                    <div id="address_section" class="hidden">
                        <label for="alamat_pengiriman" class="block text-sm font-bold text-gray-700 mb-2">Alamat Penjemputan / Pengantaran</label>
                        <textarea name="alamat_pengiriman" id="alamat_pengiriman" rows="3" placeholder="Masukkan alamat lengkap untuk kurir..." class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3 text-sm text-gray-800 font-semibold focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none"></textarea>
                        <p class="text-xs text-gray-400 font-medium mt-1">Harap isi alamat dengan detail agar mempermudah kurir melacak lokasi Anda.</p>
                        <?php if (isset(session()->getFlashdata('errors')['alamat_pengiriman'])): ?>
                            <p class="text-rose-500 text-xs mt-1 font-semibold"><?= session()->getFlashdata('errors')['alamat_pengiriman'] ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Notes/Catatan -->
                    <div>
                        <label for="catatan" class="block text-sm font-bold text-gray-700 mb-2">Catatan Laundry (Opsional)</label>
                        <textarea name="catatan" id="catatan" rows="3" placeholder="Contoh: Pisahkan baju luntur, tidak pakai pewangi menyengat, setrika lipat, dll." class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3 text-sm text-gray-800 font-semibold focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none"><?= old('catatan') ?></textarea>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-4 rounded-2xl shadow-lg shadow-blue-200 hover:shadow-none hover:-translate-y-0.5 transition-all text-sm flex items-center justify-center gap-2">
                        Buat Pesanan Laundry
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                    </button>
                </form>
            </div>
        </div>

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
