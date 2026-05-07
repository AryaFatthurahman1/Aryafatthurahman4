import { useEffect, useState } from 'react';
import { Terminal, Database, Code2, Cpu, Globe2, Layers, Sparkles } from 'lucide-react';

export default function App() {
  const [gravity, setGravity] = useState(1);

  useEffect(() => {
    const interval = setInterval(() => {
      setGravity(Math.random() * 0.5 + 0.5);
    }, 2000);
    return () => clearInterval(interval);
  }, []);

  const techStack = [
    { name: 'HTML/CSS/JS', icon: <Globe2 className="w-8 h-8" />, color: 'text-orange-500', desc: 'The fundamental building blocks.' },
    { name: 'React & Next.js', icon: <Layers className="w-8 h-8" />, color: 'text-cyan-400', desc: 'Modern, fast UI and SSR.' },
    { name: 'Vue & Angular', icon: <Cpu className="w-8 h-8" />, color: 'text-emerald-500', desc: 'Robust component frameworks.' },
    { name: 'Laravel & Go', icon: <Terminal className="w-8 h-8" />, color: 'text-red-500', desc: 'Powerful backend APIs.' },
    { name: 'MySQL & MongoDB', icon: <Database className="w-8 h-8" />, color: 'text-blue-500', desc: 'Relational & NoSQL Data.' }
  ];

  const prompts = [
    { title: 'Zero-G Framework Generator', tag: 'React', likes: 124 },
    { title: 'Quantum Database Schema', tag: 'MySQL', likes: 89 },
    { title: 'Neural Network UI Tailwind', tag: 'CSS', likes: 256 },
    { title: 'Space-Time API Routing', tag: 'Laravel', likes: 112 },
  ];

  return (
    <div className="min-h-screen bg-deep-space text-white font-sans selection:bg-neon-cyan selection:text-black">
      {/* Hero Section */}
      <section className="relative min-h-screen flex flex-col items-center justify-center overflow-hidden">
        {/* Animated Background */}
        <div className="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(0,245,255,0.15)_0%,transparent_60%)] animate-pulse" style={{ animationDuration: '4s' }}></div>
        
        <div className="z-10 text-center px-6 relative">
          <div className="absolute -top-20 left-1/2 transform -translate-x-1/2 w-64 h-64 bg-purple-500 rounded-full mix-blend-screen filter blur-[100px] opacity-50 animate-blob"></div>
          <div className="absolute -top-20 right-1/4 w-64 h-64 bg-cyan-500 rounded-full mix-blend-screen filter blur-[100px] opacity-50 animate-blob animation-delay-2000"></div>
          
          <h1 className="text-7xl md:text-9xl font-black mb-6 tracking-tighter">
            <span className="bg-gradient-to-r from-cyan-400 via-purple-500 to-pink-500 bg-clip-text text-transparent">
              ANTI<br/>GRAVITY
            </span>
          </h1>
          <p className="text-2xl md:text-3xl text-gray-300 mb-10 font-mono tracking-widest uppercase">
            Prompt Hub <span className="text-cyan-400">&bull;</span> Tech Universe
          </p>
          
          <div className="glass inline-flex items-center gap-4 px-8 py-4 rounded-3xl text-2xl font-mono transition-transform hover:scale-105 cursor-pointer">
            <Sparkles className="w-6 h-6 text-cyan-400" />
            <span>Gravity Level: <span className="text-cyan-400 font-bold">{gravity.toFixed(2)}</span>g</span>
          </div>
        </div>

        <div className="absolute bottom-10 animate-bounce text-cyan-400 flex flex-col items-center">
          <span className="text-sm font-mono uppercase tracking-widest mb-2">Scroll to Explore</span>
          <div className="w-6 h-10 border-2 border-cyan-400 rounded-full flex justify-center p-1">
            <div className="w-1 h-2 bg-cyan-400 rounded-full animate-ping"></div>
          </div>
        </div>
      </section>

      {/* Main Content */}
      <main className="max-w-7xl mx-auto px-6 py-24 space-y-32">
        
        {/* Tech Showcase */}
        <section>
          <h2 className="text-4xl md:text-5xl font-bold mb-12 flex items-center gap-4">
            <Layers className="text-purple-500 w-10 h-10" />
            Universal Tech Stack
          </h2>
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {techStack.map((tech, i) => (
              <div key={i} className="glass p-8 rounded-3xl hover:bg-white/10 transition-all duration-300 hover:-translate-y-2 group cursor-pointer border border-white/5 hover:border-cyan-400/50">
                <div className={`${tech.color} mb-6 transform group-hover:scale-110 transition-transform duration-300`}>
                  {tech.icon}
                </div>
                <h3 className="text-2xl font-bold mb-3">{tech.name}</h3>
                <p className="text-gray-400">{tech.desc}</p>
                <div className="mt-6 w-full h-1 bg-gradient-to-r from-transparent via-gray-700 to-transparent group-hover:via-cyan-400 transition-all duration-500"></div>
              </div>
            ))}
          </div>
        </section>

        {/* Prompt Library */}
        <section>
          <div className="flex justify-between items-end mb-12">
            <h2 className="text-4xl md:text-5xl font-bold flex items-center gap-4">
              <Code2 className="text-cyan-400 w-10 h-10" />
              Top Prompts
            </h2>
            <button className="hidden md:block glass px-6 py-3 rounded-full text-cyan-400 hover:bg-cyan-400 hover:text-black transition-colors font-semibold">
              Explore All →
            </button>
          </div>
          
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            {prompts.map((prompt, i) => (
              <div key={i} className="glass p-6 rounded-2xl flex items-center justify-between group cursor-pointer hover:bg-white/10 transition-all">
                <div>
                  <span className="text-xs font-mono text-purple-400 bg-purple-400/10 px-3 py-1 rounded-full mb-3 inline-block">
                    {prompt.tag}
                  </span>
                  <h3 className="text-xl font-bold group-hover:text-cyan-400 transition-colors">{prompt.title}</h3>
                </div>
                <div className="flex flex-col items-center bg-black/30 px-4 py-2 rounded-xl">
                  <span className="text-sm text-gray-400">Likes</span>
                  <span className="text-lg font-bold text-pink-500">{prompt.likes}</span>
                </div>
              </div>
            ))}
          </div>
          <button className="md:hidden w-full mt-8 glass px-6 py-4 rounded-xl text-cyan-400 font-semibold">
            Explore All Prompts
          </button>
        </section>

      </main>

      {/* Footer */}
      <footer className="border-t border-white/10 py-12 text-center mt-20">
        <p className="text-gray-500 font-mono">
          © 2026 AntiGravity Prompt Hub. Built across dimensions.
        </p>
      </footer>
    </div>
  );
}
