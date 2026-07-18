KChuu - Sistem Manajemen Penjualan

KChuu merupakan aplikasi berbasis web yang dikembangkan untuk membantu pengelolaan data produk, customer, serta transaksi penjualan dalam satu sistem terintegrasi. Aplikasi ini dibangun menggunakan framework Laravel dengan antarmuka responsif sehingga memudahkan proses administrasi dan monitoring data.

Backend
- PHP 8.3+
- Laravel 13

Frontend
- Blade Template
- Bootstrap 5
- HTML5
- CSS3
- JavaScript

Database
- MySQL

Development Tools
- Composer
- Node.js
- NPM
- Vite
- Git
- GitHub / GitLab
- Visual Studio Code

AI Recommendation
Project ini tidak menggunakan layanan AI maupun API OpenAI.

API
Project menggunakan Laravel Internal API (Request, Response, Validation, Eloquent ORM) tanpa integrasi API eksternal.

Aplikasi menerapkan pola arsitektur MVC (Model-View-Controller) yang disediakan oleh Laravel.
- **Model** bertanggung jawab terhadap pengelolaan data pada database.
- **View** menggunakan Blade Template untuk menampilkan antarmuka pengguna.
- **Controller** menangani proses bisnis dan komunikasi antara View dengan Model.


# Flow Aplikasi
1. Login
Pengguna melakukan login ke dalam sistem menggunakan akun yang telah terdaftar.
2. Dashboard
Setelah berhasil login, pengguna diarahkan menuju dashboard yang menampilkan ringkasan informasi aplikasi.
3. Manajemen Produk

Pengguna dapat:
- Melihat daftar produk
- Menambahkan produk
- Mengubah data produk
- Menghapus produk

4. Manajemen Customer
Pengguna dapat:
- Melihat daftar customer
- Menambahkan customer
- Mengubah data customer
- Menghapus data customer

5. Transaksi Penjualan
Pengguna dapat:
- Membuat transaksi baru
- Memilih customer
- Memilih beberapa produk
- Menghitung total pembayaran secara otomatis
- Menyimpan transaksi

6. Riwayat Transaksi
Pengguna dapat melihat seluruh data transaksi yang telah tersimpan sebagai laporan penjualan.

Fitur Utama
- Authentication (Login)
- Dashboard
- CRUD Produk
- CRUD Customer
- CRUD Transaksi Penjualan
- Upload Gambar Produk
- Perhitungan Total Transaksi Otomatis
- Validasi Form
- Responsive User Interface

Struktur Folder
app/
├── Http/
│   ├── Controllers/
│   └── Requests/
├── Models/

resources/
├── views/
│   ├── products/
│   ├── customers/
│   ├── transactions/
│   └── layouts/

routes/
└── web.php

database/
├── migrations/
└── seeders/

Cara Menjalankan Project
Clone repository
bash
git clone <repository-url>

Masuk ke folder project

bash
cd kchuu

Install dependency PHP

bash
composer install


Install dependency JavaScript

bash
npm install

Copy file environment

bash
cp .env.example .env

Generate application key

bash
php artisan key:generate

Konfigurasikan koneksi database pada file `.env`.
Jalankan migrasi database
bash
php artisan migrate


Jalankan server Laravel
bash
php artisan serve

Jalankan Vite
bash
npm run dev

Database
Aplikasi menggunakan database **MySQL**.

Pengujian dilakukan dengan memastikan seluruh fitur utama berjalan dengan baik, meliputi:
- Login
- CRUD Produk
- CRUD Customer
- CRUD Transaksi
- Validasi Form
- Upload Gambar
- Perhitungan Total Transaksi

Seluruh fitur telah diuji sebelum proses deployment dan pengumpulan.
Repository menggunakan Git sebagai version control.


Author
Dikembangkan sebagai tugas mata kuliah **Pemrograman Web Lanjut** oleh Nanda Rahayu Widiyanti
