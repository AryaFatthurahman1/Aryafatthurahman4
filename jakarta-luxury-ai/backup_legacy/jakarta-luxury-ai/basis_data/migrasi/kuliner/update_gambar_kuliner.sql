-- Update Culinary Items with ALL UNSPLASH IMAGES for Reliability
USE jakarta_luxury_ai;
SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE culinary_items;

INSERT INTO culinary_items (name, description, category, price, restaurant_name, location, image_url, rating, featured) VALUES
('Wagyu Beef Maranggi', 'Sate Maranggi dari daging Wagyu A5 Jepang yang sangat lembut. Dimarinasi dengan rempah ketumbar dan gula aren organik, disajikan dengan sambal oncom pedas gurih dan lontong daun pisang.', 'Main Course', 450000, 'Majestic Kitchen', 'Central Jakarta', 'https://images.unsplash.com/photo-1603073163308-9654c3fb70b5?w=800&q=80', 4.9, TRUE),

('Rijsttafel Modern Fusion', 'Pengalaman makan malam kolonial yang mewah. Terdiri dari 12 macam lauk pauk nusantara yang disajikan dalam porsi degustasi modern, termasuk Rendang, Opor Ayam Truffle, dan Sambal Udang Petai.', 'Main Course', 350000, 'Amuz Gourmet', 'South Jakarta', 'https://images.unsplash.com/photo-1552590635-27c2c2128abf?w=800&q=80', 4.8, TRUE),

('Es Teler 77 Luxury', 'Kesegaran klasik dengan sentuhan premium. Menggunakan alpukat mentega pilihan, nangka matang pohon, kelapa muda serut, dan es serut salju dengan sirup pandan asli dan santan kental yang creamy.', 'Dessert', 35000, 'Es Teler 77', 'South Jakarta', 'https://images.unsplash.com/photo-1596562098006-2d1ec7ab7445?w=800&q=80', 4.4, TRUE),

('Rendang Daging Sapi', 'Rendang daging sapi wagyu yang dimasak perlahan selama 48 jam hingga bumbu meresap sempurna dan daging lumer di mulut. Disajikan dengan nasi putih panas dan daun singkong tumbuk.', 'Main Course', 180000, 'Rendang House', 'West Jakarta', 'https://images.unsplash.com/photo-1541544741938-0af808871cc0?w=800&q=80', 4.8, TRUE),

('Truffle Nasi Goreng', 'Nasi goreng kampung yang naik kelas. Menggunakan minyak truffle hitam asli Italia, potongan jamur shitake, dan telur mata sapi omega-3 setengah matang. Ditaburi kerupuk udang premium.', 'Main Course', 280000, 'Nasi Goreng Mafia', 'West Jakarta', 'https://images.unsplash.com/photo-1603133872878-684f10d6b7f4?w=800&q=80', 4.7, TRUE),

('Satay Ayam Madura', 'Sate ayam kampung dengan potongan besar yang juicy. Dilumuri bumbu kacang mede yang kental dan manis gurih. Disajikan dengan irisan bawang merah, cabai rawit, dan lontong.', 'Appetizer', 95000, 'Satay Madura', 'North Jakarta', 'https://images.unsplash.com/photo-1621516086708-306fbc82798e?w=800&q=80', 4.7, TRUE),

('Lobster Laksa Jakarta', 'Laksa Betawi super mewah dengan topping ekor lobster utuh yang manis. Kuah santan kuning yang kaya rempah kunyit dan serai, disajikan dengan bihun jagung lembut.', 'Main Course', 380000, 'Laksa Bar', 'North Jakarta', 'https://images.unsplash.com/photo-1551248429-40975aa4de74?w=800&q=80', 4.6, TRUE),

('Ikan Bakar Jimbaran', 'Ikan kakap merah segar dibakar dengan arang batok kelapa dan olesan bumbu Jimbaran Bali yang khas. Dilengkapi dengan plecing kangkung dan sambal matah segar.', 'Main Course', 160000, 'Ikan Bakar Jimbaran', 'Central Jakarta', 'https://images.unsplash.com/photo-1535914254981-96427dfc9e79?w=800&q=80', 4.7, TRUE),

('Soto Betawi Premium', 'Soto Betawi dengan kuah susu creamy dan minyak samin. Isi daging sapi tenderloin dan paru goreng renyah. Disajikan dengan emping melinjo dan acar segar.', 'Soup', 85000, 'Soto Betawi H. Husain', 'Central Jakarta', 'https://images.unsplash.com/photo-1572656631137-7935297eff55?w=800&q=80', 4.5, TRUE),

('Pempek Palembang', 'Pempek Kapal Selam jumbo isi telur bebek. Terbuat dari ikan tenggiri asli tanpa pengawet. Disiram kuah cuko aren kental yang pedas asam manis.', 'Snack', 65000, 'Pempek Palembang', 'South Jakarta', 'https://images.unsplash.com/photo-1563245372-f21776e36f9d?w=800&q=80', 4.5, FALSE),

('Es Cendol Durian', 'Minuman penutup legendaris. Cendol tepung beras, santan segar, gula merah cair, dan topping daging durian Medan yang tebal dan legit.', 'Dessert', 30000, 'Es Cendol', 'South Jakarta', 'https://images.unsplash.com/photo-1558961363-fa8fdf82db35?w=800&q=80', 4.5, FALSE),

('Nasi Uduk Betawi', 'Sarapan khas Jakarta yang mewah. Nasi uduk wangi pandan dengan lauk semur jengkol, bihun goreng, telur dadar iris, dan ayam goreng lengkuas.', 'Main Course', 55000, 'Nasi Uduk Betawi', 'Central Jakarta', 'https://images.unsplash.com/photo-1631452180519-c014fe946bc7?w=800&q=80', 4.4, FALSE),

('Martabak Manis', 'Martabak manis tebal dan bersarang sempurna. Diberi olesan mentega Wisman berlimpah, parutan keju Kraft, coklat meises, dan kacang tanah sangrai.', 'Dessert', 60000, 'Martabak Manis', 'East Jakarta', 'https://images.unsplash.com/photo-1621245376882-628d3bd66a50?w=800&q=80', 4.3, FALSE),

('Gado-Gado Jakarta', 'Salad sayur rebus (bayam, kacang panjang, tauge) dengan bumbu kacang tanah giling kasar yang medok. Dilengkapi kerupuk udang dan emping.', 'Salad', 55000, 'Gado-Gado Jakarta', 'Central Jakarta', 'https://images.unsplash.com/photo-1626801932371-d68748373b9e?w=800&q=80', 4.2, TRUE),

('Klepon', 'Jajanan pasar elegan. Bola tepung ketan pandan kenyal berisi gula merah cair yang meletus di mulut. Dibalur kelapa parut kukus yang gurih.', 'Dessert', 20000, 'Klepon Vendor', 'East Jakarta', 'https://images.unsplash.com/photo-1630409351241-e90e7f5e478e?w=800&q=80', 4.1, FALSE);

SET FOREIGN_KEY_CHECKS = 1;
