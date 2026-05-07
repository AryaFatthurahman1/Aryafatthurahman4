<?php
require_once __DIR__ . '/../api/config/database.php';

$database = new Database();
$db = $database->getConnection();

// Update culinary images with local assets
$updates = [
    ['Rijsttafel Modern Fusion', '/assets/culinary/rijsttafel.jpg'],
    ['Wagyu Beef Maranggi', '/assets/culinary/wagyu_ph.jpg'],
    ['Truffle Nasi Goreng', '/assets/culinary/nasi_goreng_ph.jpg'],
    ['Lobster Laksa Jakarta', '/assets/culinary/lobster_laksa.jpg'],
    ['Soto Betawi Premium', '/assets/culinary/soto_betawi.jpg'],
    ['Es Teler 77', '/assets/culinary/es_teler_ph.jpg'],
    ['Rendang Daging Sapi', '/assets/culinary/rendang.jpg'],
    ['Nasi Uduk Betawi', '/assets/culinary/nasi_uduk.jpg'],
    ['Es Cendol Durian', '/assets/culinary/es_cendol.jpg'],
    ['Pempek Palembang', '/assets/culinary/pempek_ph.jpg'],
    ['Klepon', '/assets/culinary/klepon_ph.jpg'],
    ['Martabak Manis', '/assets/culinary/martabak_ph.jpg'],
    ['Gado-Gado Jakarta', '/assets/culinary/gado_gado_ph.jpg'],
    ['Satay Ayam Madura', '/assets/culinary/sate_ayam_ph.jpg'],
    ['Ikan Bakar Jimbaran', '/assets/culinary/ikan_bakar_ph.jpg'],
    ['Tahu Gejrot Cirebon', '/assets/culinary/tahu_gejrot_ph.jpg'], // assuming
    ['Ayam Goreng Kalasan', '/assets/culinary/ayam_goreng_ph.jpg'], // assuming
    ['Sate Kambing', '/assets/culinary/sate_kambing_ph.jpg'], // assuming
    ['Bakso Malang Jumbo', '/assets/culinary/bakso_ph.jpg'], // assuming
    ['Kerak Telor Deluxe', '/assets/culinary/kerak_telor_ph.jpg'], // assuming
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
echo "Images updated to local assets!\n";
?>