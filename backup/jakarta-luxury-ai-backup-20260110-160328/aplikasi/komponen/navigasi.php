<?php
// Navigasi Component - Pure HTML Fragment
// Vars available from index.php: $user
?>
<nav class="fixed top-0 left-0 w-full z-50 glass border-b border-white/5 px-6 py-4 transition-all duration-300" id="navbar">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <!-- Logo -->
        <a href="index.php?halaman=beranda" class="flex items-center gap-2 group">
            <div class="w-8 h-8 bg-gradient-to-br from-luxury-gold to-yellow-700 rounded-lg flex items-center justify-center text-black font-bold font-serif text-lg">J</div>
            <div class="flex flex-col">
                <span class="text-sm font-bold tracking-widest text-white group-hover:text-luxury-gold transition-colors">JAKARTA</span>
                <span class="text-[10px] tracking-[0.3em] text-luxury-gold uppercase">Luxury AI</span>
            </div>
        </a>

        <!-- Desktop Menu -->
        <div class="hidden lg:flex items-center space-x-8">
            <a href="index.php?halaman=wisata" class="<?php echo ($_GET['halaman'] ?? '') == 'wisata' ? 'text-luxury-gold' : 'text-gray-300'; ?> text-xs font-medium uppercase tracking-widest hover:text-luxury-gold transition-colors">Wisata & Hotel</a>
            <a href="index.php?halaman=ai-designer" class="<?php echo ($_GET['halaman'] ?? '') == 'ai-designer' ? 'text-luxury-gold' : 'text-gray-300'; ?> text-xs font-medium uppercase tracking-widest hover:text-luxury-gold transition-colors">Asisten AI</a>
            <a href="index.php?halaman=reservasi" class="<?php echo ($_GET['halaman'] ?? '') == 'reservasi' ? 'text-luxury-gold' : 'text-gray-300'; ?> text-xs font-medium uppercase tracking-widest hover:text-luxury-gold transition-colors">Reservasi</a>
            
            <?php if (isset($user) && $user && ($user['role'] ?? '') === 'admin'): ?>
                <a href="index.php?halaman=admin" class="text-xs font-bold uppercase tracking-widest text-red-500 hover:text-red-400">Admin</a>
            <?php endif; ?>
        </div>

        <!-- Auth Buttons -->
        <div class="flex items-center gap-4">
            <?php if (isset($user) && $user): ?>
                <div class="hidden md:flex items-center gap-3">
                    <span class="text-xs text-gray-400">Halo, <span class="text-white"><?php echo htmlspecialchars($user['full_name']); ?></span></span>
                    <button onclick="handleLogout()" class="w-8 h-8 rounded-full border border-white/20 flex items-center justify-center hover:bg-white/10 transition-colors" title="Keluar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </div>
            <?php else: ?>
                <div class="hidden md:flex items-center gap-4">
                    <a href="index.php?halaman=masuk" class="text-xs font-medium uppercase tracking-widest text-gray-400 hover:text-white transition-colors">Masuk</a>
                    <a href="index.php?halaman=daftar" class="px-5 py-2 bg-luxury-gold text-black text-xs font-bold uppercase tracking-widest hover:bg-white transition-colors rounded-sm">Daftar</a>
                </div>
            <?php endif; ?>

            <!-- Mobile Menu Toggle -->
            <button id="mobile-menu-btn" class="lg:hidden text-white hover:text-luxury-gold p-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu" class="hidden absolute top-full left-0 w-full bg-[#0A0A0A] border-b border-white/10 p-6 flex-col gap-4 shadow-2xl">
        <a href="index.php?halaman=wisata" class="text-sm uppercase tracking-widest text-gray-300 hover:text-luxury-gold py-2 border-b border-white/5">Wisata & Hotel</a>
        <a href="index.php?halaman=ai-designer" class="text-sm uppercase tracking-widest text-gray-300 hover:text-luxury-gold py-2 border-b border-white/5">Asisten AI</a>
        <a href="index.php?halaman=reservasi" class="text-sm uppercase tracking-widest text-gray-300 hover:text-luxury-gold py-2 border-b border-white/5">Reservasi</a>
        
        <?php if (isset($user) && $user): ?>
            <div class="py-2 border-t border-white/10 mt-2 flex justify-between items-center">
                <span class="text-sm text-gray-400"><?php echo htmlspecialchars($user['full_name']); ?></span>
                <button onclick="handleLogout()" class="text-xs text-red-400 uppercase tracking-widest">Keluar</button>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-2 gap-4 mt-2">
                <a href="index.php?halaman=masuk" class="text-center py-3 border border-white/10 text-xs uppercase tracking-widest text-gray-300 hover:border-luxury-gold">Masuk</a>
                <a href="index.php?halaman=daftar" class="text-center py-3 bg-luxury-gold text-black text-xs uppercase font-bold tracking-widest">Daftar</a>
            </div>
        <?php endif; ?>
    </div>
</nav>

<script>
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
            menu.classList.add('flex');
        } else {
            menu.classList.add('hidden');
            menu.classList.remove('flex');
        }
    });
</script>
