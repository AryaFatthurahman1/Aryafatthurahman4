
import React from 'react';

export const PhilosophyMind: React.FC = () => {
  return (
    <div className="relative z-10 w-full max-w-5xl flex flex-col items-center text-center space-y-12">
      <div className="absolute inset-0 -z-10 bg-white/[0.02] blur-[150px] rounded-full" />
      
      <p className="text-[10px] tracking-[1em] uppercase text-white/30">The Core Mind</p>
      
      <div className="relative">
        <span className="absolute -top-12 -left-12 text-9xl text-white/5 font-serif italic">"</span>
        <h2 className="text-4xl md:text-6xl font-light italic leading-tight text-white/90 tracking-tight">
          Design is not the visual shell, but the underlying <span className="text-white font-bold not-italic">geometry of thought</span> manifest in the digital void.
        </h2>
        <span className="absolute -bottom-12 -right-12 text-9xl text-white/5 font-serif italic rotate-180">"</span>
      </div>

      <div className="pt-12 flex flex-col items-center space-y-6">
        <div className="w-1 h-32 bg-gradient-to-b from-transparent via-white/20 to-transparent" />
        <p className="text-xs tracking-[0.6em] text-white/40 uppercase">Silence in complexity</p>
      </div>
    </div>
  );
};
