# O! Save - Dokumentasi Struktur Database Lengkap

## A. Analisis Data dari Struk

### Entitas yang Teridentifikasi:
1. **Toko** - Informasi toko O! Save (tidak disimpan sebagai entitas terpisah)
2. **Pelanggan** - Pembeli (bisa anonim)
3. **Kasir** - Petugas kasir
4. **Barang** - Produk yang dijual
5. **Transaksi** - Header transaksi pembelian
6. **Detail_Transaksi** - Item barang per transaksi

### Atribut dari Struk O! Save:
- **No. Transaksi**: `020.1.2004.290185.01/05/2026`
- **Tanggal**: `01/05/2026 14:27`
- **Total Item**: `9`
- **Subtotal**: `Rp 103.500`
- **Tunai**: `Rp 103.500`
- **Kembalian**: `Rp 0`

### Data Barang dari Struk:
| No | Kode | Nama Barang | Qty | Harga Satuan | Subtotal |
|----|------|-------------|-----|--------------|----------|
| 1 | AYM001 | Ayam Rolade Chicken 225gr | 1 | 9.900 | 9.900 |
| 2 | SHU001 | P.Catch Shrimp Shumai 250gr | 1 | 18.500 | 18.500 |
| 3 | KEN001 | FF Kentang Manis Putih 545gr | 1 | 17.900 | 17.900 |
| 4 | KTL001 | Kental Manis Putih 545gr | 1 | 17.900 | 17.900 |
| 5 | MIN001 | Kampak Emas Minyak Goreng 300 | 1 | 12.300 | 12.300 |
| 6 | CBL001 | Dua belibis Chili Sauce 235ml | 1 | 4.500 | 4.500 |
| 7 | LRX001 | Laurier Xtra Maxi Non Wing 2 | 1 | 17.900 | 17.900 |
| 8 | UBS001 | Unibis Marie Susu 198g | 4 | 7.500 | 30.000 |

---

## B. Proses Normalisasi

### UNF (Unnormalized Form) - Data Mentah
Tabel dengan semua data dalam satu baris (berulang untuk setiap item):

```
| no_transaksi | tanggal | nama_barang | qty | harga_satuan | subtotal | total | tunai |
|--------------|---------|-------------|-----|--------------|----------|-------|-------|
| 020.1.2004... | 01/05/2026 14:27 | Ayam Rolade | 1 | 9900 | 9900 | 103500 | 103500 |
| 020.1.2004... | 01/05/2026 14:27 | P.Catch... | 1 | 18500 | 18500 | 103500 | 103500 |
| ... (data berulang) |
```

**Masalah UNF:**
- Data berulang (redundansi)
- Tidak atomic
- Sulit di-maintain

### 1NF (First Normal Form)
**Syarat:**
- Hilangkan grup berulang
- Setiap kolom atomic (tidak bisa dibagi lagi)
- Setiap baris unik

**Hasil:**
Tabel dipisah menjadi 5 tabel:
- `pelanggan`
- `kasir`  
- `barang`
- `transaksi`
- `detail_transaksi`

### 2NF (Second Normal Form)
**Syarat:**
- Sudah 1NF
- Hilangkan dependensi parsial (atribut non-key bergantung pada sebagian PK)

**Hasil:**
- Tabel `barang` berisi data produk independen
- Tabel `transaksi` hanya berisi header transaksi
- Tabel `detail_transaksi` menyimpan item per transaksi

### 3NF (Third Normal Form)
**Syarat:**
- Sudah 2NF
- Hilangkan dependensi transitif (atribut non-key bergantung pada atribut non-key lain)

**Hasil:**
- `nama_barang`, `harga_satuan` tidak disimpan ulang di `transaksi`
- `transaksi` hanya mengacu ke `pelanggan` dan `kasir`
- `detail_transaksi` mengacu langsung ke `barang`

---

## C. Perancangan ERD (Entity Relationship Diagram)

```
┌─────────────────────────────────────────────────────────────────────┐
│                         ERD O! SAVE                                  │
└─────────────────────────────────────────────────────────────────────┘

    ┌─────────────┐         ┌───────────────────┐         ┌─────────────┐
    │  PELANGGAN  │         │    TRANSAKSI      │         │    KASIR    │
    ├─────────────┤         ├───────────────────┤         ├─────────────┤
    │ id_pelanggan│◄────────┤ id_transaksi (PK) │────────►│ id_kasir    │
    │ nama        │   1:N   │ no_transaksi      │   N:1   │ nama_kasir  │
    │ no_telp     │         │ tanggal           │         │ username    │
    │ alamat      │         │ id_pelanggan (FK) │         └─────────────┘
    └─────────────┘         │ id_kasir (FK)     │
                            │ total_item        │
                            │ total_harga       │
                            │ tunai             │
                            │ kembalian         │
                            └─────────┬─────────┘
                                      │
                                      │ 1:N
                                      ▼
                            ┌───────────────────────┐
                            │   DETAIL_TRANSAKSI    │
                            ├───────────────────────┤
                            │ id_detail_transaksi   │
                            │ id_transaksi (FK) ◄───┘
                            │ id_barang (FK) ───────►┌─────────────┐
                            │ qty                    │   BARANG    │
                            │ harga_satuan           ├─────────────┤
                            │ subtotal               │ id_barang   │
                            └────────────────────────┤ kode_barang │
                                                       │ nama_barang │
                                                       │ satuan      │
                                                       │ harga_satuan│
                                                       └─────────────┘
```

