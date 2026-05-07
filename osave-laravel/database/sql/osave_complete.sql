-- ========================================================
-- O! SAVE DATABASE - SQL DDL & DML COMPLETE
-- DBMS: MySQL / MariaDB
-- Project: O! Save Point of Sale System
-- Generated: May 2026
-- ========================================================

-- A. DROP DATABASE IF EXISTS ( uncomment if needed )
-- DROP DATABASE IF EXISTS osave_db;

-- B. CREATE DATABASE
CREATE DATABASE IF NOT EXISTS osave_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE osave_db;

-- ========================================================
-- C. DDL - CREATE TABLES
-- ========================================================

-- 1. TABEL PELANGGAN
CREATE TABLE IF NOT EXISTS pelanggan (
    id_pelanggan BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_pelanggan VARCHAR(100) NOT NULL DEFAULT 'Muhammad Arya Fatthurahman',
    no_telp VARCHAR(20) DEFAULT NULL,
    alamat TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. TABEL KASIR
CREATE TABLE IF NOT EXISTS kasir (
    id_kasir BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_kasir VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. TABEL BARANG
CREATE TABLE IF NOT EXISTS barang (
    id_barang BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(20) NOT NULL UNIQUE,
    nama_barang VARCHAR(200) NOT NULL,
    satuan VARCHAR(20) DEFAULT 'pcs',
    harga_satuan BIGINT UNSIGNED NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. TABEL TRANSAKSI
CREATE TABLE IF NOT EXISTS transaksi (
    id_transaksi BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    no_transaksi VARCHAR(100) NOT NULL UNIQUE,
    tanggal DATETIME NOT NULL,
    id_pelanggan BIGINT UNSIGNED,
    id_kasir BIGINT UNSIGNED NOT NULL,
    total_item INT UNSIGNED NOT NULL DEFAULT 0,
    total_harga BIGINT UNSIGNED NOT NULL DEFAULT 0,
    tunai BIGINT UNSIGNED NOT NULL DEFAULT 0,
    kembalian BIGINT UNSIGNED NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    -- Foreign Keys
    CONSTRAINT fk_transaksi_pelanggan
        FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id_pelanggan)
        ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT fk_transaksi_kasir
        FOREIGN KEY (id_kasir) REFERENCES kasir(id_kasir)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. TABEL DETAIL_TRANSAKSI
CREATE TABLE IF NOT EXISTS detail_transaksi (
    id_detail_transaksi BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_transaksi BIGINT UNSIGNED NOT NULL,
    id_barang BIGINT UNSIGNED NOT NULL,
    qty INT UNSIGNED NOT NULL DEFAULT 1,
    harga_satuan BIGINT UNSIGNED NOT NULL DEFAULT 0,
    subtotal BIGINT UNSIGNED NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    -- Foreign Keys
    CONSTRAINT fk_detail_transaksi
        FOREIGN KEY (id_transaksi) REFERENCES transaksi(id_transaksi)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_detail_barang
        FOREIGN KEY (id_barang) REFERENCES barang(id_barang)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================================
-- D. CREATE INDEXES
-- ========================================================
CREATE INDEX idx_transaksi_tanggal ON transaksi(tanggal);
CREATE INDEX idx_transaksi_pelanggan ON transaksi(id_pelanggan);
CREATE INDEX idx_transaksi_kasir ON transaksi(id_kasir);
CREATE INDEX idx_detail_transaksi_id ON detail_transaksi(id_transaksi);
CREATE INDEX idx_detail_barang_id ON detail_transaksi(id_barang);

-- ========================================================
-- E. DML - INSERT DATA
-- Data dari Struk O! Save 01/05/2026
-- ========================================================

-- 1. INSERT PELANGGAN
INSERT INTO pelanggan (id_pelanggan, nama_pelanggan, no_telp, alamat) VALUES
(1, 'Anonim', NULL, NULL);

-- 2. INSERT KASIR
INSERT INTO kasir (id_kasir, nama_kasir, username) VALUES
(1, 'Kasir 1', 'kasir01');

-- 3. INSERT BARANG (Data dari Struk)
INSERT INTO barang (id_barang, kode_barang, nama_barang, satuan, harga_satuan) VALUES
(1, 'AYM001', 'Ayam Rolade Chicken 225gr', 'pcs', 9900),
(2, 'SHU001', 'P.Catch Shrimp Shumai 250gr', 'pcs', 18500),
(3, 'KEN001', 'FF Kentang Manis Putih 545gr', 'pcs', 17900),
(4, 'KTL001', 'Kental Manis Putih 545gr', 'pcs', 17900),
(5, 'MIN001', 'Kampak Emas Minyak Goreng 300', 'pcs', 12300),
(6, 'CBL001', 'Dua belibis Chili Sauce 235ml', 'pcs', 4500),
(7, 'LRX001', 'Laurier Xtra Maxi Non Wing 2', 'pcs', 17900),
(8, 'UBS001', 'Unibis Marie Susu 198g', 'pcs', 7500);

-- 4. INSERT TRANSAKSI (Struk No: 020.1.2004.290185.01/05/2026)
INSERT INTO transaksi (id_transaksi, no_transaksi, tanggal, id_pelanggan, id_kasir, total_item, total_harga, tunai, kembalian) VALUES
(1, '020.1.2004.290185.01/05/2026', '2026-05-01 14:27:00', 1, 1, 9, 103500, 103500, 0);

-- 5. INSERT DETAIL TRANSAKSI
INSERT INTO detail_transaksi (id_detail_transaksi, id_transaksi, id_barang, qty, harga_satuan, subtotal) VALUES
(1, 1, 1, 1, 9900, 9900),
(2, 1, 2, 1, 18500, 18500),
(3, 1, 3, 1, 17900, 17900),
(4, 1, 4, 1, 17900, 17900),
(5, 1, 5, 1, 12300, 12300),
(6, 1, 6, 1, 4500, 4500),
(7, 1, 7, 1, 17900, 17900),
(8, 1, 8, 4, 7500, 30000);

-- ========================================================
-- F. VIEWS (Optional - untuk reporting)
-- ========================================================

-- View: Laporan Transaksi Lengkap
CREATE OR REPLACE VIEW v_laporan_transaksi AS
SELECT
    t.id_transaksi,
    t.no_transaksi,
    t.tanggal,
    p.nama_pelanggan,
    k.nama_kasir,
    t.total_item,
    t.total_harga,
    t.tunai,
    t.kembalian
FROM transaksi t
LEFT JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
LEFT JOIN kasir k ON t.id_kasir = k.id_kasir;

-- View: Detail Transaksi dengan Nama Barang
CREATE OR REPLACE VIEW v_detail_transaksi_lengkap AS
SELECT
    dt.id_detail_transaksi,
    dt.id_transaksi,
    t.no_transaksi,
    b.kode_barang,
    b.nama_barang,
    dt.qty,
    dt.harga_satuan,
    dt.subtotal
FROM detail_transaksi dt
JOIN transaksi t ON dt.id_transaksi = t.id_transaksi
JOIN barang b ON dt.id_barang = b.id_barang;

-- ========================================================
-- G. STORED PROCEDURE (Optional)
-- ========================================================

DELIMITER //

-- Procedure: Hitung Total Penjualan per Tanggal
CREATE PROCEDURE IF NOT EXISTS sp_total_penjualan(IN tanggal_filter DATE)
BEGIN
    SELECT
        COUNT(*) as jumlah_transaksi,
        SUM(total_item) as total_item_terjual,
        SUM(total_harga) as total_penjualan
    FROM transaksi
    WHERE DATE(tanggal) = tanggal_filter;
END //

DELIMITER ;

-- ========================================================
-- H. NORMALISATION DOCUMENTATION (as comments)
-- ========================================================

/*
NORMALISASI DATABASE O! SAVE:

UNF (Unnormalized Form):
----------------------------------------
| no_transaksi | tanggal | nama_barang | qty | harga | subtotal | total | tunai |
| 020.1... | 01/05/2026 | Ayam Rolade | 1 | 9900 | 9900 | 103500 | 103500 |
| 020.1... | 01/05/2026 | P.Catch... | 1 | 18500 | 18500 | 103500 | 103500 |
| ... (data berulang) |

1NF (First Normal Form):
- Hilangkan grup berulang
- Setiap kolom atomic
- Hasil: Tabel dipsiah menjadi:
  * pelanggan, kasir, barang, transaksi, detail_transaksi

2NF (Second Normal Form):
- Hilangkan dependensi parsial
- Setiap atribut non-key bergantung penuh pada PK
- Hasil: barang dipisah dari transaksi

3NF (Third Normal Form):
- Hilangkan dependensi transitif
- Tidak ada atribut non-key yang bergantung pada atribut non-key lainnya
- Hasil: Struktur final dengan 5 tabel

ERD RELATIONSHIPS:
- pelanggan (1) ---- (N) transaksi
- kasir (1) ---- (N) transaksi
- transaksi (1) ---- (N) detail_transaksi
- barang (1) ---- (N) detail_transaksi

KARDINALITAS:
- One-to-Many: pelanggan ke transaksi
- One-to-Many: kasir ke transaksi
- One-to-Many: transaksi ke detail_transaksi
- One-to-Many: barang ke detail_transaksi
*/

-- ========================================================
-- SELESAI
-- ========================================================
