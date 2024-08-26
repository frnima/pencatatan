-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Agu 2024 pada 03.33
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pencatatan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kebutuhan`
--

CREATE TABLE `data_kebutuhan` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kebutuhan` varchar(255) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `biaya` decimal(10,2) NOT NULL,
  `keterangan` text NOT NULL,
  `invoice` longblob NOT NULL,
  `invoice_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_kebutuhan`
--

INSERT INTO `data_kebutuhan` (`id`, `tanggal`, `kebutuhan`, `kuantitas`, `biaya`, `keterangan`, `invoice`, `invoice_type`) VALUES
(17, '2024-07-15', 'Harddisk External 2,5\" 1TB', 1, 759000.00, 'Permintaan Ibu Maria Bag Tu Kearsipan', '', ''),
(18, '2024-07-02', 'Harddisk Internal 3,5\" 1TB', 1, 827000.00, 'Backup Data Pabx CCTV', '', ''),
(19, '2024-07-04', 'Keyboard Mouse Logitech Slim Combo', 1, 437000.00, 'Penggantian Keyboard Mouse PC Ibu Galih', '', ''),
(20, '2024-06-28', 'Lisensi Microsoft Office Original', 2, 1919998.00, 'Relisensi PC Staff Ahli Menteri, PC Ibu Tenny Keuangan', '', ''),
(21, '2024-07-09', 'Keyboard Mouse Logitech Slim Combo', 1, 437000.00, 'Penggantian Keyboard Mouse PC PABX telepon', '', ''),
(22, '2024-06-29', 'TP Link Switch 8 Port 100mb/s', 1, 178000.00, 'Sharing 1 Scanner ke 4 PC Bag Keuangan', '', ''),
(23, '2024-07-29', 'Sharing 1 Scanner ke 4 PC Bag Keuangan', 5, 168000.00, 'Kabel konektor scanner ke pc', '', ''),
(24, '2024-06-27', 'Kabel konektor scanner ke pc', 1, 254000.00, 'Kabel Display CPU ke Monitor', '', ''),
(25, '2024-07-16', 'Kabel Display CPU ke Monitor', 3, 975000.00, 'Permintaan Mouse BMN', '', ''),
(26, '2024-07-19', 'Permintaan Mouse BMN', 2, 758000.00, 'Penambahan RAM 2 Laptop Ibu Galih', '', ''),
(27, '2024-07-16', 'SSD SATA 2,5 512GB', 1, 827000.00, 'Penggantian SSD PC PABX telepon', '', ''),
(28, '2024-07-19', 'Lisensi Microsoft Office Original', 2, 1919998.00, 'Instalasi Office Original 2 Laptop Ibu Galih', '', ''),
(29, '2024-07-23', 'Adaptor Lenovo All In One', 1, 478000.00, 'Adaptor pengganti PC Admin Poliklinik', '', ''),
(30, '2024-07-23', 'Keyboard Mouse Logitech Slim Combo', 1, 437000.00, 'Penggantian Keyboard Mouse PC Admin Poliklinik', '', ''),
(31, '2024-07-19', 'Kabel UTP  Cat 6 1 Roll', 1, 2550000.00, 'untuk penarikan kabel server ke Poliklinik', '', ''),
(32, '2024-07-19', 'Mikrotik RB750gr3 hEX series', 1, 874000.00, 'Router untuk lalu lintas jaringan private server', '', ''),
(33, '2024-07-19', 'Akses Point TP Link Archer C20', 1, 389000.00, 'Akses Point Wifi Client untuk akses RME', '', ''),
(34, '2024-07-09', 'Thermal Pasta Processor', 10, 376000.00, 'Thermal untuk cooling processor ', '', ''),
(35, '2024-07-07', 'Screen Cleaner Spray', 3, 75000.00, 'Pembersih Layar Monitor/LCD', '', ''),
(36, '2024-07-05', 'HDD 4TB Ironwolf spek NAS', 2, 7780000.00, 'Harddisk untuk backup harian RME', '', ''),
(37, '2024-07-05', 'Lisensi Software Backupper Daily 1Y', 1, 2279000.00, 'software otomatisasi backup RME', '', ''),
(38, '2024-07-06', 'software otomatisasi backup RME', 6, 5759994.00, 'Instalasi Office Original 6 PC baru rumah tangga', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(7, 'dito', '$2y$10$9wOjmJCN6jmHPCq2H9cxCOHqY35dmYZlV54oT80IH5Z91mbKp2VDC', 'inovaproject@gmailcom');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_kebutuhan`
--
ALTER TABLE `data_kebutuhan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_kebutuhan`
--
ALTER TABLE `data_kebutuhan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