### Kardinalitas:
| Relasi | Kardinalitas | Keterangan |
|--------|--------------|------------|
| Pelanggan → Transaksi | 1 : N | Satu pelanggan bisa punya banyak transaksi |
| Kasir → Transaksi | 1 : N | Satu kasir bisa memproses banyak transaksi |
| Transaksi → Detail_Transaksi | 1 : N | Satu transaksi punya banyak detail item |
| Barang → Detail_Transaksi | 1 : N | Satu barang bisa muncul di banyak transaksi |

---

## D. Implementasi Fisik Database (DDL)

### 1. CREATE DATABASE
```sql
CREATE DATABASE IF NOT EXISTS osave_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE osave_db;
```

### 2. CREATE TABLE - PELANGGAN
```sql
CREATE TABLE pelanggan (
    id_pelanggan BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_pelanggan VARCHAR(100) NOT NULL DEFAULT 'Anonim',
    no_telp VARCHAR(20) DEFAULT NULL,
    alamat TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;
```

### 3. CREATE TABLE - KASIR
```sql
CREATE TABLE kasir (
    id_kasir BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_kasir VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;
```

### 4. CREATE TABLE - BARANG
```sql
CREATE TABLE barang (
    id_barang BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(20) NOT NULL UNIQUE,
    nama_barang VARCHAR(200) NOT NULL,
    satuan VARCHAR(20) DEFAULT 'pcs',
    harga_satuan BIGINT UNSIGNED NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;
```

### 5. CREATE TABLE - TRANSAKSI
```sql
CREATE TABLE transaksi (
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
    
    CONSTRAINT fk_transaksi_pelanggan 
        FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id_pelanggan)
        ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT fk_transaksi_kasir 
        FOREIGN KEY (id_kasir) REFERENCES kasir(id_kasir)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;
```

### 6. CREATE TABLE - DETAIL_TRANSAKSI
```sql
CREATE TABLE detail_transaksi (
    id_detail_transaksi BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_transaksi BIGINT UNSIGNED NOT NULL,
    id_barang BIGINT UNSIGNED NOT NULL,
    qty INT UNSIGNED NOT NULL DEFAULT 1,
    harga_satuan BIGINT UNSIGNED NOT NULL DEFAULT 0,
    subtotal BIGINT UNSIGNED NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    CONSTRAINT fk_detail_transaksi 
        FOREIGN KEY (id_transaksi) REFERENCES transaksi(id_transaksi)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_detail_barang 
        FOREIGN KEY (id_barang) REFERENCES barang(id_barang)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;
```

### Constraints Summary:
| Constraint | Tabel | Kolom | Tipe |
|------------|-------|-------|------|
| PRIMARY KEY | pelanggan | id_pelanggan | PK |
| PRIMARY KEY | kasir | id_kasir | PK |
| PRIMARY KEY | barang | id_barang | PK |
| UNIQUE | barang | kode_barang | Unique |
| PRIMARY KEY | transaksi | id_transaksi | PK |
| UNIQUE | transaksi | no_transaksi | Unique |
| FOREIGN KEY | transaksi | id_pelanggan | FK → pelanggan |
| FOREIGN KEY | transaksi | id_kasir | FK → kasir |
| PRIMARY KEY | detail_transaksi | id_detail_transaksi | PK |
| FOREIGN KEY | detail_transaksi | id_transaksi | FK → transaksi |
| FOREIGN KEY | detail_transaksi | id_barang | FK → barang |

---

## E. Input Data (DML)

### 1. Data Pelanggan
```sql
INSERT INTO pelanggan (id_pelanggan, nama_pelanggan, no_telp, alamat) VALUES
(1, 'Anonim', NULL, NULL);
```

### 2. Data Kasir
```sql
INSERT INTO kasir (id_kasir, nama_kasir, username) VALUES
(1, 'Kasir 1', 'kasir01');
```

