
import React, { useState, useEffect } from 'react';
import { layananApi } from '../../layanan/layananApi';

interface TravelDestination {
  id: number;
  name: string;
  description: string;
  category: string;
  price_range: string;
  location: string;
  image_url: string;
  rating: number;
  featured: boolean;
}

const TravelList: React.FC = () => {
  const [travelDestinations, setTravelDestinations] = useState<TravelDestination[]>([]);
  const [loading, setLoading] = useState(true);
  const [selectedDestination, setSelectedDestination] = useState<TravelDestination | null>(null);

  useEffect(() => {
    const fetchDestinations = async () => {
      try {
        const result = await layananApi.getDestinations();
        if (result.records) {
          setTravelDestinations(result.records);
        }
      } catch (error) {
        console.error('Error fetching destinations:', error);
      } finally {
        setLoading(false);
      }
    };

    fetchDestinations();
  }, []);

  const formatPrice = (priceRange: string) => {
    return priceRange === 'Free' ? 'Gratis' : priceRange;
  };

  return (
    <div className="w-full relative">
      {loading ? (
        <div className="text-center text-gray-400 py-10">Memuat destinasi...</div>
      ) : (
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
          {travelDestinations.map((destination) => (
            <div
              key={destination.id}
              className="group cursor-pointer"
              onClick={() => setSelectedDestination(destination)}
            >
              <div className="relative overflow-hidden mb-4 aspect-[4/5] rounded-lg bg-luxury-card">
                <img
                  src={destination.image_url}
                  alt={destination.name}
                  className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                  onError={(e) => {
                    const target = e.target as HTMLImageElement;
                    target.src = 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&q=80&fit=crop';
                  }}
                  loading="lazy"
                />
                <div className="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors"></div>
                <div className="absolute bottom-6 left-6">
                  <span className="bg-luxury-gold text-black text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-tighter">Limited Edition</span>
                </div>
              </div>
              <h3 className="text-xl font-serif mb-2 group-hover:text-luxury-gold transition-colors">{destination.name}</h3>
              <p className="text-luxury-gold font-bold">{formatPrice(destination.price_range)}</p>
              <p className="text-gray-400 text-sm mb-2">{destination.location}</p>
              <button className="mt-4 text-xs uppercase tracking-widest border-b border-white/20 pb-1 group-hover:border-luxury-gold transition-all">Lihat Detail</button>
            </div>
          ))}
        </div>
      )}

      {/* TRAVEL DETAIL MODAL */}
      {selectedDestination && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm animate-fade-in" onClick={() => setSelectedDestination(null)}>
          <div className="bg-luxury-card max-w-5xl w-full rounded-2xl overflow-hidden border border-white/10 shadow-2xl flex flex-col md:flex-row h-[80vh] md:h-[600px]" onClick={e => e.stopPropagation()}>
            <div className="w-full md:w-3/5 h-1/2 md:h-full relative bg-luxury-card">
              <img 
                src={selectedDestination.image_url} 
                alt={selectedDestination.name} 
                className="w-full h-full object-cover"
                onError={(e) => {
                  const target = e.target as HTMLImageElement;
                  target.src = 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&q=80&fit=crop';
                }}
                loading="lazy"
              />
              <div className="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-50"></div>
              <div className="absolute bottom-8 left-8">
                <span className="bg-luxury-gold text-black font-bold px-4 py-2 uppercase tracking-widest text-xs rounded-sm mb-4 inline-block">Exclusive Trip</span>
              </div>
            </div>
            <div className="w-full md:w-2/5 p-8 md:p-12 relative bg-[#0f0f0f] overflow-y-auto">
              <button
                onClick={() => setSelectedDestination(null)}
                className="absolute top-6 right-6 text-gray-400 hover:text-white transition-colors"
                aria-label="Close modal"
              >
                ✕
              </button>

              <div className="mt-4">
                <span className="text-luxury-gold text-xs font-bold tracking-widest uppercase mb-2 block">{selectedDestination.category}</span>
                <h2 className="text-3xl md:text-4xl font-serif text-white mb-6 leading-tight">{selectedDestination.name}</h2>

                <div className="flex items-center gap-4 mb-8 border-b border-white/10 pb-6">
                  <div className="flex items-center gap-1">
                    <span className="text-luxury-gold">★</span>
                    <span className="text-white text-sm font-bold">{selectedDestination.rating}</span>
                  </div>
                  <div className="w-1 h-1 bg-gray-600 rounded-full"></div>
                  <span className="text-gray-400 text-sm">{selectedDestination.location}</span>
                </div>

                <p className="text-gray-300 leading-relaxed mb-8 text-sm md:text-base">
                  {selectedDestination.description}
                  <br /><br />
                  Nikmati pengalaman tak terlupakan yang dirancang khusus untuk memenuhi standar kemewahan tertinggi. Fasilitas lengkap dengan pelayanan VIP menanti Anda.
                </p>

                <div className="mt-auto">
                  <p className="text-gray-500 text-xs uppercase tracking-widest mb-1">Mulai Dari</p>
                  <p className="text-2xl font-serif text-luxury-gold mb-6">{formatPrice(selectedDestination.price_range)}</p>

                  <button className="w-full py-4 bg-luxury-gold text-black font-bold uppercase tracking-widest rounded hover:bg-white transition-all shadow-lg hover:shadow-luxury-gold/20">
                    Reservasi Sekarang
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default TravelList;




