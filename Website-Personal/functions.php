<?php
// Contoh function dengan parameter dan return value
function calculateTotalPrice($basePrice, $participants, $discount = 0) {
    $total = $basePrice * $participants;
    if ($discount > 0) {
        $total = $total - ($total * ($discount / 100));
    }
    return $total;
}

// Contoh procedure (function tanpa return value)
function displayTourCategories($categories) {
    echo '<div class="category-list">';
    foreach ($categories as $key => $value) {
        echo '<span class="badge bg-secondary m-1">'.$value.'</span>';
    }
    echo '</div>';
}

// Contoh function dengan array
function getFeaturedTours() {
    return [
        [
            'id' => 1,
            'name' => 'Bali Adventure',
            'description' => 'Explore the beautiful island of Bali with our expert guides.',
            'price' => 499,
            'image' => 'assets/img/bali.jpg'
        ],
        [
            'id' => 2,
            'name' => 'Japan Cultural',
            'description' => 'Experience the rich culture of Japan in this 10-day tour.',
            'price' => 1299,
            'image' => 'assets/img/japan.jpg'
        ],
        [
            'id' => 3,
            'name' => 'New Zealand Trek',
            'description' => 'Hike through the stunning landscapes of New Zealand.',
            'price' => 899,
            'image' => 'assets/img/nz.jpg'
        ]
    ];
}

// Contoh function dengan looping while
function displayDiscountBanners() {
    $discounts = [10, 15, 20];
    $i = 0;
    while ($i < count($discounts)) {
        echo '<div class="alert alert-info">Special '.$discounts[$i].'% off on selected tours!</div>';
        $i++;
    }
}
?>