
import React from 'react';

export const GenesisPortal: React.FC = () => {
  return (
    <div className="flex flex-col items-center justify-center text-center space-y-8 max-w-4xl relative z-10">
      <div className="absolute -z-10 w-[500px] h-[500px] bg-cyan-500/10 blur-[120px] rounded-full animate-pulse" />
      
      <div className="space-y-4">
        <p className="text-cyan-400 tracking-[0.8em] text-xs uppercase font-medium animate-pulse">
          Reality Layer Alpha
        </p>
        <h1 className="text-6xl md:text-8xl font-bold tracking-tighter leading-tight bg-clip-text text-transparent bg-gradient-to-b from-white via-white/80 to-white/40">
          BEYOND<br />INFINITE<br />DIMENSIONS
        </h1>
      </div>
      
      <p className="text-lg md:text-xl text-white/50 max-w-xl font-light leading-relaxed tracking-wide">
        Transcending conventional UI limits. Drift horizontally to traverse the creative universe of Muhammad Arya Fatthurahman.
      </p>

      <div className="pt-12 group">
        <button className="relative px-12 py-5 rounded-full bg-transparent overflow-hidden border border-white/10 group-hover:border-cyan-500/50 transition-all duration-500">
          <div className="absolute inset-0 bg-gradient-to-r from-cyan-600/20 to-purple-600/20 opacity-0 group-hover:opacity-100 transition-opacity" />
          <span className="relative text-sm tracking-[0.4em] font-medium uppercase text-white/80 group-hover:text-cyan-400 transition-colors">
            Initiate Drift
          </span>
        </button>
      </div>
    </div>
  );
};
