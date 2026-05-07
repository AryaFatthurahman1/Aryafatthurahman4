@extends('layouts.app')

@section('content')
<div class="h-[calc(100vh-80px)] overflow-hidden relative">
    <!-- Background Elements -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-[-20%] right-[-10%] w-[600px] h-[600px] bg-luxury-gold/5 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-20%] left-[-10%] w-[600px] h-[600px] bg-luxury-gold/5 rounded-full blur-[120px]"></div>
    </div>

    <!-- Main Container -->
    <div class="max-w-7xl mx-auto h-full px-6 py-6 flex flex-col relative z-10">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl md:text-4xl font-serif text-white">AI <span class="italic text-gold-gradient">Concierge</span></h1>
                <div class="flex items-center gap-2 mt-2">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    <span class="text-xs text-luxury-gold uppercase tracking-widest">Online • Ready to Serve</span>
                </div>
            </div>
            
            <button onclick="window.history.back()" class="px-4 py-2 border border-white/10 rounded-lg text-gray-400 hover:text-white hover:border-luxury-gold/50 transition-all text-xs uppercase tracking-widest">
                Kembali
            </button>
        </div>

        <!-- Chat Container -->
        <div class="flex-1 glass-card border border-white/10 rounded-2xl overflow-hidden shadow-2xl flex flex-col">
            <!-- Messages Area -->
            <div class="flex-1 overflow-y-auto p-6 md:p-8 space-y-8 scroll-smooth" id="chat-messages">
                <!-- AI Welcome Message -->
                <div class="flex items-start gap-4 max-w-2xl animate-fade-in">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-luxury-gold to-yellow-600 flex-shrink-0 flex items-center justify-center shadow-lg shadow-luxury-gold/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div class="space-y-2">
                        <div class="text-xs text-luxury-gold font-bold uppercase tracking-widest pl-1">Jakarta Luxury AI</div>
                        <div class="bg-white/5 border border-white/10 rounded-2xl rounded-tl-none p-5 shadow-inner">
                            <p class="text-gray-200 leading-relaxed text-sm md:text-base">
                                Selamat datang, Tuan. Saya siap membantu mengatur setiap detail perjalanan Anda di Jakarta. 
                                <br><br>
                                Anda dapat meminta rekomendasi restoran, reservasi jet pribadi, atau mengunggah itinerary Anda untuk saya pelajari.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Example User Message -->
                <div class="flex items-start gap-4 max-w-2xl ml-auto flex-row-reverse animate-fade-in" style="animation-delay: 0.1s">
                     <div class="w-10 h-10 rounded-full bg-white/10 flex-shrink-0 flex items-center justify-center border border-white/20">
                        <span class="text-white font-serif text-sm">You</span>
                    </div>
                    <div class="space-y-2 text-right">
                        <div class="bg-luxury-gold/10 border border-luxury-gold/20 rounded-2xl rounded-tr-none p-5">
                            <p class="text-gray-200 leading-relaxed text-sm md:text-base">
                                Saya ingin reservasi makan malam romantis dengan pemandangan kota. Tolong rekomendasikan tempat terbaik.
                            </p>
                        </div>
                    </div>
                </div>

                 <!-- AI Response -->
                 <div class="flex items-start gap-4 max-w-2xl animate-fade-in" style="animation-delay: 0.2s">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-luxury-gold to-yellow-600 flex-shrink-0 flex items-center justify-center shadow-lg shadow-luxury-gold/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div class="space-y-2">
                        <div class="text-xs text-luxury-gold font-bold uppercase tracking-widest pl-1">Jakarta Luxury AI</div>
                        <div class="bg-white/5 border border-white/10 rounded-2xl rounded-tl-none p-5 shadow-inner">
                            <p class="text-gray-200 leading-relaxed text-sm md:text-base mb-4">
                                Tentu. Berdasarkan preferensi kemewahan, saya merekomendasikan:
                            </p>
                            <div class="bg-black/40 rounded-xl p-4 border border-white/5 mb-4 hover:border-luxury-gold/30 transition-colors cursor-pointer group">
                                <h4 class="text-white font-serif text-lg group-hover:text-luxury-gold transition-colors">Henshin - The Westin Jakarta</h4>
                                <p class="text-xs text-gray-500 uppercase tracking-widest mb-2">Lantai 67 • Nikkei Cuisine</p>
                                <p class="text-gray-400 text-sm">Menawarkan pengalaman bersantap tertinggi di Indonesia dengan pemandangan 360 derajat kota Jakarta.</p>
                            </div>
                            <p class="text-gray-200 leading-relaxed text-sm md:text-base">
                                Apakah Anda ingin saya memproses reservasi untuk malam ini?
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Input Area -->
            <div class="p-4 md:p-6 bg-black/40 border-t border-white/10 backdrop-blur-md">
                <!-- File Preview (Hidden by default) -->
                <div id="file-preview" class="hidden mb-4 p-3 bg-white/5 rounded-lg border border-white/10 flex items-center justify-between w-fit max-w-md animate-slide-up">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-luxury-gold/20 rounded text-luxury-gold">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span id="file-name" class="text-sm text-gray-300 truncate max-w-[200px]">image.png</span>
                    </div>
                    <button onclick="removeFile()" class="ml-4 text-gray-500 hover:text-red-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="relative flex items-end gap-2 md:gap-4">
                     <!-- File Upload Button -->
                     <button onclick="document.getElementById('file-upload').click()" class="pb-3.5 pl-2 text-gray-400 hover:text-luxury-gold transition-colors" title="Upload Image/File">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                        </svg>
                    </button>
                    <input type="file" id="file-upload" class="hidden" onchange="handleFileUpload(this)">

                    <!-- Text Input -->
                    <div class="flex-1 relative">
                        <input type="text" 
                               placeholder="Ketik pesan Anda untuk Assistant..." 
                               class="w-full bg-white/5 border border-white/10 text-white rounded-xl py-4 pl-6 pr-14 focus:outline-none focus:border-luxury-gold focus:ring-1 focus:ring-luxury-gold transition-all placeholder-gray-600 text-sm md:text-base shadow-inner">
                        <button class="absolute right-2 top-2 bottom-2 aspect-square bg-luxury-gold rounded-lg hover:bg-white hover:text-black transition-all flex items-center justify-center shadow-lg shadow-luxury-gold/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform rotate-90" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function handleFileUpload(input) {
        if (input.files && input.files[0]) {
            const fileName = input.files[0].name;
            document.getElementById('file-name').textContent = fileName;
            document.getElementById('file-preview').classList.remove('hidden');
        }
    }

    function removeFile() {
        document.getElementById('file-upload').value = '';
        document.getElementById('file-preview').classList.add('hidden');
    }
</script>
@endsection
