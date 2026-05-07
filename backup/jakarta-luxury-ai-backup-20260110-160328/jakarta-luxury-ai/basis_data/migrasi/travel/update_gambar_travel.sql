-- Update Travel Images dengan Gambar yang Lebih Sesuai
-- Menggunakan gambar yang lebih relevan dengan nama destinasi
USE jakarta_luxury_ai;

-- Senayan Golf Club - gambar golf course yang lebih jelas
UPDATE travel_destinations SET image_url = 'https://images.unsplash.com/photo-1535131749006-b7f58c99034b?w=800&q=80' WHERE name LIKE '%Senayan Golf%';

-- Monas Luxury Lounge - gambar luxury lounge interior
UPDATE travel_destinations SET image_url = 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80' WHERE name LIKE '%Monas%';

-- Old Batavia VVIP Tour - gambar old colonial building/heritage
UPDATE travel_destinations SET image_url = 'https://images.unsplash.com/photo-1555881400-74d7acaacd8b?w=800&q=80' WHERE name LIKE '%Old Batavia%' OR name LIKE '%Kota Tua%';

-- Bundaran HI Sky Deck - gambar rooftop/sky deck view
UPDATE travel_destinations SET image_url = 'https://images.unsplash.com/photo-1514933651103-005eec06c04b?w=800&q=80' WHERE name LIKE '%Bundaran HI%';

-- Menteng Heritage Walk sudah bagus, tidak perlu diubah

-- Verify updates
SELECT name, image_url FROM travel_destinations ORDER BY name;
