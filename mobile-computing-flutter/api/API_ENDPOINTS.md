# API Endpoints untuk Alfamart Database

Contoh endpoint PHP untuk menghubungkan database Alfamart dengan aplikasi Flutter.

## 📁 Struktur File API

```
api/
├── config/
│   └── database.php          # Koneksi Database
├── auth/
│   ├── login.php             # Login user
│   └── register.php          # Register user baru
├── products/
│   ├── list.php              # Ambil daftar produk
│   ├── detail.php            # Ambil detail produk
│   └── search.php            # Cari produk
├── cart/
│   ├── add.php               # Tambah ke keranjang
│   ├── get.php               # Ambil isi keranjang
│   └── remove.php            # Hapus dari keranjang
├── orders/
│   ├── create.php            # Buat pesanan baru
│   ├── list.php              # Ambil daftar pesanan
│   ├── detail.php            # Detail pesanan
│   └── update_status.php     # Update status pesanan
├── payments/
│   ├── process.php           # Proses pembayaran
│   └── confirm.php           # Konfirmasi pembayaran
└── users/
    ├── profile.php           # Profil pengguna
    └── update_profile.php    # Update profil
```

---

## 🔑 Database Config

**File: `api/config/database.php`**

```php
<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'alfamart');
define('DB_CHARSET', 'utf8mb4');

// Function untuk koneksi database
function getConnection() {
    try {
        $pdo = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET,
            DB_USER,
            DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
        return $pdo;
    } catch (PDOException $e) {
        http_response_code(500);
        die(json_encode(['error' => 'Database connection failed']));
    }
}

// Function untuk response JSON
function response($data, $code = 200) {
    http_response_code($code);
    echo json_encode($data);
    exit;
}
?>
```

---

## 👤 Auth API

### Login

**File: `api/auth/login.php`**

```php
<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    response(['error' => 'Invalid request method'], 405);
}

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['email']) || !isset($data['password'])) {
    response(['error' => 'Email and password required'], 400);
}

$pdo = getConnection();
$stmt = $pdo->prepare("
    SELECT user_id, username, email, full_name, user_type, is_active 
    FROM users 
    WHERE email = ? AND is_active = 1
");
$stmt->execute([$data['email']]);
$user = $stmt->fetch();

if (!$user || !password_verify($data['password'], $user['password'])) {
    response(['error' => 'Invalid email or password'], 401);
}

response([
    'success' => true,
    'user' => $user,
    'token' => bin2hex(random_bytes(32)) // Generate simple token
], 200);
?>
```

### Register

**File: `api/auth/register.php`**

```php
<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    response(['error' => 'Invalid request method'], 405);
}

$data = json_decode(file_get_contents("php://input"), true);

$required = ['username', 'email', 'password', 'full_name'];
foreach ($required as $field) {
    if (!isset($data[$field])) {
        response(['error' => "$field is required"], 400);
    }
}

$pdo = getConnection();

// Check if user exists
$stmt = $pdo->prepare("SELECT user_id FROM users WHERE email = ? OR username = ?");
$stmt->execute([$data['email'], $data['username']]);

if ($stmt->fetch()) {
    response(['error' => 'User already exists'], 409);
}

// Insert new user
$stmt = $pdo->prepare("
    INSERT INTO users (username, email, password, full_name, user_type) 
    VALUES (?, ?, ?, ?, 'customer')
");

$hashed_password = password_hash($data['password'], PASSWORD_BCRYPT);

try {
    $stmt->execute([
        $data['username'],
        $data['email'],
        $hashed_password,
        $data['full_name']
    ]);
    
    response([
        'success' => true,
        'message' => 'User registered successfully'
    ], 201);
} catch (Exception $e) {
    response(['error' => 'Registration failed'], 500);
}
?>
```

---

## 📦 Products API

### Daftar Produk

**File: `api/products/list.php`**

```php
<?php
require_once '../config/database.php';

$page = $_GET['page'] ?? 1;
$limit = $_GET['limit'] ?? 10;
$category = $_GET['category'] ?? null;
$offset = ($page - 1) * $limit;

$pdo = getConnection();

$query = "SELECT p.*, c.category_name FROM products p 
          JOIN categories c ON p.category_id = c.category_id 
          WHERE p.is_active = 1";

$params = [];

if ($category) {
    $query .= " AND c.category_id = ?";
    $params[] = $category;
}

$query .= " ORDER BY p.product_name LIMIT ? OFFSET ?";
$params[] = $limit;
$params[] = $offset;

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$products = $stmt->fetchAll();

// Get total count
$countQuery = "SELECT COUNT(*) as total FROM products WHERE is_active = 1";
if ($category) {
    $countQuery .= " AND category_id = ?";
}
$countStmt = $pdo->prepare($countQuery);
$countStmt->execute($category ? [$category] : []);
$total = $countStmt->fetch()['total'];

response([
    'success' => true,
    'data' => $products,
    'pagination' => [
        'page' => $page,
        'limit' => $limit,
        'total' => $total,
        'pages' => ceil($total / $limit)
    ]
], 200);
?>
```

