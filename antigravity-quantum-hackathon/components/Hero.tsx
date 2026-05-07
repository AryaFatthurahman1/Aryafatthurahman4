import { ArrowRight, Zap, Cpu, Database, Play, ChevronDown } from 'lucide-react'

export default function Hero() {
  return (
    <section className="relative min-h-screen flex items-center justify-center overflow-hidden bg-surface-0">
      {/* Animated background orbs */}
      <div className="absolute inset-0">
        <div className="absolute top-1/4 left-1/6 w-[500px] h-[500px] bg-neon-purple/10 rounded-full blur-[120px] animate-pulse-slow" />
        <div className="absolute bottom-1/4 right-1/6 w-[600px] h-[600px] bg-neon-blue/8 rounded-full blur-[150px] animate-float-delayed" />
        <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] bg-neon-cyan/10 rounded-full blur-[100px] animate-float" />
      </div>

      {/* Grid pattern overlay */}
      <div className="absolute inset-0 grid-pattern opacity-30" />

      {/* Radial gradient overlay */}
      <div className="absolute inset-0 radial-gradient" />

      {/* Floating particles */}
      <div className="absolute inset-0 overflow-hidden pointer-events-none">
        {[...Array(20)].map((_, i) => (
          <div
            key={i}
            className="particle w-1 h-1 bg-neon-cyan/40"
            style={{
              left: `${Math.random() * 100}%`,
              top: `${Math.random() * 100}%`,
              animationDelay: `${Math.random() * 8}s`,
              animationDuration: `${6 + Math.random() * 6}s`,
            }}
          />
        ))}
      </div>

      <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-32 pb-20">
        {/* Badge */}
        <div className="inline-flex items-center space-x-2 glass rounded-full px-5 py-2 mb-10 animate-fade-in-down">
          <span className="relative flex h-2 w-2">
            <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-neon-cyan opacity-75" />
            <span className="relative inline-flex rounded-full h-2 w-2 bg-neon-cyan" />
          </span>
          <span className="text-gray-300 text-sm font-medium">May 15-17, 2026</span>
          <span className="text-gray-500">|</span>
          <span className="text-gray-300 text-sm font-medium">Berlin, Germany</span>
        </div>

        {/* Main heading */}
        <h1 className="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold tracking-tight mb-8 animate-fade-in-up">
          <span className="block text-white">AntiGravity</span>
          <span className="block quantum-gradient-text mt-2">Quantum Hackathon</span>
        </h1>

        {/* Subtitle */}
        <p className="text-lg sm:text-xl md:text-2xl text-gray-400 mb-12 max-w-3xl mx-auto leading-relaxed animate-fade-in-up" style={{ animationDelay: '0.2s' }}>
          Where Innovation Meets Entanglement. Join 500+ developers, researchers,
          and quantum enthusiasts in building the future of quantum computing.
        </p>

        {/* CTA Buttons */}
        <div className="flex flex-col sm:flex-row items-center justify-center gap-4 mb-20 animate-fade-in-up" style={{ animationDelay: '0.4s' }}>
          <button className="group relative px-8 py-4 rounded-full text-white font-semibold text-lg overflow-hidden transition-all duration-300 hover:shadow-[0_0_40px_rgba(168,85,247,0.3)]">
            <span className="absolute inset-0 quantum-gradient" />
            <span className="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity" />
            <span className="relative flex items-center space-x-2">
              <span>Register Now</span>
              <ArrowRight className="w-5 h-5 group-hover:translate-x-1 transition-transform" />
            </span>
          </button>
          <button className="group glass px-8 py-4 rounded-full text-white font-semibold text-lg hover:bg-white/10 transition-all duration-300 flex items-center space-x-3">
            <div className="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center group-hover:bg-white/20 transition-colors">
              <Play className="w-3 h-3 text-white ml-0.5" />
            </div>
            <span>Watch Recap</span>
          </button>
        </div>

        {/* Stats */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto animate-fade-in-up" style={{ animationDelay: '0.6s' }}>
          <div className="glass rounded-2xl p-8 hover:bg-white/5 transition-all duration-300 group">
            <Cpu className="w-10 h-10 text-neon-purple mx-auto mb-4 group-hover:scale-110 transition-transform" />
            <div className="text-4xl font-bold text-white mb-2">50+</div>
            <div className="text-gray-400 text-sm uppercase tracking-wider">Qubits Available</div>
          </div>
          <div className="glass rounded-2xl p-8 hover:bg-white/5 transition-all duration-300 group">
            <Database className="w-10 h-10 text-neon-blue mx-auto mb-4 group-hover:scale-110 transition-transform" />
            <div className="text-4xl font-bold text-white mb-2">$100K</div>
            <div className="text-gray-400 text-sm uppercase tracking-wider">Prize Pool</div>
          </div>
          <div className="glass rounded-2xl p-8 hover:bg-white/5 transition-all duration-300 group">
            <Zap className="w-10 h-10 text-neon-cyan mx-auto mb-4 group-hover:scale-110 transition-transform" />
            <div className="text-4xl font-bold text-white mb-2">48h</div>
            <div className="text-gray-400 text-sm uppercase tracking-wider">Non-Stop Hacking</div>
          </div>
        </div>
      </div>

      {/* Scroll indicator */}
      <div className="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
        <a href="#about" className="flex flex-col items-center space-y-2 text-gray-500 hover:text-gray-300 transition-colors">
          <span className="text-xs uppercase tracking-widest">Scroll</span>
          <ChevronDown className="w-4 h-4" />
        </a>
      </div>
    </section>
  )
}
