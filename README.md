# Laundry Management System (LMS)

LMS (Laundry Management System) adalah aplikasi dashboard internal berbasis web yang dirancang untuk memudahkan pengelolaan operasional bisnis laundry secara terpusat.

## Fitur Utama
1. **Dashboard**: Ringkasan statistik (Pelanggan, Layanan, Transaksi, Pendapatan Hari Ini), aktivitas transaksi terbaru, serta grafik pendapatan 7 hari terakhir secara visual menggunakan Chart.js.
2. **Kelola Pelanggan**: Pencatatan data pelanggan laundry lengkap dengan nama, nomor kontak, alamat, serta pencarian & paginasi data (mendukung soft deletes).
3. **Layanan Laundry**: Konfigurasi jenis layanan (Cuci Kering, Cuci Setrika, dll) beserta harga per kg, estimasi pengerjaan, dan status aktif/nonaktif.
4. **Transaksi Laundry**: Pencatatan order laundry masuk, kalkulasi biaya otomatis, pembuatan nomor invoice unik (`INV-YYYYMMDD-XXXX`), estimasi tanggal selesai otomatis, pencatatan catatan khusus, serta pembaruan status transaksi secara langsung.
5. **Laporan & Pendapatan**: Filter data transaksi berdasarkan periode waktu tertentu (Hari Ini, Minggu Ini, Bulan Ini, Kustom), ringkasan metrik keuangan, serta fitur ekspor laporan ke dalam format **Excel/CSV** dan unduhan **PDF** yang diproses menggunakan library **DOMPDF**.
6. **Kelola User**: Manajemen data pengguna internal (tambah, ubah password opsional, pencarian, dan hapus user) dengan keamanan anti-self-delete.
7. **Pengaturan**: Modifikasi profil laundry (nama toko, WhatsApp, alamat, logo) serta pembaruan profil pengguna & password.

---

## Teknologi
- **Backend**: PHP 8.2+ & CodeIgniter 4 (MVC)
- **Database**: MySQL 8+
- **Frontend**: Tailwind CSS & Google Fonts "Baloo 2"
- **Ekspor Dokumen**: DOMPDF & Native CSV Generator
- **Autentikasi & Keamanan**: Session Auth Filter, Password Hashing, dan CSRF Protection

---

## Cara Instalasi & Menjalankan Proyek

### 1. Buat Database
Buat database baru bernama `laundry_db` pada MySQL server Anda:
```sql
CREATE DATABASE laundry_db;
```

### 2. Konfigurasi Lingkungan
Pastikan berkas `.env` sudah terbuat di direktori root proyek. Konfigurasikan detail database Anda di dalamnya:
```ini
database.default.hostname = localhost
database.default.database = laundry_db
database.default.username = root
database.default.password = root   # Sesuaikan dengan password database lokal Anda
```

### 3. Jalankan Migrasi & Database Seeder
Lakukan inisialisasi tabel-tabel database beserta data dummy awal (admin default, data pelanggan, jenis layanan, dan riwayat transaksi 7 hari terakhir):
```bash
php spark migrate:refresh && php spark db:seed DatabaseSeeder
```

### 4. Jalankan Server Lokal
Jalankan server pengembangan bawaan CodeIgniter:
```bash
php spark serve
```
Aplikasi sekarang dapat diakses melalui browser Anda di: **`http://localhost:8080`**

---

## Kredensial Login Default
Gunakan akun bawaan hasil seeding untuk masuk ke sistem dashboard:
- **Username**: `admin`
- **Password**: `admin123`
