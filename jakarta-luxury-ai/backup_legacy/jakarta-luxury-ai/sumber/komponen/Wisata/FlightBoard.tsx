import React, { useState, useEffect } from 'react';

const FlightBoard: React.FC = () => {
    const [time, setTime] = useState(new Date());

    // Real-time clock effect
    useEffect(() => {
        const timer = setInterval(() => setTime(new Date()), 1000);
        return () => clearInterval(timer);
    }, []);

    const flights = [
        { time: '20:30', code: 'GA 881', destination: 'Tokyo (NRT)', gate: 'G1', status: 'Boarding' },
        { time: '21:15', code: 'SQ 965', destination: 'Singapore (SIN)', gate: 'F4', status: 'On Schedule' },
        { time: '21:45', code: 'EK 359', destination: 'Dubai (DXB)', gate: 'G8', status: 'Check-in' },
        { time: '22:10', code: 'QR 957', destination: 'Doha (DOH)', gate: 'F2', status: 'Delayed' },
        { time: '23:00', code: 'CX 798', destination: 'Hong Kong (HKG)', gate: 'G3', status: 'Scheduled' },
        { time: '23:30', code: 'JL 726', destination: 'Tokyo (HND)', gate: 'G5', status: 'Scheduled' },
        { time: '00:15', code: 'TK 057', destination: 'Istanbul (IST)', gate: 'F6', status: 'Scheduled' },
    ];

    return (
        <div className="w-full bg-black/80 backdrop-blur-xl border border-luxury-gold/30 rounded-xl overflow-hidden shadow-[0_0_50px_rgba(197,160,89,0.15)]">
            {/* Header */}
            <div className="bg-luxury-gold/10 p-6 flex justify-between items-center border-b border-luxury-gold/30">
                <div className="flex items-center gap-4">
                    <div className="w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                    <h2 className="text-2xl md:text-3xl font-serif text-luxury-gold tracking-widest uppercase">
                        Departure Information
                    </h2>
                </div>
                <div className="text-right">
                    <p className="text-4xl font-mono text-white tracking-widest font-bold">
                        {time.toLocaleTimeString('en-US', { hour12: false, hour: '2-digit', minute: '2-digit' })}
                    </p>
                    <p className="text-xs text-luxury-gold uppercase tracking-[0.3em]">Soekarno-Hatta Int'l VIP</p>
                </div>
            </div>

            {/* Board Content */}
            <div className="p-4 md:p-8">
                <div className="overflow-x-auto">
                    <table className="w-full text-left border-collapse">
                        <thead>
                            <tr className="text-gray-500 uppercase text-[10px] tracking-widest border-b border-white/10">
                                <th className="pb-4 pl-4">Time</th>
                                <th className="pb-4">Flight</th>
                                <th className="pb-4">Destination</th>
                                <th className="pb-4 text-center">Gate</th>
                                <th className="pb-4 text-right pr-4">Remarks</th>
                            </tr>
                        </thead>
                        <tbody className="font-mono">
                            {flights.map((flight, idx) => (
                                <tr key={idx} className="group hover:bg-white/5 transition-colors border-b border-white/5">
                                    <td className="py-5 pl-4 text-luxury-gold font-bold text-lg">{flight.time}</td>
                                    <td className="py-5 text-white">{flight.code}</td>
                                    <td className="py-5 text-white/80 uppercase tracking-wider">{flight.destination}</td>
                                    <td className="py-5 text-center text-luxury-gold font-bold">{flight.gate}</td>
                                    <td className="py-5 text-right pr-4">
                                        <span className={`px-4 py-1 rounded-sm text-[10px] text-black font-bold uppercase tracking-widest ${flight.status === 'Boarding' ? 'bg-green-500 animate-pulse' :
                                                flight.status === 'Delayed' ? 'bg-red-500' :
                                                    flight.status === 'Check-in' ? 'bg-yellow-500' :
                                                        'bg-gray-300'
                                            }`}>
                                            {flight.status}
                                        </span>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>

            <div className="bg-black/90 p-3 text-center border-t border-white/10">
                <p className="text-[10px] text-gray-500 animate-marquee whitespace-nowrap overflow-hidden">
                    *** PASSENGERS FOR FLIGHT GA 881 TO TOKYO PLEASE PROCEED TO GATE G1 *** KEEP YOUR LUGGAGE UNATTENDED *** LUXURY LOUNGE ACCESS AVAILABLE FOR FIRST CLASS ***
                </p>
            </div>
        </div>
    );
};

export default FlightBoard;




