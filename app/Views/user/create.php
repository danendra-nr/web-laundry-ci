<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="max-w-2xl bg-white rounded-2xl border border-gray-150 shadow-sm overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
        <h3 class="text-base font-bold text-gray-800">Tambah User Baru</h3>
        <a href="<?= base_url('user') ?>" class="text-xs font-bold text-gray-500 hover:text-gray-700 flex items-center gap-1">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Kembali
        </a>
    </div>

    <form action="<?= base_url('user/store') ?>" method="POST" class="p-6 space-y-5">
        <?= csrf_field() ?>

        <div>
            <label for="username" class="block text-sm font-semibold text-gray-700 mb-1.5">Username <span class="text-rose-500">*</span></label>
            <input type="text" name="username" id="username" value="<?= old('username') ?>" placeholder="Masukkan username" class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all" required>
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password <span class="text-rose-500">*</span></label>
            <input type="password" name="password" id="password" placeholder="Masukkan password" class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all" required>
        </div>

        <div>
            <label for="confirm_password" class="block text-sm font-semibold text-gray-700 mb-1.5">Konfirmasi Password <span class="text-rose-500">*</span></label>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Konfirmasi password" class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all" required>
        </div>

        <div>
            <label for="role" class="block text-sm font-semibold text-gray-700 mb-1.5">Role <span class="text-rose-500">*</span></label>
            <select name="role" id="role" onchange="togglePelangganSelect()" class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all" required>
                <option value="admin" <?= old('role') == 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="pelanggan" <?= old('role') == 'pelanggan' ? 'selected' : '' ?>>Pelanggan</option>
            </select>
        </div>

        <div id="pelanggan_section" class="hidden">
            <label for="pelanggan_id" class="block text-sm font-semibold text-gray-700 mb-1.5">Hubungkan ke Pelanggan <span class="text-rose-500">*</span></label>
            <select name="pelanggan_id" id="pelanggan_id" class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all">
                <option value="">-- Pilih Pelanggan --</option>
                <?php foreach ($pelanggan as $p): ?>
                    <option value="<?= $p['id'] ?>" <?= old('pelanggan_id') == $p['id'] ? 'selected' : '' ?>><?= htmlspecialchars($p['nama']) ?> (<?= htmlspecialchars($p['no_hp']) ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>

        <script>
            function togglePelangganSelect() {
                const role = document.getElementById('role').value;
                const section = document.getElementById('pelanggan_section');
                const select = document.getElementById('pelanggan_id');
                if (role === 'pelanggan') {
                    section.classList.remove('hidden');
                    select.setAttribute('required', 'required');
                } else {
                    section.classList.add('hidden');
                    select.removeAttribute('required');
                }
            }
            document.addEventListener('DOMContentLoaded', togglePelangganSelect);
        </script>

        <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
            <a href="<?= base_url('user') ?>" class="px-4 py-2.5 rounded-xl border border-gray-200 text-sm font-bold text-gray-600 hover:bg-gray-50 transition-all">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl shadow-md shadow-blue-100 hover:shadow-none transition-all text-sm">Simpan</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
