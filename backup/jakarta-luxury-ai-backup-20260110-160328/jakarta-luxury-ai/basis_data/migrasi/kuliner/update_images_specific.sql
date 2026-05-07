-- Update All Culinary Images with Specific Indonesian Food Images
-- Each image is carefully matched to the actual dish

USE jakarta_luxury_ai;

-- Nasi Goreng - Fried rice
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1563379091339-032b9d7c6cf8?w=800&q=80&fit=crop' WHERE name LIKE '%Nasi Goreng%';

-- Ikan Bakar - Grilled fish
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=800&q=80&fit=crop' WHERE name LIKE '%Ikan Bakar%';

-- Rendang - Beef rendang curry
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1565299507177-b0ac66763828?w=800&q=80&fit=crop' WHERE name LIKE '%Rendang%';

-- Wagyu Beef - Premium beef/steak
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=800&q=80&fit=crop' WHERE name LIKE '%Wagyu%' OR name LIKE '%Beef%';

-- Sate Kambing - Goat/lamb skewers
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1544025162-d76694265947?w=800&q=80&fit=crop' WHERE name LIKE '%Sate Kambing%';

-- Satay Ayam - Chicken skewers
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1529042410759-befb1204b468?w=800&q=80&fit=crop' WHERE name LIKE '%Satay%' OR name LIKE '%Sate Ayam%';

-- Ayam Goreng - Fried chicken
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1562967914-608f82629710?w=800&q=80&fit=crop' WHERE name LIKE '%Ayam Goreng%';

-- Lobster Laksa - Seafood laksa soup
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=800&q=80&fit=crop' WHERE name LIKE '%Laksa%';

-- Pempek Palembang - Fish cakes
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1574071318508-1cdbab80d002?w=800&q=80&fit=crop' WHERE name LIKE '%Pempek%';

-- Soto Betawi - Beef soup
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1547592166-66ac770c5e2b?w=800&q=80&fit=crop' WHERE name LIKE '%Soto%';

-- Bakso Malang - Meatballs soup
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1551782450-17144efb5723?w=800&q=80&fit=crop' WHERE name LIKE '%Bakso%';

-- Kerak Telor - Omelette
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=800&q=80&fit=crop' WHERE name LIKE '%Kerak Telor%';

-- Martabak Manis - Sweet pancake
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1551024506-0bccd828d307?w=800&q=80&fit=crop' WHERE name LIKE '%Martabak%';

-- Gado-Gado - Salad
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1512058424497-f9b2c5b6c6a8?w=800&q=80&fit=crop' WHERE name LIKE '%Gado%';

-- Tahu Gejrot - Fried tofu
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=800&q=80&fit=crop' WHERE name LIKE '%Tahu Gejrot%';

-- Klepon - Rice balls
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1571875257727-256c39da42af?w=800&q=80&fit=crop' WHERE name LIKE '%Klepon%';

-- Es Teler - Fruit cocktail
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1571091718767-18b5b1457add?w=800&q=80&fit=crop' WHERE name LIKE '%Es Teler%';

-- Es Cendol - Cendol drink
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1570197788417-0e82375c9371?w=800&q=80&fit=crop' WHERE name LIKE '%Cendol%';

-- Nasi Uduk - Coconut rice
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=800&q=80&fit=crop' WHERE name LIKE '%Nasi Uduk%';

-- Rijsttafel - Indonesian rice table
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=800&q=80&fit=crop' WHERE name LIKE '%Rijsttafel%';

-- Verify updates
SELECT name, image_url FROM culinary_items ORDER BY name;

