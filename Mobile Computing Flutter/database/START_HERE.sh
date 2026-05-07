#!/usr/bin/env bash
# 
# 🎉 ALFAMART DATABASE - START HERE! 🎉
#
# Panduan lengkap membuat database Alfamart untuk sistem e-commerce
# dengan struktur pembelian yang komprehensif.
#
# Created: 2024
# Compatibility: MySQL 5.7+, phpMyAdmin 5.0+
#

echo "╔════════════════════════════════════════════════════════════════════════════╗"
echo "║                  ALFAMART DATABASE - SETUP GUIDE                           ║"
echo "║                                                                            ║"
echo "║  Database untuk Sistem E-Commerce Retail (seperti Alfamart)               ║"
echo "║  Dengan 14 tabel, 3 views, 2 stored procedures, dan data dummy            ║"
echo "╚════════════════════════════════════════════════════════════════════════════╝"
echo ""

# Warna untuk terminal
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}📁 FILE-FILE YANG TERSEDIA:${NC}"
echo ""
echo -e "${GREEN}1. RINGKASAN_DATABASE.md (Mulai dari sini!)${NC}"
echo "   └─ Overview lengkap semua file & step-by-step setup"
echo ""

echo -e "${GREEN}2. database/QUICK_START.md (5 Menit Import!)${NC}"
echo "   └─ Panduan cepat untuk pemula, langkah demi langkah"
echo "   └─ Cara import ke phpMyAdmin"
echo "   └─ Test query dasar"
echo ""

echo -e "${GREEN}3. database/alfamart_schema.sql (FILE UTAMA)${NC}"
echo "   └─ File SQL lengkap (~20KB)"
echo "   └─ 14 tabel + 3 views + 2 stored procedures"
echo "   └─ Data dummy siap test"
echo "   └─ Gunakan ini untuk import pertama kali"
echo ""

echo -e "${GREEN}4. database/alfamart_full.sql (Alternatif)${NC}"
echo "   └─ Versi lebih simple tanpa banyak comment"
echo "   └─ Fungsi sama, ukuran lebih kecil"
echo ""

echo -e "${GREEN}5. database/ALFAMART_DOKUMENTASI.md (Referensi Lengkap)${NC}"
echo "   └─ Penjelasan detail tiap tabel"
echo "   └─ Daftar lengkap views & stored procedures"
echo "   └─ 50+ contoh query SQL"
echo "   └─ Tips maintenance & backup"
echo ""

echo -e "${GREEN}6. database/ER_DIAGRAM_SCHEMA.md (Arsitektur Database)${NC}"
echo "   └─ Entity Relationship Diagram visual"
echo "   └─ Relasi antar tabel"
echo "   └─ Index strategy & optimization tips"
echo ""

echo -e "${GREEN}7. api/API_ENDPOINTS.md (Integrasi Flutter)${NC}"
echo "   └─ Contoh kode PHP API siap pakai"
echo "   └─ Endpoints untuk auth, products, cart, orders"
echo "   └─ Implementasi di Flutter dengan http package"
echo ""

echo ""
echo -e "${BLUE}🚀 QUICK START (3 LANGKAH):${NC}"
echo ""
echo "1️⃣  Buka: http://localhost/phpmyadmin"
echo "    • Login dengan username: root, password: (kosong)"
echo ""
echo "2️⃣  Buat database baru:"
echo "    • Klik 'New' di sidebar"
echo "    • Database name: alfamart"
echo "    • Collation: utf8mb4_unicode_ci"
echo "    • Klik 'Create'"
echo ""
echo "3️⃣  Import file SQL:"
echo "    • Pilih database 'alfamart'"
echo "    • Tab 'Import'"
echo "    • Choose file: database/alfamart_schema.sql"
echo "    • Klik 'Go'"
echo ""

echo -e "${BLUE}✅ VERIFIKASI IMPORT:${NC}"
echo ""
echo "Di phpMyAdmin, pilih database 'alfamart', cek apakah ada tabel:"
echo "  ✓ users          ✓ promotions"
echo "  ✓ categories     ✓ reviews"
echo "  ✓ products       ✓ shopping_cart"
echo "  ✓ stock_logs     ✓ wishlist"
echo "  ✓ orders         ✓ activity_logs"
echo "  ✓ order_items    ✓ (3 views)"
echo "  ✓ payments       ✓ (2 stored procedures)"
echo "  ✓ shipments"
echo "  ✓ returns"
echo ""

echo -e "${BLUE}📊 STRUKTUR DATABASE:${NC}"
echo ""
cat << 'EOF'
USERS (Pengguna)
  ├─ ORDERS (Pesanan)
  │  ├─ ORDER_ITEMS (Detail barang)
  │  ├─ PAYMENTS (Pembayaran)
  │  ├─ SHIPMENTS (Pengiriman)
  │  └─ RETURNS (Pengembalian)
  ├─ REVIEWS (Ulasan)
  ├─ SHOPPING_CART (Keranjang)
  ├─ WISHLIST (Daftar keinginan)
  └─ ACTIVITY_LOGS (Log aktivitas)

CATEGORIES (Kategori)
  └─ PRODUCTS (Produk)
     ├─ STOCK_LOGS (Riwayat stok)
     └─ (digunakan di orders, reviews, cart, wishlist)

PROMOTIONS (Kode promo)
EOF
echo ""

