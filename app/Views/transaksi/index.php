<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="bg-white rounded-2xl border border-gray-150 shadow-sm overflow-hidden mb-6">
    <!-- Header/Filter Area -->
    <div class="px-6 py-5 border-b border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <!-- Search & Filter Form -->
        <form action="<?= base_url('transaksi') ?>" method="GET" class="w-full md:max-w-xl flex flex-col sm:flex-row gap-2">
            <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Cari invoice atau pelanggan..." class="w-full sm:max-w-xs px-4 py-2 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all">
            
            <select name="status" class="w-full sm:w-40 px-4 py-2 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all bg-white">
                <option value="">Semua Status</option>
                <option value="Menunggu" <?= $status === 'Menunggu' ? 'selected' : '' ?>>Menunggu</option>
                <option value="Diproses" <?= $status === 'Diproses' ? 'selected' : '' ?>>Diproses</option>
                <option value="Selesai" <?= $status === 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                <option value="Diambil" <?= $status === 'Diambil' ? 'selected' : '' ?>>Diambil</option>
            </select>

            <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl text-sm font-bold transition-all">Filter</button>
        </form>

        <!-- Add Button -->
        <a href="<?= base_url('transaksi/create') ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-xl shadow-md shadow-blue-100 hover:shadow-none transition-all text-sm flex items-center justify-center gap-2 self-start md:self-auto">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Tambah Transaksi
        </a>
    </div>

    <!-- Responsive Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-400 text-xs font-bold uppercase border-b border-gray-100">
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Invoice</th>
                    <th class="px-6 py-3">Pelanggan</th>
                    <th class="px-6 py-3">Layanan</th>
                    <th class="px-6 py-3">Berat</th>
                    <th class="px-6 py-3">Total Harga</th>
                    <th class="px-6 py-3">Tgl Masuk</th>
                    <th class="px-6 py-3">Tgl Selesai</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm font-semibold text-gray-700">
                <?php if (empty($transaksi)): ?>
                    <tr>
                        <td colspan="10" class="px-6 py-10 text-center text-gray-400 font-medium">Data transaksi tidak ditemukan.</td>
                    </tr>
                <?php else: ?>
                    <?php
                        $page = isset($_GET['page_transaksi']) ? (int)$_GET['page_transaksi'] : 1;
                        $no = ($page - 1) * 10 + 1;
                    ?>
                    <?php foreach ($transaksi as $t): ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-400 font-bold"><?= $no++ ?></td>
                            <td class="px-6 py-4 font-bold text-blue-600">
                                <a href="<?= base_url('transaksi/detail/' . $t['id']) ?>"><?= htmlspecialchars($t['invoice']) ?></a>
                            </td>
                            <td class="px-6 py-4"><?= htmlspecialchars($t['nama_pelanggan']) ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($t['nama_layanan']) ?></td>
                            <td class="px-6 py-4"><?= floatval($t['berat_kg']) ?> Kg</td>
                            <td class="px-6 py-4 text-gray-950 font-bold">Rp <?= number_format($t['total_harga'], 0, ',', '.') ?></td>
                            <td class="px-6 py-4"><?= date('d-m-Y', strtotime($t['tanggal_masuk'])) ?></td>
                            <td class="px-6 py-4 text-gray-500"><?= date('d-m-Y', strtotime($t['tanggal_selesai'])) ?></td>
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
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold <?= $class ?>">
                                    <form action="<?= base_url('transaksi/status/' . $t['id']) ?>" method="POST" class="inline">
                                        <?= csrf_field() ?>
                                        <select name="status" onchange="this.form.submit()" class="bg-transparent font-bold cursor-pointer outline-none">
                                            <option value="Menunggu" <?= $t['status'] === 'Menunggu' ? 'selected' : '' ?>>Menunggu</option>
                                            <option value="Diproses" <?= $t['status'] === 'Diproses' ? 'selected' : '' ?>>Diproses</option>
                                            <option value="Selesai" <?= $t['status'] === 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                                            <option value="Diambil" <?= $t['status'] === 'Diambil' ? 'selected' : '' ?>>Diambil</option>
                                        </select>
                                    </form>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right flex items-center justify-end gap-1.5">
                                <a href="<?= base_url('transaksi/detail/' . $t['id']) ?>" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all" title="Detail Invoice">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                </a>
                                <a href="<?= base_url('transaksi/edit/' . $t['id']) ?>" class="p-2 text-blue-600 hover:bg-blue-50 rounded-xl transition-all" title="Edit">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                </a>
                                <form action="<?= base_url('transaksi/delete/' . $t['id']) ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')" class="inline">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="p-2 text-rose-600 hover:bg-rose-50 rounded-xl transition-all" title="Hapus">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination Footer -->
    <?php if (!empty($transaksi)): ?>
        <div class="px-6 border-t border-gray-100">
            <?= $pager->links('transaksi', 'tailwind_full') ?>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
