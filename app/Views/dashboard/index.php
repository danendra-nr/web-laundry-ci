<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Grid Stats -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <!-- Card 1: Total Pelanggan -->
    <div class="bg-white p-6 rounded-2xl border border-gray-150 shadow-sm flex items-center justify-between">
        <div>
            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Pelanggan</span>
            <h3 class="text-3xl font-extrabold text-gray-900 mt-1"><?= number_format($stats['total_pelanggan']) ?></h3>
        </div>
        <div class="h-12 w-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
        </div>
    </div>

    <!-- Card 2: Total Layanan -->
    <div class="bg-white p-6 rounded-2xl border border-gray-150 shadow-sm flex items-center justify-between">
        <div>
            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Layanan</span>
            <h3 class="text-3xl font-extrabold text-gray-900 mt-1"><?= number_format($stats['total_layanan']) ?></h3>
        </div>
        <div class="h-12 w-12 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
        </div>
    </div>

    <!-- Card 3: Total Transaksi -->
    <div class="bg-white p-6 rounded-2xl border border-gray-150 shadow-sm flex items-center justify-between">
        <div>
            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Transaksi</span>
            <h3 class="text-3xl font-extrabold text-gray-900 mt-1"><?= number_format($stats['total_transaksi']) ?></h3>
        </div>
        <div class="h-12 w-12 rounded-xl bg-violet-50 flex items-center justify-center text-violet-600">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
        </div>
    </div>

    <!-- Card 4: Laundry Diproses -->
    <div class="bg-white p-6 rounded-2xl border border-gray-150 shadow-sm flex items-center justify-between">
        <div>
            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Laundry Diproses</span>
            <h3 class="text-3xl font-extrabold text-amber-600 mt-1"><?= number_format($stats['laundry_proses']) ?></h3>
        </div>
        <div class="h-12 w-12 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        </div>
    </div>

    <!-- Card 5: Laundry Selesai -->
    <div class="bg-white p-6 rounded-2xl border border-gray-150 shadow-sm flex items-center justify-between">
        <div>
            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Laundry Selesai</span>
            <h3 class="text-3xl font-extrabold text-emerald-600 mt-1"><?= number_format($stats['laundry_selesai']) ?></h3>
        </div>
        <div class="h-12 w-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        </div>
    </div>

    <!-- Card 6: Pendapatan Hari Ini -->
    <div class="bg-white p-6 rounded-2xl border border-gray-150 shadow-sm flex items-center justify-between">
        <div>
            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pendapatan Hari Ini</span>
            <h3 class="text-3xl font-extrabold text-blue-600 mt-1">Rp <?= number_format($stats['pendapatan_hari'], 0, ',', '.') ?></h3>
        </div>
        <div class="h-12 w-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Chart Pendapatan 7 Hari Terakhir -->
    <div class="bg-white p-6 rounded-2xl border border-gray-150 shadow-sm lg:col-span-2">
        <h3 class="text-base font-bold text-gray-800 mb-4">Grafik Pendapatan 7 Hari Terakhir</h3>
        <div class="relative h-72">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    <!-- Info Box/Summary -->
    <div class="bg-white p-6 rounded-2xl border border-gray-150 shadow-sm flex flex-col justify-between">
        <div>
            <h3 class="text-base font-bold text-gray-800 mb-4">Profil Laundry</h3>
            <div class="space-y-4">
                <div>
                    <span class="text-xs text-gray-400 font-semibold block uppercase">Nama Laundry</span>
                    <span class="text-sm font-bold text-gray-700"><?= htmlspecialchars($pengaturan['nama_laundry'] ?? '-') ?></span>
                </div>
                <div>
                    <span class="text-xs text-gray-400 font-semibold block uppercase">Nomor WhatsApp</span>
                    <span class="text-sm font-bold text-gray-700"><?= htmlspecialchars($pengaturan['whatsapp'] ?? '-') ?></span>
                </div>
                <div>
                    <span class="text-xs text-gray-400 font-semibold block uppercase">Alamat</span>
                    <span class="text-sm text-gray-600 font-medium"><?= htmlspecialchars($pengaturan['alamat'] ?? '-') ?></span>
                </div>
            </div>
        </div>
        <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between">
            <span class="text-xs text-gray-400 font-bold">Terakhir diperbarui:</span>
            <span class="text-xs text-gray-500 font-semibold"><?= date('d M Y H:i', strtotime($pengaturan['updated_at'] ?? 'now')) ?></span>
        </div>
    </div>
</div>

<!-- Aktivitas Terbaru -->
<div class="bg-white rounded-2xl border border-gray-150 shadow-sm overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
        <h3 class="text-base font-bold text-gray-800">10 Transaksi Terakhir</h3>
        <a href="<?= base_url('transaksi') ?>" class="text-xs font-bold text-blue-600 hover:text-blue-700 flex items-center gap-1">
            Lihat Semua
            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-400 text-xs font-bold uppercase border-b border-gray-100">
                    <th class="px-6 py-3">Invoice</th>
                    <th class="px-6 py-3">Pelanggan</th>
                    <th class="px-6 py-3">Layanan</th>
                    <th class="px-6 py-3">Berat</th>
                    <th class="px-6 py-3">Total Harga</th>
                    <th class="px-6 py-3">Tanggal Masuk</th>
                    <th class="px-6 py-3">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm font-semibold text-gray-700">
                <?php if (empty($recentTransactions)): ?>
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-gray-400 font-medium">Belum ada transaksi terdaftar.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($recentTransactions as $t): ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-bold text-blue-600">
                                <a href="<?= base_url('transaksi/detail/' . $t['id']) ?>"><?= htmlspecialchars($t['invoice']) ?></a>
                            </td>
                            <td class="px-6 py-4"><?= htmlspecialchars($t['nama_pelanggan']) ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($t['nama_layanan']) ?></td>
                            <td class="px-6 py-4"><?= floatval($t['berat_kg']) ?> Kg</td>
                            <td class="px-6 py-4">Rp <?= number_format($t['total_harga'], 0, ',', '.') ?></td>
                            <td class="px-6 py-4"><?= date('d-m-Y', strtotime($t['tanggal_masuk'])) ?></td>
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

<!-- Chart JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const chartData = <?= json_encode($chartData) ?>;
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.map(item => item.day),
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: chartData.map(item => item.revenue),
                borderColor: '#2563EB',
                backgroundColor: 'rgba(37, 99, 235, 0.05)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#2563EB',
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        font: {
                            family: 'Baloo 2',
                            size: 11
                        },
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            family: 'Baloo 2',
                            size: 11
                        }
                    }
                }
            }
        }
    });
</script>
<?= $this->endSection() ?>
