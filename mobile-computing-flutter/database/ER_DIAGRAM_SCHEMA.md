# Database Alfamart - ER Diagram & Schema Visualization

## 📊 Entity Relationship Diagram

```
┌──────────────────────────────────────────────────────────────────────────┐
│                         ALFAMART DATABASE SCHEMA                          │
└──────────────────────────────────────────────────────────────────────────┘

                              ┌──────────────┐
                              │    USERS     │
                              ├──────────────┤
                              │ user_id (PK) │
                              │ username     │
                              │ email        │
                              │ password     │
                              │ full_name    │
                              │ phone_number │
                              │ address      │
                              │ user_type    │
                              └──────────────┘
                                     │
                    ┌────────────────┼────────────────┬────────────────┐
                    │                │                │                │
                    ▼                ▼                ▼                ▼
            ┌──────────────┐  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐
            │   ORDERS     │  │   REVIEWS    │  │SHOPPING_CART │  │  WISHLIST    │
            ├──────────────┤  ├──────────────┤  ├──────────────┤  ├──────────────┤
            │ order_id(PK) │  │review_id(PK) │  │ cart_id(PK)  │  │wishlist_id(PK)
            │order_number  │  │ product_id   │  │ product_id   │  │ product_id   │
            │ user_id(FK)  │  │ user_id(FK)  │  │ user_id(FK)  │  │ user_id(FK)  │
            │total_amount  │  │ rating       │  │ quantity     │  │              │
            │tax_amount    │  │review_text   │  │ added_at     │  │              │
            │discount_amt  │  │review_date   │  │              │  │              │
            │final_amount  │  │              │  │              │  │              │
            │payment_method│  └──────────────┘  └──────────────┘  └──────────────┘
            │order_status  │           │
            │order_date    │           │
            └──────────────┘           │
                    │                  │
            ┌───────┼──────┬───────────┴──────┐
            │       │      │                   │
            ▼       ▼      ▼                   ▼
      ┌──────────────┐ ┌──────────────┐ ┌──────────────┐
      │ORDER_ITEMS   │ │  PRODUCTS    │ │ CATEGORIES   │
      ├──────────────┤ ├──────────────┤ ├──────────────┤
      │order_item_id │ │product_id(PK)│ │category_id(PK)
      │ order_id(FK) │ │product_name  │ │category_name │
      │product_id(FK)│ │ category_id  │ │description   │
      │ quantity     │ │ sku          │ │image_url     │
      │ unit_price   │ │description   │ │is_active     │
      │ subtotal     │ │ price        │ └──────────────┘
      └──────────────┘ │ cost_price   │
                       │ stock       │
                       │ image_url    │
                       │is_active     │
                       └──────────────┘
                              │
                              │ (many products)
                              │
                       ┌──────────────┐
                       │ STOCK_LOGS   │
                       ├──────────────┤
                       │ log_id       │
                       │product_id(FK)│
                       │qty_change    │
                       │ log_type     │
                       │ created_at   │
                       └──────────────┘

┌──────────────────────────────────────────────────────────────────────────┐
│                    ORDERS RELATED TABLES                                  │
└──────────────────────────────────────────────────────────────────────────┘

      ┌──────────────┐
      │   ORDERS     │
      └──────┬───────┘
             │
    ┌────────┼────────┬──────────┐
    │        │        │          │
    ▼        ▼        ▼          ▼
┌────────┐ ┌────────┐ ┌────────┐ ┌────────┐
│PAYMENTS│ │SHIPMENTS│ │RETURNS │ │PROMOTIONS│
├────────┤ ├────────┤ ├────────┤ ├────────┤
│payment │ │shipment│ │return  │ │promo   │
│_id(PK) │ │_id(PK) │ │_id(PK) │ │_id(PK) │
│order_id│ │order_id│ │order_id│ │code    │
│_id(FK) │ │_id(FK) │ │_id(FK) │ │discount│
│amount  │ │courier │ │reason  │ │usage   │
│status  │ │tracking│ │status  │ │period  │
└────────┘ └────────┘ └────────┘ └────────┘

┌──────────────────────────────────────────────────────────────────────────┐
│                    LOGGING & AUDIT                                        │
└──────────────────────────────────────────────────────────────────────────┘

      ┌──────────────────┐
      │ ACTIVITY_LOGS    │
      ├──────────────────┤
      │ log_id           │
      │ user_id          │
      │ action           │
      │ entity_type      │
      │ entity_id        │
      │ old_value        │
      │ new_value        │
      │ log_timestamp    │
      │ ip_address       │
      └──────────────────┘
```

---

## 🗂️ Database Architecture

