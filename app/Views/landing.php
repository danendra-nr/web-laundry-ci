<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($pengaturan['nama_laundry'] ?? 'Laundry Management System') ?> - Jasa Laundry Profesional</title>
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
                        accent: '#F3F4F6',
                        dark: '#1F2937',
                    },
                    fontFamily: {
                        baloo: ['"Baloo 2"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Baloo 2', sans-serif;
        }
        .bubble {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-15px) scale(1.05); }
        }
    </style>
</head>
<body class="bg-slate-50 text-gray-800 antialiased overflow-x-hidden">
<?php
    $whatsappNumber = preg_replace('/[^0-9]/', '', $pengaturan['whatsapp'] ?? '');
    if (!empty($whatsappNumber) && strpos($whatsappNumber, '0') === 0) {
        $whatsappNumber = '62' . substr($whatsappNumber, 1);
    }
    $waLink = !empty($whatsappNumber) ? 'https://wa.me/' . $whatsappNumber . '?text=Halo%20' . urlencode($pengaturan['nama_laundry'] ?? 'Laundry') . ',%20saya%20ingin%20memesan%20layanan%20laundry.' : '#contact';
?>

    <!-- Header Navbar -->
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="#" class="flex items-center gap-3 group">
                <?php if (!empty($pengaturan['logo']) && file_exists(FCPATH . 'uploads/logo/' . $pengaturan['logo'])): ?>
                    <img src="<?= base_url('uploads/logo/' . $pengaturan['logo']) ?>" alt="Logo" class="h-10 w-10 object-contain group-hover:scale-110 transition-transform">
                <?php else: ?>
                    <div class="h-10 w-10 rounded-2xl bg-blue-600 flex items-center justify-center text-white font-extrabold text-xl shadow-lg shadow-blue-200 group-hover:rotate-12 transition-all">
                        L
                    </div>
                <?php endif; ?>
                <span class="font-extrabold text-2xl text-blue-600 tracking-tight">
                    <?= esc($pengaturan['nama_laundry'] ?? 'Laras Laundry') ?>
                </span>
            </a>

            <!-- Desktop Nav Links -->
            <nav class="hidden md:flex items-center gap-8">
                <a href="#features" class="font-semibold text-gray-600 hover:text-blue-600 transition-colors">Keunggulan</a>
                <a href="#services" class="font-semibold text-gray-600 hover:text-blue-600 transition-colors">Layanan & Harga</a>
                <a href="#how-it-works" class="font-semibold text-gray-600 hover:text-blue-600 transition-colors">Cara Kerja</a>
                <a href="#contact" class="font-semibold text-gray-600 hover:text-blue-600 transition-colors">Hubungi Kami</a>
            </nav>

            <!-- Action Buttons -->
            <div class="flex items-center gap-4">
                <?php if (session()->get('isLoggedIn')): ?>
                    <?php
                        $dashboardUrl = session()->get('role') === 'pelanggan' ? base_url('customer/dashboard') : base_url('dashboard');
                    ?>
                    <a href="<?= $dashboardUrl ?>" class="bg-blue-50 hover:bg-blue-100 text-blue-600 font-bold py-2.5 px-6 rounded-2xl transition-all text-sm flex items-center gap-2 border border-blue-100">
                        Dashboard
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </a>
                <?php else: ?>
                    <a href="<?= base_url('login') ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-6 rounded-2xl shadow-lg shadow-blue-200 hover:shadow-none transition-all text-sm flex items-center gap-2">
                        Masuk
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative min-h-[calc(100vh-80px)] flex items-center bg-gradient-to-br from-blue-50 via-white to-blue-50 py-16 overflow-hidden">
        <!-- Floating Bubbles (Decorative) -->
        <div class="absolute top-20 left-10 w-24 h-24 rounded-full bg-blue-100/40 blur-lg bubble" style="animation-delay: 0s;"></div>
        <div class="absolute bottom-20 right-10 w-32 h-32 rounded-full bg-blue-200/30 blur-lg bubble" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/3 right-1/4 w-20 h-20 rounded-full bg-indigo-100/50 blur-lg bubble" style="animation-delay: 4s;"></div>

        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10">
            <!-- Left Text Content -->
            <div class="space-y-6 text-center lg:text-left">
                <span class="inline-flex items-center gap-2 bg-blue-50 text-blue-600 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider">
                    ✨ Solusi Laundry Cerdas & Higienis
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 leading-tight">
                    Pakaian <span class="text-blue-600 underline decoration-wavy decoration-blue-300">Bersih, Wangi</span>, & Rapi Tanpa Ribet!
                </h1>
                <p class="text-gray-600 text-lg md:text-xl font-medium max-w-xl mx-auto lg:mx-0">
                    Nikmati kemudahan layanan laundry profesional. Pesan online dengan pilihan pengiriman fleksibel: Kirim Sendiri, Jemput Saja, Antar Saja, atau Jemput & Antar sesuai kebutuhan Anda!
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <a href="#services" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-2xl shadow-xl shadow-blue-200 hover:shadow-none hover:-translate-y-0.5 transition-all text-base flex items-center justify-center gap-2">
                        Pesan Sekarang
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                    </a>
                    <a href="#contact" class="w-full sm:w-auto bg-white hover:bg-gray-100 text-gray-800 border-2 border-gray-200 font-bold py-4 px-8 rounded-2xl transition-all text-base flex items-center justify-center gap-2">
                        Hubungi Kami
                    </a>
                </div>
            </div>

            <!-- Right Interactive Graphic -->
            <div class="relative flex justify-center lg:justify-end">
                <div class="relative w-full max-w-[450px]">
                    <!-- Main image placeholder/vector illustration -->
                    <div class="bg-blue-600/10 rounded-[40px] p-6 border-2 border-blue-100 relative overflow-hidden shadow-2xl backdrop-blur-sm">
                        <!-- Washing machine UI card -->
                        <div class="bg-white rounded-3xl p-6 shadow-xl space-y-4 border border-gray-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                                    </div>
                                    <div>
                                        <h4 class="font-extrabold text-sm text-gray-900">Premium Wash</h4>
                                        <p class="text-xs text-gray-400 font-semibold">Proses sedang berjalan</p>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">Diproses</span>
                            </div>
                            <!-- Progress Bar -->
                            <div class="space-y-1">
                                <div class="flex justify-between text-xs font-bold text-gray-500">
                                    <span>Pencucian & Pengeringan</span>
                                    <span>80%</span>
                                </div>
                                <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                                    <div class="bg-blue-600 h-full w-[80%] rounded-full animate-pulse"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Mini stats cards -->
                        <div class="grid grid-cols-2 gap-4 mt-6">
                            <div class="bg-white rounded-3xl p-4 shadow-lg border border-gray-50 text-center">
                                <div class="text-2xl font-black text-blue-600">Fast</div>
                                <div class="text-xs font-bold text-gray-400 uppercase tracking-wider">Estimasi 1 Hari</div>
                            </div>
                            <div class="bg-white rounded-3xl p-4 shadow-lg border border-gray-50 text-center">
                                <div class="text-2xl font-black text-emerald-500">Clean</div>
                                <div class="text-xs font-bold text-gray-400 uppercase tracking-wider">Higienis & Rapi</div>
                            </div>
                        </div>

                        <!-- Floating decorative tags -->
                        <div class="absolute -top-4 -right-4 bg-yellow-400 text-gray-900 text-xs font-black px-4 py-2 rounded-2xl shadow-lg rotate-12">
                            Diskon 10% Pengguna Baru!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Key Features / Keunggulan -->
    <section id="features" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-4">
                <span class="text-sm font-bold text-blue-600 uppercase tracking-widest bg-blue-50 px-4 py-2 rounded-full">Mengapa Memilih Kami</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">Keunggulan Layanan Laundry Kami</h2>
                <p class="text-gray-500 font-semibold">Kami menjamin kepuasan Anda dengan mengedepankan kualitas dan ketepatan waktu.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1 -->
                <div class="bg-slate-50 hover:bg-white p-8 rounded-3xl border border-gray-100 hover:border-blue-100 hover:shadow-xl transition-all duration-300 group">
                    <div class="h-12 w-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Proses Cepat & Tepat</h3>
                    <p class="text-gray-500 text-sm font-medium">Kami mengutamakan waktu Anda dengan durasi pengerjaan yang cepat dan tepat waktu.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-slate-50 hover:bg-white p-8 rounded-3xl border border-gray-100 hover:border-blue-100 hover:shadow-xl transition-all duration-300 group">
                    <div class="h-12 w-12 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center mb-6 group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Higienis & Bersih</h3>
                    <p class="text-gray-500 text-sm font-medium">Detergen premium dan pencucian terpisah per pelanggan untuk menjaga kebersihan maksimal.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-slate-50 hover:bg-white p-8 rounded-3xl border border-gray-100 hover:border-blue-100 hover:shadow-xl transition-all duration-300 group">
                    <div class="h-12 w-12 rounded-2xl bg-yellow-50 text-yellow-500 flex items-center justify-center mb-6 group-hover:bg-yellow-500 group-hover:text-white transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Harga Bersahabat</h3>
                    <p class="text-gray-500 text-sm font-medium">Harga kiloan maupun satuan yang terjangkau tanpa mengorbankan kualitas cucian Anda.</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-slate-50 hover:bg-white p-8 rounded-3xl border border-gray-100 hover:border-blue-100 hover:shadow-xl transition-all duration-300 group">
                    <div class="h-12 w-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Layanan Antar-Jemput</h3>
                    <p class="text-gray-500 text-sm font-medium">Cukup duduk manis di rumah, kurir kami siap menjemput dan mengantar pakaian kotor Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services & Pricing / Layanan & Daftar Harga -->
    <section id="services" class="py-24 bg-slate-50 border-t border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-4">
                <span class="text-sm font-bold text-blue-600 uppercase tracking-widest bg-blue-50 px-4 py-2 rounded-full">Paket Layanan</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">Layanan Terbaik Untuk Pakaian Anda</h2>
                <p class="text-gray-500 font-semibold">Berbagai jenis kategori laundry yang bisa disesuaikan dengan kebutuhan harian Anda.</p>
            </div>

            <!-- Pricing Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if (!empty($layanan)): ?>
                    <?php foreach ($layanan as $l): ?>
                        <div class="bg-white rounded-[32px] p-8 border border-gray-100 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between relative overflow-hidden group">
                            <!-- Background accent wave -->
                            <div class="absolute -top-12 -right-12 h-28 w-28 bg-blue-50 rounded-full group-hover:scale-150 transition-transform duration-500 -z-0"></div>

                            <div class="relative z-10 space-y-6">
                                <!-- Service Header -->
                                <div class="flex justify-between items-start">
                                    <div>
                                        <span class="text-xs font-extrabold text-blue-600 uppercase bg-blue-50 px-3 py-1.5 rounded-xl tracking-wider">
                                            <?= esc($l['kode_layanan']) ?>
                                        </span>
                                        <h3 class="text-2xl font-black text-gray-900 mt-3"><?= esc($l['nama_layanan']) ?></h3>
                                    </div>
                                    <div class="h-10 w-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                                    </div>
                                </div>

                                <!-- Pricing -->
                                <div class="border-t border-b border-gray-100 py-4 flex items-baseline gap-1">
                                    <span class="text-3xl font-extrabold text-gray-900">Rp <?= number_format($l['harga_per_kg'], 0, ',', '.') ?></span>
                                    <span class="text-gray-400 font-bold text-sm">/ Kg</span>
                                </div>

                                <!-- Features list -->
                                <ul class="space-y-3 text-sm text-gray-500 font-semibold">
                                    <li class="flex items-center gap-2">
                                        <svg class="h-4 w-4 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                        Estimasi Selesai: <?= esc($l['estimasi_hari']) ?> Hari
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <svg class="h-4 w-4 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                        Pencucian Higienis (1 Mesin 1 Pelanggan)
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <svg class="h-4 w-4 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                        Setrika Rapi & Parfum Premium
                                    </li>
                                </ul>
                            </div>

                            <div class="relative z-10 pt-6">
                                <?php
                                    $pesanLink = session()->get('isLoggedIn') ? base_url('customer/pesan') : base_url('login');
                                ?>
                                <a href="<?= $pesanLink ?>" class="w-full bg-slate-100 hover:bg-blue-600 hover:text-white text-gray-700 font-bold py-3.5 px-4 rounded-2xl transition-all duration-300 text-sm flex items-center justify-center gap-2">
                                    Pesan Sekarang
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Default fallback services if db is empty -->
                    <div class="bg-white rounded-[32px] p-8 border border-gray-100 shadow-md flex flex-col justify-between">
                        <div class="space-y-6">
                            <span class="text-xs font-extrabold text-blue-600 uppercase bg-blue-50 px-3 py-1.5 rounded-xl">REG</span>
                            <h3 class="text-2xl font-black text-gray-900 mt-3">Cuci Kering Setrika</h3>
                            <div class="border-t border-b border-gray-100 py-4 flex items-baseline gap-1">
                                <span class="text-3xl font-extrabold text-gray-900">Rp 7.000</span>
                                <span class="text-gray-400 font-bold text-sm">/ Kg</span>
                            </div>
                            <ul class="space-y-3 text-sm text-gray-500 font-semibold">
                                <li class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-blue-600"></span>Estimasi 2 Hari</li>
                                <li class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-blue-600"></span>Bersih & Rapi</li>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- How It Works / Alur Pemesanan -->
    <section id="how-it-works" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-4">
                <span class="text-sm font-bold text-blue-600 uppercase tracking-widest bg-blue-50 px-4 py-2 rounded-full">Cara Kerja</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">Alur Layanan Laundry Kami</h2>
                <p class="text-gray-500 font-semibold">Hanya perlu 4 langkah mudah untuk pakaian bersih maksimal.</p>
            </div>

            <!-- Workflow Steps -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 relative">
                <!-- Step 1 -->
                <div class="text-center space-y-4 relative">
                    <div class="h-16 w-16 rounded-3xl bg-blue-50 text-blue-600 font-black text-2xl flex items-center justify-center mx-auto shadow-sm">
                        1
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Pesan Online</h3>
                    <p class="text-gray-500 text-sm font-medium px-4">Masuk/daftar akun lalu buat pesanan dengan memilih jenis layanan & opsi kurir.</p>
                </div>

                <!-- Step 2 -->
                <div class="text-center space-y-4 relative">
                    <div class="h-16 w-16 rounded-3xl bg-blue-50 text-blue-600 font-black text-2xl flex items-center justify-center mx-auto shadow-sm">
                        2
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Penjemputan / Kirim</h3>
                    <p class="text-gray-500 text-sm font-medium px-4">Bisa kirim pakaian sendiri ke laundry atau kurir kami yang menjemput (sesuai opsi).</p>
                </div>

                <!-- Step 3 -->
                <div class="text-center space-y-4 relative">
                    <div class="h-16 w-16 rounded-3xl bg-blue-50 text-blue-600 font-black text-2xl flex items-center justify-center mx-auto shadow-sm">
                        3
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Proses Cuci & Setrika</h3>
                    <p class="text-gray-500 text-sm font-medium px-4">Pakaian dipilah, dicuci secara higienis, disetrika dengan rapi, dan diberi keharuman segar.</p>
                </div>

                <!-- Step 4 -->
                <div class="text-center space-y-4 relative">
                    <div class="h-16 w-16 rounded-3xl bg-blue-600 text-white font-black text-2xl flex items-center justify-center mx-auto shadow-md">
                        4
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Antar / Ambil</h3>
                    <p class="text-gray-500 text-sm font-medium px-4">Pakaian bersih siap diantar kurir ke rumah Anda atau diambil sendiri sesuai kebutuhan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact & Map / Hubungi Kami -->
    <section id="contact" class="py-24 bg-slate-900 text-white relative overflow-hidden">
        <!-- Background light effects -->
        <div class="absolute top-1/4 left-1/4 w-96 h-96 rounded-full bg-blue-600/10 blur-3xl"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 rounded-full bg-indigo-600/10 blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Left Info -->
            <div class="space-y-8">
                <div class="space-y-4">
                    <span class="text-sm font-bold text-blue-400 uppercase tracking-widest bg-blue-900/40 px-4 py-2 rounded-full border border-blue-800/40">Hubungi Kami</span>
                    <h2 class="text-3xl md:text-5xl font-black">Pesan Sekarang atau Kunjungi Kami</h2>
                    <p class="text-gray-400 font-medium">Ada pertanyaan mengenai estimasi pengerjaan, noda membandel, atau layanan antar-jemput? Hubungi tim kami sekarang juga.</p>
                </div>

                <!-- Contact items -->
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="h-12 w-12 rounded-2xl bg-blue-600/20 text-blue-400 flex items-center justify-center border border-blue-500/20 flex-shrink-0">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </div>
                        <div>
                            <h4 class="font-extrabold text-lg text-gray-200">Alamat Workshop</h4>
                            <p class="text-gray-400 text-sm font-medium mt-1 leading-relaxed">
                                <?= esc($pengaturan['alamat'] ?? 'Jl. Pemuda No. 123, Kota Malang') ?>
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="h-12 w-12 rounded-2xl bg-emerald-600/20 text-emerald-400 flex items-center justify-center border border-emerald-500/20 flex-shrink-0">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                        </div>
                        <div>
                            <h4 class="font-extrabold text-lg text-gray-200">WhatsApp Admin</h4>
                            <p class="text-gray-400 text-sm font-medium mt-1 leading-relaxed">
                                <?= esc($pengaturan['whatsapp'] ?? '+62 812-3456-7890') ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div>
                    <a href="<?= $waLink ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-3 bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-2xl shadow-xl shadow-blue-900/30 transition-all text-base">
                        Hubungi Melalui WhatsApp
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                    </a>
                </div>
            </div>

            <!-- Right Visual / Contact Form Simulation or Map placeholder -->
            <div class="bg-slate-800/80 border border-slate-700/60 rounded-[40px] p-8 shadow-2xl space-y-6">
                <h3 class="text-2xl font-black text-gray-100">Kirim Pertanyaan Cepat</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Nama Lengkap</label>
                        <input type="text" placeholder="Masukkan nama Anda" class="w-full bg-slate-900 border border-slate-700 rounded-2xl px-4 py-3 text-sm text-gray-200 focus:outline-none focus:border-blue-500 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Pesan</label>
                        <textarea rows="4" placeholder="Tuliskan pesan atau pertanyaan Anda di sini..." class="w-full bg-slate-900 border border-slate-700 rounded-2xl px-4 py-3 text-sm text-gray-200 focus:outline-none focus:border-blue-500 transition-colors"></textarea>
                    </div>
                    <button type="button" onclick="window.open('<?= $waLink ?>', '_blank')" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-4 rounded-2xl shadow-lg transition-all text-sm flex items-center justify-center gap-2">
                        Kirim via WhatsApp
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-950 text-gray-500 text-sm font-semibold border-t border-slate-900 py-8">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                &copy; <?= date('Y') ?> <?= esc($pengaturan['nama_laundry'] ?? 'Laras Laundry') ?>. All rights reserved.
            </div>
            <div class="flex items-center gap-6">
                <a href="<?= base_url('login') ?>" class="hover:text-blue-500 transition-colors">Login Sistem</a>
                <a href="#features" class="hover:text-blue-500 transition-colors">Tentang Kami</a>
            </div>
        </div>
    </footer>

</body>
</html>
