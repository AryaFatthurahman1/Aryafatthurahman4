# 📊 RINGKASAN DATABASE ALFAMART

Berikut adalah semua file yang telah dibuat untuk sistem database Alfamart e-commerce.

---

## 📁 File-File yang Dibuat

### 1. **`database/alfamart_schema.sql`** ⭐ FILE UTAMA
   - File SQL lengkap dengan:
     - 14 tabel database
     - Views untuk reporting
     - Stored procedures
     - Data dummy untuk testing
     - Indexes untuk performa
   - **Ukuran:** ~20KB
   - **Gunakan untuk:** Import pertama kali ke phpMyAdmin

### 2. **`database/alfamart_full.sql`**
   - Versi alternatif lebih simple/clean
   - Tanpa comments yang terlalu panjang
   - **Gunakan untuk:** Backup atau jika lebih suka format minimal

### 3. **`database/QUICK_START.md`** ⭐ MULAI DARI SINI
   - Panduan 5 menit untuk import
   - Langkah-langkah dalam bahasa Indonesia
   - Cara test database
   - Contoh query penting
   - **Bacaan wajib untuk pemula!**

### 4. **`database/ALFAMART_DOKUMENTASI.md`** 📖 REFERENSI LENGKAP
   - Penjelasan detail setiap tabel
   - Daftar semua views (3 views)
   - Semua stored procedures (2 procedures)
   - 50+ contoh query umum
   - Tips maintenance & backup
   - Troubleshooting guide

### 5. **`api/API_ENDPOINTS.md`** 🔌 INTEGRASI FLUTTER
   - Contoh kode PHP untuk API
   - 8+ endpoint siap digunakan
   - Authentication (login/register)
   - Products, Cart, Orders APIs
   - Contoh implementasi di Flutter
   - Middleware dan security tips

---

## 🎯 Struktur Tabel Database

```
USERS (Pelanggan, Admin, Staff)
├─ ORDERS (Pesanan)
│  ├─ ORDER_ITEMS (Detail item pesanan)
│  │  └─ PRODUCTS (Data produk)
│  │     └─ CATEGORIES (Kategori produk)
│  ├─ PAYMENTS (Pembayaran)
│  ├─ SHIPMENTS (Pengiriman)
│  └─ RETURNS (Pengembalian)
├─ REVIEWS (Ulasan produk)
├─ SHOPPING_CART (Keranjang sementara)
├─ WISHLIST (Daftar keinginan)
└─ ACTIVITY_LOGS (Log aktivitas)

STOCK_LOGS (Riwayat stok)
PROMOTIONS (Kode promo & diskon)
```

---

## 📊 Tabel-Tabel yang Tersedia

| No | Tabel | Deskripsi | Record |
|----|-------|-----------|--------|
| 1 | **users** | Data pengguna/pelanggan | 3 (dummy) |
| 2 | **categories** | Kategori produk | 5 (dummy) |
| 3 | **products** | Data produk | 10 (dummy) |
| 4 | **stock_logs** | Riwayat perubahan stok | - |
| 5 | **orders** | Pesanan pelanggan | - |
| 6 | **order_items** | Detail item per pesanan | - |
| 7 | **payments** | Data pembayaran | - |
| 8 | **shipments** | Data pengiriman | - |
| 9 | **returns** | Pengembalian barang | - |
| 10 | **promotions** | Kode promo & diskon | - |
| 11 | **reviews** | Rating & review produk | - |
| 12 | **shopping_cart** | Keranjang belanja | - |
| 13 | **wishlist** | Daftar keinginan | - |
| 14 | **activity_logs** | Log semua aktivitas | - |

---

## 📈 3 Views untuk Reporting

### 1. **daily_sales_summary**
```sql
SELECT * FROM daily_sales_summary 
WHERE sale_date = '2024-01-15';
```
Menampilkan: Total orders, revenue, customers, avg order value per hari

### 2. **best_selling_products**
```sql
SELECT * FROM best_selling_products LIMIT 10;
```
Menampilkan: Produk terlaris, quantity terjual, revenue per produk

### 3. **customer_order_history**
```sql
SELECT * FROM customer_order_history 
WHERE user_id = 1;
```
Menampilkan: Riwayat lengkap pesanan pelanggan

---

## ⚙️ 2 Stored Procedures

### 1. **CreateNewOrder()**
```sql
CALL CreateNewOrder(
    user_id, 
    total_amount, 
    tax_amount, 
    discount_amount, 
    payment_method, 
    @order_id
);
```

### 2. **UpdateProductStock()**
```sql
CALL UpdateProductStock(
    product_id, 
    quantity_change, 
    log_type, 
    reference_id
);
```

---

## 🚀 QUICK START (5 Langkah)

### Langkah 1: Buka phpMyAdmin
```
http://localhost/phpmyadmin
```

### Langkah 2: Buat Database
- Klik **"New"** → Nama: `alfamart` → **"Create"**

### Langkah 3: Import SQL
- Pilih database `alfamart`
- Tab **"Import"** → Pilih file `alfamart_schema.sql`
- Klik **"Go"**

### Langkah 4: Verifikasi
- Seharusnya ada 14 tabel
- Ada 3 views
- Ada data dummy (users, categories, products)

### Langkah 5: Test Query
```sql
SELECT COUNT(*) as total_products FROM products;
SELECT COUNT(*) as total_users FROM users;
```

---

## 💡 Contoh Query Penting

### Ambil Semua Produk dengan Kategori
```sql
SELECT p.product_id, p.product_name, c.category_name, p.price, p.stock
FROM products p
JOIN categories c ON p.category_id = c.category_id
WHERE p.is_active = 1
ORDER BY p.product_name;
```

