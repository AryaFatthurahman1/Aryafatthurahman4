<?php
// Kaki Halaman Component - Pure HTML Fragment
$year = date('Y');
?>
<footer class="bg-[#050505] border-t border-white/5 pt-20 pb-10 mt-12 relative overflow-hidden">
    <!-- Decorative Elements -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-luxury-gold/5 blur-[120px] rounded-full pointer-events-none"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-blue-500/5 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
            <!-- Brand -->
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-2 mb-6">
                    <span class="bg-luxury-gold text-black font-bold p-1 rounded-sm text-lg">J</span>
                    <span class="text-xl font-serif text-white tracking-widest">JAKARTA <span class="text-luxury-gold">LUXURY AI</span></span>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed max-w-sm">
                    Platform eksklusif yang menggabungkan kecerdasan buatan dengan layanan gaya hidup premium di ibu kota. Kurasi pengalaman terbaik untuk Anda.
                </p>
            </div>

            <!-- Links -->
            <div>
                <h4 class="text-white font-serif mb-6">Tautan Cepat</h4>
                <ul class="space-y-4 text-sm text-gray-400">
                    <li><a href="index.php?halaman=wisata" class="hover:text-luxury-gold transition-colors">Wisata & Hotel</a></li>
                    <li><a href="index.php?halaman=ai-designer" class="hover:text-luxury-gold transition-colors">Asisten AI</a></li>
                    <li><a href="index.php?halaman=reservasi" class="hover:text-luxury-gold transition-colors">Reservasi</a></li>
                </ul>
            </div>

            <!-- Contact & Social -->
            <div>
                <h4 class="text-white font-serif mb-6">Hubungi Kami</h4>
                <ul class="space-y-4 text-sm text-gray-400 mb-6">
                    <li>concierge@luxury-jakarta.com</li>
                    <li>+62 21 5790 8888</li>
                    <li>SCBD, Jakarta Selatan</li>
                </ul>
                <div class="flex space-x-4">
                    <!-- Instagram -->
                    <a href="#" class="text-gray-400 hover:text-luxury-gold transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <!-- Facebook -->
                    <a href="#" class="text-gray-400 hover:text-luxury-gold transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                    </a>
                    <!-- X / Twitter -->
                    <a href="#" class="text-gray-400 hover:text-luxury-gold transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                </div>
            </div>
        </div>
        <!-- Bottom -->
        <div class="border-t border-white/5 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-[10px] uppercase tracking-widest text-gray-600">
            <p>&copy; <?php echo $year; ?> Jakarta Luxury AI. All Rights Reserved.</p>
            <div class="flex gap-6">
                <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
