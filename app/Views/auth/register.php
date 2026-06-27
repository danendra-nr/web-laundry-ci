<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggan - Laundry Management System</title>
    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts Baloo 2 -->
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563EB',
                        secondary: '#60A5FA',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Baloo 2', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-lg bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="h-14 w-14 rounded-2xl bg-blue-600 flex items-center justify-center text-white font-extrabold text-2xl mx-auto mb-4 shadow-lg shadow-blue-200">L</div>
                <h2 class="text-2xl font-extrabold text-gray-900">Daftar Akun Baru</h2>
                <p class="text-gray-500 text-sm mt-1">Daftar untuk melakukan pesanan laundry jarak jauh & layanan antar-jemput</p>
            </div>

            <!-- Flash alerts -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-xl flex items-center gap-3">
                    <svg class="h-5 w-5 text-rose-500 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                    <span class="font-medium text-sm"><?= session()->getFlashdata('error') ?></span>
                </div>
            <?php endif; ?>

            <!-- Form -->
            <form action="<?= base_url('register') ?>" method="POST" class="space-y-4">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="username" class="block text-sm font-semibold text-gray-700 mb-1.5">Username</label>
                        <input type="text" name="username" id="username" value="<?= old('username') ?>" placeholder="Username" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none text-sm font-medium" required>
                        <?php if (isset(session()->getFlashdata('errors')['username'])): ?>
                            <p class="text-rose-500 text-xs mt-1 font-semibold"><?= session()->getFlashdata('errors')['username'] ?></p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="nama" class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" value="<?= old('nama') ?>" placeholder="Nama Lengkap" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none text-sm font-medium" required>
                        <?php if (isset(session()->getFlashdata('errors')['nama'])): ?>
                            <p class="text-rose-500 text-xs mt-1 font-semibold"><?= session()->getFlashdata('errors')['nama'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                        <input type="password" name="password" id="password" placeholder="Min. 6 karakter" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none text-sm font-medium" required>
                        <?php if (isset(session()->getFlashdata('errors')['password'])): ?>
                            <p class="text-rose-500 text-xs mt-1 font-semibold"><?= session()->getFlashdata('errors')['password'] ?></p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="confirm_password" class="block text-sm font-semibold text-gray-700 mb-1.5">Konfirmasi Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Ulangi password" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none text-sm font-medium" required>
                        <?php if (isset(session()->getFlashdata('errors')['confirm_password'])): ?>
                            <p class="text-rose-500 text-xs mt-1 font-semibold"><?= session()->getFlashdata('errors')['confirm_password'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div>
                    <label for="no_hp" class="block text-sm font-semibold text-gray-700 mb-1.5">Nomor WhatsApp / HP</label>
                    <input type="text" name="no_hp" id="no_hp" value="<?= old('no_hp') ?>" placeholder="Contoh: 081234567890" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none text-sm font-medium" required>
                    <?php if (isset(session()->getFlashdata('errors')['no_hp'])): ?>
                        <p class="text-rose-500 text-xs mt-1 font-semibold"><?= session()->getFlashdata('errors')['no_hp'] ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Lengkap (Untuk Antar-Jemput)</label>
                    <textarea name="alamat" id="alamat" rows="3" placeholder="Masukkan alamat lengkap penjemputan/pengantaran" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none text-sm font-medium" required><?= old('alamat') ?></textarea>
                    <?php if (isset(session()->getFlashdata('errors')['alamat'])): ?>
                        <p class="text-rose-500 text-xs mt-1 font-semibold"><?= session()->getFlashdata('errors')['alamat'] ?></p>
                    <?php endif; ?>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-blue-200 hover:shadow-none transition-all text-sm flex items-center justify-center gap-2">
                    Daftar Sekarang
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                </button>
            </form>

            <div class="text-center mt-6 text-sm">
                <span class="text-gray-500">Sudah memiliki akun?</span>
                <a href="<?= base_url('login') ?>" class="text-blue-600 hover:underline font-bold ml-1">Masuk</a>
            </div>
        </div>

        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 text-center text-xs text-gray-400 font-semibold">
            &copy; <?= date('Y') ?> Laundry Management System. All rights reserved.
        </div>
    </div>

</body>
</html>
