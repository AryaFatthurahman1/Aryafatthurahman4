import React from 'react';

const hotels = [
    {
        id: 1,
        name: "The Raffles Jakarta",
        description: "An oasis of art and luxury in the heart of Kuningan. Features legendary butler service and the finest artistic heritage.",
        price: "Start from Rp 4.500.000 / night",
        image: "https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=800",
        rating: 4.9,
        location: "Kuningan"
    },
    {
        id: 2,
        name: "Hotel Indonesia Kempinski",
        description: "Historical landmark facing the Welcome Monument. The epitome of European luxury blended with Indonesian heritage.",
        price: "Start from Rp 3.800.000 / night",
        image: "https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800",
        rating: 4.8,
        location: "Thamrin"
    },
    {
        id: 3,
        name: "The Langham, Jakarta",
        description: "British elegance meets modern sophistication in SCBD. Home to the world-renowned Chuan Spa.",
        price: "Start from Rp 5.200.000 / night",
        image: "https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800",
        rating: 5.0,
        location: "SCBD"
    }
];

const Hotels: React.FC = () => {
    return (
        <div className="animate-fade-in">
            <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                {hotels.map((hotel) => (
                    <div key={hotel.id} className="group bg-luxury-card/50 border border-white/5 rounded-xl overflow-hidden hover:border-luxury-gold/50 transition-all duration-500 hover:shadow-[0_0_30px_rgba(197,160,89,0.15)]">
                        <div className="relative h-64 overflow-hidden bg-luxury-card">
                            <img
                                src={hotel.image}
                                alt={hotel.name}
                                className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                onError={(e) => {
                                  const target = e.target as HTMLImageElement;
                                  target.src = 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=800&q=80&fit=crop';
                                }}
                                loading="lazy"
                            />
                            <div className="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>
                            <div className="absolute bottom-4 left-4">
                                <span className="bg-luxury-gold text-black text-[10px] font-bold px-2 py-1 uppercase tracking-widest rounded-sm">
                                    {hotel.location}
                                </span>
                            </div>
                        </div>

                        <div className="p-6">
                            <div className="flex justify-between items-start mb-2">
                                <h3 className="text-xl font-serif text-white group-hover:text-luxury-gold transition-colors">{hotel.name}</h3>
                                <div className="flex items-center text-luxury-gold text-sm gap-1">
                                    <span>★</span> {hotel.rating}
                                </div>
                            </div>
                            <p className="text-gray-400 text-xs mb-4">{hotel.description}</p>
                            <div className="flex justify-between items-center border-t border-white/10 pt-4">
                                <span className="text-luxury-gold font-serif text-sm">{hotel.price}</span>
                                <button className="text-[10px] uppercase tracking-widest border border-white/20 px-4 py-2 hover:bg-luxury-gold hover:text-black transition-all">
                                    Book Suite
                                </button>
                            </div>
                        </div>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default Hotels;




