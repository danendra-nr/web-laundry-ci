<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="bg-white rounded-2xl border border-gray-150 shadow-sm overflow-hidden mb-6">
    <!-- Header/Filter Area -->
    <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <!-- Search Form -->
        <form action="<?= base_url('user') ?>" method="GET" class="w-full sm:max-w-xs flex gap-2">
            <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Cari username..." class="w-full px-4 py-2 text-sm font-medium border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all">
            <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl text-sm font-bold transition-all">Cari</button>
        </form>

        <!-- Add Button -->
        <a href="<?= base_url('user/create') ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-xl shadow-md shadow-blue-100 hover:shadow-none transition-all text-sm flex items-center justify-center gap-2 self-start sm:self-auto">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Tambah User
        </a>
    </div>

    <!-- Responsive Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-400 text-xs font-bold uppercase border-b border-gray-100">
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Username</th>
                    <th class="px-6 py-3">Role</th>
                    <th class="px-6 py-3">Pelanggan Terkait</th>
                    <th class="px-6 py-3">Dibuat Pada</th>
                    <th class="px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm font-semibold text-gray-700">
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-400 font-medium">Data user tidak ditemukan.</td>
                    </tr>
                <?php else: ?>
                    <?php
                        $page = isset($_GET['page_user']) ? (int)$_GET['page_user'] : 1;
                        $no = ($page - 1) * 10 + 1;
                    ?>
                    <?php foreach ($users as $u): ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-400 font-bold"><?= $no++ ?></td>
                            <td class="px-6 py-4 font-bold text-gray-900">
                                <div class="flex items-center gap-2">
                                    <?= htmlspecialchars($u['username']) ?>
                                    <?php if ($u['id'] == session()->get('id')): ?>
                                        <span class="px-2 py-0.5 rounded bg-blue-100 text-blue-800 text-[10px] font-bold">Aktif (Anda)</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <?php if (($u['role'] ?? 'admin') === 'admin'): ?>
                                    <span class="px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-bold border border-blue-100">Admin</span>
                                <?php else: ?>
                                    <span class="px-2.5 py-1 rounded-full bg-slate-50 text-slate-700 text-xs font-bold border border-slate-200">Pelanggan</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                <?= htmlspecialchars($u['nama_pelanggan'] ?? '-') ?>
                            </td>
                            <td class="px-6 py-4"><?= date('d-m-Y H:i:s', strtotime($u['created_at'])) ?></td>
                            <td class="px-6 py-4 text-right flex items-center justify-end gap-2">
                                <a href="<?= base_url('user/edit/' . $u['id']) ?>" class="p-2 text-blue-600 hover:bg-blue-50 rounded-xl transition-all" title="Edit">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                </a>
                                <?php if ($u['id'] != session()->get('id')): ?>
                                    <form action="<?= base_url('user/delete/' . $u['id']) ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')" class="inline">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="p-2 text-rose-600 hover:bg-rose-50 rounded-xl transition-all" title="Hapus">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination Footer -->
    <?php if (!empty($users)): ?>
        <div class="px-6 border-t border-gray-100">
            <?= $pager->links('user', 'tailwind_full') ?>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
