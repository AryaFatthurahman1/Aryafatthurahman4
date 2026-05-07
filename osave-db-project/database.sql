-- SCRIPT DATABASE TOKO O! SAVE
-- DBMS: MySQL / MariaDB (Laragon)

CREATE DATABASE IF NOT EXISTS osave_db;
USE osave_db;

-- 1. Tabel Toko
CREATE TABLE IF NOT EXISTS toko (
    id_toko VARCHAR(10) PRIMARY KEY,
    nama_toko VARCHAR(100) NOT NULL,
    alamat TEXT,
    npwp VARCHAR(50)
);

-- 2. Tabel Kasir
CREATE TABLE IF NOT EXISTS kasir (
    id_kasir VARCHAR(10) PRIMARY KEY,
    nama_kasir VARCHAR(100) NOT NULL
);

-- 3. Tabel Pelanggan
CREATE TABLE IF NOT EXISTS pelanggan (
    id_pelanggan VARCHAR(10) PRIMARY KEY,
    nama_pelanggan VARCHAR(100) NOT NULL
);

-- 4. Tabel Barang
CREATE TABLE IF NOT EXISTS barang (
    id_barang VARCHAR(20) PRIMARY KEY,
    nama_barang VARCHAR(150) NOT NULL,
    harga_satuan DECIMAL(10, 2) NOT NULL
);

-- 5. Tabel Transaksi
CREATE TABLE IF NOT EXISTS transaksi (
    id_transaksi VARCHAR(20) PRIMARY KEY,
    id_toko VARCHAR(10),
    id_kasir VARCHAR(10),
    id_pelanggan VARCHAR(10),
    tanggal DATE NOT NULL,
    waktu TIME NOT NULL,
    total_harga DECIMAL(12, 2) NOT NULL,
    metode_pembayaran VARCHAR(20),
    jumlah_bayar DECIMAL(12, 2),
    FOREIGN KEY (id_toko) REFERENCES toko(id_toko),
    FOREIGN KEY (id_kasir) REFERENCES kasir(id_kasir),
    FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id_pelanggan)
);

-- 6. Tabel Detail Transaksi
CREATE TABLE IF NOT EXISTS detail_transaksi (
    id_detail INT AUTO_INCREMENT PRIMARY KEY,
    id_transaksi VARCHAR(20),
    id_barang VARCHAR(20),
    qty INT NOT NULL,
    harga_at_sale DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(12, 2) NOT NULL,
    FOREIGN KEY (id_transaksi) REFERENCES transaksi(id_transaksi),
    FOREIGN KEY (id_barang) REFERENCES barang(id_barang)
);

-- DML: INPUT DATA BERDASARKAN STRUK
-- Data Toko
INSERT IGNORE INTO toko VALUES ('020', 'O! Save', 'Jl. Komarudin Lama RT.7 RW.5 Kel. Pulo Gebang Kec. Cakung', '20.786.546.0-427.000');

-- Data Kasir
INSERT IGNORE INTO kasir VALUES ('2004', 'Kasir Staff 2004');

-- Data Pelanggan (Guest)
INSERT IGNORE INTO pelanggan VALUES ('GUEST', 'Pelanggan Umum');

-- Data Barang
INSERT IGNORE INTO barang VALUES 
('B001', 'Ayoma Rolade Chicken 225gr', 9900.00),
('B002', 'P.Catch Shrimp Shumai 250gr', 18500.00),
('B003', 'FF Kental Manis Putih 545gr', 17900.00),
('B004', 'Kampak Emas Minyak Goreng 800', 17900.00),
('B005', 'Dua belibis Chili Sauce 235m', 12300.00),
('B006', 'Laurier Xtra Maxi Non Wing 2', 4500.00),
('B007', 'Unibis Marie Susu 198g', 7500.00);

-- Data Transaksi
INSERT IGNORE INTO transaksi VALUES ('290185', '020', '2004', 'GUEST', '2026-05-01', '14:27:00', 103500.00, 'CASH', 103500.00);

-- Data Detail Transaksi
INSERT IGNORE INTO detail_transaksi (id_transaksi, id_barang, qty, harga_at_sale, subtotal) VALUES 
('290185', 'B001', 1, 9900.00, 9900.00),
('290185', 'B002', 1, 18500.00, 18500.00),
('290185', 'B003', 1, 17900.00, 17900.00),
('290185', 'B004', 1, 17900.00, 17900.00),
('290185', 'B005', 1, 12300.00, 12300.00),
('290185', 'B006', 1, 4500.00, 4500.00),
('290185', 'B007', 3, 7500.00, 22500.00);

-- QUERY TEST
SELECT 
    t.id_transaksi, 
    b.nama_barang, 
    dt.qty, 
    dt.harga_at_sale, 
    dt.subtotal
FROM transaksi t
JOIN detail_transaksi dt ON t.id_transaksi = dt.id_transaksi
JOIN barang b ON dt.id_barang = b.id_barang
WHERE t.id_transaksi = '290185';
