# Import SQL untuk O! Save

Gunakan file `osave_schema.sql` untuk membuat database MySQL dan memasukkan data awal.

## Cara import di phpMyAdmin
1. Buka phpMyAdmin.
2. Klik `Import`.
3. Pilih file `database/sql/osave_schema.sql`.
4. Jalankan import.

## Setelah import
1. Ubah `DB_DATABASE=osave_db` di file `.env`.
2. Konfigurasikan `DB_USERNAME` dan `DB_PASSWORD` sesuai MySQL.
3. Jika menggunakan Laravel, jalankan:
   - `composer install`
   - `php artisan migrate --seed`

## Akses website
- `http://localhost/osave-laravel/public`
atau jika menggunakan `php artisan serve`:
- `http://127.0.0.1:8000`
