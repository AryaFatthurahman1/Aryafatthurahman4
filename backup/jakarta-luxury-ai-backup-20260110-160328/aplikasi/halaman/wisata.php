<?php
// Wisata Page - Handles Travel, Hotels, and Flights
?>
<div class="max-w-7xl mx-auto px-6 pb-20">
    <!-- Header -->
    <div class="text-center mb-16 space-y-4">
        <span class="text-luxury-gold text-xs uppercase tracking-[0.2em] animate-fade-in">Pengalaman Terbaik</span>
        <h1 class="text-4xl md:text-6xl font-serif text-white animate-slide-up">Wisata <span class="italic text-luxury-gold">& Akomodasi</span></h1>
        <p class="text-gray-400 max-w-2xl mx-auto leading-relaxed">
            Temukan destinasi eksklusif, akomodasi kelas dunia, dan transportasi pribadi yang dirancang khusus untuk Anda.
        </p>
    </div>

    <!-- Tabs -->
    <div class="flex flex-wrap justify-center gap-4 mb-16 border-b border-white/10 pb-8">
        <button onclick="switchTab('destinations')" id="tab-destinations" class="tab-btn px-6 py-2 text-xs font-bold uppercase tracking-widest text-luxury-gold border-b-2 border-luxury-gold transition-all duration-300">
            Destinasi
        </button>
        <button onclick="switchTab('hotels')" id="tab-hotels" class="tab-btn px-6 py-2 text-xs font-bold uppercase tracking-widest text-gray-500 hover:text-white border-b-2 border-transparent transition-all duration-300">
            Hotel & Resor
        </button>
        <button onclick="switchTab('flights')" id="tab-flights" class="tab-btn px-6 py-2 text-xs font-bold uppercase tracking-widest text-gray-500 hover:text-white border-b-2 border-transparent transition-all duration-300">
            Jet Pribadi
        </button>
    </div>

    <!-- Loading State -->
    <div id="loading" class="flex flex-col items-center justify-center py-20">
        <div class="w-10 h-10 border-2 border-luxury-gold border-t-transparent rounded-full animate-spin mb-4"></div>
        <p class="text-xs text-gray-500 uppercase tracking-widest">Memuat Data...</p>
    </div>

    <!-- Content Grids -->
    <div id="content-area" class="hidden min-h-[400px]">
        <!-- Destinations Grid -->
        <div id="destinations-grid" class="grid grid-cols-1 md:grid-cols-3 gap-8 hidden animate-fade-in">
            <!-- Populated by JS -->
        </div>

        <!-- Hotels Grid (Dummy Data for Now) -->
        <!-- Hotels Grid -->
        <div id="hotels-grid" class="grid grid-cols-1 md:grid-cols-3 gap-8 hidden animate-fade-in">
             <!-- Hotel 1 -->
             <div class="bg-luxury-card border border-white/10 rounded-xl overflow-hidden group hover:border-luxury-gold transition-colors">
                <div class="h-64 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80" alt="Hotel Mulia Senayan" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute top-4 right-4 bg-black/70 backdrop-blur-md px-3 py-1 rounded-full border border-luxury-gold/30">
                        <span class="text-luxury-gold text-[10px] font-bold uppercase tracking-widest">5 Star</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-serif text-white mb-1">Hotel Mulia Senayan</h3>
                    <p class="text-luxury-gold text-xs font-bold uppercase tracking-widest mb-4">IDR 4.500.000 / MALAM</p>
                    <p class="text-gray-400 text-sm mb-6 line-clamp-2">Suites mewah dengan pemandangan kota yang menakjubkan, tempat beristirahat yang sempurna.</p>
                    
                    <!-- Stats -->
                    <div class="space-y-3 mb-6">
                        <div>
                            <div class="flex justify-between text-[10px] uppercase text-gray-500 mb-1">
                                <span>Peminat</span>
                                <span class="text-white">92%</span>
                            </div>
                            <div class="h-1 bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-luxury-gold" style="width: 92%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-[10px] uppercase text-gray-500 mb-1">
                                <span>Terpesan Bulan Ini</span>
                                <span class="text-white">148 Nights</span>
                            </div>
                            <div class="h-1 bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-green-500" style="width: 80%"></div>
                            </div>
                        </div>
                    </div>

                    <a href="index.php?halaman=reservasi&type=hotel&item=Hotel Mulia Senayan" class="block w-full py-3 border border-white/10 text-center text-xs text-white uppercase tracking-widest hover:bg-luxury-gold hover:text-black transition-colors rounded-sm">Reservasi</a>
                </div>
            </div>

            <!-- Hotel 2 -->
             <div class="bg-luxury-card border border-white/10 rounded-xl overflow-hidden group hover:border-luxury-gold transition-colors">
                <div class="h-64 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=800&q=80" alt="The Ritz-Carlton" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute top-4 right-4 bg-black/70 backdrop-blur-md px-3 py-1 rounded-full border border-luxury-gold/30">
                        <span class="text-luxury-gold text-[10px] font-bold uppercase tracking-widest">5 Star</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-serif text-white mb-1">The Ritz-Carlton</h3>
                    <p class="text-luxury-gold text-xs font-bold uppercase tracking-widest mb-4">IDR 5.200.000 / MALAM</p>
                    <p class="text-gray-400 text-sm mb-6 line-clamp-2">Pelayanan legendaris di pusat bisnis Jakarta, kenyamanan tak tertandingi.</p>
                    
                    <!-- Stats -->
                    <div class="space-y-3 mb-6">
                        <div>
                            <div class="flex justify-between text-[10px] uppercase text-gray-500 mb-1">
                                <span>Peminat</span>
                                <span class="text-white">96%</span>
                            </div>
                            <div class="h-1 bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-luxury-gold" style="width: 96%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-[10px] uppercase text-gray-500 mb-1">
                                <span>Terpesan Bulan Ini</span>
                                <span class="text-white">210 Nights</span>
                            </div>
                            <div class="h-1 bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-green-500" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>

                    <a href="index.php?halaman=reservasi&type=hotel&item=The Ritz-Carlton" class="block w-full py-3 border border-white/10 text-center text-xs text-white uppercase tracking-widest hover:bg-luxury-gold hover:text-black transition-colors rounded-sm">Reservasi</a>
                </div>
            </div>

            <!-- Hotel 3 -->
             <div class="bg-luxury-card border border-white/10 rounded-xl overflow-hidden group hover:border-luxury-gold transition-colors">
                <div class="h-64 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80" alt="Raffles Jakarta" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute top-4 right-4 bg-black/70 backdrop-blur-md px-3 py-1 rounded-full border border-luxury-gold/30">
                        <span class="text-luxury-gold text-[10px] font-bold uppercase tracking-widest">5 Star</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-serif text-white mb-1">Raffles Jakarta</h3>
                    <p class="text-luxury-gold text-xs font-bold uppercase tracking-widest mb-4">IDR 6.100.000 / MALAM</p>
                    <p class="text-gray-400 text-sm mb-6 line-clamp-2">Oasis artistik di tengah kota, tempat berteduh dengan gaya klasik modern.</p>
                    
                    <!-- Stats -->
                    <div class="space-y-3 mb-6">
                        <div>
                            <div class="flex justify-between text-[10px] uppercase text-gray-500 mb-1">
                                <span>Peminat</span>
                                <span class="text-white">94%</span>
                            </div>
                            <div class="h-1 bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-luxury-gold" style="width: 94%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-[10px] uppercase text-gray-500 mb-1">
                                <span>Terpesan Bulan Ini</span>
                                <span class="text-white">180 Nights</span>
                            </div>
                            <div class="h-1 bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-green-500" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>

                    <a href="index.php?halaman=reservasi&type=hotel&item=Raffles Jakarta" class="block w-full py-3 border border-white/10 text-center text-xs text-white uppercase tracking-widest hover:bg-luxury-gold hover:text-black transition-colors rounded-sm">Reservasi</a>
                </div>
            </div>
        </div>

         <div id="flights-grid" class="grid grid-cols-1 md:grid-cols-3 gap-8 hidden animate-fade-in">
             <!-- Item 1: Gulfstream G650 -->
             <div class="bg-luxury-card border border-white/10 rounded-xl overflow-hidden group hover:border-luxury-gold transition-colors">
                <div class="h-48 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1569154941061-e231b4725ef1?w=800&q=80" alt="Gulfstream G650" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute top-4 right-4 bg-black/70 backdrop-blur-md px-3 py-1 rounded-full border border-luxury-gold/30">
                        <span class="text-luxury-gold text-[10px] font-bold uppercase tracking-widest">Premium</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-serif text-white mb-1">Gulfstream G650</h3>
                    <p class="text-luxury-gold text-xs font-bold uppercase tracking-widest mb-4">$15,000 / JAM</p>
                    <p class="text-gray-400 text-sm mb-6 line-clamp-2">Kecepatan dan kenyamanan tak tertandingi untuk perjalanan bisnis global.</p>
                    
                    <!-- Stats -->
                    <div class="space-y-3 mb-6">
                        <div>
                            <div class="flex justify-between text-[10px] uppercase text-gray-500 mb-1">
                                <span>Peminat</span>
                                <span class="text-white">98%</span>
                            </div>
                            <div class="h-1 bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-luxury-gold" style="width: 98%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-[10px] uppercase text-gray-500 mb-1">
                                <span>Reservasi Bulan Ini</span>
                                <span class="text-white">12 Flights</span>
                            </div>
                            <div class="h-1 bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-green-500" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>

                    <a href="index.php?halaman=reservasi&type=flight&item=Gulfstream G650" class="block w-full py-3 border border-white/10 text-center text-xs text-white uppercase tracking-widest hover:bg-luxury-gold hover:text-black transition-colors rounded-sm">Reservasi</a>
                </div>
            </div>

            <!-- Item 2: Bombardier Global 7500 -->
            <div class="bg-luxury-card border border-white/10 rounded-xl overflow-hidden group hover:border-luxury-gold transition-colors">
                <div class="h-48 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1559081994-6970227d8531?w=800&q=80" alt="Bombardier Global 7500" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute top-4 right-4 bg-black/70 backdrop-blur-md px-3 py-1 rounded-full border border-luxury-gold/30">
                        <span class="text-luxury-gold text-[10px] font-bold uppercase tracking-widest">Premium</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-serif text-white mb-1">Bombardier Global 7500</h3>
                    <p class="text-luxury-gold text-xs font-bold uppercase tracking-widest mb-4">$18,000 / JAM</p>
                    <p class="text-gray-400 text-sm mb-6 line-clamp-2">Jangkauan ultra-long range dengan kabin termewah di kelasnya.</p>
                    
                    <!-- Stats -->
                     <div class="space-y-3 mb-6">
                        <div>
                            <div class="flex justify-between text-[10px] uppercase text-gray-500 mb-1">
                                <span>Peminat</span>
                                <span class="text-white">95%</span>
                            </div>
                            <div class="h-1 bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-luxury-gold" style="width: 95%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-[10px] uppercase text-gray-500 mb-1">
                                <span>Reservasi Bulan Ini</span>
                                <span class="text-white">8 Flights</span>
                            </div>
                            <div class="h-1 bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-green-500" style="width: 65%"></div>
                            </div>
                        </div>
                    </div>

                    <a href="index.php?halaman=reservasi&type=flight&item=Bombardier Global 7500" class="block w-full py-3 border border-white/10 text-center text-xs text-white uppercase tracking-widest hover:bg-luxury-gold hover:text-black transition-colors rounded-sm">Reservasi</a>
                </div>
            </div>

            <!-- Item 3: Embraer Phenom 300 -->
            <div class="bg-luxury-card border border-white/10 rounded-xl overflow-hidden group hover:border-luxury-gold transition-colors">
                <div class="h-48 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1583416750470-965b2707b355?w=800&q=80" alt="Embraer Phenom 300" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute top-4 right-4 bg-black/70 backdrop-blur-md px-3 py-1 rounded-full border border-luxury-gold/30">
                        <span class="text-luxury-gold text-[10px] font-bold uppercase tracking-widest">Premium</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-serif text-white mb-1">Embraer Phenom 300</h3>
                    <p class="text-luxury-gold text-xs font-bold uppercase tracking-widest mb-4">$4,500 / JAM</p>
                    <p class="text-gray-400 text-sm mb-6 line-clamp-2">Light jet untuk perjalanan regional yang efisien dan privat.</p>
                    
                     <!-- Stats -->
                     <div class="space-y-3 mb-6">
                        <div>
                            <div class="flex justify-between text-[10px] uppercase text-gray-500 mb-1">
                                <span>Peminat</span>
                                <span class="text-white">88%</span>
                            </div>
                            <div class="h-1 bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-luxury-gold" style="width: 88%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-[10px] uppercase text-gray-500 mb-1">
                                <span>Reservasi Bulan Ini</span>
                                <span class="text-white">22 Flights</span>
                            </div>
                            <div class="h-1 bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-green-500" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>

                    <a href="index.php?halaman=reservasi&type=flight&item=Embraer Phenom 300" class="block w-full py-3 border border-white/10 text-center text-xs text-white uppercase tracking-widest hover:bg-luxury-gold hover:text-black transition-colors rounded-sm">Reservasi</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // State
    const staticHotels = [
        {name: "Hotel Mulia Senayan", image: "https://images.unsplash.com/photo-1566073771259-6a8506099945?w=600&q=80", price: "IDR 4.500.000", desc: "Suites mewah dengan pemandangan kota.", type: "hotel"},
        {name: "The Ritz-Carlton", image: "https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=600&q=80", price: "IDR 5.200.000", desc: "Pelayanan legendaris di pusat bisnis.", type: "hotel"},
        {name: "Raffles Jakarta", image: "https://images.unsplash.com/photo-1590490360182-c33d57733427?w=600&q=80", price: "IDR 6.100.000", desc: "Oasis artistik di tengah kota.", type: "hotel"},
    ];

    // staticFlights array is removed as its content is now static HTML

    async function fetchData() {
        // Fetch destinations from API
        try {
            const response = await fetch('api/perjalanan/destinations.php');
            const data = await response.json();
            renderGrid('destinations-grid', data.records || [], 'travel');
        } catch (e) {
            console.log('Error fetching destinations', e);
        }

        // Render static data
        renderGrid('hotels-grid', staticHotels, 'hotel');
        // renderGrid('flights-grid', staticFlights, 'flight'); // Removed as flights are now static HTML
        
        document.getElementById('loading').classList.add('hidden');
        document.getElementById('content-area').classList.remove('hidden');
        switchTab(window.location.hash.replace('#', '') || 'destinations');
    }

    function renderGrid(elementId, items, type) {
        const container = document.getElementById(elementId);
        container.innerHTML = items.map(item => `
            <div class="bg-luxury-card border border-white/5 rounded-xl overflow-hidden group hover:border-luxury-gold/30 transition-all duration-300">
                <div class="relative h-64 overflow-hidden">
                    <img src="${item.image_url || item.image}" alt="${item.name}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute top-4 right-4 bg-black/60 backdrop-blur-md px-3 py-1 rounded-full border border-white/10">
                        <span class="text-luxury-gold text-xs font-bold">${item.rating ? '★ ' + item.rating : 'Premium'}</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-serif text-white mb-2">${item.name}</h3>
                    <p class="text-luxury-gold text-xs font-bold uppercase tracking-widest mb-4">${item.price_range || item.price || 'Contact for Price'}</p>
                    <p class="text-gray-400 text-sm mb-6 line-clamp-2">${item.description || item.desc}</p>
                    <a href="index.php?halaman=reservasi&type=${type}&item=${encodeURIComponent(item.name)}" class="block w-full text-center py-3 border border-white/10 text-white text-xs uppercase tracking-widest hover:bg-luxury-gold hover:text-black hover:border-luxury-gold transition-all rounded-sm">
                        Reservasi
                    </a>
                </div>
            </div>
        `).join('');
    }

    function switchTab(tab) {
        if(!['destinations', 'hotels', 'flights'].includes(tab)) tab = 'destinations';
        
        // Hide all grids
        ['destinations-grid', 'hotels-grid', 'flights-grid'].forEach(id => {
            document.getElementById(id).classList.add('hidden');
        });
        
        // Show active grid
        document.getElementById(`${tab}-grid`).classList.remove('hidden');
        
        // Update styling
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('text-luxury-gold', 'border-luxury-gold');
            btn.classList.add('text-gray-500', 'border-transparent');
        });
        const activeBtn = document.getElementById(`tab-${tab}`);
        activeBtn.classList.remove('text-gray-500', 'border-transparent');
        activeBtn.classList.add('text-luxury-gold', 'border-luxury-gold');
    }

    // Init
    fetchData();
</script>
```
