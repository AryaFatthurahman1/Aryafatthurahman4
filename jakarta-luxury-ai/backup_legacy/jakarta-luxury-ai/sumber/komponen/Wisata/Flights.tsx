import React from 'react';
import FlightBoard from './FlightBoard';

const Flights: React.FC = () => {
    return (
        <div className="animate-fade-in">
            {/* Hero Section with Flight Board */}
            <div className="relative pt-32 pb-20 flex items-center justify-center px-6">
                {/* Background Image */}
                <div className="absolute inset-0 z-0">
                    <img
                        src="https://images.unsplash.com/photo-1570554886111-e85fcf373b9e?q=80&w=2070"
                        alt="Luxury Terminal"
                        className="w-full h-full object-cover opacity-40"
                        onError={(e) => {
                            const target = e.target as HTMLImageElement;
                            target.src = 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&q=80&fit=crop';
                        }}
                        loading="lazy"
                    />
                    <div className="absolute inset-0 bg-gradient-to-b from-black via-black/50 to-black"></div>
                </div>

                <div className="relative z-10 w-full max-w-6xl">
                    <div className="text-center mb-16">
                        <h2 className="text-5xl md:text-7xl font-serif text-white mb-4">
                            Private <span className="text-luxury-gold">Departures</span>
                        </h2>
                        <div className="h-1 w-20 bg-luxury-gold mx-auto mb-4"></div>
                        <p className="text-gray-400 uppercase tracking-[0.3em] text-xs">Soekarno-Hatta International VIP</p>
                    </div>

                    <FlightBoard />
                </div>
            </div>

            {/* Charter Options - Exclusive Fleet */}
            <div className="max-w-7xl mx-auto px-6 pb-20 pt-16">
                <h3 className="text-3xl font-serif text-white mb-12 border-l-4 border-luxury-gold pl-6">
                    Exclusive <span className="text-luxury-gold">Fleet</span>
                </h3>
                <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div className="group relative h-96 rounded-xl overflow-hidden cursor-pointer border border-white/5 hover:border-luxury-gold/50 transition-all">
                        <img 
                            src="https://images.unsplash.com/photo-1540962351504-03099e0a754b?w=800&q=80&fit=crop" 
                            className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                            alt="Gulfstream"
                            onError={(e) => {
                                const target = e.target as HTMLImageElement;
                                target.src = 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&q=80&fit=crop';
                            }}
                            loading="lazy"
                        />
                        <div className="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                        <div className="absolute bottom-8 left-8">
                            <h4 className="text-2xl font-serif text-white mb-2">Gulfstream G650ER</h4>
                            <p className="text-luxury-gold text-sm uppercase tracking-widest">Ultra Long Range</p>
                        </div>
                    </div>
                    <div className="group relative h-96 rounded-xl overflow-hidden cursor-pointer border border-white/5 hover:border-luxury-gold/50 transition-all">
                        <img 
                            src="https://images.unsplash.com/photo-1583416750470-965b2707b355?w=800&q=80&fit=crop" 
                            className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                            alt="Global 7500"
                            onError={(e) => {
                                const target = e.target as HTMLImageElement;
                                target.src = 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&q=80&fit=crop';
                            }}
                            loading="lazy"
                        />
                        <div className="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                        <div className="absolute bottom-8 left-8">
                            <h4 className="text-2xl font-serif text-white mb-2">Bombardier Global 7500</h4>
                            <p className="text-luxury-gold text-sm uppercase tracking-widest">Master Suite</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Flights;




