# 📋 Alfamart Database Setup Checklist

Gunakan checklist ini untuk tracking progress setup database Alfamart.

---

## ✅ FASE 1: PERSIAPAN (10 Menit)

- [ ] **Pastikan Laragon sudah terinstall**
  - Download dari: https://laragon.org
  - Atau pakai sistem lain (XAMPP, WAMP, dll)

- [ ] **Laragon sudah running**
  - Buka Laragon Control Panel
  - Klik "START ALL" (Apache & MySQL)
  - Verifikasi status: GREEN

- [ ] **phpMyAdmin accessible**
  - Buka: http://localhost/phpmyadmin
  - Jika error, restart Laragon

- [ ] **File database sudah download**
  - ✓ alfamart_schema.sql (22 KB)
  - ✓ alfamart_full.sql (backup)
  - Lokasi: `d:\laragon\www\Mobile Computing Flutter\database\`

---

## ✅ FASE 2: DATABASE CREATION (5 Menit)

### Step 1: Buat Database Baru

- [ ] Login ke phpMyAdmin
  - URL: http://localhost/phpmyadmin
  - User: root
  - Password: (kosong)

- [ ] Klik "New" di sidebar kiri

- [ ] Isi form:
  - Database name: **alfamart**
  - Collation: **utf8mb4_unicode_ci** (pilih dari dropdown)

- [ ] Klik "Create"

- [ ] Verifikasi database muncul di sidebar

### Step 2: Verifikasi Database

- [ ] Database "alfamart" terlihat di sidebar
- [ ] Status: "alfamart" highlighted/selected

---

## ✅ FASE 3: IMPORT SQL FILE (3 Menit)

### Step 1: Import File

- [ ] Pilih database "alfamart" yang baru dibuat

- [ ] Klik tab "Import" (di top menu)

- [ ] Klik "Choose File" button

- [ ] Navigate ke: `database/alfamart_schema.sql`

- [ ] Pilih file & klik "Open"

- [ ] File name terlihat di form: ✓

- [ ] Scroll ke bawah & klik "Go" atau "Import"

- [ ] Tunggu proses selesai...

### Step 2: Verifikasi Import

- [ ] Tidak ada error message
- [ ] Halaman menampilkan "Import successful"
- [ ] Bisa lihat list tabel di sidebar

---

## ✅ FASE 4: VERIFIKASI TABEL (5 Menit)

### Check Tabel-Tabel

Di sidebar, klik database "alfamart", verifikasi ada 14 tabel:

**MASTER DATA**
- [ ] users
- [ ] categories
- [ ] products
- [ ] stock_logs

**TRANSACTIONS**
- [ ] orders
- [ ] order_items
- [ ] payments
- [ ] shipments
- [ ] returns

**USER ACTIONS**
- [ ] reviews
- [ ] shopping_cart
- [ ] wishlist
- [ ] activity_logs

**MARKETING**
- [ ] promotions

### Check Views (3 views)

- [ ] daily_sales_summary
- [ ] best_selling_products
- [ ] customer_order_history

### Check Stored Procedures (2 procedures)

- [ ] CreateNewOrder
- [ ] UpdateProductStock

---

## ✅ FASE 5: DATA DUMMY VERIFICATION (3 Menit)

### Test Data di Database

Di phpMyAdmin, run query ini di tab "SQL":

**Query 1: Count Users**
```sql
SELECT COUNT(*) as total FROM users;
```
- [ ] Result: **3** ✓

**Query 2: Count Categories**
```sql
SELECT COUNT(*) as total FROM categories;
```
- [ ] Result: **5** ✓

**Query 3: Count Products**
```sql
SELECT COUNT(*) as total FROM products;
```
- [ ] Result: **10** ✓

**Query 4: Lihat Products**
```sql
SELECT * FROM products LIMIT 5;
```
- [ ] Bisa lihat data produk ✓
- [ ] Kolom: product_id, product_name, price, stock, dll ✓

**Query 5: Lihat Users**
```sql
SELECT * FROM users;
```
- [ ] User 1: customer1@example.com ✓
- [ ] User 2: customer2@example.com ✓
- [ ] User 3: admin@example.com ✓

---

## ✅ FASE 6: TEST BASIC QUERIES (5 Menit)

Jalankan query-query ini di phpMyAdmin untuk test:

### Test 1: Join Query
```sql
SELECT p.product_name, c.category_name, p.price, p.stock
FROM products p
JOIN categories c ON p.category_id = c.category_id
LIMIT 5;
```
- [ ] Query berhasil ✓
- [ ] Hasil menampilkan produk dengan kategori ✓

### Test 2: Aggregation Query
```sql
SELECT c.category_name, COUNT(p.product_id) as product_count
FROM categories c
LEFT JOIN products p ON c.category_id = p.category_id
GROUP BY c.category_id;
```
- [ ] Query berhasil ✓
- [ ] Lihat jumlah produk per kategori ✓

### Test 3: View Query
```sql
SELECT * FROM best_selling_products;
```
- [ ] Query berhasil ✓
- [ ] View berfungsi dengan baik ✓

### Test 4: Stored Procedure
```sql
CALL CreateNewOrder(1, 100000, 10000, 5000, 'cash', @order_id);
SELECT @order_id;
```
- [ ] Query berhasil ✓
- [ ] Order tercipta dengan ID ✓
- [ ] Cek di tabel orders: `SELECT * FROM orders WHERE order_id = @order_id;` ✓

---

## ✅ FASE 7: DATABASE SETUP COMPLETE ✓

Jika semua check di atas ✓, maka:

- [x] **Database alfamart sudah siap!**
- [x] **14 tabel terinstall**
- [x] **Data dummy ada**
- [x] **Views berfungsi**
- [x] **Stored procedures aktif**

---

## 🔌 FASE 8: KONEKSI KE APPLICATION (Opsional)

### Setup API Connection

- [ ] Baca file: `api/API_ENDPOINTS.md`

- [ ] Copy contoh kode database config

- [ ] Edit file: `api/config/database.php`
  - DB_HOST: localhost
  - DB_USER: root
  - DB_PASS: (kosong)
  - DB_NAME: alfamart

- [ ] Test koneksi dengan simple query

### Setup Flutter Integration

- [ ] Baca file: `api/API_ENDPOINTS.md` bagian Flutter

- [ ] Setup http package di pubspec.yaml:
  ```yaml
  dependencies:
    http: ^0.13.0
  ```

- [ ] Create API service class

- [ ] Test login endpoint

- [ ] Test products listing

---

## 📊 FASE 9: BACKUP & MAINTENANCE

### First Backup

- [ ] Export database sebagai backup pertama
  - phpMyAdmin → Export
  - Format: SQL
  - Simpan dengan nama: `alfamart_backup_20240115.sql`

- [ ] Simpan di folder: `database/backups/`

### Maintenance Checklist

- [ ] Setup backup schedule (weekly)

- [ ] Monitor disk space

- [ ] Check slow queries

- [ ] Optimize tables (monthly)

---

## 🐛 TROUBLESHOOTING CHECKLIST

Jika ada masalah, check:

### Error: Import Failed
- [ ] File SQL ada & bisa dibaca
- [ ] Ukuran file < 2MB
- [ ] Pastikan connected ke database "alfamart"
- [ ] Coba import file yang lebih kecil dulu

### Error: Foreign Key
- [ ] Pastikan tabel parent sudah ada
- [ ] Cek urutan import tabel
- [ ] Verifikasi kolom FK sesuai

### Error: Duplicate Entry
- [ ] Cek field UNIQUE (email, username, SKU)
- [ ] Jangan insert record dengan email sama

### Error: Koneksi Database
- [ ] Pastikan MySQL running
- [ ] Verifikasi username/password
- [ ] Cek database name benar: "alfamart"

### Error: Query Timeout
- [ ] Query terlalu kompleks
- [ ] Tambah LIMIT untuk hasil banyak
- [ ] Cek apakah ada infinite loop

---

## 📚 DOKUMENTASI REFERENCE

Jika butuh bantuan, baca file ini:

| Masalah | Baca File |
|---------|-----------|
| Mulai dari mana? | RINGKASAN_DATABASE.md |
| Cara import? | database/QUICK_START.md |
| Detail tabel? | database/ALFAMART_DOKUMENTASI.md |
| Gambar ER? | database/ER_DIAGRAM_SCHEMA.md |
| API code? | api/API_ENDPOINTS.md |
| Troubleshoot? | database/ALFAMART_DOKUMENTASI.md (bagian Troubleshooting) |

---

## ✨ FINAL CHECKLIST

- [ ] Database "alfamart" ada di phpMyAdmin
- [ ] 14 tabel terinstall dengan benar
- [ ] 3 views berfungsi
- [ ] 2 stored procedures aktif
- [ ] Data dummy tersedia (3 users, 5 categories, 10 products)
- [ ] Basic queries berjalan tanpa error
- [ ] Backup pertama sudah dibuat
- [ ] Siap untuk tahap berikutnya (API development)

---

## 🎉 SELESAI!

Jika semua check ✓, berarti:

**Database Alfamart sudah 100% siap digunakan!**

### Next Steps:
1. ✅ Setup database (DONE!)
2. ⏳ Develop API endpoints
3. ⏳ Setup Flutter app integration
4. ⏳ Testing
5. ⏳ Deployment

---

**Tanggal Selesai: _______________**

**Catatan:**
```
_________________________________________________________________

_________________________________________________________________

_________________________________________________________________
```

---

**Happy Coding! 🚀**
