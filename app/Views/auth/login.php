<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Laundry Management System</title>
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

    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="p-8">
            <!-- Back to Home -->
            <div class="mb-6">
                <a href="<?= base_url('/') ?>" class="text-xs font-bold text-gray-500 hover:text-blue-600 transition-colors flex items-center gap-1.5">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Kembali ke Beranda
                </a>
            </div>

            <!-- Header -->
            <div class="text-center mb-8">
                <div class="h-14 w-14 rounded-2xl bg-blue-600 flex items-center justify-center text-white font-extrabold text-2xl mx-auto mb-4 shadow-lg shadow-blue-200">L</div>
                <h2 class="text-2xl font-extrabold text-gray-900">Selamat Datang</h2>
                <p class="text-gray-500 text-sm mt-1">Silakan masuk ke akun Laundry Management System</p>
            </div>

            <!-- Flash alerts -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl flex items-center gap-3">
                    <svg class="h-5 w-5 text-emerald-500 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                    <span class="font-medium text-sm"><?= session()->getFlashdata('success') ?></span>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-xl flex items-center gap-3">
                    <svg class="h-5 w-5 text-rose-500 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                    <span class="font-medium text-sm"><?= session()->getFlashdata('error') ?></span>
                </div>
            <?php endif; ?>

            <!-- Form -->
            <form action="<?= base_url('login') ?>" method="POST" class="space-y-5">
                <?= csrf_field() ?>

                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-1.5">Username</label>
                    <input type="text" name="username" id="username" value="<?= old('username') ?>" placeholder="Masukkan username" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none text-sm font-medium" required>
                    <?php if (isset(session()->getFlashdata('errors')['username'])): ?>
                        <p class="text-rose-500 text-xs mt-1 font-semibold"><?= session()->getFlashdata('errors')['username'] ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                    <input type="password" name="password" id="password" placeholder="Masukkan password" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none text-sm font-medium" required>
                    <?php if (isset(session()->getFlashdata('errors')['password'])): ?>
                        <p class="text-rose-500 text-xs mt-1 font-semibold"><?= session()->getFlashdata('errors')['password'] ?></p>
                    <?php endif; ?>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-blue-200 hover:shadow-none transition-all text-sm flex items-center justify-center gap-2">
                    Masuk
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                </button>
            </form>
            
            <div class="text-center mt-6 text-sm">
                <span class="text-gray-500 font-semibold">Belum punya akun?</span>
                <a href="<?= base_url('register') ?>" class="text-blue-600 hover:underline font-bold ml-1">Daftar Pelanggan</a>
            </div>
        </div>

        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 text-center text-xs text-gray-400 font-semibold">
            &copy; <?= date('Y') ?> Laundry Management System. All rights reserved.
        </div>
    </div>

</body>
</html>
