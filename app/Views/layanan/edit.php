<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="max-w-2xl bg-white rounded-2xl border border-gray-150 shadow-sm overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
        <h3 class="text-base font-bold text-gray-800">Edit Layanan Laundry</h3>
        <a href="<?= base_url('layanan') ?>" class="text-xs font-bold text-gray-500 hover:text-gray-700 flex items-center gap-1">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Kembali
        </a>
    </div>

    <form action="<?= base_url('layanan/update/' . $layanan['id']) ?>" method="POST" class="p-6 space-y-5">
        <?= csrf_field() ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="kode_layanan" class="block text-sm font-semibold text-gray-700 mb-1.5">Kode Layanan <span class="text-rose-500">*</span></label>
                <input type="text" name="kode_layanan" id="kode_layanan" value="<?= old('kode_layanan', $layanan['kode_layanan']) ?>" placeholder="Contoh: CK (Cuci Kering)" class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all uppercase" required>
            </div>

            <div>
                <label for="nama_layanan" class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Layanan <span class="text-rose-500">*</span></label>
                <input type="text" name="nama_layanan" id="nama_layanan" value="<?= old('nama_layanan', $layanan['nama_layanan']) ?>" placeholder="Contoh: Cuci Kering Setrika" class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all" required>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="harga_per_kg" class="block text-sm font-semibold text-gray-700 mb-1.5">Harga Per Kg (Rp) <span class="text-rose-500">*</span></label>
                <input type="number" name="harga_per_kg" id="harga_per_kg" value="<?= old('harga_per_kg', (int)$layanan['harga_per_kg']) ?>" placeholder="Contoh: 7000" class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all" required>
            </div>

            <div>
                <label for="estimasi_hari" class="block text-sm font-semibold text-gray-700 mb-1.5">Estimasi Waktu (Hari) <span class="text-rose-500">*</span></label>
                <input type="number" name="estimasi_hari" id="estimasi_hari" value="<?= old('estimasi_hari', $layanan['estimasi_hari']) ?>" placeholder="Contoh: 2" class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all" required>
            </div>
        </div>

        <div>
            <label for="status" class="block text-sm font-semibold text-gray-700 mb-1.5">Status Layanan <span class="text-rose-500">*</span></label>
            <select name="status" id="status" class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all bg-white" required>
                <option value="Aktif" <?= old('status', $layanan['status']) === 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                <option value="Nonaktif" <?= old('status', $layanan['status']) === 'Nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
            </select>
        </div>

        <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
            <a href="<?= base_url('layanan') ?>" class="px-4 py-2.5 rounded-xl border border-gray-200 text-sm font-bold text-gray-600 hover:bg-gray-50 transition-all">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl shadow-md shadow-blue-100 hover:shadow-none transition-all text-sm">Update</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
