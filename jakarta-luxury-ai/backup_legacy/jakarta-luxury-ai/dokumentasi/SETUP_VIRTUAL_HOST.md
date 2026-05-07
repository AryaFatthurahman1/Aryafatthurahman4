# Panduan Setup Virtual Host

Jakarta Luxury AI: `jakarta-luxury-ai.test`

## Langkah 1: Copy File Virtual Host

1. Buka file `konfigurasi/jakarta-luxury-ai.test.conf`
2. Copy file ini ke folder Laragon Apache:

   ```text
   C:\laragon\etc\apache2\sites-enabled\jakarta-luxury-ai.test.conf
   ```

## Langkah 2: Edit Windows Hosts File

1. Buka Notepad sebagai Administrator
2. Buka file: `C:\Windows\System32\drivers\etc\hosts`
3. Tambahkan baris berikut di akhir file:

   ```text
   127.0.0.1    jakarta-luxury-ai.test
   ```

4. Save file

## Langkah 3: Restart Apache di Laragon

1. Buka Laragon
2. Klik tombol "Stop All"
3. Tunggu beberapa detik
4. Klik tombol "Start All"
5. Pastikan Apache dan MySQL running (hijau)

## Langkah 4: Test Akses

Buka browser dan akses:

- <http://jakarta-luxury-ai.test>

Jika masih error, coba:

- <http://jakarta-luxury-ai.test/index.html>

## Troubleshooting

### Error "Not Found" atau "403 Forbidden"

**Solusi:**

1. Pastikan DocumentRoot di virtual host benar:

   ```text
   DocumentRoot "d:/laragon/www/jakarta-luxury-ai"
   ```

2. Restart Apache di Laragon

### Error "This site can't be reached"

**Solusi:**

1. Cek hosts file sudah benar
2. Flush DNS cache:

   ```cmd
   ipconfig /flushdns
   ```

3. Restart browser

### Halaman Blank / Tidak Ada Styling

**Solusi:**

1. Jalankan Vite dev server:

   ```bash
   npm run dev
   ```

2. Akses via Vite: <http://localhost:5173>

## Catatan Penting

### Untuk Development (Recommended)

Gunakan Vite dev server untuk development:

```bash
npm run dev
```

Akses: <http://localhost:5173>

**Keuntungan:**

- Hot Module Replacement (HMR)
- Faster reload
- Better debugging
- Auto-compile Tailwind CSS

### Untuk Production

1. Build production assets:

   ```bash
   npm run build
   ```

2. Akses via Apache: <http://jakarta-luxury-ai.test>

## Alternatif: Gunakan Laragon Quick Add

1. Klik kanan icon Laragon di system tray
2. Pilih "Apache" → "sites-enabled"
3. Create new file: `jakarta-luxury-ai.test.conf`
4. Paste konfigurasi dari `konfigurasi/jakarta-luxury-ai.test.conf`
5. Restart Apache

## Struktur URL

Setelah setup berhasil:

- **Frontend (Vite)**: <http://localhost:5173>
- **Frontend (Apache)**: <http://jakarta-luxury-ai.test>
- **API**: <http://jakarta-luxury-ai.test/api/>
- **Database**: localhost:3306 (MySQL)

## Rekomendasi

Untuk development, lebih baik gunakan:

- **Frontend**: Vite dev server (<http://localhost:5173>)
- **Backend API**: Tetap via Apache (<http://localhost/jakarta-luxury-ai/api/>)
- **Database**: MySQL via Laragon

Ini memberikan best development experience dengan HMR dan fast refresh.