### Layer 1: Master Data
```
USERS
├─ Customer
├─ Admin
└─ Staff

CATEGORIES → PRODUCTS → STOCK_LOGS
```

### Layer 2: Transactions
```
ORDERS
├─ ORDER_ITEMS
├─ PAYMENTS
├─ SHIPMENTS
└─ RETURNS
```

### Layer 3: User Actions
```
SHOPPING_CART (temporary)
WISHLIST (favorite)
REVIEWS (feedback)
ACTIVITY_LOGS (audit trail)
```

### Layer 4: Marketing
```
PROMOTIONS (discount codes)
```

---

## 📋 Relasi Antar Tabel

### Many-to-One Relationships
```
USERS
  ↓ (1:M)
  └─ ORDERS
  └─ REVIEWS
  └─ SHOPPING_CART
  └─ WISHLIST
  └─ ACTIVITY_LOGS

CATEGORIES
  ↓ (1:M)
  └─ PRODUCTS

PRODUCTS
  ↓ (1:M)
  ├─ STOCK_LOGS
  ├─ ORDER_ITEMS
  ├─ REVIEWS
  ├─ SHOPPING_CART
  └─ WISHLIST

ORDERS
  ↓ (1:M)
  ├─ ORDER_ITEMS
  ├─ PAYMENTS
  ├─ SHIPMENTS
  └─ RETURNS
```

### One-to-One Relationships
```
ORDERS (1) ← → (1) PAYMENTS
ORDERS (1) ← → (1) SHIPMENTS (mostly)
```

---

## 📊 Tabel Statistics

```sql
SELECT 
    TABLE_NAME,
    TABLE_ROWS,
    DATA_LENGTH,
    INDEX_LENGTH
FROM information_schema.TABLES
WHERE TABLE_SCHEMA = 'alfamart'
ORDER BY TABLE_ROWS DESC;
```

### Expected Output:
```
┌─────────────────┬──────────────┬─────────────┐
│ TABLE_NAME      │ TABLE_ROWS   │ SIZE (KB)   │
├─────────────────┼──────────────┼─────────────┤
│ orders          │ 1000+        │ 256         │
│ order_items     │ 5000+        │ 320         │
│ activity_logs   │ 10000+       │ 512         │
│ products        │ 1000+        │ 128         │
│ users           │ 500+         │ 64          │
│ reviews         │ 500+         │ 96          │
│ stock_logs      │ 2000+        │ 192         │
│ shipments       │ 500+         │ 96          │
│ payments        │ 1000+        │ 192         │
│ categories      │ 50+          │ 16          │
│ shopping_cart   │ 200+         │ 32          │
│ wishlist        │ 300+         │ 48          │
│ returns         │ 50+          │ 16          │
│ promotions      │ 20+          │ 8           │
└─────────────────┴──────────────┴─────────────┘
```

---

## 🔑 Primary & Foreign Keys

### Primary Keys
```
✓ users.user_id
✓ categories.category_id
✓ products.product_id
✓ orders.order_id
✓ order_items.order_item_id
✓ payments.payment_id
✓ shipments.shipment_id
✓ returns.return_id
✓ reviews.review_id
✓ shopping_cart.cart_id
✓ wishlist.wishlist_id
✓ stock_logs.log_id
✓ promotions.promo_id
✓ activity_logs.log_id
```

### Foreign Keys
```
products.category_id        → categories.category_id
orders.user_id              → users.user_id
order_items.order_id        → orders.order_id (CASCADE DELETE)
order_items.product_id      → products.product_id
payments.order_id           → orders.order_id
shipments.order_id          → orders.order_id
returns.order_id            → orders.order_id
reviews.product_id          → products.product_id
reviews.user_id             → users.user_id
reviews.order_id            → orders.order_id
shopping_cart.user_id       → users.user_id (CASCADE DELETE)
shopping_cart.product_id    → products.product_id
wishlist.user_id            → users.user_id (CASCADE DELETE)
wishlist.product_id         → products.product_id
stock_logs.product_id       → products.product_id
activity_logs.user_id       → users.user_id
```

---

## 📈 Data Types Reference

| Type | Size | Usage |
|------|------|-------|
| INT | 4 bytes | ID, quantities |
| BIGINT | 8 bytes | Large numbers |
| DECIMAL(10,2) | - | Money/prices |
| VARCHAR(100) | Variable | Names, emails |
| TEXT | Variable | Descriptions |
| TIMESTAMP | 4 bytes | Created/updated dates |
| DATE | 3 bytes | Delivery dates |
| DATETIME | 8 bytes | Specific times |
| BOOLEAN | 1 byte | is_active, flags |
| ENUM | 1-2 bytes | Status fields |

---

## 🏗️ Storage Engine

