
import React from 'react';

export const IdentityField: React.FC = () => {
  return (
    <div className="relative w-full max-w-6xl flex flex-col md:flex-row items-center gap-16 z-10">
      <div className="flex-1 space-y-8">
        <div className="space-y-2">
          <p className="text-purple-400 tracking-[0.5em] text-[10px] uppercase">Identity Matrix</p>
          <h2 className="text-5xl md:text-7xl font-bold tracking-tight text-white leading-none">
            MUHAMMAD <br /> 
            <span className="text-transparent bg-clip-text bg-gradient-to-r from-white via-magenta-400 to-cyan-400">ARYA</span> <br /> 
            FATTHURAHMAN
          </h2>
        </div>
        
        <p className="text-lg text-white/60 max-w-md leading-relaxed font-light">
          A hyper-intelligent architect of digital ecosystems. Merging cutting-edge aesthetics with high-performance logic.
        </p>

        <div className="flex gap-8 pt-4">
          {[
            { label: 'ROLE', value: 'Reality Architect' },
            { label: 'ORIGIN', value: 'Cyber Realm' },
            { label: 'STATUS', value: 'Transcending' }
          ].map((item, i) => (
            <div key={i} className="space-y-1">
              <p className="text-[9px] tracking-[0.3em] text-white/30 uppercase">{item.label}</p>
              <p className="text-sm tracking-widest text-white/80">{item.value}</p>
            </div>
          ))}
        </div>
      </div>

      <div className="relative w-80 h-80 flex-shrink-0 group">
        {/* Abstract Avatar Placeholder/Hologram */}
        <div className="absolute inset-0 bg-gradient-to-tr from-cyan-500 via-magenta-500 to-purple-500 rounded-full blur-3xl opacity-20 group-hover:opacity-40 transition-opacity duration-700" />
        <div className="relative w-full h-full rounded-full border border-white/5 backdrop-blur-sm overflow-hidden flex items-center justify-center bg-white/5">
           <svg className="w-48 h-48 text-white/10" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="0.5">
             <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
           </svg>
           {/* Animated Rings */}
           <div className="absolute inset-0 border border-cyan-500/20 rounded-full animate-[spin_10s_linear_infinite]" />
           <div className="absolute inset-4 border border-magenta-500/20 rounded-full animate-[spin_15s_linear_infinite_reverse]" />
        </div>
      </div>
    </div>
  );
};