### Detail Produk

**File: `api/products/detail.php`**

```php
<?php
require_once '../config/database.php';

$product_id = $_GET['id'] ?? null;

if (!$product_id) {
    response(['error' => 'Product ID required'], 400);
}

$pdo = getConnection();

$stmt = $pdo->prepare("
    SELECT p.*, c.category_name, 
           AVG(r.rating) as avg_rating, 
           COUNT(r.review_id) as review_count
    FROM products p
    JOIN categories c ON p.category_id = c.category_id
    LEFT JOIN reviews r ON p.product_id = r.product_id
    WHERE p.product_id = ? AND p.is_active = 1
    GROUP BY p.product_id
");
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if (!$product) {
    response(['error' => 'Product not found'], 404);
}

// Get reviews
$reviewStmt = $pdo->prepare("
    SELECT r.*, u.full_name 
    FROM reviews r
    JOIN users u ON r.user_id = u.user_id
    WHERE r.product_id = ?
    ORDER BY r.review_date DESC
    LIMIT 5
");
$reviewStmt->execute([$product_id]);
$reviews = $reviewStmt->fetchAll();

$product['reviews'] = $reviews;

response(['success' => true, 'data' => $product], 200);
?>
```

---

## 🛒 Shopping Cart API

### Tambah Keranjang

**File: `api/cart/add.php`**

```php
<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    response(['error' => 'Invalid request method'], 405);
}

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['user_id']) || !isset($data['product_id']) || !isset($data['quantity'])) {
    response(['error' => 'Missing required fields'], 400);
}

$pdo = getConnection();

// Check if product exists and has stock
$productStmt = $pdo->prepare("SELECT stock, price FROM products WHERE product_id = ?");
$productStmt->execute([$data['product_id']]);
$product = $productStmt->fetch();

if (!$product || $product['stock'] < $data['quantity']) {
    response(['error' => 'Insufficient stock'], 400);
}

// Check if already in cart
$cartStmt = $pdo->prepare("
    SELECT cart_id, quantity FROM shopping_cart 
    WHERE user_id = ? AND product_id = ?
");
$cartStmt->execute([$data['user_id'], $data['product_id']]);
$cartItem = $cartStmt->fetch();

if ($cartItem) {
    // Update quantity
    $updateStmt = $pdo->prepare("
        UPDATE shopping_cart 
        SET quantity = quantity + ? 
        WHERE cart_id = ?
    ");
    $updateStmt->execute([$data['quantity'], $cartItem['cart_id']]);
} else {
    // Insert new item
    $insertStmt = $pdo->prepare("
        INSERT INTO shopping_cart (user_id, product_id, quantity) 
        VALUES (?, ?, ?)
    ");
    $insertStmt->execute([$data['user_id'], $data['product_id'], $data['quantity']]);
}

response(['success' => true, 'message' => 'Added to cart'], 201);
?>
```

### Ambil Keranjang

**File: `api/cart/get.php`**

```php
<?php
require_once '../config/database.php';

$user_id = $_GET['user_id'] ?? null;

if (!$user_id) {
    response(['error' => 'User ID required'], 400);
}

$pdo = getConnection();

$stmt = $pdo->prepare("
    SELECT c.cart_id, c.quantity, p.product_id, p.product_name, 
           p.price, p.image_url, 
           (c.quantity * p.price) as subtotal
    FROM shopping_cart c
    JOIN products p ON c.product_id = p.product_id
    WHERE c.user_id = ?
    ORDER BY c.added_at DESC
");
$stmt->execute([$user_id]);
$items = $stmt->fetchAll();

$total = array_reduce($items, function($sum, $item) {
    return $sum + $item['subtotal'];
}, 0);

response([
    'success' => true,
    'data' => $items,
    'total' => $total
], 200);
?>
```

---

## 📋 Orders API

### Buat Pesanan

**File: `api/orders/create.php`**