**Engine: InnoDB**
```sql
-- Features:
✓ Foreign Key Support (ACID compliance)
✓ Transaction Support (BEGIN, COMMIT, ROLLBACK)
✓ Crash Recovery
✓ Row-level Locking
✓ Full-text Search Support
```

---

## 💾 Backup Strategy

### Daily Backup
```bash
# Backup ke file
mysqldump -u root -p alfamart > alfamart_backup_$(date +%Y%m%d).sql

# Restore dari backup
mysql -u root -p alfamart < alfamart_backup_20240115.sql
```

### Scheduled Backup (di phpMyAdmin)
1. Database → Export → Format: SQL
2. Save file dengan naming: `alfamart_backup_YYYYMMDD.sql`

---

## 🔍 Index Strategy

### Indexes by Table

**USERS**
```sql
INDEX idx_email (email)           -- For login
INDEX idx_username (username)     -- For unique checks
```

**PRODUCTS**
```sql
INDEX idx_product_name (product_name)  -- For search
INDEX idx_sku (sku)                    -- For lookup
INDEX idx_stock (stock)                -- For low stock alerts
INDEX idx_category (category_id)       -- For filtering
```

**ORDERS**
```sql
INDEX idx_order_number (order_number)  -- For lookup
INDEX idx_user_id (user_id)            -- For customer orders
INDEX idx_order_date (order_date)      -- For reports
INDEX idx_order_status (order_status)  -- For filtering
COMPOSITE: idx_status_date (order_status, order_date)
```

**ORDER_ITEMS**
```sql
INDEX idx_order_id (order_id)          -- For order details
INDEX idx_product_id (product_id)      -- For product analysis
```

---

## 📊 Sample Query Optimization

### Query 1: Get Recent Orders (OPTIMIZED)
```sql
-- ✅ GOOD: Uses index on order_date
SELECT o.*, u.full_name 
FROM orders o
JOIN users u ON o.user_id = u.user_id
WHERE o.order_date > DATE_SUB(NOW(), INTERVAL 7 DAY)
ORDER BY o.order_date DESC;

-- ❌ BAD: Full table scan
SELECT o.*, u.full_name 
FROM orders o
JOIN users u ON o.user_id = u.user_id
WHERE YEAR(o.order_date) = 2024;
```

### Query 2: Find Products by Category (OPTIMIZED)
```sql
-- ✅ GOOD: Direct category lookup with index
SELECT p.* 
FROM products p
WHERE p.category_id = 1
ORDER BY p.product_name;

-- ❌ BAD: String comparison without index
SELECT p.* 
FROM products p
JOIN categories c ON p.category_id = c.category_id
WHERE c.category_name = 'Elektronik';
```

---

## 🚀 Performance Tips

1. **Use Indexes Wisely**
   - Index on WHERE, JOIN, ORDER BY columns
   - Avoid too many indexes (slows writes)

2. **Batch Operations**
   - Use INSERT ... VALUES (...), (...), (...)
   - Better than individual inserts

3. **Denormalization**
   - Store aggregates (total_amount, tax_amount)
   - Avoid complex joins in frequently used queries

4. **Archive Old Data**
   - Move completed orders to archive table
   - Keep main tables lean

5. **Monitor Performance**
   - Use EXPLAIN to analyze queries
   - Check slow query log

---

## 📊 Database Size Estimation

**For 10,000 customers, 50,000 orders:**

```
User Data:           ~5 MB
Products:            ~2 MB
Orders:             ~10 MB
Order Items:        ~15 MB
Other Tables:       ~5 MB
Indexes:            ~8 MB
─────────────────────────
Total:             ~45 MB
```

---

## ✅ Database Integrity

### Constraints Active
```
✓ PRIMARY KEY on all tables
✓ FOREIGN KEY relationships enforced
✓ UNIQUE constraints on business keys
✓ CHECK constraints on valid values
✓ DEFAULT values for common fields
✓ NOT NULL where required
```

### Data Validation Examples
```sql
-- Rating must be 1-5
ALTER TABLE reviews 
ADD CONSTRAINT check_rating CHECK (rating >= 1 AND rating <= 5);

-- Stock cannot be negative
ALTER TABLE products
ADD CONSTRAINT check_stock CHECK (stock >= 0);

-- Price must be positive
ALTER TABLE products
ADD CONSTRAINT check_price CHECK (price > 0);
```

---

## 🎯 Next Steps

1. ✅ Review this schema
2. ✅ Import into phpMyAdmin
3. ✅ Create sample data
4. ✅ Test queries
5. ✅ Create API endpoints
6. ✅ Connect with Flutter

---

**Database Alfamart - Production Ready! 🚀**
