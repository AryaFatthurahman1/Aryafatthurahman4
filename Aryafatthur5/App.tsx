
import React, { useRef, useEffect, useState, useCallback } from 'react';
import { Background } from './components/Background';
import { GenesisPortal } from './components/GenesisPortal';
import { IdentityField } from './components/IdentityField';
import { CosmicSkills } from './components/CosmicSkills';
import { ProjectStations } from './components/ProjectStations';
import { PhilosophyMind } from './components/PhilosophyMind';
import { FinalTranscendence } from './components/FinalTranscendence';

export default function App() {
  const containerRef = useRef<HTMLDivElement>(null);
  const [scrollProgress, setScrollProgress] = useState(0);

  const handleWheel = useCallback((e: WheelEvent) => {
    if (containerRef.current) {
      e.preventDefault();
      containerRef.current.scrollLeft += e.deltaY + e.deltaX;
      
      const maxScroll = containerRef.current.scrollWidth - containerRef.current.clientWidth;
      const progress = containerRef.current.scrollLeft / maxScroll;
      setScrollProgress(progress);
    }
  }, []);

  useEffect(() => {
    const container = containerRef.current;
    if (container) {
      container.addEventListener('wheel', handleWheel, { passive: false });
    }
    return () => {
      if (container) {
        container.removeEventListener('wheel', handleWheel);
      }
    };
  }, [handleWheel]);

  return (
    <div className="relative h-screen w-screen overflow-hidden bg-[#050508]">
      {/* Dynamic Cosmic Background */}
      <Background scrollProgress={scrollProgress} />

      {/* Main Horizontal Reality Track */}
      <div 
        ref={containerRef}
        className="flex h-full w-full overflow-x-auto overflow-y-hidden snap-x snap-mandatory scroll-smooth"
        style={{ scrollbarWidth: 'none', msOverflowStyle: 'none' }}
      >
        <section className="min-w-full flex-shrink-0 snap-start h-full flex items-center justify-center p-8 md:p-24">
          <GenesisPortal />
        </section>

        <section className="min-w-full flex-shrink-0 snap-start h-full flex items-center justify-center p-8 md:p-24">
          <IdentityField />
        </section>

        <section className="min-w-full flex-shrink-0 snap-start h-full flex items-center justify-center p-8 md:p-24">
          <CosmicSkills />
        </section>

        <section className="min-w-full flex-shrink-0 snap-start h-full flex items-center justify-center p-8 md:p-24">
          <ProjectStations />
        </section>

        <section className="min-w-full flex-shrink-0 snap-start h-full flex items-center justify-center p-8 md:p-24">
          <PhilosophyMind />
        </section>

        <section className="min-w-full flex-shrink-0 snap-start h-full flex items-center justify-center p-8 md:p-24">
          <FinalTranscendence />
        </section>
      </div>

      {/* Progress HUD */}
      <div className="fixed bottom-12 left-1/2 -translate-x-1/2 flex items-center gap-4 z-50">
        <div className="h-[2px] w-64 bg-white/10 overflow-hidden rounded-full">
          <div 
            className="h-full bg-gradient-to-r from-cyan-400 via-magenta-500 to-pink-500 transition-all duration-300"
            style={{ width: `${scrollProgress * 100}%` }}
          />
        </div>
        <span className="text-[10px] uppercase tracking-[0.4em] text-white/40 font-display">
          Reality {Math.min(Math.ceil(scrollProgress * 6) + 1, 6)} / 6
        </span>
      </div>

      {/* Navigation Hint */}
      <div className="fixed bottom-12 right-12 z-50 flex items-center gap-2 pointer-events-none opacity-40 animate-pulse">
        <span className="text-[10px] uppercase tracking-widest">Drift to explore</span>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1" strokeLinecap="round" strokeLinejoin="round">
          <path d="M5 12h14M12 5l7 7-7 7"/>
        </svg>
      </div>
    </div>
  );
}
