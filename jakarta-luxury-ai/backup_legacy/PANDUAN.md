# Panduan Jakarta Luxury AI (Versi PHP)

Website ini telah dikonversi ke **Pure PHP, HTML, dan CSS** untuk kesederhanaan dan kemudahan presentasi.

## Struktur Folder

- `index.php`: Entry point utama aplikasi.
- `aplikasi/`: Berisi logika tampilan.
  - `halaman/`: Konten setiap halaman (beranda, wisata, kuliner, dll).
  - `komponen/`: Komponen yang dipakai berulang (navigasi, kaki halaman).
- `api/`: Backend API untuk database dan integrasi AI.
- `aset/`: Gambar dan file statis lainnya.
- `database.sql`: File database terpadu.

## Cara Menjalankan di Laragon

1. Pastikan Laragon sudah berjalan (Apache & MySQL).
2. Akses `http://jakarta-luxury-ai.test` di browser.
3. Login Admin Demo: `admin@luxury.com` / `admin123`.

## Catatan

- Website ini menggunakan **Tailwind CSS via CDN**, jadi tidak perlu proses `npm install` atau `npm run build`.
- Interaksi dinamis dikelola menggunakan JavaScript Fetch API yang terhubung ke backend PHP di folder `api/`.