### Ambil Pesanan Hari Ini
```sql
SELECT o.order_number, u.full_name, o.final_amount, o.order_status
FROM orders o
JOIN users u ON o.user_id = u.user_id
WHERE DATE(o.order_date) = CURDATE()
ORDER BY o.order_date DESC;
```

### Revenue Bulanan
```sql
SELECT 
    DATE_FORMAT(o.order_date, '%Y-%m') as bulan,
    SUM(o.final_amount) as total_revenue,
    COUNT(DISTINCT o.order_id) as total_orders
FROM orders o
WHERE o.order_status IN ('paid', 'shipped', 'delivered')
GROUP BY DATE_FORMAT(o.order_date, '%Y-%m');
```

### Top 10 Pelanggan (Berdasarkan Pembelian)
```sql
SELECT 
    u.user_id, u.full_name, u.email,
    COUNT(o.order_id) as total_orders,
    SUM(o.final_amount) as total_spent
FROM users u
LEFT JOIN orders o ON u.user_id = o.user_id
GROUP BY u.user_id
ORDER BY total_spent DESC
LIMIT 10;
```

---

## 🔌 API Integration (Flutter)

File `api/API_ENDPOINTS.md` berisi contoh lengkap untuk:

✅ **Authentication**
- Login: `api/auth/login.php`
- Register: `api/auth/register.php`

✅ **Products**
- Daftar: `api/products/list.php`
- Detail: `api/products/detail.php`

✅ **Shopping Cart**
- Tambah: `api/cart/add.php`
- Ambil: `api/cart/get.php`
- Hapus: `api/cart/remove.php`

✅ **Orders**
- Buat: `api/orders/create.php`
- List: `api/orders/list.php`
- Detail: `api/orders/detail.php`

✅ **Payments**
- Proses: `api/payments/process.php`
- Konfirmasi: `api/payments/confirm.php`

---

## 📱 Integrasi dengan Flutter

```dart
// Contoh di Flutter
import 'package:http/http.dart' as http;

const String API_URL = 'http://localhost/api';

// Get Products
Future<void> getProducts() async {
  final response = await http.get(
    Uri.parse('$API_URL/products/list.php?page=1&limit=10'),
  );
  
  if (response.statusCode == 200) {
    print(response.body); // JSON response
  }
}
```

---

## 🔐 Data Dummy untuk Testing

### Users
- **Customer 1:** customer1@example.com
- **Customer 2:** customer2@example.com  
- **Admin:** admin@example.com

### Categories (5)
- Makanan & Minuman
- Perawatan Diri
- Elektronik & Gadget
- Pakaian & Aksesori
- Rumah Tangga

### Products (10)
- Mie Instan (Rp2.500)
- Kopi Instan (Rp15.000)
- Sampo Rambut (Rp25.000)
- Deodorant (Rp18.000)
- Powerbank (Rp150.000)
- Kabel USB (Rp45.000)
- Kaos Polos (Rp50.000)
- Celana Jeans (Rp120.000)
- Sikat Gigi (Rp12.000)
- Tempat Sampah (Rp35.000)

---

## 📚 Dokumentasi Referensi

| File | Konten | Target |
|------|--------|--------|
| QUICK_START.md | 5 menit import | Beginner ✅ |
| ALFAMART_DOKUMENTASI.md | Lengkap & detail | Developer 📖 |
| API_ENDPOINTS.md | Kode siap pakai | Backend Dev 🔌 |

---

## ✅ Checklist Setup

- [ ] Buka phpMyAdmin
- [ ] Buat database `alfamart`
- [ ] Import `alfamart_schema.sql`
- [ ] Verifikasi 14 tabel ada
- [ ] Test query basic
- [ ] Setup API endpoints (jika perlu)
- [ ] Setup koneksi di Flutter app
- [ ] Test login/register
- [ ] Test product listing
- [ ] Test create order

---

## 🛠️ Troubleshooting

### Import gagal?
1. Cek ukuran file (harus < 2MB)
2. Disable **max_allowed_packet** jika perlu
3. Coba import perlahan (import file yang lebih kecil dulu)

### Foreign key error?
1. Pastikan tabel parent sudah ada
2. Cek relasi tabel benar
3. Gunakan `SET FOREIGN_KEY_CHECKS=0;` saat import

### Koneksi database gagal?
1. Pastikan MySQL running
2. Check username/password di config
3. Verify database name (`alfamart`)

### Query tidak return hasil?
1. Cek data dummy sudah insert
2. Verify kondisi WHERE clause
3. Jalankan `SELECT COUNT(*) FROM table;`

---

## 📞 Tips Maintenance

### Backup Database
```sql
-- Di phpMyAdmin: Export → Format SQL
```

### Optimize Tabel
```sql
OPTIMIZE TABLE orders, products, users, order_items;
```

### Cek Stok Menipis
```sql
SELECT * FROM products WHERE stock < 10;
```

### Laporan Revenue Hari Ini
```sql
SELECT SUM(final_amount) as today_revenue 
FROM orders 
WHERE DATE(order_date) = CURDATE();
```

---

## 🎓 Belajar Lebih Lanjut

1. Baca QUICK_START.md untuk pemula
2. Pelajari ALFAMART_DOKUMENTASI.md untuk detail
3. Lihat API_ENDPOINTS.md untuk integrasi
4. Test query di phpMyAdmin
5. Buat API endpoints sesuai kebutuhan
6. Connect ke Flutter app

---

## 🎉 Selesai!

Database Alfamart sudah siap digunakan!

**Next Steps:**
1. ✅ Setup database (sudah!)
2. ⏳ Create API endpoints (gunakan API_ENDPOINTS.md)
3. ⏳ Connect ke Flutter app
4. ⏳ Test end-to-end
5. ⏳ Deploy ke production

**Happy Coding! 🚀**
