import { Brain, Cpu, Lock, Database, Flame, ArrowRight } from 'lucide-react'

export default function Challenges() {
  const challenges = [
    {
      icon: Brain,
      title: 'Quantum Machine Learning',
      description: 'Develop quantum neural networks and explore quantum-enhanced ML algorithms for real-world applications.',
      difficulty: 'Advanced',
      tags: ['QML', 'Neural Networks', 'Optimization'],
      gradient: 'from-neon-purple to-neon-blue',
      iconBg: 'bg-neon-purple/10',
      iconColor: 'text-neon-purple',
    },
    {
      icon: Cpu,
      title: 'Quantum Optimization',
      description: 'Solve complex optimization problems using quantum algorithms like QAOA and VQE.',
      difficulty: 'Intermediate',
      tags: ['QAOA', 'VQE', 'Combinatorial'],
      gradient: 'from-neon-blue to-neon-cyan',
      iconBg: 'bg-neon-blue/10',
      iconColor: 'text-neon-blue',
    },
    {
      icon: Lock,
      title: 'Quantum Cryptography',
      description: 'Build secure communication systems using quantum key distribution and post-quantum cryptography.',
      difficulty: 'Advanced',
      tags: ['QKD', 'Security', 'Encryption'],
      gradient: 'from-neon-cyan to-neon-pink',
      iconBg: 'bg-neon-cyan/10',
      iconColor: 'text-neon-cyan',
    },
    {
      icon: Database,
      title: 'Quantum Simulation',
      description: 'Simulate quantum systems and materials using quantum computing techniques.',
      difficulty: 'Intermediate',
      tags: ['Simulation', 'Materials', 'Chemistry'],
      gradient: 'from-neon-pink to-neon-purple',
      iconBg: 'bg-neon-pink/10',
      iconColor: 'text-neon-pink',
    }
  ]

  return (
    <section id="challenges" className="py-32 bg-surface-50 relative overflow-hidden">
      <div className="absolute inset-0 grid-pattern opacity-15" />
      <div className="absolute top-1/2 right-0 w-[500px] h-[500px] bg-neon-blue/5 rounded-full blur-[150px]" />

      <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section header */}
        <div className="text-center mb-20">
          <div className="inline-flex items-center space-x-2 glass rounded-full px-4 py-1.5 mb-6">
            <Flame className="w-3.5 h-3.5 text-neon-purple" />
            <span className="text-xs font-medium uppercase tracking-wider text-gray-400">Challenges</span>
          </div>
          <h2 className="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 tracking-tight">
            Push the Boundaries
            <br />
            <span className="quantum-gradient-text">of Quantum Computing</span>
          </h2>
          <p className="text-gray-400 text-lg max-w-2xl mx-auto leading-relaxed">
            Choose from a variety of exciting challenges that push the boundaries of quantum computing.
            Work individually or in teams of up to 4 members.
          </p>
        </div>

        {/* Challenge cards */}
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          {challenges.map((challenge, index) => (
            <div
              key={index}
              className="group glass rounded-3xl p-8 hover:bg-white/[0.03] transition-all duration-500 relative overflow-hidden"
            >
              {/* Gradient accent line */}
              <div className={`absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r ${challenge.gradient} opacity-0 group-hover:opacity-100 transition-opacity duration-500`} />

              <div className="flex items-start justify-between mb-6">
                <div className={`w-14 h-14 rounded-2xl ${challenge.iconBg} flex items-center justify-center group-hover:scale-110 transition-transform duration-300`}>
                  <challenge.icon className={`w-7 h-7 ${challenge.iconColor}`} />
                </div>
                <span className={`px-3 py-1 rounded-full text-xs font-semibold ${
                  challenge.difficulty === 'Advanced'
                    ? 'bg-red-500/10 text-red-400 border border-red-500/20'
                    : 'bg-yellow-500/10 text-yellow-400 border border-yellow-500/20'
                }`}>
                  {challenge.difficulty}
                </span>
              </div>

              <h3 className="text-xl font-bold text-white mb-3 group-hover:text-neon-cyan transition-colors duration-300">
                {challenge.title}
              </h3>
              <p className="text-gray-400 mb-6 leading-relaxed">{challenge.description}</p>

              <div className="flex flex-wrap gap-2 mb-6">
                {challenge.tags.map((tag) => (
                  <span
                    key={tag}
                    className="px-3 py-1 bg-white/5 text-gray-400 rounded-lg text-xs font-medium border border-white/5"
                  >
                    {tag}
                  </span>
                ))}
              </div>

              <a href="#" className="inline-flex items-center space-x-2 text-sm text-gray-400 hover:text-white transition-colors group/link">
                <span>Learn more</span>
                <ArrowRight className="w-4 h-4 group-hover/link:translate-x-1 transition-transform" />
              </a>
            </div>
          ))}
        </div>

        {/* CTA */}
        <div className="mt-16 text-center">
          <p className="text-gray-400 mb-6">Don&apos;t see a challenge that interests you?</p>
          <button className="group relative px-8 py-3.5 rounded-full text-white font-semibold overflow-hidden transition-all duration-300 hover:shadow-[0_0_30px_rgba(6,182,212,0.2)]">
            <span className="absolute inset-0 quantum-gradient opacity-80 group-hover:opacity-100 transition-opacity" />
            <span className="relative flex items-center space-x-2">
              <span>Propose Your Own Challenge</span>
              <ArrowRight className="w-4 h-4 group-hover:translate-x-1 transition-transform" />
            </span>
          </button>
        </div>
      </div>
    </section>
  )
}
