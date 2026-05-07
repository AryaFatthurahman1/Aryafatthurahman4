<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Reservation | Jakarta Luxury AI</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (via CDN for simplicity if build process is stuck, but we should use Vite eventually) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'luxury-files': '#1a1a1a', // Dark background
                        'luxury-gold': '#D4AF37', // Gold accent
                        'luxury-gold-light': '#F3E5AB',
                        'luxury-text': '#F5F5F5',
                        'luxury-muted': '#A3A3A3',
                    },
                    fontFamily: {
                        'serif': ['"Playfair Display"', 'serif'],
                        'sans': ['"Inter"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #0a0a0a;
            color: #f5f5f5;
        }
        .gold-gradient {
            background: linear-gradient(135deg, #D4AF37 0%, #F3E5AB 50%, #D4AF37 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .gold-border {
            border: 1px solid rgba(212, 175, 55, 0.3);
        }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="absolute w-full z-50 px-6 py-8">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="/" class="text-2xl font-serif font-bold tracking-wider text-luxury-gold">
                JAKARTA LUXURY
            </a>
            <div class="hidden md:flex space-x-8 text-sm uppercase tracking-widest text-luxury-muted">
                <a href="#" class="hover:text-luxury-gold transition-colors duration-300">Suites</a>
                <a href="#" class="hover:text-luxury-gold transition-colors duration-300">Dining</a>
                <a href="#" class="hover:text-luxury-gold transition-colors duration-300">Experience</a>
                <a href="#" class="text-luxury-gold border-b border-luxury-gold pb-1">Reservation</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center relative pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <!-- Background Elements -->
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
            <div class="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-l from-luxury-gold/5 to-transparent"></div>
            <div class="absolute bottom-0 left-0 w-1/4 h-1/2 bg-gradient-to-t from-luxury-gold/5 to-transparent"></div>
        </div>
        
        <div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 gap-16 relative z-10">
            <!-- Left Column: AI Assistant Context -->
            <div class="flex flex-col justify-center space-y-8">
                <div>
                    <h2 class="text-luxury-gold text-lg uppercase tracking-[0.2em] mb-4">Your Personal Concierge</h2>
                    <h1 class="font-serif text-5xl md:text-6xl text-white leading-tight mb-6">
                        Experience <br>
                        <span class="gold-gradient italic">Effortless</span> Booking.
                    </h1>
                    <p class="text-luxury-muted text-lg font-light leading-relaxed max-w-lg">
                        Our AI Assistant is at your service to curate your perfect stay. From suite selection to dining reservations, simply ask and we shall arrange it.
                    </p>
                </div>

                <!-- Chat Interface Mockup -->
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 p-6 rounded-lg max-w-md shadow-2xl">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-luxury-gold to-yellow-600 flex items-center justify-center text-black font-bold font-serif">JL</div>
                        <div>
                            <p class="text-white text-sm font-medium">Luxury Assistant</p>
                            <p class="text-xs text-luxury-gold animate-pulse">Online</p>
                        </div>
                    </div>
                    <div class="space-y-4 text-sm font-light">
                        <div class="bg-white/10 rounded-br-xl rounded-tr-xl rounded-bl-xl p-3 text-white/90 self-start">
                            Welcome to Jakarta Luxury. How may I assist you with your reservation today?
                        </div>
                        <div class="bg-luxury-gold/20 rounded-tl-xl rounded-tr-xl rounded-bl-xl p-3 text-luxury-gold self-end text-right ml-12 border border-luxury-gold/20">
                            I'd like to book a Presidential Suite for next weekend.
                        </div>
                        <div class="bg-white/10 rounded-br-xl rounded-tr-xl rounded-bl-xl p-3 text-white/90 self-start">
                            Excellent choice. For how many guests should I prepare the suite?
                        </div>
                    </div>
                    
                    <!-- Input Area -->
                    <div class="mt-6 relative">
                        <input type="text" placeholder="Type your request here..." class="w-full bg-black/50 border border-white/10 rounded px-4 py-3 text-white text-sm focus:outline-none focus:border-luxury-gold transition-colors placeholder-white/30">
                        <button class="absolute right-3 top-3 text-luxury-gold hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Column: Traditional Form -->
            <div class="flex flex-col justify-center">
                <div class="bg-[#111] p-8 md:p-12 border border-white/5 shadow-2xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-luxury-gold/10 rounded-bl-full -mr-12 -mt-12 transition-all duration-700 group-hover:scale-150"></div>
                    
                    <h3 class="font-serif text-3xl text-white mb-8 border-l-2 border-luxury-gold pl-4">Direct Reservation</h3>
                    
                    <form class="space-y-6">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs uppercase tracking-widest text-luxury-muted">Check In</label>
                                <input type="date" class="w-full bg-white/5 border-b border-white/10 py-2 text-white focus:outline-none focus:border-luxury-gold transition-colors">
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs uppercase tracking-widest text-luxury-muted">Check Out</label>
                                <input type="date" class="w-full bg-white/5 border-b border-white/10 py-2 text-white focus:outline-none focus:border-luxury-gold transition-colors">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs uppercase tracking-widest text-luxury-muted">Guests</label>
                            <select class="w-full bg-white/5 border-b border-white/10 py-2 text-white focus:outline-none focus:border-luxury-gold transition-colors [&>option]:text-black">
                                <option>1 Guest</option>
                                <option>2 Guests</option>
                                <option>3 Guests</option>
                                <option>4+ Guests</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs uppercase tracking-widest text-luxury-muted">Room Type</label>
                            <select class="w-full bg-white/5 border-b border-white/10 py-2 text-white focus:outline-none focus:border-luxury-gold transition-colors [&>option]:text-black">
                                <option>Deluxe King</option>
                                <option>Executive Suite</option>
                                <option>Presidential Suite</option>
                            </select>
                        </div>

                        <button type="button" class="mt-8 w-full bg-luxury-gold text-black uppercase tracking-widest py-4 text-xs font-bold hover:bg-white transition-colors duration-300">
                            Check Availability
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer class="text-center py-6 text-luxury-muted text-xs tracking-widest opacity-50">
        &copy; 2026 Jakarta Luxury AI. All Rights Reserved.
    </footer>
</body>
</html>
