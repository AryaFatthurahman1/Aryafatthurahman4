<?php
// Reservasi Page
?>
<div class="max-w-4xl mx-auto px-6 pb-24">
    <div class="text-center mb-12">
        <h1 class="text-3xl md:text-5xl font-serif text-white mb-4">Buat <span class="text-luxury-gold italic">Reservasi</span></h1>
        <p class="text-gray-400">Kami akan menyusun setiap detail perjalanan Anda dengan presisi.</p>
    </div>

    <div class="bg-luxury-card border border-white/5 p-8 md:p-12 rounded-2xl relative overflow-hidden">
        <!-- Background element -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-luxury-gold/5 rounded-full blur-[100px] pointer-events-none"></div>

        <form id="reservation-form" class="space-y-8 relative z-10">
            <!-- Hidden inputs for pre-filled data -->
            <input type="hidden" id="item-input" name="item_id">

            <!-- Personal Info -->
            <div class="space-y-6">
                <h3 class="text-sm font-bold uppercase tracking-widest text-white border-b border-white/10 pb-2">Informasi Kontak</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" class="w-full bg-black/50 border border-white/10 p-4 text-white focus:border-luxury-gold transition-colors outline-none rounded-sm" placeholder="John Doe" required>
                    </div>
                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-2">Email</label>
                        <input type="email" name="email" class="w-full bg-black/50 border border-white/10 p-4 text-white focus:border-luxury-gold transition-colors outline-none rounded-sm" placeholder="john@example.com" required>
                    </div>
                </div>
            </div>

            <!-- Booking Details -->
            <div class="space-y-6">
                <h3 class="text-sm font-bold uppercase tracking-widest text-white border-b border-white/10 pb-2">Detail Pemesanan</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-2">Jenis Layanan</label>
                        <select id="type-select" name="type" class="w-full bg-black/50 border border-white/10 p-4 text-white focus:border-luxury-gold transition-colors outline-none rounded-sm">
                            <option value="travel">Paket Wisata Mewah</option>
                            <option value="hotel">Hotel & Resor</option>
                            <option value="flight">Charter Jet Pribadi</option>
                            <option value="concierge">Layanan Asisten AI</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-2">Item / Destinasi</label>
                        <input type="text" id="item-text" name="item_name" class="w-full bg-black/50 border border-white/10 p-4 text-white focus:border-luxury-gold transition-colors outline-none rounded-sm" placeholder="Pilih layanan atau ketik manual..." required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-2">Tanggal</label>
                        <input type="date" name="date" class="w-full bg-black/50 border border-white/10 p-4 text-white focus:border-luxury-gold transition-colors outline-none rounded-sm" required>
                    </div>
                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-2">Jumlah Tamu</label>
                        <input type="number" name="guests" min="1" value="1" class="w-full bg-black/50 border border-white/10 p-4 text-white focus:border-luxury-gold transition-colors outline-none rounded-sm" required>
                    </div>
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-500 mb-2">Permintaan Khusus</label>
                    <textarea name="request" rows="4" class="w-full bg-black/50 border border-white/10 p-4 text-white focus:border-luxury-gold transition-colors outline-none rounded-sm" placeholder="Ceritakan preferensi spesifik Anda..."></textarea>
                </div>
            </div>

            <button type="submit" class="w-full py-5 bg-luxury-gold text-black font-bold uppercase tracking-[0.2em] hover:bg-white transition-colors rounded-sm">
                Konfirmasi Reservasi
            </button>
        </form>

        <div id="success-msg" class="hidden text-center mt-8 p-6 bg-green-900/20 border border-green-500/30 rounded-lg">
            <h3 class="text-xl font-serif text-white mb-2">Reservasi Diterima</h3>
            <p class="text-gray-400 text-sm">Tim Concierge kami akan menghubungi Anda segera untuk konfirmasi dan pembayaran.</p>
        </div>
    </div>
</div>

<script>
    // Pre-fill form from URL params
    const urlParams = new URLSearchParams(window.location.search);
    const type = urlParams.get('type');
    const item = urlParams.get('item');

    if(type) {
        const select = document.getElementById('type-select');
        // Simple mapping or direct value setting if matches
        if([...select.options].some(o => o.value === type)) {
            select.value = type;
        }
    }

    if(item) {
        document.getElementById('item-text').value = decodeURIComponent(item);
    }

    // Handle Submit
    document.getElementById('reservation-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const btn = e.target.querySelector('button');
        const originalText = btn.innerText;
        btn.disabled = true;
        btn.innerText = 'MEMPROSES...';

        const formData = new FormData(e.target);
        
        try {
            // Convert to JSON and add mock/default data for API requirements
            const formDataObj = Object.fromEntries(formData.entries());
            
            // Allow guest reservations by checking user session or defaulting to 1 (Demo User)
            const payload = {
                ...formDataObj,
                user_id: <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : (isset($user['id']) ? $user['id'] : 1); ?>,
                item_id: formDataObj.item_id || 999, // Fallback ID if empty
                reservation_date: formDataObj.date, // Map form 'date' to API 'reservation_date'
                reservation_time: '10:00:00', // Default time
                total_price: 0, // TBD
                number_of_people: formDataObj.guests,
                special_requests: formDataObj.request
            };
            
            const response = await fetch('api/reservasi/create.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });
            
            // Handle non-JSON responses (like PHP errors)
            const textResult = await response.text();
            let result;
            try {
                result = JSON.parse(textResult);
            } catch (e) {
                console.error('Server returned non-JSON:', textResult);
                throw new Error('Server Return Invalid JSON');
            }

            if (response.ok || (result.message && result.message.toLowerCase().includes('success'))) {
                document.getElementById('reservation-form').classList.add('opacity-50', 'pointer-events-none');
                document.getElementById('success-msg').classList.remove('hidden');
                // Scroll to message
                document.getElementById('success-msg').scrollIntoView({ behavior: 'smooth' });
            } else {
                alert('Gagal: ' + (result.message || 'Error server'));
            }
        } catch (error) {
            console.error('Reservation Error:', error);
            alert('Terjadi kesalahan koneksi: ' + error.message);
        } finally {
            btn.disabled = false;
            btn.innerText = originalText;
        }
    });
</script>
