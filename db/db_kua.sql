-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2025 at 02:53 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

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
-- Table structure for table `feedback_bimbingan`
--

CREATE TABLE `feedback_bimbingan` (
  `id_feedback` int(11) NOT NULL,
  `id_sesi` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `komentar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `master_kua`
--

CREATE TABLE `master_kua` (
  `id_` int(11) NOT NULL,
  `nama_kua` varchar(200) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_kua`
--

INSERT INTO `master_kua` (`id_`, `nama_kua`, `alamat`) VALUES
(1, 'Kantor Urusan Agama Kecamatan Banjarmasin Tengah', 'Kantor Urusan Agama Kecamatan Banjarmasin Teng'),
(2, 'Kantor Urusan Agama (KUA) Banjarmasin Barat', 'Gg. Balai Desa Jl. Teluk Tiram Darat No.02, Tlk. Tiram, Kec. Banjarmasin Bar., Kota Banjarmasin, Kalimantan Selatan 70113'),
(3, 'KUA Banjarmasin Selatan', 'Jl. Kelayan B Gg. Balai Desa No.RT 011/001, Kelayan Tim., Kec. Banjarmasin Sel., Kota Banjarmasin, Kalimantan Selatan 70233');

-- --------------------------------------------------------

--
-- Table structure for table `materi_bimbingan`
--

CREATE TABLE `materi_bimbingan` (
  `id_materi` int(11) NOT NULL,
  `judul_materi` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `file_materi` varchar(255) DEFAULT NULL,
  `id_sesi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materi_bimbingan`
--

INSERT INTO `materi_bimbingan` (`id_materi`, `judul_materi`, `deskripsi`, `file_materi`, `id_sesi`) VALUES
(1, 'Test', 'Testasd', 'ct6ybs7ssmgok0o44k.ct', 1);

-- --------------------------------------------------------

--
-- Table structure for table `peserta_bimbingan`
--

CREATE TABLE `peserta_bimbingan` (
  `id_peserta` int(11) NOT NULL,
  `id_daftar` varchar(30) NOT NULL,
  `id_sesi` int(11) NOT NULL,
  `status_pendaftaran` enum('Diterima','Ditolak','Menunggu') DEFAULT 'Menunggu',
  `tanggal_daftar` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peserta_bimbingan`
--

INSERT INTO `peserta_bimbingan` (`id_peserta`, `id_daftar`, `id_sesi`, `status_pendaftaran`, `tanggal_daftar`) VALUES
(3, 'PN/01/2024-11-15/2024', 1, 'Diterima', '2024-12-13 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `peserta_sesi`
--

CREATE TABLE `peserta_sesi` (
  `id_peserta_sesi` int(11) NOT NULL,
  `id_sesi` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `status_kehadiran` enum('Hadir','Tidak Hadir') DEFAULT 'Tidak Hadir',
  `sertifikat` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peserta_sesi`
--

INSERT INTO `peserta_sesi` (`id_peserta_sesi`, `id_sesi`, `id_peserta`, `status_kehadiran`, `sertifikat`) VALUES
(2, 1, 3, 'Hadir', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sesi_bimbingan`
--

CREATE TABLE `sesi_bimbingan` (
  `id_sesi` int(11) NOT NULL,
  `nama_sesi` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `link_meeting` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `kapasitas` int(11) NOT NULL,
  `status` enum('Aktif','Selesai') DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sesi_bimbingan`
--

INSERT INTO `sesi_bimbingan` (`id_sesi`, `nama_sesi`, `tanggal`, `waktu`, `lokasi`, `link_meeting`, `deskripsi`, `kapasitas`, `status`) VALUES
(1, 'Test 1', '2024-12-12', '09:00:00', 'Bumi', 'link-bokep', 'test', 25, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bukti_pembayaran`
--

CREATE TABLE `tbl_bukti_pembayaran` (
  `id` varchar(40) NOT NULL,
  `id_registrasi` varchar(150) NOT NULL,
  `bukti_bayar` varchar(60) NOT NULL,
  `tanggal` varchar(60) NOT NULL,
  `user_id` varchar(17) NOT NULL,
  `kode_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bukti_pembayaran`
--

INSERT INTO `tbl_bukti_pembayaran` (`id`, `id_registrasi`, `bukti_bayar`, `tanggal`, `user_id`, `kode_transaksi`) VALUES
('KUA0111241501', 'PN/01/2024-11-15/2024', '16lfqs6l4gxwo8g0wg.png', '2024-11-15', '123123123123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_daftar_nikah`
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

--
-- Dumping data for table `tbl_daftar_nikah`
--

INSERT INTO `tbl_daftar_nikah` (`id_daftar`, `kewarganegaraan_calsu`, `nik_calsu`, `nama_calsu`, `tempat_lahir_calsu`, `tanggal_lahir_calsu`, `umur_calsu`, `status_calsu`, `agama_calsu`, `alamat_calsu`, `pendidikan_terakhir_calsu`, `foto_calsu`, `kewarganegaraan_calis`, `nik_calis`, `nama_calis`, `tempat_lahir_calis`, `tanggal_lahir_calis`, `umur_calis`, `status_calis`, `agama_calis`, `alamat_calis`, `pendidikan_terakhir_calis`, `foto_calis`, `tempat_menikah`, `alamat_nikah`, `tanggal_nikah_m`, `jam_nikah`, `foto_latar_gandeng`, `berkas_diperlukan`, `status`, `tanggal_daftar`, `user_id`, `kode_transaksi`) VALUES
('PN/01/2024-11-15/2024', 'WNI', '123123123', '123123123', '123123123123123', '2024-11-06', '123', 'Duda', 'Kristen Protestan', 'asdasd', 'SMA/Sederajat', '', 'WNI', 'asdasd123123123', '123123123', '123123123', '2024-11-01', '123', 'Janda', 'Islam', '123123123', 'Tidak Tamat Sekolah', '', 'Di Kua', '23eqweqwe', '2024-11-05', '05:00:00', '', '', 'Pendaftaran Berhasil', '2024-11-15', '123123123123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jadwal`
--

CREATE TABLE `tbl_jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_daftar_nikah` varchar(30) NOT NULL,
  `tgl_nikah` varchar(40) NOT NULL,
  `jam_nikah` varchar(10) NOT NULL,
  `tempat_nikah` varchar(20) NOT NULL,
  `alamat_nikah` text NOT NULL,
  `id_penghulu` varchar(16) NOT NULL,
  `status_jadwal` varchar(50) NOT NULL,
  `id_catin` varchar(16) NOT NULL,
  `kode_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jadwal`
--

INSERT INTO `tbl_jadwal` (`id_jadwal`, `id_daftar_nikah`, `tgl_nikah`, `jam_nikah`, `tempat_nikah`, `alamat_nikah`, `id_penghulu`, `status_jadwal`, `id_catin`, `kode_transaksi`) VALUES
(1, 'PN/01/2024-11-15/2024', '2024-11-05', '05:00:00', 'Di Kua', '23eqweqwe', '2938409283123124', 'PENDING', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penerimaan_pendaftaran`
--

CREATE TABLE `tbl_penerimaan_pendaftaran` (
  `nomor_surat_penerimaan` varchar(50) NOT NULL,
  `id_pendaftaran_nikah` varchar(30) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `kode_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_penerimaan_pendaftaran`
--

INSERT INTO `tbl_penerimaan_pendaftaran` (`nomor_surat_penerimaan`, `id_pendaftaran_nikah`, `tanggal`, `kode_transaksi`) VALUES
('01/Kua.17.01-2/PN.01/11/2024', 'PN/01/2024-11-15/2024', '2024-11-15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penghulu`
--

CREATE TABLE `tbl_penghulu` (
  `Nip` varchar(16) NOT NULL,
  `nama_penghulu` varchar(200) NOT NULL,
  `foto` varchar(60) NOT NULL,
  `alamat_penghulu` text NOT NULL,
  `telpon_penghulu` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_penghulu`
--

INSERT INTO `tbl_penghulu` (`Nip`, `nama_penghulu`, `foto`, `alamat_penghulu`, `telpon_penghulu`) VALUES
('2938409283123124', 'Udin', '1luuaz6s14v4kgc480.png', 'Bumi', '123456678787890');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penolakan`
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
-- Table structure for table `tbl_pesan`
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
-- Table structure for table `tbl_rekomendasi`
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
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `nik` varchar(16) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`nik`, `email`, `password`, `level`) VALUES
('123123123123', 'user@kua.com', '$2y$10$7pGwcC/EHjsewFcsdgrg4eEiZC7Xm3jm4XXAjC7EWj9vfT01fPHa2', 'MASYARAKAT'),
('1234567890', 'adminkua@mail.com', '$2y$10$wQsDeHkG8h1zo5B283Q6B.bYUCkMeJCXr8Ky9TlQmeJ.2Si6XvPXS', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `user_detail`
--

CREATE TABLE `user_detail` (
  `id` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `pekerjaan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_detail`
--

INSERT INTO `user_detail` (`id`, `nik`, `nama`, `alamat`, `no_hp`, `pekerjaan`) VALUES
(3, '1234567890', 'Muhammad Zainudin', 'bumi', '', 'pegasus'),
(9, '1342343436345345', 'Burhan Kece', 'Jln wildansari I G no 44', '', 'Freelance'),
(10, '123123123123', 'asd', 'bumi', '', 'pegasus');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback_bimbingan`
--
ALTER TABLE `feedback_bimbingan`
  ADD PRIMARY KEY (`id_feedback`);

--
-- Indexes for table `master_kua`
--
ALTER TABLE `master_kua`
  ADD PRIMARY KEY (`id_`);

--
-- Indexes for table `materi_bimbingan`
--
ALTER TABLE `materi_bimbingan`
  ADD PRIMARY KEY (`id_materi`);

--
-- Indexes for table `peserta_bimbingan`
--
ALTER TABLE `peserta_bimbingan`
  ADD PRIMARY KEY (`id_peserta`);

--
-- Indexes for table `peserta_sesi`
--
ALTER TABLE `peserta_sesi`
  ADD PRIMARY KEY (`id_peserta_sesi`);

--
-- Indexes for table `sesi_bimbingan`
--
ALTER TABLE `sesi_bimbingan`
  ADD PRIMARY KEY (`id_sesi`);

--
-- Indexes for table `tbl_bukti_pembayaran`
--
ALTER TABLE `tbl_bukti_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_daftar_nikah`
--
ALTER TABLE `tbl_daftar_nikah`
  ADD PRIMARY KEY (`id_daftar`);

--
-- Indexes for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `tbl_penerimaan_pendaftaran`
--
ALTER TABLE `tbl_penerimaan_pendaftaran`
  ADD PRIMARY KEY (`nomor_surat_penerimaan`);

--
-- Indexes for table `tbl_penghulu`
--
ALTER TABLE `tbl_penghulu`
  ADD PRIMARY KEY (`Nip`);

--
-- Indexes for table `tbl_penolakan`
--
ALTER TABLE `tbl_penolakan`
  ADD PRIMARY KEY (`id_penolakan`);

--
-- Indexes for table `tbl_pesan`
--
ALTER TABLE `tbl_pesan`
  ADD PRIMARY KEY (`id_k`);

--
-- Indexes for table `tbl_rekomendasi`
--
ALTER TABLE `tbl_rekomendasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback_bimbingan`
--
ALTER TABLE `feedback_bimbingan`
  MODIFY `id_feedback` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_kua`
--
ALTER TABLE `master_kua`
  MODIFY `id_` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `materi_bimbingan`
--
ALTER TABLE `materi_bimbingan`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `peserta_bimbingan`
--
ALTER TABLE `peserta_bimbingan`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `peserta_sesi`
--
ALTER TABLE `peserta_sesi`
  MODIFY `id_peserta_sesi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sesi_bimbingan`
--
ALTER TABLE `sesi_bimbingan`
  MODIFY `id_sesi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_pesan`
--
ALTER TABLE `tbl_pesan`
  MODIFY `id_k` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_detail`
--
ALTER TABLE `user_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
