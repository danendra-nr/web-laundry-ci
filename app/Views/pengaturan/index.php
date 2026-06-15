<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Panel 1: Profil Laundry -->
    <div class="bg-white rounded-2xl border border-gray-150 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100">
            <h3 class="text-base font-bold text-gray-800">Profil Laundry</h3>
        </div>

        <form action="<?= base_url('pengaturan/update') ?>" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            <?= csrf_field() ?>

            <!-- Current Logo Preview -->
            <div class="flex items-center gap-4">
                <div class="h-20 w-20 rounded-2xl bg-gray-50 border border-gray-200 overflow-hidden flex items-center justify-center">
                    <?php if (!empty($pengaturan['logo']) && file_exists(FCPATH . 'uploads/logo/' . $pengaturan['logo'])): ?>
                        <img src="<?= base_url('uploads/logo/' . $pengaturan['logo']) ?>" alt="Logo Preview" class="h-full w-full object-contain">
                    <?php else: ?>
                        <svg class="h-8 w-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="logo" class="block text-xs font-bold text-gray-400 uppercase mb-1">Unggah Logo Baru</label>
                    <input type="file" name="logo" id="logo" class="text-xs font-semibold text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                    <span class="text-[10px] text-gray-400 block mt-1 font-semibold">Format: PNG, JPG, JPEG. Maks: 2MB.</span>
                </div>
            </div>

            <div>
                <label for="nama_laundry" class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Laundry <span class="text-rose-500">*</span></label>
                <input type="text" name="nama_laundry" id="nama_laundry" value="<?= old('nama_laundry', $pengaturan['nama_laundry'] ?? '') ?>" class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all" required>
            </div>

            <div>
                <label for="whatsapp" class="block text-sm font-semibold text-gray-700 mb-1.5">Nomor WhatsApp / HP <span class="text-rose-500">*</span></label>
                <input type="text" name="whatsapp" id="whatsapp" value="<?= old('whatsapp', $pengaturan['whatsapp'] ?? '') ?>" class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all" required>
            </div>

            <div>
                <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Lengkap <span class="text-rose-500">*</span></label>
                <textarea name="alamat" id="alamat" rows="4" class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all" required><?= old('alamat', $pengaturan['alamat'] ?? '') ?></textarea>
            </div>

            <div class="pt-4 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl shadow-md shadow-blue-100 hover:shadow-none transition-all text-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <!-- Panel 2: Akun Pengguna / Password -->
    <div class="bg-white rounded-2xl border border-gray-150 shadow-sm overflow-hidden h-fit">
        <div class="px-6 py-5 border-b border-gray-100">
            <h3 class="text-base font-bold text-gray-800">Akun Pengguna</h3>
        </div>

        <form action="<?= base_url('pengaturan/updatePassword') ?>" method="POST" class="p-6 space-y-5">
            <?= csrf_field() ?>

            <div>
                <label for="username" class="block text-sm font-semibold text-gray-700 mb-1.5">Username <span class="text-rose-500">*</span></label>
                <input type="text" name="username" id="username" value="<?= old('username', session()->get('username')) ?>" class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all" required>
            </div>

            <div>
                <label for="password_baru" class="block text-sm font-semibold text-gray-700 mb-1.5">Password Baru <span class="text-xs font-semibold text-gray-400">(Kosongkan jika tidak ingin diubah)</span></label>
                <input type="password" name="password_baru" id="password_baru" placeholder="Masukkan password baru" class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all">
            </div>

            <div>
                <label for="confirm_password" class="block text-sm font-semibold text-gray-700 mb-1.5">Konfirmasi Password Baru</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Ulangi password baru" class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all">
            </div>

            <div class="pt-4 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl shadow-md shadow-blue-100 hover:shadow-none transition-all text-sm">
                    Perbarui Akun
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