echo -e "${BLUE}📋 TABEL-TABEL (14 Total):${NC}"
echo ""
printf "%-20s %-40s\n" "Tabel" "Fungsi"
printf "%-20s %-40s\n" "─────" "──────"
printf "%-20s %-40s\n" "users" "Data pengguna/pelanggan"
printf "%-20s %-40s\n" "categories" "Kategori produk"
printf "%-20s %-40s\n" "products" "Data produk utama"
printf "%-20s %-40s\n" "stock_logs" "Riwayat perubahan stok"
printf "%-20s %-40s\n" "orders" "Pesanan pelanggan"
printf "%-20s %-40s\n" "order_items" "Detail item per pesanan"
printf "%-20s %-40s\n" "payments" "Pembayaran pesanan"
printf "%-20s %-40s\n" "shipments" "Pengiriman barang"
printf "%-20s %-40s\n" "returns" "Pengembalian barang"
printf "%-20s %-40s\n" "promotions" "Kode promo & diskon"
printf "%-20s %-40s\n" "reviews" "Rating & ulasan produk"
printf "%-20s %-40s\n" "shopping_cart" "Keranjang belanja"
printf "%-20s %-40s\n" "wishlist" "Daftar keinginan"
printf "%-20s %-40s\n" "activity_logs" "Log semua aktivitas"
echo ""

echo -e "${BLUE}👥 DATA DUMMY (Sudah Terinsert):${NC}"
echo ""
echo "Users: 3 pengguna"
echo "  • customer1@example.com (customer)"
echo "  • customer2@example.com (customer)"
echo "  • admin@example.com (admin)"
echo ""
echo "Categories: 5 kategori"
echo "  • Makanan & Minuman"
echo "  • Perawatan Diri"
echo "  • Elektronik & Gadget"
echo "  • Pakaian & Aksesori"
echo "  • Rumah Tangga"
echo ""
echo "Products: 10 produk sample"
echo "  • Mie Instan, Kopi, Sampo, Deodorant, Powerbank"
echo "  • Kabel USB, Kaos, Celana, Sikat Gigi, Tempat Sampah"
echo ""

echo -e "${BLUE}📊 VIEWS (Untuk Reporting):${NC}"
echo ""
echo "1. daily_sales_summary"
echo "   └─ Ringkasan penjualan per hari"
echo ""
echo "2. best_selling_products"
echo "   └─ Produk dengan penjualan terbanyak"
echo ""
echo "3. customer_order_history"
echo "   └─ Riwayat pesanan pelanggan"
echo ""

echo -e "${BLUE}⚙️  STORED PROCEDURES:${NC}"
echo ""
echo "1. CreateNewOrder(user_id, total, tax, discount, method, @order_id)"
echo "   └─ Membuat pesanan baru dengan validasi otomatis"
echo ""
echo "2. UpdateProductStock(product_id, qty_change, type, ref_id)"
echo "   └─ Update stok dan catat di log otomatis"
echo ""

echo -e "${BLUE}📱 INTEGRASI FLUTTER:${NC}"
echo ""
echo "File: api/API_ENDPOINTS.md berisi contoh kode untuk:"
echo "  • Login/Register API"
echo "  • Products List & Detail API"
echo "  • Shopping Cart CRUD API"
echo "  • Create Order API"
echo "  • Payments Processing API"
echo ""

echo -e "${BLUE}🔍 TEST QUERY (di phpMyAdmin):${NC}"
echo ""
echo "Lihat semua produk:"
echo "  SELECT * FROM products;"
echo ""
echo "Lihat stok terendah:"
echo "  SELECT * FROM products WHERE stock < 10;"
echo ""
echo "Lihat data user:"
echo "  SELECT * FROM users;"
echo ""

echo -e "${BLUE}📚 DOKUMENTASI:${NC}"
echo ""
echo "📖 Untuk pemula:"
echo "   → Baca: RINGKASAN_DATABASE.md"
echo "   → Lalu: database/QUICK_START.md"
echo ""
echo "🔧 Untuk developer:"
echo "   → Baca: database/ALFAMART_DOKUMENTASI.md"
echo "   → Reference: database/ER_DIAGRAM_SCHEMA.md"
echo ""
echo "🔌 Untuk backend:"
echo "   → Baca: api/API_ENDPOINTS.md"
echo "   → Contoh kode PHP siap pakai"
echo ""

echo -e "${BLUE}❓ TROUBLESHOOTING:${NC}"
echo ""
echo "❌ Import gagal?"
echo "   → Cek file size (harus < 2MB)"
echo "   → Disable max_allowed_packet jika perlu"
echo ""
echo "❌ Foreign key error?"
echo "   → Cek tabel parent sudah ada"
echo "   → Cek relasi tabel benar"
echo ""
echo "❌ Koneksi database gagal?"
echo "   → Pastikan MySQL running"
echo "   → Verify username/password"
echo "   → Database name harus 'alfamart'"
echo ""

echo -e "${GREEN}═══════════════════════════════════════════════════════════════════════════════${NC}"
echo ""
echo -e "${GREEN}✅ Database Alfamart siap digunakan!${NC}"
echo ""
echo "Next steps:"
echo "  1. Setup database (sudah selesai!)"
echo "  2. Create API endpoints (gunakan contoh di API_ENDPOINTS.md)"
echo "  3. Connect ke Flutter app"
echo "  4. Test end-to-end"
echo "  5. Deploy ke production"
echo ""
echo -e "${GREEN}Happy Coding! 🚀${NC}"
echo ""
