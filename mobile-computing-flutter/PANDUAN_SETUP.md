# PANDUAN SETUP EDUCONNECT

## Langkah-langkah Setup untuk UAS

### 1. Setup Database (WAJIB DILAKUKAN PERTAMA)

1. **Buka Laragon** dan pastikan MySQL sudah running
2. **Buka HeidiSQL** atau phpMyAdmin
3. **Buat database baru**:
   ```sql
   CREATE DATABASE educonnect_db;
   ```
4. **Import schema**:
   - Buka file `database/schema.sql`
   - Copy semua isinya
   - Paste dan execute di HeidiSQL/phpMyAdmin
   - Atau via command line:
     ```bash
     mysql -u root educonnect_db < "d:\laragon\www\Mobile Computing Flutter\database\schema.sql"
     ```

5. **Verifikasi database**:
   - Check apakah ada 3 tabel: `users`, `articles`, `discussions`
   - Check apakah ada sample data (3 users, 5 articles, 5 discussions)

### 2. Test Backend API

1. **Pastikan Laragon running**
2. **Test API di browser**:
   - Buka: `http://localhost/Mobile%20Computing%20Flutter/api/articles/list.php`
   - Harusnya muncul JSON response dengan list artikel
   
3. **Test Login API** (gunakan Postman atau browser extension):
   ```
   POST http://localhost/Mobile%20Computing%20Flutter/api/auth/login.php
   Body (JSON):
   {
     "email": "admin@educonnect.com",
     "password": "password"
   }
   ```

### 3. Setup Flutter Application

1. **Check Flutter installation**:
   ```bash
   flutter doctor
   ```
   Pastikan semua ✓ (atau minimal Android toolchain OK)

2. **Install dependencies**:
   ```bash
   cd "d:\laragon\www\Mobile Computing Flutter"
   flutter pub get
   ```

3. **Check devices**:
   ```bash
   flutter devices
   ```
   Pastikan ada device (emulator atau chrome)

4. **Run aplikasi**:
   ```bash
   flutter run
   ```
   Pilih device yang tersedia

### 4. Testing Aplikasi

#### Test Login (Requirement g)
- Email: `admin@educonnect.com`
- Password: `password`
- ✅ Check: Login berhasil, muncul **Snackbar** success (Requirement b)
- ✅ Check: Data tersimpan di **SharedPreferences** (Requirement j)
- ✅ Check: Redirect ke Home Screen

#### Test Home Screen (Requirement c, d, f, k)
- ✅ Check: **Judul Aplikasi** "EduConnect" di AppBar (Requirement c)
- ✅ Check: **List Data** artikel muncul (Requirement f)
- ✅ Check: **Container** untuk card layout (Requirement e)
- ✅ Check: **Image** network untuk thumbnail artikel (Requirement k)
- ✅ Check: Pull to refresh berfungsi

#### Test Article Detail (Requirement d, e, k)
- Tap salah satu artikel
- ✅ Check: **Artikel** lengkap dengan konten (Requirement d)
- ✅ Check: **Image** header artikel (Requirement k)
- ✅ Check: **Container** untuk layout (Requirement e)

#### Test Discussions (Requirement f, h, i)
- Tap menu "Diskusi" di bottom nav
- ✅ Check: **List Data** diskusi muncul (Requirement f)
- Tap FAB "Buat Diskusi"
- ✅ Check: **TextField** untuk judul dan pesan (Requirement i)
- ✅ Check: **Button** untuk submit (Requirement h)
- Isi form dan submit
- ✅ Check: **Snackbar** success muncul (Requirement b)

#### Test Profile (Requirement h, i, k, a)
- Tap menu "Profil" di bottom nav
- ✅ Check: **Image** profile dari network (Requirement k)
- ✅ Check: **TextField** untuk edit profil (Requirement i)
- Tap "Edit" dan ubah data
- ✅ Check: **Button** untuk save (Requirement h)
- Tap "Logout"
- ✅ Check: **Message** dialog konfirmasi (Requirement a)

#### Test Settings (Requirement a, b)
- Tap menu "Pengaturan" di bottom nav
- Tap "Tentang Aplikasi"
- ✅ Check: **Message** dialog muncul (Requirement a)
- Tap "Hapus Cache"
- ✅ Check: **Message** dialog konfirmasi (Requirement a)
- ✅ Check: **Snackbar** muncul setelah confirm (Requirement b)

### 5. Checklist Requirement UAS

| No | Requirement | Status | Lokasi |
|----|------------|--------|--------|
| 1 | 3 Tabel Database | ✅ | `database/schema.sql` |
| a | Message | ✅ | Profile (logout), Settings (about, clear cache) |
| b | Snackbar | ✅ | Login, Home, Discussions, Profile, Settings |
| c | Judul Aplikasi | ✅ | Login screen, Home AppBar |
| d | Artikel | ✅ | Home screen, Article Detail screen |
| e | Container | ✅ | Semua card layouts |
| f | List Data | ✅ | Home (articles), Discussions |
| g | Login | ✅ | Login screen dengan auth |
| h | Button | ✅ | Custom button di semua form |
| i | TextField | ✅ | Login, Profile, Discussions |
| j | SharedPreference | ✅ | `lib/utils/shared_prefs.dart` |
| k | Image | ✅ | Logo (local), Thumbnails & Profile (network) |
| 4 | API + Hosting | ✅ | 8 endpoints di folder `api/` |
| 5 | 5 Menu | ✅ | 6 screens: Login, Home, Detail, Discussions, Profile, Settings |

### 6. Troubleshooting

#### Error: Connection refused
```
Solusi:
1. Pastikan Laragon running
2. Check MySQL service aktif
3. Test API di browser terlebih dahulu
```

#### Error: Database connection failed
```
Solusi:
1. Check database sudah dibuat
2. Import schema.sql
3. Check credentials di api/config/database.php
```

#### Flutter: No devices found
```
Solusi:
1. Buka Android Studio dan start emulator
2. Atau gunakan Chrome: flutter run -d chrome
```

### 7. Persiapan Presentasi UAS

1. ✅ Database sudah di-import
2. ✅ Laragon running
3. ✅ Flutter app bisa dijalankan
4. ✅ Test semua fitur berfungsi
5. ✅ Siapkan demo account: `admin@educonnect.com` / `password`
6. ✅ Screenshot aplikasi (optional)

---

**PENTING**: Pastikan semua langkah di atas sudah dilakukan sebelum UAS!

Jika ada error, cek file `README.md` untuk troubleshooting lebih detail.
