# PANDUAN CEPAT - Import Database Alfamart ke phpMyAdmin

## 🚀 MULAI CEPAT (5 Menit)

### 1️⃣ Siapkan phpMyAdmin

Pastikan Laragon sudah berjalan:
- Buka Laragon Control Panel
- Klik **START ALL** (Apache & MySQL)
- Akses `http://localhost/phpmyadmin`

### 2️⃣ Buat Database Baru

1. Klik **"New"** di sidebar kiri
   ```
   Database name: alfamart
   Collation: utf8mb4_unicode_ci
   ```
2. Klik **"Create"**

### 3️⃣ Import File SQL

1. Pilih database **"alfamart"** yang baru dibuat
2. Klik tab **"Import"**
3. Klik **"Choose File"** → pilih `alfamart_schema.sql`
4. Scroll ke bawah → Klik **"Import"**
5. ✅ Selesai! Database siap digunakan

---

## 📋 Verifikasi Import Berhasil

Di phpMyAdmin, buka tab **"Structure"** dan pastikan ada 14 tabel:

- ✅ users
- ✅ categories  
- ✅ products
- ✅ stock_logs
- ✅ orders
- ✅ order_items
- ✅ payments
- ✅ shipments
- ✅ returns
- ✅ promotions
- ✅ reviews
- ✅ shopping_cart
- ✅ wishlist
- ✅ activity_logs

---

## 🔍 Test Database

### Test 1: Lihat Data Dummy
Di phpMyAdmin, jalankan query ini:

```sql
SELECT * FROM users;
SELECT * FROM categories;
SELECT * FROM products;
```

Seharusnya ada 3 users, 5 categories, dan 10 produk.

### Test 2: Buat Pesanan Baru
```sql
CALL CreateNewOrder(1, 100000, 10000, 5000, 'cash', @order_id);
SELECT @order_id;
```

### Test 3: Lihat Penjualan Harian
```sql
SELECT * FROM daily_sales_summary;
```

---

## 🛠️ Koneksi ke Aplikasi PHP

### File: `config/database.php`

```php
<?php
$db_host = 'localhost';
$db_name = 'alfamart';
$db_user = 'root';
$db_pass = '';

try {
    $pdo = new PDO(
        "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4",
        $db_user,
        $db_pass
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}
```

### File: `config/database.php` (MySQLi)

```php
<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'alfamart';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
```

---

## 📊 Query Contoh Penting

### Ambil Semua Produk
```sql
SELECT p.*, c.category_name, 
       (p.price - p.cost_price) as profit_per_unit
FROM products p
JOIN categories c ON p.category_id = c.category_id
WHERE p.is_active = 1
ORDER BY p.product_name;
```

### Ambil Pesanan Hari Ini
```sql
SELECT o.order_id, o.order_number, u.full_name, 
       o.final_amount, o.order_status, o.payment_method
FROM orders o
JOIN users u ON o.user_id = u.user_id
WHERE DATE(o.order_date) = CURDATE()
ORDER BY o.order_date DESC;
```

### Ambil Detail Pesanan
```sql
SELECT 
    o.order_number,
    u.full_name,
    p.product_name,
    oi.quantity,
    oi.unit_price,
    oi.subtotal
FROM orders o
JOIN users u ON o.user_id = u.user_id
JOIN order_items oi ON o.order_id = oi.order_id
JOIN products p ON oi.product_id = p.product_id
WHERE o.order_id = ?;
```

### Update Status Pesanan
```sql
UPDATE orders 
SET order_status = 'shipped' 
WHERE order_id = ?;
```

### Cek Stok Produk
```sql
SELECT product_id, product_name, sku, stock, price
FROM products
WHERE stock < 20
ORDER BY stock ASC;
```

---

## ⚙️ Setup User Database (Opsional)

Untuk keamanan, buat user khusus:

```sql
CREATE USER 'alfamart_app'@'localhost' IDENTIFIED BY 'MySecurePass123!';
GRANT SELECT, INSERT, UPDATE, DELETE, EXECUTE 
ON alfamart.* TO 'alfamart_app'@'localhost';
FLUSH PRIVILEGES;
```

Gunakan `alfamart_app` / `MySecurePass123!` di config aplikasi.

---

## 🐛 Troubleshooting

| Masalah | Solusi |
|---------|--------|
| Import gagal | Cek ukuran file, disable max_allowed_packet |
| Kolom foreign key error | Pastikan tabel parent ada terlebih dahulu |
| Query result kosong | Verifikasi data dummy sudah terinsert |
| Koneksi denied | Check username/password di config |

---

## 📈 Struktur Hubungan Tabel

```
┌─────────┐
│  USERS  │
└────┬────┘
     │
     ├─→ ORDERS ──→ ORDER_ITEMS ──→ PRODUCTS
     │      │
     │      ├─→ PAYMENTS
     │      ├─→ SHIPMENTS  
     │      └─→ RETURNS
     │
     ├─→ REVIEWS ──→ PRODUCTS
     ├─→ SHOPPING_CART ──→ PRODUCTS
     ├─→ WISHLIST ──→ PRODUCTS
     └─→ ACTIVITY_LOGS

PRODUCTS ──→ CATEGORIES
         ──→ STOCK_LOGS

ORDERS ──→ PROMOTIONS
```

---

## 📝 Catatan Penting

✅ **Email default:**
- Customer: customer1@example.com, customer2@example.com
- Admin: admin@example.com

✅ **Password:** Semua password di data dummy di-hash, gunakan untuk testing saja

✅ **Stok:** Semua produk memiliki stok dummy

✅ **Next Step:** Setup API endpoints PHP untuk menghubungkan ke aplikasi Flutter

---

## 📞 Butuh Bantuan?

Lihat file **ALFAMART_DOKUMENTASI.md** untuk:
- Penjelasan detail setiap tabel
- Stored procedures lebih lanjut
- Advanced queries
- Backup & maintenance

---

**Selamat! Database Alfamart sudah siap digunakan! 🎉**