```php
<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    response(['error' => 'Invalid request method'], 405);
}

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['user_id']) || !isset($data['items']) || count($data['items']) == 0) {
    response(['error' => 'Missing required fields'], 400);
}

$pdo = getConnection();

try {
    $pdo->beginTransaction();
    
    // Calculate totals
    $total_amount = 0;
    $items = [];
    
    foreach ($data['items'] as $item) {
        $stmt = $pdo->prepare("SELECT price FROM products WHERE product_id = ?");
        $stmt->execute([$item['product_id']]);
        $product = $stmt->fetch();
        
        if (!$product) {
            throw new Exception("Product not found");
        }
        
        $subtotal = $product['price'] * $item['quantity'];
        $total_amount += $subtotal;
        
        $items[] = [
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'unit_price' => $product['price'],
            'subtotal' => $subtotal
        ];
    }
    
    $tax_amount = $total_amount * 0.1; // 10% tax
    $discount_amount = $data['discount_amount'] ?? 0;
    $final_amount = $total_amount + $tax_amount - $discount_amount;
    
    $order_number = 'ORD-' . date('Ymd') . '-' . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
    
    // Insert order
    $orderStmt = $pdo->prepare("
        INSERT INTO orders (order_number, user_id, total_amount, tax_amount, 
                           discount_amount, final_amount, payment_method, order_status)
        VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')
    ");
    
    $orderStmt->execute([
        $order_number,
        $data['user_id'],
        $total_amount,
        $tax_amount,
        $discount_amount,
        $final_amount,
        $data['payment_method'] ?? 'cash'
    ]);
    
    $order_id = $pdo->lastInsertId();
    
    // Insert order items
    $itemStmt = $pdo->prepare("
        INSERT INTO order_items (order_id, product_id, quantity, unit_price, subtotal)
        VALUES (?, ?, ?, ?, ?)
    ");
    
    foreach ($items as $item) {
        $itemStmt->execute([
            $order_id,
            $item['product_id'],
            $item['quantity'],
            $item['unit_price'],
            $item['subtotal']
        ]);
        
        // Update stock
        $stockStmt = $pdo->prepare("
            UPDATE products SET stock = stock - ? WHERE product_id = ?
        ");
        $stockStmt->execute([$item['quantity'], $item['product_id']]);
    }
    
    // Clear shopping cart
    $clearStmt = $pdo->prepare("DELETE FROM shopping_cart WHERE user_id = ?");
    $clearStmt->execute([$data['user_id']]);
    
    $pdo->commit();
    
    response([
        'success' => true,
        'order_id' => $order_id,
        'order_number' => $order_number,
        'final_amount' => $final_amount
    ], 201);
    
} catch (Exception $e) {
    $pdo->rollBack();
    response(['error' => $e->getMessage()], 500);
}
?>
```

---

## 🔐 Middleware untuk Authentication

**File: `api/middleware/auth.php`**

```php
<?php
function verifyToken($token) {
    // Simple token verification (gunakan JWT untuk production)
    if (empty($token)) {
        http_response_code(401);
        die(json_encode(['error' => 'Unauthorized']));
    }
    // Add your token verification logic here
    return true;
}

function requireAuth() {
    $headers = apache_request_headers();
    $token = $headers['Authorization'] ?? '';
    
    if (strpos($token, 'Bearer ') === 0) {
        $token = substr($token, 7);
        verifyToken($token);
    } else {
        http_response_code(401);
        die(json_encode(['error' => 'Missing authorization header']));
    }
}
?>
```

---

## 🚀 Testing dengan Flutter

```dart
// Contoh di Flutter
import 'package:http/http.dart' as http;
import 'dart:convert';

const String API_URL = 'http://localhost/api';

// Login
Future<void> login(String email, String password) async {
  final response = await http.post(
    Uri.parse('$API_URL/auth/login.php'),
    headers: {'Content-Type': 'application/json'},
    body: jsonEncode({
      'email': email,
      'password': password,
    }),
  );
  
  if (response.statusCode == 200) {
    final data = jsonDecode(response.body);
    print('Login successful: ${data['user']}');
  }
}

// Get Products
Future<List> getProducts() async {
  final response = await http.get(
    Uri.parse('$API_URL/products/list.php?page=1&limit=10'),
  );
  
  if (response.statusCode == 200) {
    final data = jsonDecode(response.body);
    return data['data'];
  }
  throw Exception('Failed to load products');
}
```

---

## 📝 Catatan Penting

- ✅ Selalu validate input dari client
- ✅ Gunakan prepared statements untuk query
- ✅ Implement proper error handling
- ✅ Use HTTPS di production
- ✅ Implement JWT token untuk authentication
- ✅ Add rate limiting untuk API endpoints
- ✅ Log all activities untuk audit trail

---

**Selamat! API Alfamart sudah siap diintegrasikan dengan aplikasi Flutter!**
