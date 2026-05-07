# Panduan Import ke phpMyAdmin dan Laragon

## 1. Jalankan Laragon

- Buka Laragon.
- Klik `Start All`.
- Pastikan `Apache` dan `MySQL` aktif.

## 2. Buka project website

- Simpan project ini di folder `D:\laragon\www\Mobile Computing Flutter`.
- Buka browser:
  - `http://localhost/Mobile%20Computing%20Flutter/`
  - atau buat virtual host Laragon jika diinginkan.

## 3. Import database ke phpMyAdmin

- Buka [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
- Klik tab `Import`.
- Pilih file [alfamart_laragon_ready.sql](/D:/laragon/www/Mobile%20Computing%20Flutter/database/alfamart_laragon_ready.sql)
- Klik `Import`.

File ini akan:
- membuat database `alfamart`
- membuat tabel `users`, `categories`, `products`, `orders`, `order_items`
- mengisi contoh daftar harga barang ala Alfamart

## 4. Cek koneksi website

Setelah import berhasil, buka:

- [index.php](/D:/laragon/www/Mobile%20Computing%20Flutter/index.php)
- [health API](/D:/laragon/www/Mobile%20Computing%20Flutter/api/health.php)

## 5. Endpoint yang bisa dipakai

- [api/products/list.php](/D:/laragon/www/Mobile%20Computing%20Flutter/api/products/list.php)
- [api/categories/list.php](/D:/laragon/www/Mobile%20Computing%20Flutter/api/categories/list.php)
- [api/dashboard/summary.php](/D:/laragon/www/Mobile%20Computing%20Flutter/api/dashboard/summary.php)

## 6. Struktur database singkat

- `users`: data admin dan pelanggan
- `categories`: kategori barang
- `products`: daftar harga, SKU, stok, rating
- `orders`: header transaksi
- `order_items`: detail barang per transaksi

## 7. Jika database Anda berbeda

Edit file [database.php](/D:/laragon/www/Mobile%20Computing%20Flutter/api/config/database.php) dan ubah:

- `host`
- `db_name`
- `username`
- `password`
