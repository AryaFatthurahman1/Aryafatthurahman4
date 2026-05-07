
import React from 'react';

const ProjectCard = ({ title, category, image }: { title: string, category: string, image: string }) => (
  <div className="relative group min-w-[400px] h-[500px] rounded-3xl overflow-hidden border border-white/10 hover:border-white/30 transition-all duration-700">
    <div className="absolute inset-0 bg-cover bg-center transition-transform duration-1000 group-hover:scale-110" style={{ backgroundImage: `url(${image})` }} />
    <div className="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent" />
    
    <div className="absolute inset-0 p-12 flex flex-col justify-end space-y-4">
      <div className="space-y-1">
        <p className="text-cyan-400 tracking-[0.4em] text-[10px] uppercase font-bold">{category}</p>
        <h3 className="text-4xl font-bold tracking-tight text-white group-hover:translate-x-2 transition-transform duration-500">{title}</h3>
      </div>
      <p className="text-white/60 font-light text-sm line-clamp-2">
        A multi-dimensional platform exploring the limits of contemporary digital existence.
      </p>
      <div className="pt-4 flex items-center gap-4">
        <div className="w-12 h-12 rounded-full border border-white/20 flex items-center justify-center group-hover:bg-white group-hover:text-black transition-all duration-500">
          <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M14 5l7 7m0 0l-7 7m7-7H3" />
          </svg>
        </div>
        <span className="text-[10px] tracking-widest uppercase text-white/40 group-hover:text-white transition-colors">Enter Station</span>
      </div>
    </div>
  </div>
);

export const ProjectStations: React.FC = () => {
  return (
    <div className="relative z-10 w-full flex flex-col space-y-16">
      <div className="pl-8 md:pl-24 space-y-2">
        <p className="text-pink-500 tracking-[0.5em] text-xs uppercase">Archive of Creations</p>
        <h2 className="text-5xl md:text-7xl font-bold tracking-tighter">Space Stations</h2>
      </div>

      <div className="flex gap-12 overflow-x-visible pb-12 px-8 md:px-24">
        <ProjectCard 
          title="Nova Interface" 
          category="Web Dimension"
          image="https://picsum.photos/seed/nova/800/1000"
        />
        <ProjectCard 
          title="Core Sync" 
          category="Cyber Layer"
          image="https://picsum.photos/seed/sync/800/1000"
        />
        <ProjectCard 
          title="Prism Vision" 
          category="Visual Reality"
          image="https://picsum.photos/seed/prism/800/1000"
        />
        <ProjectCard 
          title="Nexus Flux" 
          category="System Pulse"
          image="https://picsum.photos/seed/nexus/800/1000"
        />
      </div>
    </div>
  );
};
