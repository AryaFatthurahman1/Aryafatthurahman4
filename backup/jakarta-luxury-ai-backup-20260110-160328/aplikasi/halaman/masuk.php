<?php
// Masuk (Login) Page
?>
<div class="min-h-[80vh] flex items-center justify-center px-6">
    <div class="w-full max-w-md bg-luxury-card p-10 border border-luxury-gold/20 rounded-lg shadow-2xl">
        <div class="border-b border-white/10 pb-8 mb-8 text-center">
            <h2 class="text-3xl font-serif text-white mb-2">Selamat Datang <span class="text-luxury-gold italic">Kembali</span></h2>
            <p class="text-gray-400 text-sm">Masuk untuk mengakses layanan concierge pribadi Anda.</p>
        </div>

        <div id="login-error" class="hidden mb-4 p-3 bg-red-900/20 border border-red-500 text-red-400 text-xs rounded"></div>
        <div id="login-success" class="hidden mb-4 p-3 bg-green-900/20 border border-green-500 text-green-400 text-xs rounded">Login Berhasil! Mengalihkan...</div>

        <form id="login-form" class="space-y-6">
            <!-- Email -->
            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-gray-500">Alamat Email</label>
                <input type="email" name="email" class="w-full bg-black border border-white/10 focus:border-luxury-gold p-4 text-white outline-none transition-colors rounded-sm" placeholder="nama@email.com" required>
            </div>

            <!-- Password -->
            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-gray-500">Kata Sandi</label>
                <input type="password" name="password" class="w-full bg-black border border-white/10 focus:border-luxury-gold p-4 text-white outline-none transition-colors rounded-sm" placeholder="••••••••" required>
            </div>

            <button type="submit" id="login-submit" class="w-full bg-luxury-gold text-black font-bold uppercase tracking-widest py-4 hover:bg-white transition-colors rounded-sm mt-8">
                Masuk Sekarang
            </button>
        </form>

        <div class="mt-8 text-center border-t border-white/10 pt-6">
            <p class="text-gray-500 text-xs">Belum menjadi anggota? <a href="index.php?halaman=daftar" class="text-luxury-gold hover:underline">Daftar Keanggotaan</a></p>
        </div>

        <div class="mt-6 pt-6 border-t border-white/10">
            <p class="text-[10px] text-gray-600 text-center uppercase tracking-widest">Login Admin Demo: admin@luxury.com / admin123</p>
        </div>
    </div>
</div>

<script>
    document.getElementById('login-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const errorDiv = document.getElementById('login-error');
        const submitBtn = document.getElementById('login-submit');
        const formData = new FormData(e.target);
        
        errorDiv.classList.add('hidden');
        submitBtn.disabled = true;
        submitBtn.innerText = 'Memproses...';

        try {
            const response = await fetch('api/otentikasi/login.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(Object.fromEntries(formData))
            });
            const result = await response.json();

            if (response.ok) {
                document.getElementById('login-success').classList.remove('hidden');
                setTimeout(() => {
                     window.location.href = 'index.php?halaman=beranda';
                }, 1500);
            } else {
                errorDiv.innerText = result.message || 'Login gagal.';
                errorDiv.classList.remove('hidden');
            }
        } catch (error) {
            errorDiv.innerText = 'Terjadi kesalahan sistem.';
            errorDiv.classList.remove('hidden');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerText = 'Masuk Sekarang';
        }
    });
</script>
