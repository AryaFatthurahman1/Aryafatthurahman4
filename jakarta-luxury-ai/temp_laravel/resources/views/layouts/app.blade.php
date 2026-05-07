<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Jakarta Luxury AI') }} - Premium Concierge</title>
    @php
        $manifestPath = public_path('build/manifest.json');
        $manifest = file_exists($manifestPath)
            ? json_decode((string) file_get_contents($manifestPath), true)
            : [];
        $cssFile = $manifest['resources/css/app.css']['file'] ?? null;
        $jsFile = $manifest['resources/js/app.js']['file'] ?? null;
    @endphp
    @if ($cssFile)
        <link rel="stylesheet" href="{{ asset('temp_laravel/public/build/' . $cssFile) }}">
    @endif
    @if ($jsFile)
        <script type="module" src="{{ asset('temp_laravel/public/build/' . $jsFile) }}"></script>
    @endif
    <link rel="stylesheet" href="{{ asset('css/luxury.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --luxury-gold: #fbbf24;
        }
        .font-serif { font-family: 'Playfair Display', serif; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #010309; color: white; }
        .glass { background: rgba(1, 3, 9, 0.8); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255,255,255,0.05); }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 w-full z-50 glass border-b border-white/5 px-6 py-4 transition-all duration-300">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="w-8 h-8 bg-gradient-to-br from-luxury-gold to-yellow-700 rounded-lg flex items-center justify-center text-black font-bold font-serif text-lg">J</div>
                <div class="flex flex-col">
                    <span class="text-sm font-bold tracking-widest text-white group-hover:text-luxury-gold transition-colors">JAKARTA</span>
                    <span class="text-[10px] tracking-[0.3em] text-luxury-gold uppercase">Luxury AI</span>
                </div>
            </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('wisata.index') }}" class="text-xs font-bold uppercase tracking-widest hover:text-luxury-gold transition-colors {{ request()->routeIs('wisata.index') ? 'text-luxury-gold' : 'text-gray-300' }}">Wisata & Hotel</a>
                    <a href="{{ route('asisten-ai') }}" class="text-xs font-bold uppercase tracking-widest hover:text-luxury-gold transition-colors {{ request()->routeIs('asisten-ai') ? 'text-luxury-gold' : 'text-gray-300' }}">Asisten AI</a>
                    <a href="{{ route('reservasi') }}" class="text-xs font-bold uppercase tracking-widest hover:text-luxury-gold transition-colors {{ request()->routeIs('reservasi') ? 'text-luxury-gold' : 'text-gray-300' }}">Reservasi</a>
                </div>

            <!-- Auth Buttons -->
            <div class="flex items-center gap-4">
                @auth
                    <div class="hidden md:flex items-center gap-3">
                        <span class="text-xs text-gray-400">Halo, <span class="text-white">{{ Auth::user()->full_name ?? Auth::user()->name }}</span></span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="w-8 h-8 rounded-full border border-white/20 flex items-center justify-center hover:bg-white/10 transition-colors" title="Keluar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="hidden md:flex items-center gap-4">
                        <a href="{{ route('login') }}" class="text-xs font-medium uppercase tracking-widest text-gray-400 hover:text-white transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="px-5 py-2 bg-luxury-gold text-black text-xs font-bold uppercase tracking-widest hover:bg-white transition-colors rounded-sm">Daftar</a>
                    </div>
                @endauth

                <!-- Mobile Menu Toggle (Simplified) -->
                <button class="lg:hidden text-white hover:text-luxury-gold p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#050505] border-t border-white/5 pt-20 pb-10 mt-12 relative overflow-hidden">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-luxury-gold/5 blur-[120px] rounded-full pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="bg-luxury-gold text-black font-bold p-1 rounded-sm text-lg">J</span>
                        <span class="text-xl font-serif text-white tracking-widest">JAKARTA <span class="text-luxury-gold">LUXURY AI</span></span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed max-w-sm">
                        Platform eksklusif yang menggabungkan kecerdasan buatan dengan layanan gaya hidup premium di ibu kota.
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-serif mb-6">Tautan Cepat</h4>
                    <ul class="space-y-4 text-sm text-gray-400">
                        <li><a href="{{ route('wisata.index') }}" class="hover:text-luxury-gold transition-colors">Wisata & Hotel</a></li>
                        <li><a href="#" class="hover:text-luxury-gold transition-colors">Asisten AI</a></li>
                        <li><a href="#" class="hover:text-luxury-gold transition-colors">Reservasi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-serif mb-6">Hubungi Kami</h4>
                    <ul class="space-y-4 text-sm text-gray-400">
                        <li>concierge@luxury-jakarta.com</li>
                        <li>+62 21 5790 8888</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/5 pt-8 mt-10 text-center text-[10px] uppercase tracking-widest text-gray-600">
                &copy; {{ date('Y') }} Jakarta Luxury AI. All Rights Reserved.
            </div>
        </div>
    </footer>
</body>
</html>
