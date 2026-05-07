# Dokumentasi Database Alfamart

## Deskripsi Sistem

Database ini dirancang untuk sistem e-commerce/retail seperti Alfamart dengan fitur-fitur lengkap untuk manajemen produk, pesanan, pembayaran, dan pengiriman.

---

## Struktur Database

### 1. **USERS (Pengguna)**
- Menyimpan data pelanggan, admin, dan staff
- Fields: username, email, password, alamat, tipe pengguna
- Relations: One-to-Many dengan Orders, Reviews, Shopping Cart

### 2. **CATEGORIES (Kategori Produk)**
- Klasifikasi produk ke kategori
- Contoh: Makanan, Elektronik, Pakaian, dll

### 3. **PRODUCTS (Produk)**
- Data produk utama
- Atribut: nama, harga, stok, SKU, gambar
- Terhubung ke kategori dan orders melalui order items

### 4. **STOCK_LOGS (Log Stok)**
- Mencatat setiap perubahan stok
- Tipe: purchase, sale, adjustment, return
- Untuk tracking dan audit trail

### 5. **ORDERS (Pesanan)**
- Pesanan utama dari pelanggan
- Status: pending, confirmed, paid, shipped, delivered, cancelled
- Total: subtotal, pajak, diskon, amount akhir

### 6. **ORDER_ITEMS (Detail Pesanan)**
- Rincian barang dalam setiap pesanan
- Menyimpan: quantity, unit_price, subtotal per item

### 7. **PAYMENTS (Pembayaran)**
- Rekam transaksi pembayaran
- Status: pending, completed, failed, refunded
- Metode: cash, debit, credit, transfer, e_wallet

### 8. **SHIPMENTS (Pengiriman)**
- Data pengiriman barang
- Tracking number dan estimasi delivery
- Status pengiriman real-time

### 9. **RETURNS (Pengembalian)**
- Pesanan yang dikembalikan
- Alasan dan status retur
- Jumlah refund

### 10. **PROMOTIONS (Promosi)**
- Kode promo dan diskon
- Tipe: persentase atau fixed amount
- Masa berlaku dan batasan penggunaan

### 11. **REVIEWS (Ulasan Produk)**
- Rating dan review dari pelanggan
- Rating 1-5 bintang
- Helpful count untuk ranking

### 12. **SHOPPING_CART (Keranjang)**
- Keranjang belanja sementara
- Relasi user ke products

### 13. **WISHLIST**
- Daftar keinginan produk
- Untuk user tracking produk favorit

### 14. **ACTIVITY_LOGS (Log Aktivitas)**
- Audit trail semua aktivitas
- Siapa, apa, kapan, IP address
- Untuk keamanan dan compliance

---

## Cara Import Database ke phpMyAdmin

### Langkah 1: Buka phpMyAdmin
1. Akses `http://localhost/phpmyadmin`
2. Login dengan username dan password MySQL

### Langkah 2: Buat Database Baru
1. Klik menu "Databases"
2. Masukkan nama database: **alfamart**
3. Pilih collation: **utf8mb4_unicode_ci**
4. Klik "Create"

### Langkah 3: Import SQL File
1. Pilih database yang baru dibuat (alfamart)
2. Klik tab **"Import"**
3. Pilih file `alfamart_schema.sql`
4. Klik "Go" atau "Import"
5. Tunggu proses selesai

### Langkah 4: Verifikasi
1. Refresh halaman
2. Di sidebar sebelah kiri, buka database alfamart
3. Verifikasi 14 tabel sudah ada:
   - users
   - categories
   - products
   - stock_logs
   - orders
   - order_items
   - payments
   - shipments
   - returns
   - promotions
   - reviews
   - shopping_cart
   - wishlist
   - activity_logs

---

## Views (Pandangan) yang Tersedia

### 1. **daily_sales_summary**
Menampilkan ringkasan penjualan harian:
- Jumlah pesanan
- Total revenue
- Jumlah pelanggan unik
- Rata-rata nilai pesanan

```sql
SELECT * FROM daily_sales_summary WHERE sale_date = '2024-01-15';
```

### 2. **best_selling_products**
Produk dengan penjualan terbanyak:
- Total terjual
- Total revenue per produk
- Jumlah pesanan yang mengandung produk

```sql
SELECT * FROM best_selling_products LIMIT 10;
```

### 3. **customer_order_history**
Riwayat lengkap pesanan pelanggan:
- Nama pelanggan
- Nomor pesanan
- Status pesanan
- Jumlah item

```sql
SELECT * FROM customer_order_history WHERE user_id = 1;
```

---

## Stored Procedures

### 1. **CreateNewOrder**
Membuat pesanan baru dengan validasi otomatis

```sql
CALL CreateNewOrder(
    1,                    -- user_id
    100000,              -- total_amount
    10000,               -- tax_amount
    5000,                -- discount_amount
    'cash',              -- payment_method
    @order_id            -- output parameter
);

SELECT @order_id;  -- Lihat order_id yang dibuat
```

