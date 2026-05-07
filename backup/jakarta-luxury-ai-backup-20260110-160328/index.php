<?php
session_start();
// Error reporting - turn off in production
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Basic Configuration
$halaman_aktif = isset($_GET['halaman']) ? $_GET['halaman'] : 'beranda';
$judul_halaman = "Jakarta Luxury AI - Travel & Concierge";
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

// Whitelist pages for security
$halaman_valid = [
    'beranda',
    'wisata',
    'kuliner', // Keeping for legacy reference if needed, though mostly removed
    'reservasi',
    'masuk',
    'daftar',
    'ai-designer',
    'admin'
];

if (!in_array($halaman_aktif, $halaman_valid)) {
    $halaman_aktif = 'beranda';
}
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $judul_halaman; ?></title>
    <meta name="description" content="Platform AI Luxury Travel & Concierge Pertama di Jakarta">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'luxury-gold': '#C5A059',
                        'luxury-dark': '#0A0A0A',
                        'luxury-card': '#141414',
                        'luxury-text': '#E5E5E5',
                    },
                    fontFamily: {
                        serif: ['Playfair Display', 'serif'],
                        sans: ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 1s ease-out',
                        'slide-up': 'slideUp 0.8s ease-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <style>
        body {
            background-color: #0A0A0A;
            color: #E5E5E5;
            font-family: 'Inter', sans-serif;
        }
        .font-serif { font-family: 'Playfair Display', serif; }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #0A0A0A;
        }
        ::-webkit-scrollbar-thumb {
            background: #333;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #C5A059;
        }

        .glass {
            background: rgba(10, 10, 10, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        
        .text-gradient {
            background: linear-gradient(to right, #C5A059, #FDB931);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col selection:bg-luxury-gold selection:text-black">

    <!-- Navigation -->
    <?php include 'aplikasi/komponen/navigasi.php'; ?>

    <!-- Main Content -->
    <main class="flex-grow pt-24">
        <?php 
            $path = "aplikasi/halaman/{$halaman_aktif}.php";
            if (file_exists($path)) {
                include $path;
            } else {
                echo "<div class='min-h-[50vh] flex items-center justify-center text-red-400'>Halaman tidak ditemukan.</div>";
            }
        ?>
    </main>

    <!-- Footer -->
    <?php include 'aplikasi/komponen/kaki_halaman.php'; ?>

    <!-- Global Scripts -->
    <script>
        // Simple logout handler
        function handleLogout() {
            if(confirm('Apakah Anda yakin ingin keluar?')) {
                // In a real app, verify via API first
                window.location.href = 'api/otentikasi/logout.php'; 
            }
        }
    </script>
</body>
</html>
