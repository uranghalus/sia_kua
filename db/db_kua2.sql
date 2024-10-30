-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Mar 2023 pada 07.41
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kua`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_kua`
--

CREATE TABLE `master_kua` (
  `id_` int(11) NOT NULL,
  `nama_kua` varchar(200) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_kua`
--

INSERT INTO `master_kua` (`id_`, `nama_kua`, `alamat`) VALUES
(1, 'Kantor Urusan Agama Kecamatan Banjarmasin Tengah', 'Kantor Urusan Agama Kecamatan Banjarmasin Teng'),
(2, 'Kantor Urusan Agama (KUA) Banjarmasin Barat', 'Gg. Balai Desa Jl. Teluk Tiram Darat No.02, Tlk. Tiram, Kec. Banjarmasin Bar., Kota Banjarmasin, Kalimantan Selatan 70113'),
(3, 'KUA Banjarmasin Selatan', 'Jl. Kelayan B Gg. Balai Desa No.RT 011/001, Kelayan Tim., Kec. Banjarmasin Sel., Kota Banjarmasin, Kalimantan Selatan 70233');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bukti_pembayaran`
--

CREATE TABLE `tbl_bukti_pembayaran` (
  `id` varchar(40) NOT NULL,
  `id_registrasi` varchar(150) NOT NULL,
  `bukti_bayar` varchar(60) NOT NULL,
  `tanggal` varchar(60) NOT NULL,
  `user_id` varchar(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_daftar_nikah`
--

CREATE TABLE `tbl_daftar_nikah` (
  `id_daftar` varchar(30) NOT NULL,
  `kewarganegaraan_calsu` varchar(15) NOT NULL,
  `nik_calsu` varchar(16) NOT NULL,
  `nama_calsu` varchar(200) NOT NULL,
  `tempat_lahir_calsu` varchar(150) NOT NULL,
  `tanggal_lahir_calsu` varchar(40) NOT NULL,
  `umur_calsu` varchar(3) NOT NULL,
  `status_calsu` varchar(60) NOT NULL,
  `agama_calsu` varchar(60) NOT NULL,
  `alamat_calsu` text NOT NULL,
  `pendidikan_terakhir_calsu` varchar(50) NOT NULL,
  `foto_calsu` varchar(50) NOT NULL,
  `kewarganegaraan_calis` varchar(20) NOT NULL,
  `nik_calis` varchar(16) NOT NULL,
  `nama_calis` varchar(200) NOT NULL,
  `tempat_lahir_calis` varchar(150) NOT NULL,
  `tanggal_lahir_calis` varchar(40) NOT NULL,
  `umur_calis` varchar(3) NOT NULL,
  `status_calis` varchar(60) NOT NULL,
  `agama_calis` varchar(20) NOT NULL,
  `alamat_calis` text NOT NULL,
  `pendidikan_terakhir_calis` varchar(40) NOT NULL,
  `foto_calis` varchar(50) NOT NULL,
  `tempat_menikah` varchar(20) NOT NULL,
  `alamat_nikah` text NOT NULL,
  `tanggal_nikah_m` varchar(40) NOT NULL,
  `jam_nikah` time NOT NULL,
  `foto_latar_gandeng` varchar(40) NOT NULL,
  `berkas_diperlukan` varchar(40) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tanggal_daftar` date NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `kode_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jadwal`
--

CREATE TABLE `tbl_jadwal` (
  `id_jadwal` varchar(15) NOT NULL,
  `id_daftar_nikah` varchar(30) NOT NULL,
  `tgl_nikah` varchar(40) NOT NULL,
  `jam_nikah` varchar(10) NOT NULL,
  `tempat_nikah` varchar(20) NOT NULL,
  `alamat_nikah` text NOT NULL,
  `id_penghulu` varchar(16) NOT NULL,
  `status_jadwal` varchar(50) NOT NULL,
  `id_catin` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penghulu`
--

CREATE TABLE `tbl_penghulu` (
  `Nip` varchar(16) NOT NULL,
  `nama_penghulu` varchar(200) NOT NULL,
  `foto` varchar(60) NOT NULL,
  `alamat_penghulu` text NOT NULL,
  `telpon_penghulu` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penolakan`
--

CREATE TABLE `tbl_penolakan` (
  `id_penolakan` varchar(50) NOT NULL,
  `id_pendaftaran` varchar(30) NOT NULL,
  `jenis_penolakan` varchar(30) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `kode_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pesan`
--

CREATE TABLE `tbl_pesan` (
  `id_k` int(11) NOT NULL,
  `nama_pengirim` varchar(200) NOT NULL,
  `id_penerima` varchar(16) NOT NULL,
  `pesan` text NOT NULL,
  `judul_pesan` varchar(200) NOT NULL,
  `tgl_pesan` varchar(20) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rekomendasi`
--

CREATE TABLE `tbl_rekomendasi` (
  `id` varchar(150) NOT NULL,
  `id_pendaftaran_nikah` varchar(40) NOT NULL,
  `tujuan_kua` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_transaksi` varchar(11) NOT NULL,
  `user_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `nik` varchar(16) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`nik`, `email`, `password`, `level`) VALUES
('1234567890', 'adminkua@mail.com', '$2y$10$wQsDeHkG8h1zo5B283Q6B.bYUCkMeJCXr8Ky9TlQmeJ.2Si6XvPXS', 'ADMIN'),
('1342343436345345', 'burhankece@mail.com', '$2y$10$tpQr1XKVLWfEfZ5n8gpjq.mXcHhgSregMXxefDrin1BpiLrwoOzwC', 'MASYARAKAT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_detail`
--

CREATE TABLE `user_detail` (
  `id` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `pekerjaan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_detail`
--

INSERT INTO `user_detail` (`id`, `nik`, `nama`, `alamat`, `pekerjaan`) VALUES
(3, '1234567890', 'Muhammad Zainudin', 'bumi', 'pegasus'),
(9, '1342343436345345', 'Burhan Kece', 'Jln wildansari I G no 44', 'Freelance');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `master_kua`
--
ALTER TABLE `master_kua`
  ADD PRIMARY KEY (`id_`);

--
-- Indeks untuk tabel `tbl_bukti_pembayaran`
--
ALTER TABLE `tbl_bukti_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_daftar_nikah`
--
ALTER TABLE `tbl_daftar_nikah`
  ADD PRIMARY KEY (`id_daftar`);

--
-- Indeks untuk tabel `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `tbl_penghulu`
--
ALTER TABLE `tbl_penghulu`
  ADD PRIMARY KEY (`Nip`);

--
-- Indeks untuk tabel `tbl_penolakan`
--
ALTER TABLE `tbl_penolakan`
  ADD PRIMARY KEY (`id_penolakan`);

--
-- Indeks untuk tabel `tbl_pesan`
--
ALTER TABLE `tbl_pesan`
  ADD PRIMARY KEY (`id_k`);

--
-- Indeks untuk tabel `tbl_rekomendasi`
--
ALTER TABLE `tbl_rekomendasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`nik`);

--
-- Indeks untuk tabel `user_detail`
--
ALTER TABLE `user_detail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `master_kua`
--
ALTER TABLE `master_kua`
  MODIFY `id_` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_pesan`
--
ALTER TABLE `tbl_pesan`
  MODIFY `id_k` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user_detail`
--
ALTER TABLE `user_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
