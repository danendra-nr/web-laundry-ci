<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="max-w-2xl bg-white rounded-2xl border border-gray-150 shadow-sm overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
        <h3 class="text-base font-bold text-gray-800">Edit User</h3>
        <a href="<?= base_url('user') ?>" class="text-xs font-bold text-gray-500 hover:text-gray-700 flex items-center gap-1">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Kembali
        </a>
    </div>

    <form action="<?= base_url('user/update/' . $user['id']) ?>" method="POST" class="p-6 space-y-5">
        <?= csrf_field() ?>

        <div>
            <label for="username" class="block text-sm font-semibold text-gray-700 mb-1.5">Username <span class="text-rose-500">*</span></label>
            <input type="text" name="username" id="username" value="<?= old('username', $user['username']) ?>" placeholder="Masukkan username" class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all" required>
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password Baru <span class="text-xs font-semibold text-gray-400">(Kosongkan jika tidak ingin diubah)</span></label>
            <input type="password" name="password" id="password" placeholder="Masukkan password baru" class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all">
        </div>

        <div>
            <label for="confirm_password" class="block text-sm font-semibold text-gray-700 mb-1.5">Konfirmasi Password Baru</label>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Konfirmasi password baru" class="w-full px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all">
        </div>

        <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
            <a href="<?= base_url('user') ?>" class="px-4 py-2.5 rounded-xl border border-gray-200 text-sm font-bold text-gray-600 hover:bg-gray-50 transition-all">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl shadow-md shadow-blue-100 hover:shadow-none transition-all text-sm">Update</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
