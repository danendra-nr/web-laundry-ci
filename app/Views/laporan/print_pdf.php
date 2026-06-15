<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
            color: #333;
        }
        .header {
            width: 100%;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header td {
            vertical-align: top;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            color: #2563EB;
        }
        .summary-box {
            width: 100%;
            margin-bottom: 20px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-collapse: collapse;
        }
        .summary-box td {
            padding: 10px;
            width: 50%;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .table th, .table td {
            border: 1px solid #e5e7eb;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f3f4f6;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .footer-sig {
            float: right;
            width: 200px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <table class="header">
        <tr>
            <td>
                <span style="font-size: 16px; font-weight: bold; text-transform: uppercase;"><?= htmlspecialchars($pengaturan['nama_laundry'] ?? 'LMS') ?></span><br>
                <span>WhatsApp: <?= htmlspecialchars($pengaturan['whatsapp'] ?? '-') ?></span><br>
                <span style="font-size: 9px; color: #666;"><?= htmlspecialchars($pengaturan['alamat'] ?? '-') ?></span>
            </td>
            <td style="text-align: right;">
                <span class="title">Laporan Transaksi</span><br>
                <span>Rentang: 
                    <?php if ($filter === 'hari_ini') echo 'Hari Ini (' . date('d-m-Y') . ')'; ?>
                    <?php if ($filter === 'minggu_ini') echo 'Minggu Ini'; ?>
                    <?php if ($filter === 'bulan_ini') echo 'Bulan Ini'; ?>
                    <?php if ($filter === 'custom') echo date('d-m-Y', strtotime($startDate)) . ' s/d ' . date('d-m-Y', strtotime($endDate)); ?>
                </span><br>
                <span style="font-size: 9px; color: #999;">Dicetak: <?= date('d-m-Y H:i:s') ?></span>
            </td>
        </tr>
    </table>

    <table class="summary-box">
        <tr>
            <td>
                <span style="font-size: 10px; color: #999; text-transform: uppercase;">Total Transaksi</span><br>
                <span style="font-size: 16px; font-weight: bold;"><?= number_format($totalTransaksi) ?> Transaksi</span>
            </td>
            <td>
                <span style="font-size: 10px; color: #999; text-transform: uppercase;">Total Pendapatan</span><br>
                <span style="font-size: 16px; font-weight: bold; color: #2563EB;">Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></span>
            </td>
        </tr>
    </table>

    <table class="table">
        <thead>
            <tr>
                <th class="text-center" style="width: 5%;">No</th>
                <th style="width: 15%;">Invoice</th>
                <th style="width: 10%;">Tanggal</th>
                <th style="width: 15%;">Pelanggan</th>
                <th style="width: 15%;">Layanan</th>
                <th class="text-center" style="width: 8%;">Berat</th>
                <th class="text-right" style="width: 12%;">Harga</th>
                <th class="text-right" style="width: 12%;">Total</th>
                <th class="text-center" style="width: 8%;">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($transaksi)): ?>
                <tr>
                    <td colspan="9" class="text-center" style="padding: 20px; color: #999;">Tidak ada data terfilter.</td>
                </tr>
            <?php else: ?>
                <?php $no = 1; ?>
                <?php foreach ($transaksi as $t): ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td style="font-weight: bold;"><?= htmlspecialchars($t['invoice']) ?></td>
                        <td><?= date('d-m-Y', strtotime($t['tanggal_masuk'])) ?></td>
                        <td><?= htmlspecialchars($t['nama_pelanggan']) ?></td>
                        <td><?= htmlspecialchars($t['nama_layanan']) ?></td>
                        <td class="text-center"><?= floatval($t['berat_kg']) ?> Kg</td>
                        <td class="text-right">Rp <?= number_format($t['harga_per_kg'], 0, ',', '.') ?></td>
                        <td class="text-right" style="font-weight: bold;">Rp <?= number_format($t['total_harga'], 0, ',', '.') ?></td>
                        <td class="text-center"><?= $t['status'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer-sig">
        <p style="color: #666; margin-bottom: 40px;">Pengelola Laundry,</p>
        <p style="font-weight: bold; border-top: 1px solid #ccc; padding-top: 5px;">Admin LMS</p>
    </div>

</body>
</html>
