
import React, { useState } from 'react';
import { generateLuxuryImage, chatWithConcierge } from '../../layanan/layananGemini';

const AiDesigner: React.FC = () => {
  const [prompt, setPrompt] = useState('');
  const [loading, setLoading] = useState(false);
  const [generatedImg, setGeneratedImg] = useState<string | null>(null);
  const [chatHistory, setChatHistory] = useState<{ role: 'user' | 'ai'; text: string }[]>([]);
  const [chatInput, setChatInput] = useState('');
  const [roomType] = useState('');
  const [designStyle] = useState('');
  const [budget] = useState('');

  const handleGenerate = async () => {
    if (!prompt) return;
    setLoading(true);
    try {
      // Enhanced prompt for better results
      const enhancedPrompt = `Create a luxurious ${prompt} interior design for Jakarta luxury brand. Style: high-end, sophisticated, elegant atmosphere with gold accents. Premium materials, dramatic lighting, photorealistic, 8K resolution, architectural photography.`;
      const url = await generateLuxuryImage(enhancedPrompt);
      setGeneratedImg(url);
    } catch (error) {
      console.error('Error generating image:', error);
      // Better fallback with theme-specific images
      const fallbackImages = [
        'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800',
        'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=800',
        'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=800'
      ];
      setGeneratedImg(fallbackImages[Math.floor(Math.random() * fallbackImages.length)]);
    } finally {
      setLoading(false);
    }
  };

  const handleChat = async (e: React.FormEvent) => {
    e.preventDefault();
    if (!chatInput) return;

    const userMsg = chatInput;
    setChatInput('');
    setChatHistory(prev => [...prev, { role: 'user', text: userMsg }]);

    try {
      // Enhanced context for better responses
      const contextualPrompt = `User is asking about: "${userMsg}". As Jakarta Luxury AI concierge, provide personalized, elegant recommendations for luxury travel, dining, and experiences in Jakarta. Be specific and helpful.`;
      const aiResponse = await chatWithConcierge(contextualPrompt);
      if (aiResponse) {
        setChatHistory(prev => [...prev, { role: 'ai', text: aiResponse }]);
      }
    } catch (error) {
      console.error('Chat error:', error);
      // Better fallback responses
      const fallbackResponses = [
        'Selamat datang di Jakarta Luxury AI! Saya siap membantu Anda menemukan pengalaman mewah terbaik di Jakarta. Apa yang bisa saya bantu hari ini?',
        'Halo! Saya adalah concierge virtual Jakarta Luxury AI. Mari saya bantu Anda merencanakan pengalaman istimewa di Jakarta.',
        'Selamat datang! Sebagai concierge Jakarta Luxury AI, saya siap memberikan rekomendasi tempat mewah dan eksklusif untuk Anda.'
      ];
      setChatHistory(prev => [...prev, {
        role: 'ai',
        text: fallbackResponses[Math.floor(Math.random() * fallbackResponses.length)]
      }]);
    }
  };

  return (
    <div className="py-20 px-6 max-w-7xl mx-auto">
      <div className="text-center mb-16">
        <h1 className="text-4xl md:text-6xl font-serif mb-6 text-luxury-gold">AI Interior Designer</h1>
        <p className="text-xl text-gray-400 max-w-3xl mx-auto">
          Buat desain interior mewah untuk ruangan Anda dengan bantuan kecerdasan buatan terkini
        </p>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-12">
        {/* Left Side: Image Generation */}
        <div className="space-y-8">
          <h2 className="text-3xl font-serif">Visual <span className="text-luxury-gold">Designer</span> AI</h2>
          <p className="text-gray-400">Deskripsikan suasana impian Anda untuk restoran atau destinasi wisata, dan biarkan AI kami memvisualisasikannya.</p>

          <div className="space-y-4">
            <textarea
              value={prompt}
              onChange={(e) => setPrompt(e.target.value)}
              className="w-full h-32 bg-luxury-card border border-white/10 p-4 rounded-lg focus:border-luxury-gold outline-none text-sm transition-all"
              placeholder="Contoh: Modern minimalist restaurant in Jakarta with botanical garden theme and dim lighting..."
            ></textarea>

            <div className="flex flex-wrap gap-2">
              {['Modern Minimalist', 'Batavia Colonial', 'Tropical Luxury', 'Futuristic Cyberpunk', 'Javanese Royal'].map((style) => (
                <button
                  key={style}
                  onClick={() => setPrompt((prev) => `${prev} ${style} style, high-end interior, 8k resolution.`)}
                  className="px-3 py-1 bg-white/5 border border-white/10 text-xs text-gray-400 rounded-full hover:bg-luxury-gold hover:text-black hover:border-luxury-gold transition-all"
                >
                  + {style}
                </button>
              ))}
            </div>
            <button
              onClick={handleGenerate}
              disabled={loading}
              className={`w-full py-4 bg-luxury-gold text-black font-bold uppercase tracking-widest rounded transition-all ${loading ? 'opacity-50 cursor-not-allowed' : 'hover:bg-yellow-600'}`}
            >
              {loading ? 'Sedang Mendesain...' : 'Hasilkan Visual Desain'}
            </button>
          </div>

          <div className="aspect-video w-full bg-black/50 border border-white/5 rounded-lg overflow-hidden flex items-center justify-center relative">
            {generatedImg ? (
              <div className="relative w-full h-full">
                <img src={generatedImg} alt="AI Generated" className="w-full h-full object-cover" />
                <button
                  onClick={() => setGeneratedImg(null)}
                  className="absolute top-4 right-4 px-4 py-2 bg-red-500/20 text-red-500 text-xs hover:bg-red-500 hover:text-white font-bold uppercase tracking-wider border border-red-500/30 hover:border-red-500 rounded transition-all"
                >
                  Hapus
                </button>
              </div>
            ) : (
              <div className="text-gray-700 text-sm italic">Visualisasi desain akan muncul di sini</div>
            )}
            {loading && (
              <div className="absolute inset-0 bg-black/60 flex items-center justify-center">
                <div className="animate-spin rounded-full h-12 w-12 border-t-2 border-luxury-gold"></div>
              </div>
            )}
          </div>
        </div>

        {/* Right Side: AI Concierge Chat */}
        <div className="bg-luxury-card border border-white/10 rounded-2xl flex flex-col h-[700px] overflow-hidden shadow-2xl">
          <div className="p-6 border-b border-white/10 bg-black/40 flex items-center justify-between">
            <div className="flex items-center space-x-3">
              <div className="w-10 h-10 rounded-full bg-luxury-gold flex items-center justify-center text-black font-bold">C</div>
              <div>
                <h3 className="font-bold text-sm">Concierge Jakarta Luxury</h3>
                <span className="text-[10px] text-green-500 uppercase tracking-widest animate-pulse">Online</span>
              </div>
            </div>
          </div>

          <div className="flex-grow overflow-y-auto p-6 space-y-4 bg-[url('https://www.transparenttextures.com/patterns/black-paper.png')]">
            {chatHistory.length === 0 && (
              <div className="text-center py-20 text-gray-600">
                <p className="text-sm italic">"Selamat datang di Jakarta Luxury. Bagaimana saya bisa membantu merencanakan pengalaman istimewa Anda hari ini?"</p>
              </div>
            )}
            {chatHistory.map((msg, i) => (
              <div key={i} className={`flex ${msg.role === 'user' ? 'justify-end' : 'justify-start'}`}>
                <div className={`max-w-[80%] p-4 rounded-2xl text-sm leading-relaxed ${msg.role === 'user' ? 'bg-luxury-gold text-black rounded-tr-none' : 'bg-white/5 border border-white/10 text-gray-300 rounded-tl-none'
                  }`}>
                  {msg.text}
                </div>
              </div>
            ))}
          </div>

          <form onSubmit={handleChat} className="p-4 border-t border-white/10 bg-black/40">
            <div className="flex space-x-2">
              <input
                type="text"
                value={chatInput}
                onChange={(e) => setChatInput(e.target.value)}
                className="flex-grow bg-black border border-white/10 p-3 rounded-md outline-none focus:border-luxury-gold text-sm transition-all"
                placeholder="Tanyakan sesuatu..."
              />
              <button className="px-6 py-2 bg-luxury-gold text-black font-bold rounded-md hover:bg-yellow-600 transition-all uppercase text-xs">Kirim</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  );
};

export default AiDesigner;




