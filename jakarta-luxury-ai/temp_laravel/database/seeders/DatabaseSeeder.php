<?php

namespace Database\Seeders;

<<<<<<< HEAD
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Destinasi;

class DatabaseSeeder extends Seeder
{
=======
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

>>>>>>> c23f13e (Initial Laravel setup with AI Reservation page)
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD
        // Users
        User::create([
            'username' => 'admin',
            'email' => 'admin@jakartaluxury.ai',
            'password' => Hash::make('password'),
            'full_name' => 'Administrator',
            'role' => 'admin',
            'phone' => '081234567890'
        ]);

        User::create([
            'username' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'full_name' => 'Regular User',
            'role' => 'user'
        ]);

        // Travel Destinations
        $destinations = [
            [
                'name' => 'Pulau Macan Eco Resort',
                'description' => 'Surga tersembunyi di Kepulauan Seribu dengan konsep eco-living yang mewah dan privat. Nikmati keindahan laut dari villa di atas air.',
                'category' => 'Island',
                'price_range' => 'IDR 3.500.000 / malam',
                'location' => 'Kepulauan Seribu',
                'image_url' => 'https://images.unsplash.com/photo-1590523741831-ab7e8b8f9c7f?w=800&q=80',
                'rating' => 4.8,
                'featured' => true
            ],
            [
                'name' => 'Private History Tour Kota Tua',
                'description' => 'Jelajahi sejarah Jakarta dengan akses VIP ke museum dan gedung bersejarah, dipandu oleh ahli sejarah kurator.',
                'category' => 'History',
                'price_range' => 'IDR 1.500.000 / paket',
                'location' => 'Jakarta Barat',
                'image_url' => 'https://images.unsplash.com/photo-1565035010268-a3816f98589a?w=800&q=80',
                'rating' => 4.7,
                'featured' => false
            ],
            [
                'name' => 'Jakarta Skyline Helicopter Tour',
                'description' => 'Lihat kemegahan kota Jakarta dari ketinggian dengan layanan helikopter pribadi yang eksklusif.',
                'category' => 'Adventure',
                'price_range' => 'IDR 5.000.000 / 30 menit',
                'location' => 'Jakarta Pusat',
                'image_url' => 'https://images.unsplash.com/photo-1540962351504-03099e0a754b?w=800&q=80',
                'rating' => 4.9,
                'featured' => true
            ],
            [
                'name' => 'Shopping Spree at Plaza Indonesia',
                'description' => 'Pendampingan belanja pribadi di pusat perbelanjaan paling mewah di Jakarta.',
                'category' => 'Shopping',
                'price_range' => 'On Request',
                'location' => 'Jakarta Pusat',
                'image_url' => 'https://images.unsplash.com/photo-1567401893414-76b7b1e5a7a5?w=800&q=80',
                'rating' => 4.6,
                'featured' => false
            ],
            [
                'name' => 'Monas VIP Sunset Access',
                'description' => 'Akses eksklusif ke puncak Monas saat matahari terbenam dengan jamuan makan malam privat.',
                'category' => 'Landmark',
                'price_range' => 'IDR 2.000.000 / orang',
                'location' => 'Jakarta Pusat',
                'image_url' => 'https://images.unsplash.com/photo-1628258334105-2a0b3d6efee1?w=800&q=80',
                'rating' => 4.8,
                'featured' => true
            ]
        ];

        foreach ($destinations as $dest) {
            \App\Models\Destinasi::create($dest);
        }
=======
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
>>>>>>> c23f13e (Initial Laravel setup with AI Reservation page)
    }
}
