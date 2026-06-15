<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Filter Card -->
<div class="bg-white rounded-2xl border border-gray-150 shadow-sm overflow-hidden mb-6">
    <div class="px-6 py-5 border-b border-gray-100">
        <h3 class="text-base font-bold text-gray-800">Filter Laporan Transaksi & Pendapatan</h3>
    </div>
    
    <form action="<?= base_url('laporan') ?>" method="GET" class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <div>
                <label for="filter" class="block text-xs font-bold text-gray-400 uppercase mb-1.5">Rentang Waktu</label>
                <select name="filter" id="filter" onchange="toggleCustomDates()" class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all bg-white">
                    <option value="hari_ini" <?= $filter === 'hari_ini' ? 'selected' : '' ?>>Hari Ini</option>
                    <option value="minggu_ini" <?= $filter === 'minggu_ini' ? 'selected' : '' ?>>Minggu Ini</option>
                    <option value="bulan_ini" <?= $filter === 'bulan_ini' ? 'selected' : '' ?>>Bulan Ini</option>
                    <option value="custom" <?= $filter === 'custom' ? 'selected' : '' ?>>Kustom Tanggal</option>
                </select>
            </div>

            <div id="custom-date-start" class="hidden">
                <label for="start_date" class="block text-xs font-bold text-gray-400 uppercase mb-1.5">Mulai Tanggal</label>
                <input type="date" name="start_date" id="start_date" value="<?= htmlspecialchars($startDate) ?>" class="w-full px-4 py-2 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all bg-white">
            </div>

            <div id="custom-date-end" class="hidden">
                <label for="end_date" class="block text-xs font-bold text-gray-400 uppercase mb-1.5">Sampai Tanggal</label>
                <input type="date" name="end_date" id="end_date" value="<?= htmlspecialchars($endDate) ?>" class="w-full px-4 py-2 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all bg-white">
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl shadow-md shadow-blue-100 hover:shadow-none transition-all text-sm flex-1">
                    Tampilkan
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Stats Summary -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
    <!-- Card 1: Total Pendapatan -->
    <div class="bg-white p-6 rounded-2xl border border-gray-150 shadow-sm flex items-center justify-between">
        <div>
            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Pendapatan Terfilter</span>
            <h3 class="text-3xl font-extrabold text-blue-600 mt-1">Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></h3>
        </div>
        <div class="h-12 w-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        </div>
    </div>

    <!-- Card 2: Total Transaksi -->
    <div class="bg-white p-6 rounded-2xl border border-gray-150 shadow-sm flex items-center justify-between">
        <div>
            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Transaksi Terfilter</span>
            <h3 class="text-3xl font-extrabold text-gray-900 mt-1"><?= number_format($totalTransaksi) ?></h3>
        </div>
        <div class="h-12 w-12 rounded-xl bg-violet-50 flex items-center justify-center text-violet-600">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
        </div>
    </div>
</div>

<!-- Laporan Table -->
<div class="bg-white rounded-2xl border border-gray-150 shadow-sm overflow-hidden mb-6">
    <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h3 class="text-base font-bold text-gray-800">Detail Laporan Terfilter</h3>
        
        <div class="flex items-center gap-2">
            <!-- CSV Link -->
            <a href="<?= base_url('laporan') . '?' . http_build_query(array_merge($_GET, ['export' => 'csv'])) ?>" class="px-4 py-2 border border-gray-200 hover:bg-gray-50 text-gray-700 font-bold rounded-xl text-xs flex items-center gap-1.5 transition-all">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                Export Excel/CSV
            </a>
            <!-- PDF Link -->
            <a href="<?= base_url('laporan') . '?' . http_build_query(array_merge($_GET, ['export' => 'pdf'])) ?>" class="px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-xl text-xs flex items-center gap-1.5 transition-all shadow-md shadow-rose-100 hover:shadow-none">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" /></svg>
                Unduh PDF
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-400 text-xs font-bold uppercase border-b border-gray-100">
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Invoice</th>
                    <th class="px-6 py-3">Tgl Masuk</th>
                    <th class="px-6 py-3">Pelanggan</th>
                    <th class="px-6 py-3">Layanan</th>
                    <th class="px-6 py-3">Berat</th>
                    <th class="px-6 py-3">Harga/Kg</th>
                    <th class="px-6 py-3">Total Harga</th>
                    <th class="px-6 py-3">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm font-semibold text-gray-700">
                <?php if (empty($transaksi)): ?>
                    <tr>
                        <td colspan="9" class="px-6 py-10 text-center text-gray-400 font-medium">Tidak ada transaksi dalam rentang tanggal ini.</td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; ?>
                    <?php foreach ($transaksi as $t): ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-400 font-bold"><?= $no++ ?></td>
                            <td class="px-6 py-4 font-bold text-blue-600"><?= htmlspecialchars($t['invoice']) ?></td>
                            <td class="px-6 py-4"><?= date('d-m-Y', strtotime($t['tanggal_masuk'])) ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($t['nama_pelanggan']) ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($t['nama_layanan']) ?></td>
                            <td class="px-6 py-4"><?= floatval($t['berat_kg']) ?> Kg</td>
                            <td class="px-6 py-4">Rp <?= number_format($t['harga_per_kg'], 0, ',', '.') ?></td>
                            <td class="px-6 py-4 text-gray-900 font-extrabold">Rp <?= number_format($t['total_harga'], 0, ',', '.') ?></td>
                            <td class="px-6 py-4">
                                <?php
                                    $statusClasses = [
                                        'Menunggu' => 'bg-gray-100 text-gray-700',
                                        'Diproses' => 'bg-blue-50 text-blue-700 border border-blue-100',
                                        'Selesai'  => 'bg-amber-50 text-amber-700 border border-amber-100',
                                        'Diambil'  => 'bg-emerald-50 text-emerald-700 border border-emerald-100',
                                    ];
                                    $class = $statusClasses[$t['status']] ?? 'bg-gray-100 text-gray-700';
                                ?>
                                <span class="px-3 py-1 rounded-full text-xs font-bold <?= $class ?>"><?= $t['status'] ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Filter Show/Hide Dates Script -->
<script>
    function toggleCustomDates() {
        const filter = document.getElementById('filter').value;
        const startDiv = document.getElementById('custom-date-start');
        const endDiv = document.getElementById('custom-date-end');
        
        if (filter === 'custom') {
            startDiv.classList.remove('hidden');
            endDiv.classList.remove('hidden');
            document.getElementById('start_date').required = true;
            document.getElementById('end_date').required = true;
        } else {
            startDiv.classList.add('hidden');
            endDiv.classList.add('hidden');
            document.getElementById('start_date').required = false;
            document.getElementById('end_date').required = false;
        }
    }
    
    // Trigger on load
    document.addEventListener('DOMContentLoaded', toggleCustomDates);
</script>
<?= $this->endSection() ?>
