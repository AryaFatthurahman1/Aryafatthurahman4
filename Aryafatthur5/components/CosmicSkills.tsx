
import React from 'react';

const SkillEntity = ({ title, icon, color, description }: { title: string, icon: React.ReactNode, color: string, description: string }) => (
  <div className="group relative p-8 rounded-3xl border border-white/5 bg-white/5 backdrop-blur-md hover:bg-white/10 transition-all duration-500 w-80">
    <div className={`absolute -top-12 -left-12 w-48 h-48 rounded-full blur-[60px] opacity-0 group-hover:opacity-40 transition-opacity duration-700`} style={{ backgroundColor: color }} />
    <div className="relative z-10 space-y-6">
      <div className={`w-16 h-16 rounded-2xl flex items-center justify-center bg-black/40 border border-white/10 text-white group-hover:scale-110 transition-transform duration-500`}>
        {icon}
      </div>
      <div className="space-y-2">
        <h3 className="text-2xl font-semibold tracking-tight">{title}</h3>
        <p className="text-sm text-white/50 leading-relaxed font-light">{description}</p>
      </div>
      <div className="flex items-center gap-2 pt-2">
        <div className="h-1 w-full bg-white/5 rounded-full overflow-hidden">
          <div className="h-full group-hover:w-full w-0 transition-all duration-1000 ease-out" style={{ backgroundColor: color }} />
        </div>
      </div>
    </div>
  </div>
);

export const CosmicSkills: React.FC = () => {
  return (
    <div className="relative z-10 w-full flex flex-col items-center space-y-20">
      <div className="text-center space-y-4">
        <p className="text-teal-400 tracking-[0.5em] text-xs uppercase">Quantum Expertise</p>
        <h2 className="text-5xl md:text-6xl font-bold tracking-tighter">Living Capabilities</h2>
      </div>

      <div className="flex flex-wrap justify-center gap-8 md:gap-12">
        <SkillEntity 
          title="Web Development"
          description="Forging high-fidelity, interactive digital landscapes using modern frameworks and cosmic logic."
          color="#00F5FF"
          icon={
            <svg className="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1} d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
            </svg>
          }
        />
        <SkillEntity 
          title="Cybersecurity"
          description="Erecting impenetrable energetic shields around data and systems to ensure universal integrity."
          color="#7209B7"
          icon={
            <svg className="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1} d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
          }
        />
        <SkillEntity 
          title="UI/UX Alchemy"
          description="Transmuting user needs into harmonic visual waves that resonate across all digital dimensions."
          color="#F72585"
          icon={
            <svg className="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1} d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
            </svg>
          }
        />
      </div>
    </div>
  );
};
