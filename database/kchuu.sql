-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Bulan Mei 2026 pada 03.54
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kchuu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Breads', '2026-05-15 05:57:20', '2026-05-15 05:59:26'),
(4, 'Cakes', '2026-05-15 05:57:59', '2026-05-15 05:57:59'),
(5, 'Biscuits/Cookies', '2026-05-15 05:58:27', '2026-05-15 15:56:21'),
(8, 'Viennoiseries', '2026-05-15 15:54:52', '2026-05-15 15:55:14'),
(9, 'Pâte à Choux', '2026-05-15 16:33:26', '2026-05-15 16:33:26'),
(10, 'Shortcrust Pastry', '2026-05-15 16:33:44', '2026-05-15 16:33:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_15_044650_create_kategoris_table', 1),
(5, '2026_05_15_070924_create_produks_table', 1),
(6, '2026_05_15_120000_add_role_to_users_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produks`
--

CREATE TABLE `produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `gambar_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produks`
--

INSERT INTO `produks` (`id`, `kategori_id`, `nama_produk`, `harga`, `stok`, `deskripsi`, `gambar`, `gambar_link`, `created_at`, `updated_at`) VALUES
(2, 5, 'Chocochip Cookies', 32500, 12, 'Chrunchy & Sweet', 'produk/2WlzPAjqNbuGJB84CUKA1NJ9gTqWPYjSix4pavX6.jpg', NULL, '2026-05-15 06:03:16', '2026-05-15 15:58:02'),
(3, 4, 'Muffins', 15000, 48, 'Chocolate and Cheese', 'produk/RsPcom5GS3bJfjt72ORHknz1eeJ7AmKEzZST9KUE.jpg', NULL, '2026-05-15 07:50:38', '2026-05-15 07:50:38'),
(4, 4, 'Cheese Cake', 97000, 6, 'Fluffy cake', 'produk/Qs5jY5bQzfcfpmDOsaKD7WD9mySCR5RtgTZQ5fTg.jpg', NULL, '2026-05-15 07:51:45', '2026-05-15 07:51:45'),
(5, 8, 'Croissant', 30000, 10, 'Wangiy', 'produk/o8jvnrLW4ix6IaLhQMDbHVv36W3b7hOGPMlC5plx.jpg', NULL, '2026-05-15 07:56:58', '2026-05-15 16:03:21'),
(6, 1, 'Sour Dough', 33500, 27, 'Crisp Crust', 'produk/oNf4BtW3ugKqexcpqwcDJshWqu9LkyTA1NWcRyc3.jpg', NULL, '2026-05-15 08:09:42', '2026-05-15 16:09:40'),
(8, 9, 'Choux Craquelin', 18000, 124, 'Top Choice', 'produk/5KY9MeQhwBC4NYC17FDtxPbSBzf3DvC4U7AjOtjI.jpg', NULL, '2026-05-15 15:44:17', '2026-05-15 16:39:02'),
(10, 4, 'Fudgy Brownie', 107000, 9, 'Rich of Cacao', 'produk/qWb34Vk9w3qKeNBsWBbkBZfNtj9gn8aeeN0vroGo.jpg', NULL, '2026-05-15 16:00:18', '2026-05-15 16:00:18'),
(11, 4, 'Tiramisu', 72500, 4, 'Your Favorite Mouse', 'produk/HCjfWnRCR7MPVvebq5hz14TxtIBLzS2BsLj2lDQk.jpg', NULL, '2026-05-15 16:03:03', '2026-05-15 16:03:03'),
(12, 4, 'Black Forest', 91400, 11, 'Rich of Cacao', 'produk/YJuVV4pIsuqR0xecTFyuAKWrmDC8IwcQ5WWI3Zi9.jpg', NULL, '2026-05-15 16:05:40', '2026-05-15 16:05:40'),
(13, 1, 'Baguette', 23000, 16, 'Crisp Crust', 'produk/kwdEU3dusS52vL1IWW1i5dKDpTHBr4HRnl0ZepPj.jpg', NULL, '2026-05-15 16:08:48', '2026-05-15 16:08:48'),
(14, 1, 'French Toast and Fruits', 20500, 8, 'Buttery Bread', 'produk/lAXQF96S63od4rm2yOFJeO17zKku4j6GdveRREOY.jpg', NULL, '2026-05-15 16:12:25', '2026-05-15 16:12:25'),
(15, 1, 'Croutons', 17000, 100, 'This Cubes will Satisfy Your Tounge', 'produk/V8y64rrXwlnK2OgvbHKfy78oxPz5n0HkvmOT3FMZ.jpg', NULL, '2026-05-15 16:16:22', '2026-05-15 16:16:22'),
(16, 1, 'Roti Buaya', 139000, 19, 'Will You Marry Me?', 'produk/ST3pN89NrulgyMOcOCWked37xZq9L49abWhLeIIJ.jpg', NULL, '2026-05-15 16:18:46', '2026-05-15 16:18:46'),
(17, 1, 'Roti Gulung Abon', 42500, 24, 'Hohoho Don\'t Forget My Taste', 'produk/gWIzuqNR72JmxKDpj41qzXynEC8OZULmuFrRpRnq.png', NULL, '2026-05-15 16:21:01', '2026-05-15 16:21:01'),
(18, 1, 'Brioche', 32000, 55, 'Shiny, Shimmering, & Splendid', 'produk/e47RgXCVDBXwWzJHDiYmis7b1IPjWDplURDuajf7.jpg', NULL, '2026-05-15 16:23:59', '2026-05-15 16:23:59'),
(19, 8, 'Cromboloni', 100000, 18, '4 Variants', 'produk/o6DawFqUdSaZXEEjDlQqh3vdz9WZslF5tPy8C2cM.jpg', NULL, '2026-05-15 16:26:38', '2026-05-15 16:30:33'),
(20, 9, 'Éclair with Ice Cream', 15000, 88, 'So Sweet', 'produk/4rXM7tCHzKXbFqOgFxI3OYI2udwlzGLGsq9BHp6h.jpg', NULL, '2026-05-15 16:30:05', '2026-05-15 16:39:51'),
(21, 9, 'Choux à la Crème', 15000, 124, 'Classic ones', 'produk/PyEfjrmgtiSUYqSaLajaC0SQ0Yxt4crqkC6I41Br.jpg', NULL, '2026-05-15 16:35:54', '2026-05-15 16:35:54'),
(22, 10, 'Apple Pie', 250000, 3, 'Classic ones', 'produk/TYD11YonrhwsXZd1LKjeptd4pp6aj940JKwmnB9K.jpg', NULL, '2026-05-15 16:41:33', '2026-05-15 16:41:33'),
(23, 10, 'Fruit Tartlet', 10000, 150, 'Mini Cutie Chibi', 'produk/YtPF81gPLpGnNanncDgxDPZuUgxgRfDDPbFjXL7v.jpg', NULL, '2026-05-15 16:43:23', '2026-05-15 16:43:23'),
(24, 10, 'Quiche Lorraine', 280000, 6, 'Rich of Beef Bacon', 'produk/7qLrCAujAtsz4lQOEjG3xhOIYMRqYRn7ZyyjDqPn.jpg', NULL, '2026-05-15 16:47:01', '2026-05-15 16:47:01'),
(25, 10, 'Cheese Tart', 25000, 63, 'Japanese-Hokkaido Version of Tart', 'produk/BFwsylJZY6RKRHGQwd3msQX1Q7WaAQ4cbVxmltUa.jpg', NULL, '2026-05-15 16:49:27', '2026-05-15 16:49:27'),
(26, 10, 'Lemon Meringue Tart', 62000, 8, 'Fresh and Sweet', 'produk/vqAuO07SisnsPlDtW9RCHQFMJ3KvlF3NEPIfdFEH.jpg', NULL, '2026-05-15 16:51:49', '2026-05-15 16:51:49'),
(27, 5, 'Nastar', 75000, 29, 'Your Warm Memories', 'produk/JAZdjHXTJyGwgXK2iV3dCJJ7d1IwND6j8SDCrKsw.jpg', NULL, '2026-05-15 16:55:34', '2026-05-15 16:55:34'),
(28, 5, 'Nastar Taiwan', 30000, 67, 'One of Siblings', 'produk/U77Xnh9qyvOEYLklSpXVMF7eRQ0Q7EbpgE55kf2p.jpg', NULL, '2026-05-15 16:58:57', '2026-05-15 16:59:20'),
(29, 4, 'Ketan Hitam Keju', 75000, 12, 'Kejunya Tumpah-tumpah', 'produk/70rAoHsGJabTyoUueZzgabgRwtvS27LP0n66Do8n.jpg', NULL, '2026-05-15 17:06:42', '2026-05-15 17:07:32'),
(30, 5, 'Semprit Keju', 67000, 72, 'Wangiy', 'produk/BMbe20AMnS27kjJcfxt1Ywsji7lEI0FfcMaXJA86.jpg', NULL, '2026-05-15 17:08:59', '2026-05-15 17:10:55'),
(31, 5, 'Meringue', 72000, 84, 'Crunchy and Sweet', 'produk/nMNQ2IiOLDSn3AbOu0O2xgRgVY6nkxW2Fj4KFmRr.jpg', NULL, '2026-05-15 17:12:54', '2026-05-15 17:12:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('hEVn3lg0GjZzzVfhbg7gEWFV1G9KfMvSMjMeyo4z', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJKaDNmdzlORG8wdktzeGhqcko4bGJWSm05dlJ5OVYxMEN1V1lEdjNhIiwidXJsIjpbXSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9wcm9kdWsiLCJyb3V0ZSI6InByb2R1ay5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxfQ==', 1778893409);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'NanaS', 'nrw241000@gmail.com', NULL, '$2y$12$44ApOTjOBA0D3X5MsfIVtOyAXUp2ENkKMJ9cwdPDQHdSgNR5oErIi', 'user', NULL, '2026-05-15 05:56:35', '2026-05-15 05:56:35');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produks_kategori_id_foreign` (`kategori_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `produks`
--
ALTER TABLE `produks`
  ADD CONSTRAINT `produks_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