### 2. **UpdateProductStock**
Update stok produk dengan log otomatis

```sql
CALL UpdateProductStock(
    1,          -- product_id
    -5,         -- quantity_change (minus untuk penjualan)
    'sale',     -- log_type
    1           -- reference_id (order_id)
);
```

---

## Contoh Query Umum

### 1. Lihat Semua Pesanan Hari Ini
```sql
SELECT o.order_id, o.order_number, u.full_name, o.final_amount, o.order_status
FROM orders o
JOIN users u ON o.user_id = u.user_id
WHERE DATE(o.order_date) = CURDATE()
ORDER BY o.order_date DESC;
```

### 2. Lihat Stok Produk yang Menipis (< 10)
```sql
SELECT product_id, product_name, sku, stock, price
FROM products
WHERE stock < 10
ORDER BY stock ASC;
```

### 3. Hitung Revenue Bulanan
```sql
SELECT 
    DATE_FORMAT(o.order_date, '%Y-%m') as bulan,
    SUM(o.final_amount) as total_revenue,
    COUNT(DISTINCT o.order_id) as jumlah_pesanan
FROM orders o
WHERE o.order_status IN ('paid', 'shipped', 'delivered')
GROUP BY DATE_FORMAT(o.order_date, '%Y-%m')
ORDER BY bulan DESC;
```

### 4. Pelanggan dengan Pembelian Terbanyak
```sql
SELECT 
    u.user_id,
    u.full_name,
    u.email,
    COUNT(o.order_id) as jumlah_pesanan,
    SUM(o.final_amount) as total_belanja,
    AVG(o.final_amount) as rata_rata_belanja
FROM users u
LEFT JOIN orders o ON u.user_id = o.user_id
GROUP BY u.user_id
ORDER BY total_belanja DESC
LIMIT 10;
```

### 5. Detail Pesanan dengan Barangnya
```sql
SELECT 
    o.order_number,
    o.order_date,
    u.full_name,
    p.product_name,
    oi.quantity,
    oi.unit_price,
    oi.subtotal
FROM orders o
JOIN users u ON o.user_id = u.user_id
JOIN order_items oi ON o.order_id = oi.order_id
JOIN products p ON oi.product_id = p.product_id
WHERE o.order_id = 1
ORDER BY oi.order_item_id;
```

---

## Relasi Antar Tabel

```
users (1) ──→ (M) orders
           ──→ (M) reviews
           ──→ (M) shopping_cart
           ──→ (M) wishlist
           ──→ (M) activity_logs

categories (1) ──→ (M) products

products (1) ──→ (M) order_items
           ──→ (M) reviews
           ──→ (M) stock_logs
           ──→ (M) shopping_cart
           ──→ (M) wishlist

orders (1) ──→ (M) order_items
         ──→ (1) payments
         ──→ (1) shipments
         ──→ (1) returns

order_items (M) ──→ (1) products
```

---

## Index untuk Performa

Database sudah memiliki index pada kolom-kolom yang sering di-query:
- `orders.order_status` dan `orders.order_date` - untuk laporan penjualan
- `products.category_id` - untuk filter kategori
- `order_items.order_id` - untuk detail pesanan
- `users.email` dan `users.username` - untuk login
- `reviews.product_id` dan `reviews.rating` - untuk rating produk

---

## Maintenance

### Backup Database
```sql
-- Lakukan backup rutin melalui phpMyAdmin
-- Menu: Export → pilih format SQL
```

### Hapus Data Lama
```sql
-- Hapus log aktivitas lebih dari 1 tahun
DELETE FROM activity_logs 
WHERE log_timestamp < DATE_SUB(NOW(), INTERVAL 1 YEAR);
```

### Optimize Table
```sql
-- Optimasi tabel untuk performa lebih baik
OPTIMIZE TABLE orders, order_items, products, users;
```

---

## Keamanan

### User Privileges (Best Practice)
```sql
-- Buat user untuk aplikasi
CREATE USER 'alfamart_user'@'localhost' IDENTIFIED BY 'secure_password_123';

-- Grant privileges
GRANT SELECT, INSERT, UPDATE, DELETE ON alfamart.* TO 'alfamart_user'@'localhost';
GRANT EXECUTE ON alfamart.* TO 'alfamart_user'@'localhost';

FLUSH PRIVILEGES;
```

---

## Troubleshooting

### Error: "Foreign Key Constraint Failed"
- Pastikan record parent ada sebelum insert child
- Contoh: Harus ada user sebelum membuat order

### Error: "Duplicate Entry"
- Field unique sudah ada nilai yang sama
- Check: username, email, SKU, tracking_number

### Query Lambat?
- Gunakan EXPLAIN untuk analisis
- Tambah index pada kolom yang sering di-filter
- Gunakan views untuk query kompleks

---

## Kontak & Support

Untuk pertanyaan lebih lanjut tentang struktur database, silakan referensikan dokumentasi ini atau konsultasikan dengan database administrator.

**Database Created:** 2024
**Compatibility:** MySQL 5.7+, phpMyAdmin 5.0+
