<?php
require_once __DIR__ . '/../api/config/database.php';

$database = new Database();
$db = $database->getConnection();

// Clear existing travel destinations
$query = "DELETE FROM travel_destinations";
$stmt = $db->prepare($query);
$stmt->execute();

// Insert new travel destinations with culinary theme
$destinations = [
    [
        'name' => 'Kota Tua Heritage Night',
        'description' => 'Experience the colonial charm of Jakarta\'s Old Town with luxury dining and cultural performances',
        'category' => 'Cultural',
        'price_range' => 'Rp 2.500.000',
        'location' => 'West Jakarta',
        'image_url' => 'https://images.unsplash.com/photo-1541628171120-d3e91141e6ce?w=800',
        'rating' => 4.8,
        'featured' => true
    ],
    [
        'name' => 'Luxury Yacht Thousand Islands',
        'description' => 'Premium yacht charter to pristine islands with gourmet onboard dining experience',
        'category' => 'Luxury',
        'price_range' => 'Rp 15.000.000',
        'location' => 'Thousand Islands',
        'image_url' => 'https://images.unsplash.com/photo-1567891777981-ed9796861529?w=800',
        'rating' => 4.9,
        'featured' => true
    ],
    [
        'name' => 'Jakarta Heli-Tour Skyline',
        'description' => 'Helicopter tour over Jakarta\'s skyline with exclusive rooftop dining experience',
        'category' => 'Adventure',
        'price_range' => 'Rp 8.000.000',
        'location' => 'Central Jakarta',
        'image_url' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800',
        'rating' => 4.7,
        'featured' => true
    ],
    [
        'name' => 'Artistic Gallery Private Tour',
        'description' => 'Curated art gallery tour with private chef dining experience',
        'category' => 'Cultural',
        'price_range' => 'Rp 3.200.000',
        'location' => 'South Jakarta',
        'image_url' => 'https://images.unsplash.com/photo-1493333858332-93acc5d1f504?w=800',
        'rating' => 4.6,
        'featured' => true
    ],
    [
        'name' => 'Presidential Suite Retreat',
        'description' => 'Luxury accommodation with private dining and concierge services',
        'category' => 'Luxury',
        'price_range' => 'Rp 25.000.000',
        'location' => 'Central Jakarta',
        'image_url' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=800',
        'rating' => 4.9,
        'featured' => true
    ],
    [
        'name' => 'Golf Executive Experience',
        'description' => 'Championship golf course with fine dining and business lounge facilities',
        'category' => 'Sports',
        'price_range' => 'Rp 5.500.000',
        'location' => 'South Jakarta',
        'image_url' => 'https://images.unsplash.com/photo-1587174486073-ae5e5cff23aa?w=800',
        'rating' => 4.5,
        'featured' => true
    ]
];

$query = "INSERT INTO travel_destinations (name, description, category, price_range, location, image_url, rating, featured) 
          VALUES (:name, :description, :category, :price_range, :location, :image_url, :rating, :featured)";

$stmt = $db->prepare($query);

foreach ($destinations as $destination) {
    $stmt->bindParam(":name", $destination['name']);
    $stmt->bindParam(":description", $destination['description']);
    $stmt->bindParam(":category", $destination['category']);
    $stmt->bindParam(":price_range", $destination['price_range']);
    $stmt->bindParam(":location", $destination['location']);
    $stmt->bindParam(":image_url", $destination['image_url']);
    $stmt->bindParam(":rating", $destination['rating']);
    $stmt->bindParam(":featured", $destination['featured']);
    
    if ($stmt->execute()) {
        echo "Inserted: " . $destination['name'] . "\n";
    } else {
        echo "Failed to insert: " . $destination['name'] . "\n";
    }
}

echo "Travel destinations updated successfully!\n";
?>