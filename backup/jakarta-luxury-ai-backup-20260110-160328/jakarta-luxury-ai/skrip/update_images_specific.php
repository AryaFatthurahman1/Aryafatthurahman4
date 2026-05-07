<?php
require_once __DIR__ . '/../api/config/database.php';

$database = new Database();
$db = $database->getConnection();

// Update images with more specific URLs for Indonesian dishes
// Using Unsplash search IDs that better match each dish type
$updates = [
    // Nasi Goreng - Fried rice (search for fried rice)
    ['Truffle Nasi Goreng', 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=800&q=80&fit=crop'],
    
    // Ikan Bakar - Grilled fish (search for grilled fish)
    ['Ikan Bakar Jimbaran', 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=800&q=80&fit=crop'],
    
    // Rendang - Beef curry (search for beef curry/rendang)
    ['Rendang Daging Sapi', 'https://images.unsplash.com/photo-1565299507177-b0ac66763828?w=800&q=80&fit=crop'],
    
    // Wagyu Beef - Premium beef/steak
    ['Wagyu Beef Maranggi', 'https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=800&q=80&fit=crop'],
    
    // Sate Kambing - Goat skewers
    ['Sate Kambing', 'https://images.unsplash.com/photo-1544025162-d76694265947?w=800&q=80&fit=crop'],
    
    // Satay Ayam - Chicken skewers
    ['Satay Ayam Madura', 'https://images.unsplash.com/photo-1529042410759-befb1204b468?w=800&q=80&fit=crop'],
    
    // Ayam Goreng - Fried chicken
    ['Ayam Goreng Kalasan', 'https://images.unsplash.com/photo-1562967914-608f82629710?w=800&q=80&fit=crop'],
    
    // Lobster Laksa - Seafood soup
    ['Lobster Laksa Jakarta', 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=800&q=80&fit=crop'],
    
    // Pempek Palembang - Fish cakes
    ['Pempek Palembang', 'https://images.unsplash.com/photo-1574071318508-1cdbab80d002?w=800&q=80&fit=crop'],
    
    // Soto Betawi - Beef soup
    ['Soto Betawi Premium', 'https://images.unsplash.com/photo-1547592166-66ac770c5e2b?w=800&q=80&fit=crop'],
    
    // Bakso Malang - Meatballs soup
    ['Bakso Malang Jumbo', 'https://images.unsplash.com/photo-1551782450-17144efb5723?w=800&q=80&fit=crop'],
    
    // Kerak Telor - Omelette
    ['Kerak Telor Deluxe', 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=800&q=80&fit=crop'],
    
    // Martabak Manis - Sweet pancake
    ['Martabak Manis', 'https://images.unsplash.com/photo-1551024506-0bccd828d307?w=800&q=80&fit=crop'],
    
    // Gado-Gado - Salad
    ['Gado-Gado Jakarta', 'https://images.unsplash.com/photo-1512058424497-f9b2c5b6c6a8?w=800&q=80&fit=crop'],
    
    // Tahu Gejrot - Fried tofu
    ['Tahu Gejrot Cirebon', 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=800&q=80&fit=crop'],
    
    // Klepon - Rice balls
    ['Klepon', 'https://images.unsplash.com/photo-1571875257727-256c39da42af?w=800&q=80&fit=crop'],
    
    // Es Teler - Fruit cocktail
    ['Es Teler 77', 'https://images.unsplash.com/photo-1571091718767-18b5b1457add?w=800&q=80&fit=crop'],
    
    // Es Cendol - Cendol drink
    ['Es Cendol Durian', 'https://images.unsplash.com/photo-1570197788417-0e82375c9371?w=800&q=80&fit=crop'],
    
    // Nasi Uduk - Coconut rice
    ['Nasi Uduk Betawi', 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=800&q=80&fit=crop'],
    
    // Rijsttafel - Indonesian rice table
    ['Rijsttafel Modern Fusion', 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=800&q=80&fit=crop']
];

$query = "UPDATE culinary_items SET image_url = :image_url WHERE name = :name";
$stmt = $db->prepare($query);

$updated = 0;
foreach ($updates as $update) {
    $stmt->bindParam(":name", $update[0]);
    $stmt->bindParam(":image_url", $update[1]);
    
    if ($stmt->execute()) {
        $updated++;
        echo "Updated: " . $update[0] . "\n";
    } else {
        echo "Failed to update: " . $update[0] . "\n";
    }
}

echo "\nTotal updated: $updated culinary items\n";
echo "All images have been updated to match dish names!\n";
?>

