-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2021 at 08:23 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(50) NOT NULL,
  `id_toko` int(50) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `harga_barang` int(50) NOT NULL,
  `kategori_barang` char(10) NOT NULL,
  `desc_barang` varchar(200) NOT NULL,
  `gambar` varchar(500) NOT NULL,
  `qty_barang` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `id_toko`, `nama_barang`, `harga_barang`, `kategori_barang`, `desc_barang`, `gambar`, `qty_barang`) VALUES
(4, 1, 'MOBIL MARIO', 10000, 'games', 'MAU BALAPAN SAMA MARIO?', 'https://m.media-amazon.com/images/I/91KQmjDxj-L._SL1500_.jpg', 10),
(5, 1, 'POKEMON', 20000, 'games', 'GOTTA CATCH EM ALL', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//98/MTA-9127466/nintendo_switch_nintendo_switch_pokemon_sword_full01_r0qe1e3o.jpg', 28),
(6, 2, 'KURSI GAMING LEVEL 1', 10000, 'aksesoris', 'KURSI KAYU BIASA', 'https://neufert-cdn.archdaily.net/uploads/photo/image/234787/full_zeitraum-bluechair-01-pro-b-arcit18.jpg?v=1609986931', 19),
(7, 2, 'KURSI GAMING LEVEL 999', 99000, 'aksesoris', 'KURSI SKORPION?!', 'https://m.media-amazon.com/images/I/616BjMuE-fL._AC_SL1482_.jpg', 13);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(50) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty_barangcart` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ordering`
--

CREATE TABLE `ordering` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(50) NOT NULL,
  `Id_transaksi` int(50) NOT NULL,
  `Id_shipping` int(50) NOT NULL,
  `lokasi_pengiriman` varchar(50) NOT NULL,
  `total_harga` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(50) NOT NULL,
  `email_pengguna` varchar(50) NOT NULL,
  `password_pengguna` varchar(32) NOT NULL,
  `nama_pengguna` char(50) NOT NULL,
  `alamat_pengguna` varchar(50) NOT NULL,
  `nomortelp_pengguna` int(13) NOT NULL,
  `status_toko` varchar(5) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `email_pengguna`, `password_pengguna`, `nama_pengguna`, `alamat_pengguna`, `nomortelp_pengguna`, `status_toko`) VALUES
(1, 'filbertlimm@gmail.com', 'password', 'Filbert L', 'Rumah Saya', 98872121, '1'),
(2, 'kursi@gmail.com', 'password', 'Pak Bejoh', 'Rumah Bejo', 123456789, '1'),
(6, 'orangmencoba@gmail.com', 'password', 'Saya mencoba', 'Rumah Mencoba', 0, '1'),
(7, 'bejoh345@gmail.com ', 'password', 'Bejoh Budiant000', 'Alamat Rumah Bejoh', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `Id_shipping` int(50) NOT NULL,
  `nama_shipping` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`Id_shipping`, `nama_shipping`, `harga`) VALUES
(1, 'JNE', 10000),
(2, 'Gojek', 20000),
(3, 'Express', 30000);

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `id_pengguna` int(50) NOT NULL,
  `nama_toko` varchar(50) NOT NULL,
  `deskripsi_toko` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `id_pengguna`, `nama_toko`, `deskripsi_toko`) VALUES
(1, 1, 'Toko Games', 'Toko menjual berbagai macam kebutuhan seputar games'),
(2, 2, 'TOKO KURSI GEMING', 'Kursi dijamin aman dan terkendali'),
(12, 6, 'mencoba', 'mencoba'),
(13, 7, 'Toko Mouse Banyak', 'Sedia Gaming Mouse Variasi');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `Id_transaksi` int(50) NOT NULL,
  `nama_transaksi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`Id_transaksi`, `nama_transaksi`) VALUES
(1, 'Cash On Delivery'),
(2, 'OVO'),
(3, 'E-Wallet');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `barang_idtoko_fk` (`id_toko`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `ordering`
--
ALTER TABLE `ordering`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`Id_shipping`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`),
  ADD KEY `toko_idpengguna_fk` (`id_pengguna`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`Id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `ordering`
--
ALTER TABLE `ordering`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `Id_shipping` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `Id_transaksi` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_idtoko_fk` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`);

--
-- Constraints for table `toko`
--
ALTER TABLE `toko`
  ADD CONSTRAINT `toko_idpengguna_fk` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
