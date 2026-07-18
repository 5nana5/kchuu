KChuu Bakery Management System
Deskripsi

KChuu Bakery Management System merupakan aplikasi berbasis web yang dikembangkan menggunakan Laravel untuk membantu proses pengelolaan data produk, kategori, stok, dan transaksi penjualan pada toko roti. Sistem ini menyediakan dashboard yang menampilkan ringkasan informasi bisnis sehingga memudahkan administrator dalam memantau aktivitas penjualan.

Fitur Utama
Dashboard Admin
Total Produk
Total Stok
Total Transaksi Penjualan
Total Pendapatan
Insight produk terlaris
Insight stok terendah
Rekomendasi restock
Grafik produk per kategori
Grafik persentase stok produk
Jam dan tanggal secara real-time
Manajemen Kategori
Menambah kategori
Mengubah kategori
Menghapus kategori
Melihat daftar kategori
Manajemen Produk
Menambah produk
Mengubah produk
Menghapus produk
Upload gambar produk
Pengelolaan stok
Transaksi Penjualan
Mencatat transaksi penjualan
Perhitungan total otomatis
Merchant Code
Riwayat transaksi
Laporan
Export transaksi ke Excel
Export transaksi ke PDF
Authentication
Login
Register
Profile
Logout
Teknologi yang Digunakan
PHP 8.x
Laravel 13
Bootstrap 5
MySQL
Chart.js
Laravel Breeze
Instalasi

Clone repository

git clone <repository-url>

Masuk ke folder project

cd kchuu

Install dependency

composer install
npm install

Salin file environment

cp .env.example .env

Generate application key

php artisan key:generate

Konfigurasi database pada file .env

Kemudian jalankan migrasi database

php artisan migrate

Jalankan server

php artisan serve

Compile asset

npm run dev
Struktur Menu
Dashboard
Kategori
Produk
Transaksi Penjualan
Transaksi Stok
Profile
Screenshot

Tambahkan screenshot aplikasi pada bagian ini.

Dashboard
Halaman Produk
Halaman Kategori
Halaman Transaksi Penjualan
Dashboard Analytics
Pengembang

Nanda Rahayu Widiyanti

Program Studi Teknik Informatika
Universitas Dian Nusantara

Lisensi

Project ini dibuat sebagai tugas mata kuliah Pemrograman Web Lanjut dan digunakan untuk keperluan akademik.
Project ini dibuat untuk memenuhi tugas mata kuliah Pemrograman Web Lanjut yang diampu oleh dosen saya, Muchamad Sandy, S.Kom., M.M.SI,.
