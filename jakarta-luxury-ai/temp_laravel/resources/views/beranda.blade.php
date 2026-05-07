@extends('layouts.app')

@section('content')
<div class="space-y-32">
    <!-- Hero Section -->
    <!-- Hero Section -->
    <section class="min-h-screen flex items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-black/40 to-black z-10"></div>
            <!-- Jakarta Luxury Concierge Asset -->
            <img src="{{ asset('assets/concierge.png') }}" 
                 alt="Luxury Concierge" 
                 class="w-full h-full object-cover scale-105 animate-pan-slow"
            />
        </div>

        <div class="relative z-20 text-center px-6 max-w-5xl mx-auto space-y-8 animate-slide-up">
            <div class="inline-block border border-luxury-gold/30 bg-black/50 backdrop-blur-md px-6 py-2 rounded-full mb-4">
                <span class="text-luxury-gold text-xs uppercase tracking-[0.3em] font-medium">The Future of Luxury</span>
            </div>
            <h1 class="lux-h1" style="font-family: 'Playfair Display', serif;">
                Jakarta <span class="italic lux-grad-text">Reimagined</span>
            </h1>
            <p class="text-lg text-gray-300 font-light max-w-2xl mx-auto leading-relaxed">
                Platform concierge bertenaga AI pertama yang mengkurasi pengalaman perjalanan, hotel bintang lima, dan gaya hidup elit di ibukota.
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center pt-8">
                <a href="{{ route('wisata.index') }}" class="lux-btn">
                    Mulai Eksplorasi
                </a>
                <a href="{{ route('asisten-ai') }}" class="lux-btn lux-btn-outline">
                    Tanya AI Concierge
                </a>
            </div>
        </div>
    </section>

    <!-- Detail Foto / Gallery Section -->
    <section class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div class="space-y-8">
                <h2 class="text-4xl md:text-5xl font-serif text-white">Visualisasi <br><span class="text-luxury-gold italic">Kemewahan</span></h2>
                <p class="text-gray-400 text-lg leading-relaxed">
                    Setiap sudut Jakarta memiliki cerita. Kami menangkap detail arsitektur modern, suasana lounge eksklusif, dan keindahan tersembunyi yang hanya bisa diakses oleh segelintir orang.
                </p>
                <div class="grid grid-cols-2 gap-8 pt-8">
                    <div>
                        <span class="block text-4xl font-serif text-gold-gradient mb-2">50+</span>
                        <span class="text-xs text-gray-500 uppercase tracking-widest">Lokasi Premium</span>
                    </div>
                    <div>
                        <span class="block text-4xl font-serif text-gold-gradient mb-2">AI</span>
                        <span class="text-xs text-gray-500 uppercase tracking-widest">Personal Assistant</span>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-4 pt-12">
                    <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=800&q=80" class="w-full h-64 object-cover rounded-lg opacity-80 hover:opacity-100 transition-opacity duration-500" alt="Detail 1">
                    <img src="https://images.unsplash.com/photo-1578683010236-d716f9a3f461?w=800&q=80" class="w-full h-80 object-cover rounded-lg opacity-80 hover:opacity-100 transition-opacity duration-500" alt="Detail 2">
                </div>
                <div class="space-y-4">
                    <img src="https://images.unsplash.com/photo-1625244724120-1fd1d34d00f6?w=800&q=80" class="w-full h-80 object-cover rounded-lg opacity-80 hover:opacity-100 transition-opacity duration-500" alt="Detail 3">
                    <img src="https://images.unsplash.com/photo-1563720223185-11003d516935?w=800&q=80" class="w-full h-64 object-cover rounded-lg opacity-80 hover:opacity-100 transition-opacity duration-500" alt="Detail 4">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Preview -->
    <section class="max-w-7xl mx-auto px-6 pb-20">
        <div class="text-center mb-16">
            <span class="text-luxury-gold text-xs uppercase tracking-[0.2em]">Our Services</span>
            <h2 class="text-4xl font-serif text-white mt-4">Pengalaman Terkurasi</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Travel -->
            <div class="group relative h-[400px] overflow-hidden rounded-xl border border-white/10 hover:border-luxury-gold/50 transition-colors">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
                <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=800&q=80" class="w-full h-full object-cover -z-10 group-hover:scale-110 transition-transform duration-700" alt="Wisata Mewah">
                <div class="absolute bottom-0 left-0 p-8">
                    <h3 class="text-2xl font-serif text-white mb-2">Wisata Mewah</h3>
                    <p class="text-gray-400 text-sm mb-6 line-clamp-2">Jelajahi destinasi eksklusif Jakarta dengan akses VIP dan pelayanan privat.</p>
                    <a href="{{ route('wisata.index') }}" class="text-luxury-gold text-xs uppercase tracking-widest font-bold hover:text-white">Lihat Detail -></a>
                </div>
            </div>

            <!-- Hotel -->
            <div class="group relative h-[400px] overflow-hidden rounded-xl border border-white/10 hover:border-luxury-gold/50 transition-colors">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
                <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=800&q=80" class="w-full h-full object-cover -z-10 group-hover:scale-110 transition-transform duration-700" alt="Hotel & Resor">
                <div class="absolute bottom-0 left-0 p-8">
                    <h3 class="text-2xl font-serif text-white mb-2">Hotel & Resor</h3>
                    <p class="text-gray-400 text-sm mb-6 line-clamp-2">Nikmati kenyamanan menginap di hotel bintang lima terbaik.</p>
                    <a href="{{ route('wisata.index') }}#hotels" class="text-luxury-gold text-xs uppercase tracking-widest font-bold hover:text-white">Lihat Detail -></a>
                </div>
            </div>

            <!-- Private Jet -->
            <div class="group relative h-[400px] overflow-hidden rounded-xl border border-white/10 hover:border-luxury-gold/50 transition-colors">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
                <img src="https://images.unsplash.com/photo-1583416750470-965b2707b355?w=800&q=80" class="w-full h-full object-cover -z-10 group-hover:scale-110 transition-transform duration-700" alt="Jet Pribadi">
                <div class="absolute bottom-0 left-0 p-8">
                    <h3 class="text-2xl font-serif text-white mb-2">Jet Pribadi</h3>
                    <p class="text-gray-400 text-sm mb-6 line-clamp-2">Terbang dengan privasi dan kenyamanan maksimal menggunakan armada jet pribadi kami.</p>
                    <a href="{{ route('wisata.index') }}#flights" class="text-luxury-gold text-xs uppercase tracking-widest font-bold hover:text-white">Lihat Detail -></a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
