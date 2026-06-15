<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="max-w-2xl bg-white rounded-2xl border border-gray-150 shadow-sm overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
        <h3 class="text-base font-bold text-gray-800">Tambah Transaksi Laundry Baru</h3>
        <a href="<?= base_url('transaksi') ?>" class="text-xs font-bold text-gray-500 hover:text-gray-700 flex items-center gap-1">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Kembali
        </a>
    </div>

    <form action="<?= base_url('transaksi/store') ?>" method="POST" class="p-6 space-y-5">
        <?= csrf_field() ?>

        <div>
            <label for="pelanggan_id" class="block text-sm font-semibold text-gray-700 mb-1.5">Pilih Pelanggan <span class="text-rose-500">*</span></label>
            <select name="pelanggan_id" id="pelanggan_id" class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all bg-white" required>
                <option value="">-- Pilih Pelanggan --</option>
                <?php foreach ($pelanggan as $p): ?>
                    <option value="<?= $p['id'] ?>" <?= old('pelanggan_id') == $p['id'] ? 'selected' : '' ?>><?= htmlspecialchars($p['nama']) ?> (<?= htmlspecialchars($p['no_hp']) ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="layanan_id" class="block text-sm font-semibold text-gray-700 mb-1.5">Pilih Layanan Laundry <span class="text-rose-500">*</span></label>
            <select name="layanan_id" id="layanan_id" onchange="updateServiceDetails()" class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all bg-white" required>
                <option value="">-- Pilih Layanan --</option>
                <?php foreach ($layanan as $l): ?>
                    <option value="<?= $l['id'] ?>" <?= old('layanan_id') == $l['id'] ? 'selected' : '' ?>><?= htmlspecialchars($l['nama_layanan']) ?> (<?= htmlspecialchars($l['kode_layanan']) ?>)</option>
                <?php endforeach; ?>
            </select>
            
            <!-- Dynamic Service Details Box -->
            <div id="service-info" class="hidden mt-2 p-3 bg-blue-50 rounded-xl border border-blue-100 flex items-center justify-between text-xs font-bold text-blue-700">
                <span>Harga: <span id="service-price">-</span></span>
                <span>Estimasi: <span id="service-est">-</span></span>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="berat_kg" class="block text-sm font-semibold text-gray-700 mb-1.5">Berat Laundry (Kg) <span class="text-rose-500">*</span></label>
                <input type="number" step="0.01" name="berat_kg" id="berat_kg" value="<?= old('berat_kg') ?>" placeholder="Contoh: 3.5" class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all" required>
            </div>

            <div>
                <label for="tanggal_masuk" class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal Masuk <span class="text-rose-500">*</span></label>
                <input type="date" name="tanggal_masuk" id="tanggal_masuk" value="<?= old('tanggal_masuk', date('Y-m-d')) ?>" class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all bg-white" required>
            </div>
        </div>

        <div>
            <label for="catatan" class="block text-sm font-semibold text-gray-700 mb-1.5">Catatan Khusus</label>
            <textarea name="catatan" id="catatan" rows="3" placeholder="Contoh: Baju putih dipisah, luntur, dll..." class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all"><?= old('catatan') ?></textarea>
        </div>

        <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
            <a href="<?= base_url('transaksi') ?>" class="px-4 py-2.5 rounded-xl border border-gray-200 text-sm font-bold text-gray-600 hover:bg-gray-50 transition-all">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl shadow-md shadow-blue-100 hover:shadow-none transition-all text-sm">Simpan</button>
        </div>
    </form>
</div>

<!-- Interactive Javascript Details -->
<script>
    const services = <?= json_encode($layanan) ?>;
    
    function updateServiceDetails() {
        const select = document.getElementById('layanan_id');
        const selectedId = select.value;
        const infoDiv = document.getElementById('service-info');
        const priceSpan = document.getElementById('service-price');
        const estSpan = document.getElementById('service-est');

        const service = services.find(s => s.id == selectedId);
        if (service) {
            priceSpan.innerText = 'Rp ' + parseFloat(service.harga_per_kg).toLocaleString('id-ID');
            estSpan.innerText = service.estimasi_hari + ' Hari';
            infoDiv.classList.remove('hidden');
        } else {
            infoDiv.classList.add('hidden');
        }
    }
    
    // Auto-trigger on page load if validation fails and value exists
    document.addEventListener('DOMContentLoaded', () => {
        if (document.getElementById('layanan_id').value) {
            updateServiceDetails();
        }
    });
</script>
<?= $this->endSection() ?>
