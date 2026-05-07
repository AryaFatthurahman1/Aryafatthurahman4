# Struktur Folder Jakarta Luxury AI

## 📁 Struktur Proyek

```text
jakarta-luxury-ai/
├── 📂 basis_data/                  # Database & Migrasi
│   ├── 📂 skema/                  # Skema database utama
│   │   └── database.sql           # Skema database utama
│   └── 📂 migrasi/                # File migrasi
│       ├── 📂 kuliner/            # Migrasi data kuliner
│       │   └── update_gambar_kuliner.sql
│       └── 📂 wisata/             # Migrasi data wisata
│           └── update_gambar_travel.sql
│
├── 📂 api/                        # API Backend (PHP)
│   ├── 📂 ai/                     # Endpoint chat AI (Gemini)
│   │   └── chat.php
│   ├── 📂 auth/                   # Autentikasi
│   │   ├── login.php
│   │   └── register.php
│   ├── 📂 config/                 # Konfigurasi API
│   │   └── database.php
│   ├── 📂 kuliner/                # Endpoint Kuliner
│   │   ├── items.php
│   │   ├── orders.php
│   │   ├── place_order.php
│   │   ├── order_history.php
│   │   └── cancel_order.php
│   ├── 📂 reservasi/              # Endpoint Reservasi
│   │   └── create.php
│   └── 📂 wisata/                 # Endpoint Wisata
│
├── 📂 sumber/                     # Sumber Frontend (React + TypeScript)
│   ├── 📂 komponen/               # Komponen React
│   │   ├── 📂 Admin/             # Komponen Admin
│   │   ├── 📂 AI/                # Desainer AI
│   │   ├── 📂 Autentikasi/       # Masuk & Daftar
│   │   ├── 📂 Kuliner/           # Menu makanan & pesanan
│   │   ├── 📂 Reservasi/         # Formulir reservasi
│   │   ├── 📂 Wisata/            # Paket wisata
│   │   ├── Aplikasi.tsx          # Komponen utama aplikasi
│   │   ├── KakiHalaman.tsx       # Footer
│   │   ├── Beranda.tsx           # Home page
│   │   └── Navigasi.tsx          # Navbar
│   ├── 📂 layanan/                # API & Layanan
│   │   ├── layananApi.ts         # Layanan API utama
│   │   └── layananGemini.ts      # Layanan Integrasi Gemini
│   ├── 📂 gaya/                   # Gaya CSS
│   │   └── index.css
│   ├── 📂 tipe/                   # Definisi tipe TypeScript
│   │   └── tipe.ts
│   └── 📂 utilitas/               # Utilitas & Helper
│       └── utama.tsx             # Titik masuk React
│
├── 📂 publik/                     # Aset Publik
│   ├── 📂 assets/                 # Gambar & file statis
│   │   ├── 📂 kuliner/           # Gambar kuliner
│   │   ├── 📂 wisata/            # Gambar wisata
│   │   └── 📂 dist/              # Hasil build produksi
│   └── index.html                 # HTML utama
│
├── 📂 skrip/                      # Skrip Utilitas (PHP)
│   ├── setup.php                  # Pengaturan database
│   ├── test.php                   # Skrip pengujian
│   └── update_travel_data.php     # Migrasi data
│
├── 📂 konfigurasi/                # File Konfigurasi
│   ├── .env.local                 # Variabel lingkungan
│   ├── tsconfig.json              # Konfigurasi TypeScript
│   ├── vite-env.d.ts              # Tipe Vite
│   └── vite.config.ts             # Konfigurasi Vite
│
├── 📂 dokumentasi/                # Dokumentasi Proyek
│   ├── README.md                  # Dokumentasi utama
│   ├── metadata.json              # Metadata proyek
│   └── jakarta-luxury-ai.zip      # Cadangan proyek
│
├── 📂 node_modules/               # Dependensi NPM
│
├── 📄 .env                        # Variabel lingkungan
├── 📄 .gitignore                  # Aturan pengabaian Git
├── 📄 .htaccess                   # Konfigurasi Apache
├── 📄 index.html                  # Entri HTML utama
├── 📄 utama.php                   # Titik masuk PHP (Indonesianized)
├── 📄 package.json                # Dependensi NPM
├── 📄 package-lock.json           # File kunci NPM
├── 📄 postcss.config.js           # Konfigurasi PostCSS
├── 📄 tailwind.config.js          # Konfigurasi Tailwind CSS
├── 📄 tsconfig.json               # Konfigurasi TypeScript (root)
└── 📄 vite.config.ts              # Konfigurasi Vite (root)
```
