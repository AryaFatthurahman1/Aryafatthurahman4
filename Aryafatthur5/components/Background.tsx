
import React, { useMemo } from 'react';

interface BackgroundProps {
  scrollProgress: number;
}

export const Background: React.FC<BackgroundProps> = ({ scrollProgress }) => {
  const particles = useMemo(() => {
    return Array.from({ length: 40 }).map((_, i) => ({
      id: i,
      x: Math.random() * 100,
      y: Math.random() * 100,
      size: Math.random() * 3 + 1,
      duration: Math.random() * 20 + 10,
      delay: Math.random() * -20,
    }));
  }, []);

  return (
    <div className="fixed inset-0 pointer-events-none z-0 overflow-hidden">
      {/* Multi-layered Gradients */}
      <div 
        className="absolute inset-0 opacity-40 transition-transform duration-1000 ease-out"
        style={{
          background: `radial-gradient(circle at ${40 - scrollProgress * 20}% ${50 + scrollProgress * 10}%, #3A0CA3 0%, transparent 60%)`,
          transform: `scale(${1 + scrollProgress * 0.2})`
        }}
      />
      <div 
        className="absolute inset-0 opacity-30 transition-transform duration-1000 ease-out delay-75"
        style={{
          background: `radial-gradient(circle at ${70 + scrollProgress * 10}% ${30 - scrollProgress * 10}%, #F72585 0%, transparent 50%)`,
          transform: `scale(${1.2 - scrollProgress * 0.1})`
        }}
      />
      <div 
        className="absolute inset-0 opacity-20 transition-transform duration-1000 ease-out delay-150"
        style={{
          background: `radial-gradient(circle at ${20 + scrollProgress * 30}% ${80 - scrollProgress * 20}%, #00F5FF 0%, transparent 40%)`,
        }}
      />

      {/* Plasma Pulse Layers */}
      <div className="absolute inset-0 animate-pulse opacity-10 blur-[100px]" style={{ background: 'conic-gradient(from 0deg, #3A0CA3, #F72585, #00F5FF, #3A0CA3)' }} />

      {/* Floating Particles */}
      {particles.map((p) => (
        <div
          key={p.id}
          className="absolute rounded-full bg-white/20 blur-[1px]"
          style={{
            left: `${p.x}%`,
            top: `${p.y}%`,
            width: `${p.size}px`,
            height: `${p.size}px`,
            animation: `float ${p.duration}s infinite linear`,
            animationDelay: `${p.delay}s`,
            opacity: 0.2 + Math.random() * 0.3
          }}
        />
      ))}

      {/* Noise Overlay */}
      <div className="absolute inset-0 opacity-[0.03] pointer-events-none mix-blend-overlay bg-[url('https://grainy-gradients.vercel.app/noise.svg')]" />

      <style>{`
        @keyframes float {
          0% { transform: translate(0, 0); }
          33% { transform: translate(${Math.random() * 100}px, ${Math.random() * 100}px); }
          66% { transform: translate(${Math.random() * -100}px, ${Math.random() * 50}px); }
          100% { transform: translate(0, 0); }
        }
      `}</style>
    </div>
  );
};
