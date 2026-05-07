@extends('layouts.app')

@section('content')
@section('content')
<div class="min-h-[90vh] flex items-center justify-center relative py-20 px-6">
    <!-- Background Elements -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-[20%] left-[-10%] w-[500px] h-[500px] bg-luxury-gold/5 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-[20%] right-[-10%] w-[500px] h-[500px] bg-luxury-gold/5 rounded-full blur-[100px]"></div>
    </div>

    <!-- Card Container -->
    <div class="w-full max-w-4xl glass-card rounded-2xl p-8 md:p-12 relative z-10 shadow-2xl border border-white/10 animate-fade-in">
        <div class="text-center mb-10 space-y-4">
            <span class="text-luxury-gold text-xs uppercase tracking-[0.3em] font-medium">Reservasi Eksklusif</span>
            <h1 class="text-4xl md:text-5xl font-serif text-white">Buat <span class="italic text-gold-gradient">Pesanan</span></h1>
            <p class="text-gray-400 text-sm max-w-lg mx-auto">
                Silakan isi detail di bawah ini untuk memulai pengalaman kemewahan tak terlupakan Anda.
            </p>
        </div>

        <form class="space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Name -->
                <div class="space-y-2 group">
                    <label class="text-xs uppercase tracking-widest text-gray-400 font-bold group-focus-within:text-luxury-gold transition-colors">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 group-focus-within:text-luxury-gold transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input type="text" class="w-full bg-black/40 border border-white/10 text-white rounded-lg pl-12 pr-4 py-4 focus:outline-none focus:border-luxury-gold focus:ring-1 focus:ring-luxury-gold transition-all placeholder-gray-600" placeholder="Nama Lengkap Anda">
                    </div>
                </div>
                
                <!-- Service Type -->
                <div class="space-y-2 group">
                    <label class="text-xs uppercase tracking-widest text-gray-400 font-bold group-focus-within:text-luxury-gold transition-colors">Layanan</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 group-focus-within:text-luxury-gold transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <select class="w-full bg-black/40 border border-white/10 text-white rounded-lg pl-12 pr-10 py-4 focus:outline-none focus:border-luxury-gold focus:ring-1 focus:ring-luxury-gold transition-all appearance-none cursor-pointer">
                            <option class="bg-luxury-black">Pilih Layanan</option>
                            <option class="bg-luxury-black">Hotel & Resor</option>
                            <option class="bg-luxury-black">Jet Pribadi</option>
                            <option class="bg-luxury-black">Tur Eksklusif</option>
                            <option class="bg-luxury-black">Makan Malam VIP</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Date -->
                <div class="space-y-2 group">
                    <label class="text-xs uppercase tracking-widest text-gray-400 font-bold group-focus-within:text-luxury-gold transition-colors">Tanggal</label>
                    <div class="relative">
                         <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 group-focus-within:text-luxury-gold transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input type="date" class="w-full bg-black/40 border border-white/10 text-white rounded-lg pl-12 pr-4 py-4 focus:outline-none focus:border-luxury-gold focus:ring-1 focus:ring-luxury-gold transition-all scheme-dark cursor-pointer text-gray-300">
                    </div>
                </div>

                <!-- Guests -->
                <div class="space-y-2 group">
                    <label class="text-xs uppercase tracking-widest text-gray-400 font-bold group-focus-within:text-luxury-gold transition-colors">Jumlah Tamu</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 group-focus-within:text-luxury-gold transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <input type="number" min="1" class="w-full bg-black/40 border border-white/10 text-white rounded-lg pl-12 pr-4 py-4 focus:outline-none focus:border-luxury-gold focus:ring-1 focus:ring-luxury-gold transition-all placeholder-gray-600" placeholder="2">
                    </div>
                </div>
            </div>

            <!-- Special Request -->
            <div class="space-y-2 group">
                <label class="text-xs uppercase tracking-widest text-gray-400 font-bold group-focus-within:text-luxury-gold transition-colors">Permintaan Khusus</label>
                <div class="relative">
                    <div class="absolute top-4 left-4 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 group-focus-within:text-luxury-gold transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <textarea rows="4" class="w-full bg-black/40 border border-white/10 text-white rounded-lg pl-12 pr-4 py-4 focus:outline-none focus:border-luxury-gold focus:ring-1 focus:ring-luxury-gold transition-all placeholder-gray-600" placeholder="Ceritakan detail kebutuhan Anda..."></textarea>
                </div>
            </div>

            <button type="button" class="w-full bg-gradient-to-r from-luxury-gold to-yellow-600 text-black font-bold uppercase tracking-widest py-4 rounded-lg hover:to-yellow-500 transition-all transform hover:scale-[1.01] shadow-lg shadow-luxury-gold/20">
                Konfirmasi Reservasi
            </button>
        </form>
    </div>
</div>
@endsection
