<?php
// AI Designer Page
?>
<div class="py-20 px-6 max-w-7xl mx-auto">
    <div class="text-center mb-16">
        <h1 class="text-4xl md:text-6xl font-serif mb-6 text-luxury-gold">AI Concierge & <span class="text-white">Designer</span></h1>
        <p class="text-xl text-gray-400 max-w-3xl mx-auto">
             Konsultasikan rencana perjalanan Anda dan buat konsep desain interior mewah dengan bantuan AI.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Left Side: Visual Inspiration (Static Mockup for simplicity) -->
        <div class="space-y-8">
            <h2 class="text-3xl font-serif">Inspirasi <span class="text-luxury-gold">Visual</span></h2>
            <p class="text-gray-400">Gunakan tema desain kami untuk memvisualisasikan atmosfer impian Anda.</p>
            
            <div id="visual-display" class="aspect-video w-full bg-luxury-card border border-white/5 rounded-2xl overflow-hidden flex items-center justify-center relative">
                <img id="design-img" src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=1200&q=80" alt="Design Preview" class="w-full h-full object-cover">
                <div id="design-loader" class="absolute inset-0 bg-black/60 flex items-center justify-center hidden">
                    <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-luxury-gold"></div>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                <?php
                $styles = [
                    'Modern Minimalist' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=600',
                    'Colonial Batavia' => 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=600',
                    'Tropical Luxury' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=600',
                    'Royal Javanese' => 'https://images.unsplash.com/photo-1518349662116-c411fe76a0d2?w=600',
                    'High-End Penthouse' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=600',
                    'Elegant Lounge' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=600'
                ];
                foreach ($styles as $name => $url): ?>
                    <button onclick="changeInspiration('<?php echo $url; ?>')" class="p-4 bg-white/5 border border-white/10 rounded-xl hover:border-luxury-gold transition-all text-xs text-gray-400 font-bold uppercase tracking-wider text-center">
                        <?php echo $name; ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Right Side: AI Concierge Chat -->
        <div class="bg-luxury-card border border-white/10 rounded-2xl flex flex-col h-[650px] overflow-hidden shadow-2xl">
            <div class="p-6 border-b border-white/10 bg-black/40 flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-luxury-gold flex items-center justify-center text-black font-bold shadow-[0_0_15px_rgba(197,160,89,0.5)]">C</div>
                <div>
                    <h3 class="font-bold text-sm text-white">Concierge Virtual</h3>
                    <span class="text-[10px] text-green-500 uppercase tracking-widest animate-pulse">Berbasis AI</span>
                </div>
            </div>

            <div id="chat-messages" class="flex-grow overflow-y-auto p-6 space-y-4 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]">
                    <div class="max-w-[85%] p-4 bg-white/5 border border-white/10 text-gray-300 rounded-2xl rounded-tl-none text-sm leading-relaxed">
                        Selamat datang di Jakarta Luxury Clubs. Saya adalah konsierge pribadi Anda. Mohon informasikan preferensi perjalanan atau gaya hidup yang Anda inginkan hari ini.
                    </div>
            </div>

            <form id="chat-form" class="p-4 border-t border-white/10 bg-black/40">
                <div class="flex space-x-2">
                    <input
                        type="text"
                        id="chat-input"
                        required
                        class="flex-grow bg-black border border-white/10 p-4 rounded-xl outline-none focus:border-luxury-gold text-sm text-white transition-all"
                        placeholder="Tanyakan rekomendasi atau rencana perjalanan..."
                    >
                    <button type="submit" class="px-8 py-2 bg-luxury-gold text-black font-bold rounded-xl hover:bg-yellow-600 transition-all uppercase text-xs">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function changeInspiration(url) {
        const img = document.getElementById('design-img');
        const loader = document.getElementById('design-loader');
        
        loader.classList.remove('hidden');
        img.style.opacity = '0.3';
        
        const newImg = new Image();
        newImg.src = url;
        newImg.onload = () => {
            img.src = url;
            img.style.opacity = '1';
            loader.classList.add('hidden');
        };
    }

    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    const chatMsg = document.getElementById('chat-messages');

    chatForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const msg = chatInput.value;
        chatInput.value = '';

        // Add user message
        appendMessage('user', msg);

        try {
            const response = await fetch('api/ai/chat.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    user_id: 1, // Mock
                    message: msg
                })
            });
            const data = await response.json();
            appendMessage('ai', data.response || 'Maaf, saya sedang sibuk. Silakan coba lagi nanti.');
        } catch (error) {
            appendMessage('ai', 'Maaf, terjadi kesalahan koneksi.');
        }
    });

    function appendMessage(role, text) {
        const div = document.createElement('div');
        div.className = `flex ${role === 'user' ? 'justify-end' : 'justify-start'}`;
        div.innerHTML = `
            <div class="max-w-[85%] p-4 rounded-2xl text-sm leading-relaxed ${
                role === 'user' 
                ? 'bg-luxury-gold text-black rounded-tr-none' 
                : 'bg-white/5 border border-white/10 text-gray-300 rounded-tl-none'
            }">
                ${text}
            </div>
        `;
        chatMsg.appendChild(div);
        chatMsg.scrollTop = chatMsg.scrollHeight;
    }
</script>
