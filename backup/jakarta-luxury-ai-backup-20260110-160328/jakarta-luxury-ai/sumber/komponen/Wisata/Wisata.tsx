
import React, { useState } from 'react';
import TravelList from './TravelList';
import Hotels from './Hotels';
import Flights from './Flights';

const Travel: React.FC = () => {
    const [activeTab, setActiveTab] = useState<'destinations' | 'hotels' | 'flights'>('destinations');

    return (
        <div className="py-20 px-6 max-w-7xl mx-auto min-h-screen">
            <div className="text-center mb-16">
                <h2 className="text-4xl md:text-6xl font-serif mb-6">
                    Luxury <span className="text-luxury-gold">Travel</span>
                </h2>
                <p className="text-gray-400 max-w-2xl mx-auto mb-10">
                    Kurasi perjalanan, akomodasi, dan penerbangan terbaik untuk pengalaman tak terlupakan di Jakarta dan sekitarnya.
                </p>

                {/* Tabs */}
                <div className="flex justify-center gap-2 md:gap-4 mb-12">
                    <button
                        onClick={() => setActiveTab('destinations')}
                        className={`px-6 py-3 text-[10px] md:text-xs uppercase tracking-[0.2em] font-bold border transition-all duration-300 ${activeTab === 'destinations'
                                ? 'bg-luxury-gold text-black border-luxury-gold shadow-[0_0_20px_rgba(197,160,89,0.3)]'
                                : 'bg-transparent text-gray-400 border-white/10 hover:border-luxury-gold hover:text-luxury-gold'
                            }`}
                    >
                        Destinasi
                    </button>
                    <button
                        onClick={() => setActiveTab('hotels')}
                        className={`px-6 py-3 text-[10px] md:text-xs uppercase tracking-[0.2em] font-bold border transition-all duration-300 ${activeTab === 'hotels'
                                ? 'bg-luxury-gold text-black border-luxury-gold shadow-[0_0_20px_rgba(197,160,89,0.3)]'
                                : 'bg-transparent text-gray-400 border-white/10 hover:border-luxury-gold hover:text-luxury-gold'
                            }`}
                    >
                        Hotels & Resorts
                    </button>
                    <button
                        onClick={() => setActiveTab('flights')}
                        className={`px-6 py-3 text-[10px] md:text-xs uppercase tracking-[0.2em] font-bold border transition-all duration-300 ${activeTab === 'flights'
                                ? 'bg-luxury-gold text-black border-luxury-gold shadow-[0_0_20px_rgba(197,160,89,0.3)]'
                                : 'bg-transparent text-gray-400 border-white/10 hover:border-luxury-gold hover:text-luxury-gold'
                            }`}
                    >
                        Private Jets
                    </button>
                </div>
            </div>

            <div className="transition-all duration-500">
                {activeTab === 'destinations' && <TravelList />}
                {activeTab === 'hotels' && <Hotels />}
                {activeTab === 'flights' && <Flights />}
            </div>
        </div>
    );
};

export default Travel;




