
import React from 'react';

export const FinalTranscendence: React.FC = () => {
  return (
    <div className="relative z-10 w-full max-w-6xl flex flex-col md:flex-row items-end justify-between gap-24">
      <div className="flex-1 space-y-16">
        <div className="space-y-6">
          <h2 className="text-7xl md:text-9xl font-bold tracking-tighter text-white/10 select-none">TRANSCEND</h2>
          <div className="space-y-4">
             <h3 className="text-4xl md:text-5xl font-bold tracking-tight">Expand the Vision.</h3>
             <p className="text-white/50 text-lg font-light leading-relaxed max-w-md">
               The journey does not end here. Reach out to collaborate on building the next evolution of digital reality.
             </p>
          </div>
        </div>

        <div className="grid grid-cols-2 gap-12">
           <div className="space-y-4">
              <p className="text-[10px] tracking-[0.4em] uppercase text-cyan-400 font-bold">Signal Channels</p>
              <ul className="space-y-3">
                {['LinkedIn', 'GitHub', 'Twitter', 'Behance'].map(social => (
                  <li key={social} className="group flex items-center gap-3 cursor-pointer">
                    <div className="w-1 h-1 bg-white/30 group-hover:bg-cyan-400 group-hover:w-4 transition-all duration-300" />
                    <span className="text-white/60 group-hover:text-white transition-colors tracking-widest text-sm">{social}</span>
                  </li>
                ))}
              </ul>
           </div>
           <div className="space-y-4">
              <p className="text-[10px] tracking-[0.4em] uppercase text-magenta-500 font-bold">Direct Pulse</p>
              <p className="text-white/80 hover:text-white transition-colors cursor-pointer text-sm tracking-wider">hello@dimensional.arya</p>
           </div>
        </div>
      </div>

      <div className="w-full md:w-[450px] p-10 rounded-[40px] border border-white/5 bg-white/[0.03] backdrop-blur-2xl space-y-8 relative overflow-hidden group">
        <div className="absolute inset-0 bg-gradient-to-br from-cyan-500/5 via-transparent to-pink-500/5 pointer-events-none" />
        
        <div className="space-y-2 relative">
           <p className="text-[10px] tracking-[0.3em] uppercase text-white/40">Transmission Panel</p>
           <h4 className="text-2xl font-bold">Connect Mindset</h4>
        </div>

        <form className="space-y-6 relative" onSubmit={e => e.preventDefault()}>
          <div className="space-y-2">
            <input 
              type="text" 
              placeholder="Your Matrix ID (Name)" 
              className="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-cyan-500/50 transition-colors text-white placeholder:text-white/20"
            />
          </div>
          <div className="space-y-2">
            <input 
              type="email" 
              placeholder="Frequency Channel (Email)" 
              className="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-cyan-500/50 transition-colors text-white placeholder:text-white/20"
            />
          </div>
          <div className="space-y-2">
            <textarea 
              placeholder="Transmission Data (Message)" 
              rows={4}
              className="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-cyan-500/50 transition-colors text-white placeholder:text-white/20 resize-none"
            />
          </div>
          <button className="w-full py-5 rounded-2xl bg-white text-black font-bold tracking-[0.4em] uppercase text-xs hover:bg-cyan-400 transition-all active:scale-95">
            SEND SIGNAL
          </button>
        </form>

        <p className="text-center text-[9px] tracking-[0.5em] uppercase text-white/20 pt-4">
          There Is No End. Only Expansion.
        </p>
      </div>
    </div>
  );
};
