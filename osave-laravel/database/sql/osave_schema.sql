-- DDL: Create database and tables for O! Save
CREATE DATABASE IF NOT EXISTS `osave_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `osave_db`;

CREATE TABLE `pelanggan` (
  `id_pelanggan` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` VARCHAR(100) NOT NULL DEFAULT 'Anonim',
  `no_telp` VARCHAR(20) DEFAULT NULL,
  `alamat` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `kasir` (
  `id_kasir` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_kasir` VARCHAR(100) NOT NULL,
  `username` VARCHAR(50) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id_kasir`),
  UNIQUE KEY `kasir_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `barang` (
  `id_barang` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_barang` VARCHAR(25) NOT NULL,
  `nama_barang` VARCHAR(150) NOT NULL,
  `satuan` VARCHAR(30) NOT NULL DEFAULT 'pcs',
  `harga_satuan` BIGINT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id_barang`),
  UNIQUE KEY `barang_kode_barang_unique` (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `transaksi` (
  `id_transaksi` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_transaksi` VARCHAR(100) NOT NULL,
  `tanggal` DATETIME NOT NULL,
  `id_pelanggan` BIGINT UNSIGNED NOT NULL,
  `id_kasir` BIGINT UNSIGNED NOT NULL,
  `total_item` INT UNSIGNED NOT NULL DEFAULT 0,
  `total_harga` BIGINT UNSIGNED NOT NULL DEFAULT 0,
  `tunai` BIGINT UNSIGNED NOT NULL DEFAULT 0,
  `kembalian` BIGINT UNSIGNED NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  UNIQUE KEY `transaksi_no_transaksi_unique` (`no_transaksi`),
  KEY `transaksi_id_pelanggan_foreign` (`id_pelanggan`),
  KEY `transaksi_id_kasir_foreign` (`id_kasir`),
  CONSTRAINT `transaksi_id_pelanggan_foreign` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  CONSTRAINT `transaksi_id_kasir_foreign` FOREIGN KEY (`id_kasir`) REFERENCES `kasir` (`id_kasir`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_transaksi` BIGINT UNSIGNED NOT NULL,
  `id_barang` BIGINT UNSIGNED NOT NULL,
  `qty` INT UNSIGNED NOT NULL DEFAULT 1,
  `harga_satuan` BIGINT UNSIGNED NOT NULL,
  `subtotal` BIGINT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id_detail_transaksi`),
  KEY `detail_transaksi_id_transaksi_foreign` (`id_transaksi`),
  KEY `detail_transaksi_id_barang_foreign` (`id_barang`),
  CONSTRAINT `detail_transaksi_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE,
  CONSTRAINT `detail_transaksi_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- DML: Seed data from O! Save receipt
INSERT INTO `pelanggan` (`nama_pelanggan`) VALUES ('Anonim');
INSERT INTO `kasir` (`nama_kasir`, `username`) VALUES ('Kasir 1', 'kasir01');

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `satuan`, `harga_satuan`) VALUES
('AYM001', 'Ayam Rolade Chicken 225gr', 'pcs', 9900),
('SHU001', 'P.Catch Shrimp Shumai 250gr', 'pcs', 18500),
('KEN001', 'FF Kentang Manis Putih 545gr', 'pcs', 17900),
('KTL001', 'Kental Manis Putih 545gr', 'pcs', 17900),
('MIN001', 'Kampak Emas Minyak Goreng 300', 'pcs', 12300),
('CBL001', 'Dua belibis Chili Sauce 235ml', 'pcs', 4500),
('LRX001', 'Laurier Xtra Maxi Non Wing 2', 'pcs', 17900),
('UBS001', 'Unibis Marie Susu 198g', 'pcs', 7500);

INSERT INTO `transaksi` (`no_transaksi`, `tanggal`, `id_pelanggan`, `id_kasir`, `total_item`, `total_harga`, `tunai`, `kembalian`) VALUES
('020.1.2004.290185.01/05/2026', '2026-05-01 14:27:00', 1, 1, 9, 103500, 103500, 0);

INSERT INTO `detail_transaksi` (`id_transaksi`, `id_barang`, `qty`, `harga_satuan`, `subtotal`) VALUES
(1, 1, 1, 9900, 9900),
(1, 2, 1, 18500, 18500),
(1, 3, 1, 17900, 17900),
(1, 4, 1, 17900, 17900),
(1, 5, 1, 12300, 12300),
(1, 6, 1, 4500, 4500),
(1, 7, 1, 17900, 17900),
(1, 8, 4, 7500, 30000);
