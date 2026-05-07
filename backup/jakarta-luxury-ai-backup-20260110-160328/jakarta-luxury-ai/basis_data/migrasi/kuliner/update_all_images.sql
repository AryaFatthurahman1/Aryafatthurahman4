-- Update All Culinary Images with Proper Unsplash URLs
-- Each image is matched to the specific dish

USE jakarta_luxury_ai;

-- Rijsttafel Modern Fusion - Indonesian rice table
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=800&q=80&fit=crop' WHERE name = 'Rijsttafel Modern Fusion';

-- Wagyu Beef Maranggi - Premium beef
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=800&q=80&fit=crop' WHERE name = 'Wagyu Beef Maranggi';

-- Truffle Nasi Goreng - Fried rice
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1563379091339-032b9d7c6cf8?w=800&q=80&fit=crop' WHERE name = 'Truffle Nasi Goreng';

-- Lobster Laksa Jakarta - Laksa soup
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=800&q=80&fit=crop' WHERE name = 'Lobster Laksa Jakarta';

-- Soto Betawi Premium - Beef soup
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1547592166-66ac770c5e2b?w=800&q=80&fit=crop' WHERE name = 'Soto Betawi Premium';

-- Kerak Telor Deluxe - Omelette
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=800&q=80&fit=crop' WHERE name = 'Kerak Telor Deluxe';

-- Es Teler 77 - Fruit cocktail (unique image)
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1571091718767-18b5b1457add?w=800&q=80&fit=crop' WHERE name = 'Es Teler 77';

-- Gado-Gado Jakarta - Salad
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1512058424497-f9b2c5b6c6a8?w=800&q=80&fit=crop' WHERE name = 'Gado-Gado Jakarta';

-- Ayam Goreng Kalasan - Fried chicken
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1562967914-608f82629710?w=800&q=80&fit=crop' WHERE name = 'Ayam Goreng Kalasan';

-- Rendang Daging Sapi - Beef rendang
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1565299507177-b0ac66763828?w=800&q=80&fit=crop' WHERE name = 'Rendang Daging Sapi';

-- Bakso Malang Jumbo - Meatballs
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1551782450-17144efb5723?w=800&q=80&fit=crop' WHERE name = 'Bakso Malang Jumbo';

-- Satay Ayam Madura - Chicken satay
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1529042410759-befb1204b468?w=800&q=80&fit=crop' WHERE name = 'Satay Ayam Madura';

-- Pempek Palembang - Fish cakes (unique image)
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1574071318508-1cdbab80d002?w=800&q=80&fit=crop' WHERE name = 'Pempek Palembang';

-- Martabak Manis - Sweet pancake
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1551024506-0bccd828d307?w=800&q=80&fit=crop' WHERE name = 'Martabak Manis';

-- Nasi Uduk Betawi - Coconut rice
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=800&q=80&fit=crop' WHERE name = 'Nasi Uduk Betawi';

-- Sate Kambing - Goat satay
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1544025162-d76694265947?w=800&q=80&fit=crop' WHERE name = 'Sate Kambing';

-- Es Cendol Durian - Cendol drink (unique image)
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1570197788417-0e82375c9371?w=800&q=80&fit=crop' WHERE name = 'Es Cendol Durian';

-- Tahu Gejrot Cirebon - Fried tofu (unique image)
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=800&q=80&fit=crop' WHERE name = 'Tahu Gejrot Cirebon';

-- Ikan Bakar Jimbaran - Grilled fish (unique image)
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=800&q=80&fit=crop' WHERE name = 'Ikan Bakar Jimbaran';

-- Klepon - Rice balls (unique image)
UPDATE culinary_items SET image_url = 'https://images.unsplash.com/photo-1571875257727-256c39da42af?w=800&q=80&fit=crop' WHERE name = 'Klepon';

-- Verify updates
SELECT name, image_url FROM culinary_items ORDER BY name;

