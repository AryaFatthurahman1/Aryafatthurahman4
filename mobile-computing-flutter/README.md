# EduConnect - Aplikasi Mobile Learning

![EduConnect Logo](assets/images/logo.png)

Aplikasi mobile learning management system yang dibuat untuk UAS Mobile Computing menggunakan Flutter dan PHP REST API.

## 📱 Fitur Aplikasi

### ✅ Requirement UAS Terpenuhi

- ✅ **3 Tabel Database**: `users`, `articles`, `discussions`
- ✅ **a) Message**: Dialog konfirmasi di logout, about, clear cache
- ✅ **b) Snackbar**: Notifikasi error/success di semua operasi
- ✅ **c) Judul Aplikasi**: "EduConnect" di AppBar dan Login
- ✅ **d) Artikel**: List artikel dan detail artikel lengkap
- ✅ **e) Container**: Digunakan di semua card layouts
- ✅ **f) List Data**: ListView di home (artikel) dan discussions
- ✅ **g) Login**: Login screen dengan autentikasi
- ✅ **h) Button**: Custom button widget di semua form
- ✅ **i) TextField**: Input fields di login, profile, discussions
- ✅ **j) SharedPreference**: Session & token management
- ✅ **k) Image**: Logo (local) + thumbnails & profile (network)
- ✅ **API dengan Hosting**: PHP REST API siap di-hosting
- ✅ **6 Menu/Screens**: Login, Home, Article Detail, Discussions, Profile, Settings

## 🏗️ Struktur Aplikasi

### Backend (PHP API)
```
api/
├── config/
│   ├── database.php      # Konfigurasi database
│   └── cors.php          # CORS headers
├── auth/
│   ├── login.php         # Login endpoint
│   └── register.php      # Register endpoint
├── articles/
│   ├── list.php          # List artikel
│   └── detail.php        # Detail artikel
├── discussions/
│   ├── list.php          # List diskusi
│   └── create.php        # Buat diskusi
└── users/
    └── profile.php       # Get/Update profil
```

### Frontend (Flutter)
```
lib/
├── main.dart             # Entry point
├── models/               # Data models
│   ├── user_model.dart
│   ├── article_model.dart
│   └── discussion_model.dart
├── services/
│   └── api_service.dart  # HTTP client
├── utils/
│   ├── constants.dart    # App constants
│   └── shared_prefs.dart # SharedPreferences helper
├── widgets/              # Reusable widgets
│   ├── custom_button.dart
│   ├── custom_textfield.dart
│   └── article_card.dart
└── screens/              # App screens
    ├── login_screen.dart
    ├── home_screen.dart
    ├── article_detail_screen.dart
    ├── discussions_screen.dart
    ├── profile_screen.dart
    └── settings_screen.dart
```

## 🚀 Cara Setup dan Running

### 1. Setup Database

```bash
# Buka MySQL di Laragon atau XAMPP
# Import database schema
mysql -u root educonnect_db < database/schema.sql

# Atau import manual via phpMyAdmin
```

### 2. Setup Backend API

1. Pastikan Laragon/XAMPP sudah running
2. Database sudah di-import
3. API sudah bisa diakses di: `http://localhost/Mobile%20Computing%20Flutter/api/`

### 3. Setup Flutter App

```bash
# Masuk ke direktori project
cd "d:\laragon\www\Mobile Computing Flutter"

# Install dependencies
flutter pub get

# Check Flutter setup
flutter doctor

# Run aplikasi
flutter run
```

### 4. Konfigurasi API URL

Jika menggunakan hosting, edit file `lib/utils/constants.dart`:

```dart
static const String baseUrl = 'https://your-domain.com/api';
```

## 📝 API Endpoints

### Authentication
- `POST /api/auth/login.php` - Login user
- `POST /api/auth/register.php` - Register user baru

### Articles
- `GET /api/articles/list.php` - List semua artikel
- `GET /api/articles/detail.php?id={id}` - Detail artikel

### Discussions
- `GET /api/discussions/list.php` - List diskusi
- `POST /api/discussions/create.php` - Buat diskusi baru

### Users
- `GET /api/users/profile.php?id={id}` - Get profil user
- `PUT /api/users/profile.php` - Update profil user

## 👤 Demo Account

Untuk testing, gunakan akun berikut:

```
Email: admin@educonnect.com
Password: password
```

Atau:

```
Email: budi@student.com
Password: password
```

## 📦 Dependencies

### Flutter Packages
- `http: ^1.1.0` - HTTP client untuk API calls
- `shared_preferences: ^2.2.2` - Local storage
- `cached_network_image: ^3.3.0` - Image caching
- `provider: ^6.1.1` - State management

### Backend
- PHP 7.4+
- MySQL 5.7+
- PDO Extension

## 🎨 Screenshots

### Login Screen
- Logo aplikasi (local image)
- Email & password TextField
- Login Button
- Form validation

### Home Screen
- Welcome card dengan profile image
- List artikel dengan thumbnail
- Pull to refresh
- Bottom navigation

### Article Detail
- Header image
- Full article content
- Author info
- View counter

### Discussions
- List diskusi
- Create discussion dialog
- Real-time updates

### Profile
- Profile image (network)
- Edit profile form
- Update functionality
- Logout confirmation dialog

### Settings
- App settings
- About dialog
- Clear cache option

## 🔧 Troubleshooting

### Error: Connection refused
- Pastikan Laragon/XAMPP sudah running
- Check MySQL service aktif
- Verify API URL di `constants.dart`

### Error: Database connection failed
- Check credentials di `api/config/database.php`
- Pastikan database `educonnect_db` sudah dibuat
- Import schema.sql

### Flutter pub get error
- Run `flutter clean`
- Delete `pubspec.lock`
- Run `flutter pub get` lagi

## 📄 Lisensi

Aplikasi ini dibuat untuk keperluan UAS Mobile Computing.

## 👨‍💻 Developer

Dibuat dengan ❤️ menggunakan Flutter & PHP

---

**Note**: Pastikan semua requirement UAS sudah terpenuhi sebelum presentasi!
