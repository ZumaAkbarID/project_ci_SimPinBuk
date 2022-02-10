-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 10 Feb 2022 pada 14.00
-- Versi server: 5.7.25
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simpinbuk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `pin` varchar(4) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('1','2') NOT NULL COMMENT '1 = Laki-Laki, 2 = Perempuan',
  `tanggal_lahir` date NOT NULL,
  `role` enum('Admin','Member') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id`, `pin`, `password`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `role`) VALUES
(1, '2121', '$2y$10$0E4jaVKfZz0i2zQEO.20IeLXh10qC9i4c6yf.ykTNdvgGvwEv0QWO', 'Rahmat Wahyuma Akbar', '1', '2005-02-11', 'Member'),
(2, '1234', '$2y$10$YCiYCZN1FH2QuvvCKQ3ZXe8o.hciGtInfeyKYAyQG4Sf9z5ytEu6O', 'Joko', '1', '2018-02-20', 'Member'),
(3, '2131', '$2y$10$Zv5SNtYDc.ENovTanpwkiOxZWLKOARBhchdwLT7hVTypIPLQDrxYK', 'Janoko', '1', '2321-12-12', 'Member'),
(4, '1264', '$2y$10$fXtpC2Od3heaFLihyLDjruiX6a3.7MrRNdMgM9zF1NQZcB5xR7qzi', 'AKUN', '1', '4223-03-12', 'Member'),
(5, '9898', '$2y$10$1fYVooI2Bk2/Cu/M.0OeIOy9DVjYzOTU2PuaSQj9Y5eRO7JZSxCE.', 'Akun Benar', '1', '2005-02-11', 'Member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL DEFAULT 'default-book.png',
  `deskripsi` text NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `pemilik` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL COMMENT '0 = dipinjam, 1 = tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `gambar`, `deskripsi`, `pengarang`, `tahun_terbit`, `pemilik`, `status`) VALUES
(1, 'Naruto Sippuden', 'default-book.png', 'Naruto adalah seorang ninja yang sangat jago anjay jago.', 'Masashi Kishimoto', 2021, 1, '1'),
(2, 'Boruto Sippuden', 'default-book.png', 'Boruto adalah seorang ninja keren mantap jiwa sekali uwau yang sangat jago anjay jago.', 'Oisshi', 2022, 1, '1'),
(9, 'Saya Ganteng', '20376cae-a5fb-4a9f-96ca-8ddf6225c1d9.jpg', 'Saya ganteng sekali uwu yaampun. yahahaha hayukkk, ini deskripsi tapi aneh kalo kurang panjang', 'Zuma', 2022, 1, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjam`
--

CREATE TABLE `pinjam` (
  `id_pinjam` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `tgl_pinjam` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_kembali` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat`
--

CREATE TABLE `riwayat` (
  `id_riwayat` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `id_pinjam` int(11) DEFAULT NULL,
  `deskripsi` text NOT NULL,
  `tipe` enum('Pinjam','Kembalikan','Simpan','Hapus','Perbarui') NOT NULL,
  `waktu` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 = tidak didelete, 1 = didelete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pin` (`pin`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `pemilik` (`pemilik`);

--
-- Indeks untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_pinjam` (`id_pinjam`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `pemilik` FOREIGN KEY (`pemilik`) REFERENCES `anggota` (`id`);

--
-- Ketidakleluasaan untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  ADD CONSTRAINT `id_anggota` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id`),
  ADD CONSTRAINT `id_buku` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`);

--
-- Ketidakleluasaan untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  ADD CONSTRAINT `idPinjam` FOREIGN KEY (`id_pinjam`) REFERENCES `pinjam` (`id_pinjam`),
  ADD CONSTRAINT `uid` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
