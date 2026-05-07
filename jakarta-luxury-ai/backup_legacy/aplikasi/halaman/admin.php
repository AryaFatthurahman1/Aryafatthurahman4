<?php
// Admin Page (Sederhana)
?>
<div class="py-20 px-6 max-w-7xl mx-auto">
    <div class="mb-12">
    <div class="mb-12">
        <h2 class="text-4xl font-serif mb-4">Panel <span class="text-luxury-gold">Admin</span></h2>
        <p class="text-gray-400">Kelola reservasi dan data aplikasi.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <div class="bg-luxury-card p-8 rounded-2xl border border-white/10">
            <h3 class="text-gray-500 text-xs uppercase tracking-widest mb-2 font-bold">Total Pemesanan</h3>
            <p id="total-res" class="text-3xl font-serif text-white">...</p>
        </div>
        <div class="bg-luxury-card p-8 rounded-2xl border border-white/10">
            <h3 class="text-gray-500 text-xs uppercase tracking-widest mb-2 font-bold">Layanan Aktif</h3>
            <p id="total-menu" class="text-3xl font-serif text-luxury-gold">...</p>
        </div>
        <div class="bg-luxury-card p-8 rounded-2xl border border-white/10">
            <h3 class="text-gray-500 text-xs uppercase tracking-widest mb-2 font-bold">Status Sistem</h3>
            <p class="text-3xl font-serif text-green-500">Online</p>
        </div>
    </div>

    <div class="bg-luxury-card rounded-2xl border border-white/10 overflow-hidden shadow-2xl">
        <div class="p-6 border-b border-white/10 flex justify-between items-center">
            <h3 class="font-bold uppercase tracking-widest text-xs">Pemesanan Terbaru</h3>
            <button onclick="fetchAdminData()" class="text-luxury-gold text-xs font-bold hover:underline">Muat Ulang</button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-black/40 text-gray-500 uppercase text-[10px] tracking-widest">
                    <tr>
                        <th class="p-6 font-bold">ID</th>
                        <th class="p-6 font-bold">Jenis</th>
                        <th class="p-6 font-bold">Tanggal</th>
                        <th class="p-6 font-bold">Status</th>
                        <th class="p-6 font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody id="admin-table-body" class="divide-y divide-white/5">
                    <!-- Data will be injected here -->
                    <tr>
                        <td colspan="5" class="p-20 text-center text-gray-600 italic">Memuat data reservasi...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    async function fetchAdminData() {
        try {
            const response = await fetch('api/reservasi/list.php');
            const data = await response.json();
            
            if (data.records) {
                document.getElementById('total-res').innerText = data.records.length;
                const tableBody = document.getElementById('admin-table-body');
                
                tableBody.innerHTML = data.records.map(res => `
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="p-6 font-bold text-luxury-gold">#${res.id}</td>
                        <td class="p-6">
                            <span class="px-2 py-1 bg-white/5 rounded text-[10px] uppercase font-bold tracking-tighter text-gray-400 border border-white/10">
                                ${res.type}
                            </span>
                        </td>
                        <td class="p-6 text-gray-400">${res.reservation_date}</td>
                        <td class="p-6">
                            <span class="text-yellow-500 text-xs font-bold uppercase tracking-widest">${res.status || 'Pending'}</span>
                        </td>
                        <td class="p-6">
                            <button class="text-white hover:text-luxury-gold transition-colors">Detail</button>
                        </td>
                    </tr>
                `).join('');
            }
        } catch (error) {
            console.error('Admin fetch error:', error);
        }
        
        // Mock menu count
        document.getElementById('total-menu').innerText = '24';
    }

    fetchAdminData();
</script>
