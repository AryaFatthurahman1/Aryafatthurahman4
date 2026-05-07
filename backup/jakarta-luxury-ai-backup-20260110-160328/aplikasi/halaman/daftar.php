<?php
// Daftar (Register) Page
?>
<div class="min-h-[90vh] flex items-center justify-center px-4 py-12 md:px-0">
    <div class="w-full max-w-2xl bg-luxury-card p-10 md:p-14 border border-luxury-gold/20 rounded-xl shadow-[0_0_50px_rgba(197,160,89,0.1)]">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif text-white mb-3">Registrasi <span class="text-luxury-gold italic">Keanggotaan</span></h2>
            <p class="text-gray-400 text-sm tracking-wide">Bergabunglah untuk akses eksklusif.</p>
        </div>

        <div id="register-error" class="hidden mb-8 p-4 bg-red-900/20 border border-red-500/50 text-red-300 text-sm rounded-lg text-center"></div>
        <div id="register-success" class="hidden mb-8 p-4 bg-green-900/20 border border-green-500/50 text-green-300 text-sm rounded-lg text-center">Registrasi Berhasil! Mengalihkan...</div>

        <form id="register-form" class="space-y-6">
            
            <!-- Account Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-luxury-gold">Username</label>
                    <input type="text" name="username" class="w-full bg-black/50 border border-white/10 focus:border-luxury-gold p-4 text-white outline-none transition-all rounded-sm placeholder-gray-700" placeholder="username" required>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-luxury-gold">Nama Identitas (Sesuai KTP)</label>
                    <input type="text" name="full_name" class="w-full bg-black/50 border border-white/10 focus:border-luxury-gold p-4 text-white outline-none transition-all rounded-sm placeholder-gray-700" placeholder="Nama Lengkap" required>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-luxury-gold">Alamat Email</label>
                    <input type="email" name="email" class="w-full bg-black/50 border border-white/10 focus:border-luxury-gold p-4 text-white outline-none transition-all rounded-sm placeholder-gray-700" placeholder="email@contoh.com" required>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-luxury-gold">Nomor Telepon</label>
                    <input type="tel" name="phone" class="w-full bg-black/50 border border-white/10 focus:border-luxury-gold p-4 text-white outline-none transition-all rounded-sm placeholder-gray-700" placeholder="+62..." required>
                </div>
            </div>

            <!-- Address -->
            <div class="space-y-2 pt-2">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-8 md:col-span-9 space-y-2">
                         <label class="text-[10px] font-bold uppercase tracking-widest text-luxury-gold">Jalan / Nama Komplek</label>
                         <input type="text" id="street" class="w-full bg-black/50 border border-white/10 focus:border-luxury-gold p-4 text-white outline-none transition-all rounded-sm placeholder-gray-700" placeholder="Jl. Jendral Sudirman..." required>
                    </div>
                    <div class="col-span-4 md:col-span-3 space-y-2">
                         <label class="text-[10px] font-bold uppercase tracking-widest text-luxury-gold">No. Rumah</label>
                         <input type="text" id="house_number" class="w-full bg-black/50 border border-white/10 focus:border-luxury-gold p-4 text-white outline-none transition-all rounded-sm placeholder-gray-700" placeholder="No. 123" required>
                    </div>
                </div>
            </div>

            <!-- Security -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                <div class="space-y-2">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-luxury-gold">Kata Sandi</label>
                    <input type="password" id="password" name="password" class="w-full bg-black/50 border border-white/10 focus:border-luxury-gold p-4 text-white outline-none transition-all rounded-sm" required>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-luxury-gold">Ulangi Kata Sandi</label>
                    <input type="password" id="confirmPassword" name="confirm_password" class="w-full bg-black/50 border border-white/10 focus:border-luxury-gold p-4 text-white outline-none transition-all rounded-sm" required>
                </div>
            </div>
            
            <button
                type="submit"
                id="register-submit"
                class="w-full py-5 bg-luxury-gold text-black font-bold tracking-[0.2em] hover:bg-white transition-all rounded-sm uppercase text-xs mt-10 disabled:opacity-50 disabled:cursor-not-allowed shadow-[0_0_20px_rgba(197,160,89,0.3)] hover:shadow-[0_0_30px_rgba(255,255,255,0.3)]"
            >
                Daftar Sekarang
            </button>
        </form>

        <p class="mt-10 text-center text-xs text-gray-500">
            Sudah memiliki akun? <a href="index.php?halaman=masuk" class="text-luxury-gold hover:text-white transition-colors ml-1">Masuk disini</a>
        </p>
    </div>
</div>

    <script>
    document.getElementById('register-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const errorDiv = document.getElementById('register-error');
        const submitBtn = document.getElementById('register-submit');
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        const formData = new FormData(e.target);
        
        errorDiv.classList.add('hidden');

        if (password !== confirmPassword) {
            errorDiv.innerText = 'Password tidak cocok.';
            errorDiv.classList.remove('hidden');
            return;
        }

        submitBtn.disabled = true;
        submitBtn.innerText = 'Memproses...';

        // Combine address
        const street = document.getElementById('street').value;
        const houseNumber = document.getElementById('house_number').value;
        const fullAddress = `${street}, No. ${houseNumber}`;

        const payload = Object.fromEntries(formData);
        payload.address = fullAddress; // Add address to payload

        try {
            const response = await fetch('api/otentikasi/register.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });
            const result = await response.json();

            if (response.ok) { // Check for HTTP success status
                document.getElementById('register-success').classList.remove('hidden');
                setTimeout(() => {
                    window.location.href = 'index.php?halaman=beranda';
                }, 1500);
            } else {
                errorDiv.innerText = result.message || 'Registrasi gagal.';
                errorDiv.classList.remove('hidden');
            }
        } catch (error) {
            console.error(error); // Debugging
            errorDiv.innerText = 'Terjadi kesalahan sistem.';
            errorDiv.classList.remove('hidden');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerText = 'Daftar Sekarang';
        }
    });
    </script>