### 3. Data Barang
```sql
INSERT INTO barang (id_barang, kode_barang, nama_barang, satuan, harga_satuan) VALUES
(1, 'AYM001', 'Ayam Rolade Chicken 225gr', 'pcs', 9900),
(2, 'SHU001', 'P.Catch Shrimp Shumai 250gr', 'pcs', 18500),
(3, 'KEN001', 'FF Kentang Manis Putih 545gr', 'pcs', 17900),
(4, 'KTL001', 'Kental Manis Putih 545gr', 'pcs', 17900),
(5, 'MIN001', 'Kampak Emas Minyak Goreng 300', 'pcs', 12300),
(6, 'CBL001', 'Dua belibis Chili Sauce 235ml', 'pcs', 4500),
(7, 'LRX001', 'Laurier Xtra Maxi Non Wing 2', 'pcs', 17900),
(8, 'UBS001', 'Unibis Marie Susu 198g', 'pcs', 7500);
```

### 4. Data Transaksi
```sql
INSERT INTO transaksi (id_transaksi, no_transaksi, tanggal, id_pelanggan, id_kasir, total_item, total_harga, tunai, kembalian) VALUES
(1, '020.1.2004.290185.01/05/2026', '2026-05-01 14:27:00', 1, 1, 9, 103500, 103500, 0);
```

### 5. Data Detail Transaksi
```sql
INSERT INTO detail_transaksi (id_detail_transaksi, id_transaksi, id_barang, qty, harga_satuan, subtotal) VALUES
(1, 1, 1, 1, 9900, 9900),
(2, 1, 2, 1, 18500, 18500),
(3, 1, 3, 1, 17900, 17900),
(4, 1, 4, 1, 17900, 17900),
(5, 1, 5, 1, 12300, 12300),
(6, 1, 6, 1, 4500, 4500),
(7, 1, 7, 1, 17900, 17900),
(8, 1, 8, 4, 7500, 30000);
```

---

## F. Query Contoh

### 1. Lihat Semua Transaksi dengan Detail
```sql
SELECT 
    t.no_transaksi,
    t.tanggal,
    p.nama_pelanggan,
    k.nama_kasir,
    t.total_harga,
    t.tunai,
    t.kembalian
FROM transaksi t
LEFT JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
LEFT JOIN kasir k ON t.id_kasir = k.id_kasir;
```

### 2. Lihat Detail Barang per Transaksi
```sql
SELECT 
    t.no_transaksi,
    b.kode_barang,
    b.nama_barang,
    dt.qty,
    dt.harga_satuan,
    dt.subtotal
FROM detail_transaksi dt
JOIN transaksi t ON dt.id_transaksi = t.id_transaksi
JOIN barang b ON dt.id_barang = b.id_barang
WHERE t.no_transaksi = '020.1.2004.290185.01/05/2026';
```

### 3. Total Penjualan per Tanggal
```sql
SELECT 
    DATE(tanggal) as tanggal,
    COUNT(*) as jumlah_transaksi,
    SUM(total_harga) as total_penjualan
FROM transaksi
GROUP BY DATE(tanggal);
```

---

## G. File SQL Lengkap

File SQL lengkap tersedia di:
- **`database/sql/osave_complete.sql`** - Untuk import ke phpMyAdmin

---

## H. Cara Menggunakan

### 1. Import ke phpMyAdmin:
1. Buka phpMyAdmin (http://localhost/phpmyadmin)
2. Klik "New" untuk buat database baru
3. Ketik nama database: `osave_db`
4. Klik "Create"
5. Klik tab "Import"
6. Pilih file `database/sql/osave_complete.sql`
7. Klik "Go"

### 2. Jalankan Laravel:
```bash
# Install dependencies
composer install
npm install

# Setup environment
copy .env.example .env
php artisan key:generate

# Jalankan migrasi dan seeder
php artisan migrate:fresh --seed

# Jalankan server
php artisan serve
```

### 3. Akses Website:
- Buka browser: `http://localhost:8000`

---

## I. Struktur File Project

```
osave-laravel/
├── app/
│   ├── Models/
│   │   ├── Pelanggan.php
│   │   ├── Kasir.php
│   │   ├── Barang.php
│   │   ├── Transaksi.php
│   │   └── DetailTransaksi.php
│   └── Http/Controllers/
│       ├── TransactionController.php
│       └── BarangController.php
├── database/
│   ├── migrations/
│   │   ├── 2026_05_03_000001_create_pelanggan_table.php
│   │   ├── 2026_05_04_000001_create_kasir_table.php
│   │   ├── 2026_05_04_000002_create_barang_table.php
│   │   ├── 2026_05_04_000003_create_transaksi_table.php
│   │   └── 2026_05_04_000004_create_detail_transaksi_table.php
│   ├── seeders/
│   │   ├── PelangganSeeder.php
│   │   ├── KasirSeeder.php
│   │   ├── BarangSeeder.php
│   │   ├── TransaksiSeeder.php
│   │   └── DetailTransaksiSeeder.php
│   └── sql/
│       └── osave_complete.sql
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php
│   ├── transactions/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   ├── edit.blade.php
│   │   └── show.blade.php
│   └── barang/
│       ├── index.blade.php
│       ├── create.blade.php
│       └── edit.blade.php
└── routes/
    └── web.php
```

---

**Selesai! Database O! Save siap digunakan.**
