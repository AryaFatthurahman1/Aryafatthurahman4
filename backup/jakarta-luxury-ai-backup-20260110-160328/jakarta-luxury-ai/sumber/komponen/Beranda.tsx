
import React from 'react';
import { AppRoute } from '../tipe/tipe';

const Home: React.FC = () => {
  return (
    <div className="flex flex-col">
      {/* Hero Section */}
      <section className="relative h-[90vh] flex items-center justify-center overflow-hidden">
        <div className="absolute inset-0 z-0">
          <img
            src="https://images.unsplash.com/photo-1555899434-94d1368aa7af?auto=format&fit=crop&q=80&w=2000"
            alt="Jakarta Night"
            className="w-full h-full object-cover opacity-40"
          />
          <div className="absolute inset-0 bg-gradient-to-t from-luxury-dark via-transparent to-luxury-dark/50"></div>
        </div>

        <div className="relative z-10 text-center px-4 max-w-4xl">
          <h1 className="text-5xl md:text-8xl font-serif mb-6 leading-tight">
            Eksplorasi <span className="text-luxury-gold">Kemewahan</span> Jakarta
          </h1>
          <p className="text-lg md:text-xl text-gray-400 mb-10 font-light max-w-2xl mx-auto leading-relaxed">
            Perjalanan eksklusif dan desain kuliner mutakhir. Rasakan pengalaman Jakarta yang belum pernah Anda bayangkan sebelumnya.
          </p>
          <div className="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href={`#${AppRoute.TRAVEL}`} className="w-full sm:w-auto px-10 py-4 bg-luxury-gold text-black font-bold tracking-widest hover:bg-yellow-600 transition-all">
              JELAJAHI TRAVEL
            </a>
            <a href={`#${AppRoute.RESERVATION}`} className="w-full sm:w-auto px-10 py-4 border border-white/20 hover:border-luxury-gold transition-all tracking-widest uppercase text-sm">
              BUAT RESERVASI
            </a>
          </div>
        </div>
      </section>

      {/* Culinary Design Preview */}
      <section className="py-24 bg-luxury-card px-6">
        <div className="max-w-7xl mx-auto">
          <div className="flex flex-col md:flex-row items-center gap-16">
            <div className="flex-1 space-y-8">
              <h2 className="text-4xl md:text-5xl font-serif">Desain Kuliner & <span className="text-luxury-gold italic">Interior</span></h2>
              <p className="text-gray-400 leading-relaxed text-lg">
                Kami tidak hanya menyajikan makanan; kami menciptakan atmosfer. Dari interior bergaya Parisian hingga modernism minimalis di jantung Jakarta, setiap hidangan adalah karya seni.
              </p>
              <div className="grid grid-cols-2 gap-4">
                <div className="p-4 border border-luxury-gold/20 rounded-lg">
                  <h3 className="text-luxury-gold text-2xl font-serif mb-2">50+</h3>
                  <p className="text-xs uppercase tracking-widest">Restoran Mewah</p>
                </div>
                <div className="p-4 border border-luxury-gold/20 rounded-lg">
                  <h3 className="text-luxury-gold text-2xl font-serif mb-2">Exclusive</h3>
                  <p className="text-xs uppercase tracking-widest">Chef Internasional</p>
                </div>
              </div>
            </div>
            <div className="flex-1 grid grid-cols-2 gap-4">
              <img src="https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" className="rounded-xl object-cover h-96 w-full" alt="Luxury Restaurant Interior" />
              <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" className="rounded-xl object-cover h-96 mt-12 w-full" alt="Fine Dining Experience" />
            </div>
          </div>
        </div>
      </section>

      {/* Luxury Concierge Section (Rebranded) */}
      <section className="py-24 px-6 relative overflow-hidden bg-gradient-to-b from-black to-gray-900 border-t border-white/5">
        <div className="max-w-7xl mx-auto">
          <div className="flex flex-col lg:flex-row items-center gap-16">

            {/* Left: Text & Features */}
            <div className="flex-1 text-left">
              <span className="text-luxury-gold uppercase tracking-[0.4em] text-xs font-bold mb-4 block">The Art of Service</span>
              <h2 className="text-4xl md:text-6xl font-serif mb-6 leading-tight">
                Lebih Dari Sekadar <br /><span className="italic text-gray-500">Asisten Pribadi</span>
              </h2>
              <p className="text-gray-400 text-lg mb-12 max-w-xl leading-relaxed">
                Kami memadukan intuisi manusia dengan presisi teknologi untuk menyusun perjalanan yang sepenuhnya tentang Anda. Tak ada detail yang terlewat, tak ada keinginan yang mustahil.
              </p>

              <div className="space-y-8">
                {[
                  { title: 'Curated Itineraries', desc: 'Setiap detik perjalanan dirancang khusus sesuai preferensi dan mood Anda.', icon: '✨' },
                  { title: 'Privilege Access', desc: 'Akses instan ke lokasi tersembunyi dan event paling eksklusif di Jakarta.', icon: '🗝️' },
                  { title: '24/7 Royal Assistance', desc: 'Layanan siap sedia kapanpun Anda butuhkan, tanpa batasan waktu.', icon: '🛎️' },
                ].map((feature, idx) => (
                  <div key={idx} className="flex gap-6 group cursor-pointer">
                    <div className="w-12 h-12 bg-luxury-gold/10 rounded-full flex items-center justify-center text-2xl group-hover:bg-luxury-gold group-hover:text-black transition-colors">
                      {feature.icon}
                    </div>
                    <div>
                      <h3 className="text-xl font-serif text-white mb-2 group-hover:text-luxury-gold transition-colors">{feature.title}</h3>
                      <p className="text-gray-500 text-sm">{feature.desc}</p>
                    </div>
                  </div>
                ))}
              </div>
            </div>

            {/* Right: Visual Stats / Membership Card */}
            <div className="flex-1 w-full">
              <div className="relative bg-white/5 border border-white/10 rounded-2xl p-8 backdrop-blur-md hover:border-luxury-gold/30 transition-all duration-500 group">
                {/* Decorative Glow */}
                <div className="absolute -top-20 -right-20 w-64 h-64 bg-luxury-gold/5 rounded-full blur-3xl pointer-events-none"></div>

                <div className="flex justify-between items-start mb-8">
                  <div>
                    <h3 className="text-3xl font-serif text-white">Elite <span className="text-luxury-gold">Membership</span></h3>
                    <p className="text-xs text-gray-400 uppercase tracking-widest mt-1">Jakarta Luxury Club</p>
                  </div>
                  <div className="w-12 h-12 border border-luxury-gold/30 rounded-full flex items-center justify-center">
                    <span className="text-luxury-gold font-serif text-xl">JL</span>
                  </div>
                </div>

                {/* Live Stats */}
                <div className="grid grid-cols-2 gap-6 mb-8">
                  <div className="p-4 bg-black/40 rounded-lg">
                    <p className="text-2xl font-bold text-white mb-1">1,420+</p>
                    <p className="text-[10px] text-gray-400 uppercase tracking-wider">Perjalanan Terkurasi</p>
                  </div>
                  <div className="p-4 bg-black/40 rounded-lg">
                    <p className="text-2xl font-bold text-luxury-gold mb-1">98%</p>
                    <p className="text-[10px] text-gray-400 uppercase tracking-wider">Tingkat Kepuasan</p>
                  </div>
                </div>

                {/* "Current Status" Mockup */}
                <div className="border-t border-white/10 pt-6">
                  <div className="flex items-center gap-4 mb-4">
                    <div className="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <p className="text-xs text-gray-300 uppercase tracking-widest">Live Activity</p>
                  </div>
                  <div className="space-y-3">
                    <div className="flex justify-between items-center text-sm text-gray-400">
                      <span>Reservasi Hotel Mulia</span>
                      <span className="text-green-500 text-xs">Confirmed</span>
                    </div>
                    <div className="flex justify-between items-center text-sm text-gray-400">
                      <span>Private Jet to Bali</span>
                      <span className="text-luxury-gold text-xs">Processing...</span>
                    </div>
                  </div>
                </div>

                <button className="w-full mt-8 py-4 bg-luxury-gold text-black font-bold uppercase tracking-widest text-xs hover:bg-white transition-colors">
                  Bergabung Dengan Klub
                </button>
              </div>
            </div>

          </div>
        </div>
      </section>
    </div>
  );
};

export default Home;




