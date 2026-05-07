<?php
// Beranda Page
?>
<div class="space-y-32">
    <!-- Hero Section -->
    <section class="min-h-[90vh] flex items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-black/60 z-10"></div>
            <img src="https://images.unsplash.com/photo-1578683010236-d716f9a3f461?q=80&w=2070&auto=format&fit=crop" 
                 alt="Luxury Jakarta" 
                 class="w-full h-full object-cover animate-fade-in"
            />
        </div>

        <div class="relative z-20 text-center px-6 max-w-5xl mx-auto space-y-8 animate-slide-up">
            <div class="inline-block border border-luxury-gold/30 bg-black/50 backdrop-blur-md px-6 py-2 rounded-full mb-4">
                <span class="text-luxury-gold text-xs uppercase tracking-[0.3em] font-medium">The Future of Luxury</span>
            </div>
            <h1 class="text-5xl md:text-8xl font-serif text-white leading-tight">
                Jakarta <span class="text-transparent bg-clip-text bg-gradient-to-r from-luxury-gold to-yellow-600">Reimagined</span>
            </h1>
            <p class="text-lg text-gray-300 font-light max-w-2xl mx-auto leading-relaxed">
                Platform concierge bertenaga AI pertama yang mengkurasi pengalaman perjalanan, hotel bintang lima, dan gaya hidup elit di ibukota.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center pt-8">
                <a href="index.php?halaman=wisata" class="px-10 py-4 bg-luxury-gold text-black text-xs font-bold uppercase tracking-widest hover:bg-white transition-all duration-300 rounded-sm">
                    Mulai Eksplorasi
                </a>
                <a href="index.php?halaman=ai-designer" class="px-10 py-4 border border-white/20 text-white text-xs font-bold uppercase tracking-widest hover:border-luxury-gold hover:text-luxury-gold transition-all duration-300 rounded-sm backdrop-blur-sm">
                    Tanya AI Concierge
                </a>
            </div>
        </div>
    </section>

    <!-- Detail Foto / Gallery Section (Requested by User) -->
    <section class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div class="space-y-8">
                <h2 class="text-4xl md:text-5xl font-serif text-white">Visualisasi <br><span class="text-luxury-gold italic">Kemewahan</span></h2>
                <p class="text-gray-400 text-lg leading-relaxed">
                    Setiap sudut Jakarta memiliki cerita. Kami menangkap detail arsitektur modern, suasana lounge eksklusif, dan keindahan tersembunyi yang hanya bisa diakses oleh segelintir orang.
                </p>
                <div class="grid grid-cols-2 gap-8 pt-8">
                    <div>
                        <span class="block text-4xl font-serif text-luxury-gold mb-2">50+</span>
                        <span class="text-xs text-gray-500 uppercase tracking-widest">Lokasi Premium</span>
                    </div>
                    <div>
                        <span class="block text-4xl font-serif text-luxury-gold mb-2">AI</span>
                        <span class="text-xs text-gray-500 uppercase tracking-widest">Personal Assistant</span>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Grid -->
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-4 pt-12">
                    <img src="https://images.unsplash.com/photo-1600210492493-0946911123ea?w=800&q=80" class="w-full h-64 object-cover rounded-lg opacity-80 hover:opacity-100 transition-opacity duration-500" alt="Detail 1">
                    <img src="https://images.unsplash.com/photo-1563720223185-11003d516935?w=800&q=80" class="w-full h-80 object-cover rounded-lg opacity-80 hover:opacity-100 transition-opacity duration-500" alt="Detail 2">
                </div>
                <div class="space-y-4">
                    <img src="https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=800&q=80" class="w-full h-80 object-cover rounded-lg opacity-80 hover:opacity-100 transition-opacity duration-500" alt="Detail 3">
                    <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=800&q=80" class="w-full h-64 object-cover rounded-lg opacity-80 hover:opacity-100 transition-opacity duration-500" alt="Detail 4">
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
                    <a href="index.php?halaman=wisata" class="text-luxury-gold text-xs uppercase tracking-widest font-bold hover:text-white">Lihat Detail -></a>
                </div>
            </div>

            <!-- Hotel -->
            <div class="group relative h-[400px] overflow-hidden rounded-xl border border-white/10 hover:border-luxury-gold/50 transition-colors">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
                <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=800&q=80" class="w-full h-full object-cover -z-10 group-hover:scale-110 transition-transform duration-700" alt="Hotel & Resor">
                <div class="absolute bottom-0 left-0 p-8">
                    <h3 class="text-2xl font-serif text-white mb-2">Hotel & Resor</h3>
                    <p class="text-gray-400 text-sm mb-6 line-clamp-2">Nikmati kenyamanan menginap di hotel bintang lima terbaik (Ritz Carlton, Mulia, Kempinski).</p>
                    <a href="index.php?halaman=wisata#hotels" class="text-luxury-gold text-xs uppercase tracking-widest font-bold hover:text-white">Lihat Detail -></a>
                </div>
            </div>

            <!-- Private Jet -->
            <div class="group relative h-[400px] overflow-hidden rounded-xl border border-white/10 hover:border-luxury-gold/50 transition-colors">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
                <img src="https://images.unsplash.com/photo-1583416750470-965b2707b355?w=800&q=80" class="w-full h-full object-cover -z-10 group-hover:scale-110 transition-transform duration-700" alt="Jet Pribadi">
                <div class="absolute bottom-0 left-0 p-8">
                    <h3 class="text-2xl font-serif text-white mb-2">Jet Pribadi</h3>
                    <p class="text-gray-400 text-sm mb-6 line-clamp-2">Terbang dengan privasi dan kenyamanan maksimal menggunakan armada jet pribadi kami.</p>
                    <a href="index.php?halaman=wisata#flights" class="text-luxury-gold text-xs uppercase tracking-widest font-bold hover:text-white">Lihat Detail -></a>
                </div>
            </div>
        </div>
    </section>
</div>
