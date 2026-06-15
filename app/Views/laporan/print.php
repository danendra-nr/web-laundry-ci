<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Transaksi - <?= $pengaturan['nama_laundry'] ?? 'LMS' ?></title>
    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts Baloo 2 -->
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Baloo 2', sans-serif;
            background-color: #ffffff;
            color: #000000;
        }
    </style>
</head>
<body class="p-8 text-sm" onload="window.print()">

    <!-- Header -->
    <div class="flex items-center justify-between border-b-2 border-gray-900 pb-4 mb-6">
        <div>
            <h1 class="text-2xl font-black uppercase tracking-tight text-gray-900"><?= htmlspecialchars($pengaturan['nama_laundry'] ?? 'LMS') ?></h1>
            <p class="text-xs text-gray-500 font-bold">WhatsApp: <?= htmlspecialchars($pengaturan['whatsapp'] ?? '-') ?></p>
            <p class="text-xs text-gray-500 max-w-sm mt-1"><?= htmlspecialchars($pengaturan['alamat'] ?? '-') ?></p>
        </div>
        <div class="text-right">
            <h2 class="text-lg font-black uppercase text-blue-600">Laporan Transaksi</h2>
            <p class="text-xs font-semibold text-gray-400">Rentang: 
                <span class="font-bold text-gray-700 uppercase">
                    <?php if ($filter === 'hari_ini') echo 'Hari Ini (' . date('d-m-Y') . ')'; ?>
                    <?php if ($filter === 'minggu_ini') echo 'Minggu Ini'; ?>
                    <?php if ($filter === 'bulan_ini') echo 'Bulan Ini'; ?>
                    <?php if ($filter === 'custom') echo date('d-m-Y', strtotime($startDate)) . ' s/d ' . date('d-m-Y', strtotime($endDate)); ?>
                </span>
            </p>
            <span class="text-[10px] text-gray-400 block mt-1">Dicetak pada: <?= date('d-m-Y H:i:s') ?></span>
        </div>
    </div>

    <!-- Summary Box -->
    <div class="grid grid-cols-2 gap-4 border border-gray-200 rounded-2xl p-4 mb-6 bg-gray-50 font-bold text-gray-700">
        <div>
            <span class="text-xs text-gray-400 uppercase tracking-wider block">Total Transaksi</span>
            <span class="text-xl text-gray-900 font-extrabold"><?= number_format($totalTransaksi) ?> Transaksi</span>
        </div>
        <div>
            <span class="text-xs text-gray-400 uppercase tracking-wider block">Total Pendapatan</span>
            <span class="text-xl text-blue-600 font-extrabold">Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></span>
        </div>
    </div>

    <!-- Data Table -->
    <table class="w-full text-left border-collapse border border-gray-200 text-xs font-semibold text-gray-700">
        <thead>
            <tr class="bg-gray-100 uppercase border-b border-gray-200">
                <th class="border border-gray-200 px-4 py-2 text-center">No</th>
                <th class="border border-gray-200 px-4 py-2">Invoice</th>
                <th class="border border-gray-200 px-4 py-2">Tanggal</th>
                <th class="border border-gray-200 px-4 py-2">Pelanggan</th>
                <th class="border border-gray-200 px-4 py-2">Layanan</th>
                <th class="border border-gray-200 px-4 py-2 text-center">Berat</th>
                <th class="border border-gray-200 px-4 py-2 text-right">Harga</th>
                <th class="border border-gray-200 px-4 py-2 text-right">Total</th>
                <th class="border border-gray-200 px-4 py-2 text-center">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <?php if (empty($transaksi)): ?>
                <tr>
                    <td colspan="9" class="border border-gray-200 px-4 py-6 text-center text-gray-400 font-medium">Tidak ada data terfilter.</td>
                </tr>
            <?php else: ?>
                <?php $no = 1; ?>
                <?php foreach ($transaksi as $t): ?>
                    <tr>
                        <td class="border border-gray-200 px-4 py-2 text-center text-gray-400 font-bold"><?= $no++ ?></td>
                        <td class="border border-gray-200 px-4 py-2 font-bold text-gray-900"><?= htmlspecialchars($t['invoice']) ?></td>
                        <td class="border border-gray-200 px-4 py-2"><?= date('d-m-Y', strtotime($t['tanggal_masuk'])) ?></td>
                        <td class="border border-gray-200 px-4 py-2"><?= htmlspecialchars($t['nama_pelanggan']) ?></td>
                        <td class="border border-gray-200 px-4 py-2"><?= htmlspecialchars($t['nama_layanan']) ?></td>
                        <td class="border border-gray-200 px-4 py-2 text-center"><?= floatval($t['berat_kg']) ?> Kg</td>
                        <td class="border border-gray-200 px-4 py-2 text-right">Rp <?= number_format($t['harga_per_kg'], 0, ',', '.') ?></td>
                        <td class="border border-gray-200 px-4 py-2 text-right text-gray-900 font-black">Rp <?= number_format($t['total_harga'], 0, ',', '.') ?></td>
                        <td class="border border-gray-200 px-4 py-2 text-center font-bold uppercase text-[10px]"><?= $t['status'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Signature / Footer -->
    <div class="mt-16 flex justify-end">
        <div class="text-center w-48">
            <p class="text-xs font-semibold text-gray-400">Pengelola Laundry,</p>
            <div class="h-16"></div>
            <p class="font-bold text-gray-900 border-t border-gray-200 pt-1">Admin LMS</p>
        </div>
    </div>

</body>
</html>
