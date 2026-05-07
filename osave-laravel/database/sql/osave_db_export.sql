-- SQL Export for O! Save Database
-- Ready for PHPMyAdmin Import

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: `osave_db`
CREATE DATABASE IF NOT EXISTS `osave_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `osave_db`;

-- Table structure for table `toko`
CREATE TABLE `toko` (
  `id_toko` varchar(10) NOT NULL,
  `nama_toko` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `npwp` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_toko`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `kasir`
CREATE TABLE `kasir` (
  `id_kasir` varchar(10) NOT NULL,
  `nama_kasir` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_kasir`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `pelanggan`
CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(10) NOT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `barang`
CREATE TABLE `barang` (
  `id_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(150) DEFAULT NULL,
  `harga_satuan` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `transaksi`
CREATE TABLE `transaksi` (
  `id_transaksi` varchar(20) NOT NULL,
  `id_toko` varchar(10) DEFAULT NULL,
  `id_kasir` varchar(10) DEFAULT NULL,
  `id_pelanggan` varchar(10) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu` time DEFAULT NULL,
  `total_harga` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `id_toko` (`id_toko`),
  KEY `id_kasir` (`id_kasir`),
  KEY `id_pelanggan` (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `detail_transaksi`
CREATE TABLE `detail_transaksi` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` varchar(20) DEFAULT NULL,
  `id_barang` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `subtotal` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`id_detail`),
  KEY `id_transaksi` (`id_transaksi`),
  KEY `id_barang` (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for tables
INSERT INTO `toko` (`id_toko`, `nama_toko`, `alamat`, `npwp`) VALUES
('020', 'O! Save', 'Jl. Komarudin Lama RT.7 RW.5', '20.786.546.0-427.000');

INSERT INTO `kasir` (`id_kasir`, `nama_kasir`) VALUES
('2004', 'Staff 2004');

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`) VALUES
('G001', 'Guest');

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga_satuan`) VALUES
('B01', 'Ayoma Rolade Chicken 225gr', 9900.00),
('B02', 'P.Catch Shrimp Shumai 250gr', 18500.00),
('B03', 'FF Kental Manis Putih 545gr', 17900.00),
('B04', 'Kampak Emas Minyak Goreng 800', 17900.00),
('B05', 'Dua belibis Chili Sauce 235m', 12300.00),
('B06', 'Laurier Xtra Maxi Non Wing 2', 4500.00),
('B07', 'Unibis Marie Susu 198g', 7500.00);

INSERT INTO `transaksi` (`id_transaksi`, `id_toko`, `id_kasir`, `id_pelanggan`, `tanggal`, `waktu`, `total_harga`) VALUES
('290185', '020', '2004', 'G001', '2026-05-01', '14:27:00', 103500.00);

INSERT INTO `detail_transaksi` (`id_transaksi`, `id_barang`, `qty`, `subtotal`) VALUES
('290185', 'B01', 1, 9900.00),
('290185', 'B02', 1, 18500.00),
('290185', 'B03', 1, 17900.00),
('290185', 'B04', 1, 17900.00),
('290185', 'B05', 1, 12300.00),
('290185', 'B06', 1, 4500.00),
('290185', 'B07', 3, 22500.00);

-- Constraints for dumped tables
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_kasir`) REFERENCES `kasir` (`id_kasir`),
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);

ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`),
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

COMMIT;
