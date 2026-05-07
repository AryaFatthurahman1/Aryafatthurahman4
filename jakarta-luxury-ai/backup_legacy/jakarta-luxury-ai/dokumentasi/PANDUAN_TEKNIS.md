# Panduan Teknis Jakarta Luxury AI

Dokumen ini menjelaskan struktur teknologi, cara setup, dan perintah-perintah yang tersedia dalam proyek ini.

## 🛠 Tech Stack

Proyek ini dibangun menggunakan kombinasi teknologi modern:

- **Frontend**: [React 18](https://reactjs.org/) + [TypeScript](https://www.typescriptlang.org/)
- **Build Tool**: [Vite](https://vitejs.dev/)
- **Styling**: [Tailwind CSS](https://tailwindcss.com/)
- **Backend API**: [PHP 8.2+](https://www.php.net/) (Manual API, bukan Laravel)
- **Database**: [MySQL](https://www.mysql.com/)
- **AI Integration**: [Google Gemini API](https://ai.google.dev/)

## 🚀 Perintah Penting (CLI)
>
> [!IMPORTANT]
> Proyek ini **BUKAN** Laravel. Jangan gunakan perintah `php artisan`. Berikut adalah perintah yang benar:

### Frontend (Development)

Menjalankan server pengembangan Vite dengan Hot Module Replacement (HMR).

```bash
npm run dev
```

Default akses: [http://localhost:5173](http://localhost:5173)

### Frontend (Production Build)

Mengompilasi aset untuk produksi (akan menghasilkan folder `dist/`).

```bash
npm run build
```

### Database & Backend

Karena backend menggunakan PHP manual di Laragon:

1. Pastikan **Laragon** berjalan (Apache & MySQL aktif).
2. Gunakan script setup untuk inisialisasi database:

```bash
php skrip/setup.php
```

## 📁 Struktur Folder Utama

- `api/` - Endpoint backend (PHP).
- `src/` - Kode sumber frontend (React components, services, styles).
- `database/` - Skema dan migrasi SQL.
- `konfigurasi/` - File konfigurasi proyek.
- `skrip/` - Utility scripts untuk maintenance.

## 🔌 Cara Setup Virtual Host

Untuk mengakses via [http://jakarta-luxury-ai.test](http://jakarta-luxury-ai.test):

1. Copy `konfigurasi/jakarta-luxury-ai.test.conf` ke folder sites-enabled Apache Laragon.
2. Tambahkan `127.0.0.1 jakarta-luxury-ai.test` ke file `hosts` Windows.
3. Restart Apache.

Lihat panduan lengkap di [SETUP_VIRTUAL_HOST.md](file:///d:/laragon/www/jakarta-luxury-ai/dokumentasi/SETUP_VIRTUAL_HOST.md).

## ⚠️ Troubleshooting

### Error: "php artisan command not found"

**Penyebab**: Anda mencoba menjalankan perintah Laravel di proyek React/Vite.  
**Solusi**: Gunakan `npm run dev` untuk menjalankan aplikasi.

### Gambar Tidak Muncul

**Penyebab**: Browser memblokir mixed content atau URL Unsplash tidak valid.  
**Solusi**: Pastikan koneksi internet aktif karena gambar diambil dari Unsplash API.

### Database Connection Error

**Penyebab**: Konfigurasi di `api/config/database.php` tidak sesuai dengan setting Laragon Anda.  
**Solusi**: Sesuaikan user, password, dan nama database di file tersebut.
