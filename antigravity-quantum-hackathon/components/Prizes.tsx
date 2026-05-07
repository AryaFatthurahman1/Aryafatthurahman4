import { Trophy, Gift, Star, Crown, Medal, Award } from 'lucide-react'

export default function Prizes() {
  const prizes = [
    {
      icon: Crown,
      title: 'First Place',
      value: '$50,000',
      description: 'Grand prize plus quantum computing credits and mentorship program',
      gradient: 'from-yellow-400 to-amber-500',
      borderGradient: 'from-yellow-400/50 via-amber-400/30 to-yellow-400/50',
      glow: 'hover:shadow-[0_0_60px_rgba(234,179,8,0.15)]',
      size: 'md:scale-105',
    },
    {
      icon: Medal,
      title: 'Second Place',
      value: '$30,000',
      description: 'Quantum computing credits and internship opportunities',
      gradient: 'from-gray-300 to-gray-400',
      borderGradient: 'from-gray-300/30 via-gray-400/20 to-gray-300/30',
      glow: 'hover:shadow-[0_0_40px_rgba(156,163,175,0.1)]',
      size: '',
    },
    {
      icon: Award,
      title: 'Third Place',
      value: '$20,000',
      description: 'Quantum computing credits and tech gadgets',
      gradient: 'from-amber-600 to-amber-700',
      borderGradient: 'from-amber-600/30 via-amber-700/20 to-amber-600/30',
      glow: 'hover:shadow-[0_0_40px_rgba(180,83,9,0.1)]',
      size: '',
    }
  ]

  const additionalPrizes = [
    'Best Quantum ML Solution',
    'Most Innovative Approach',
    'Best Beginner Team',
    'People&apos;s Choice Award',
    'Best Documentation',
    'Most Scalable Solution',
  ]

  const credits = [
    { value: '$10,000', label: 'IBM Quantum Credits', color: 'text-neon-blue' },
    { value: '$5,000', label: 'Google Quantum Credits', color: 'text-neon-cyan' },
    { value: '$5,000', label: 'IonQ Quantum Credits', color: 'text-neon-purple' },
  ]

  return (
    <section id="prizes" className="py-32 bg-surface-0 relative overflow-hidden">
      <div className="absolute inset-0 grid-pattern opacity-20" />
      <div className="absolute top-0 left-1/4 w-[600px] h-[600px] bg-yellow-500/3 rounded-full blur-[200px]" />
      <div className="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-neon-purple/5 rounded-full blur-[150px]" />

      <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section header */}
        <div className="text-center mb-20">
          <div className="inline-flex items-center space-x-2 glass rounded-full px-4 py-1.5 mb-6">
            <Trophy className="w-3.5 h-3.5 text-yellow-400" />
            <span className="text-xs font-medium uppercase tracking-wider text-gray-400">Prizes</span>
          </div>
          <h2 className="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 tracking-tight">
            Compete for
            <br />
            <span className="quantum-gradient-text">Glory &amp; Rewards</span>
          </h2>
          <p className="text-gray-400 text-lg max-w-2xl mx-auto leading-relaxed">
            Compete for over $100,000 in prizes, quantum computing credits, and exclusive
            opportunities to work with leading quantum companies.
          </p>
        </div>

        {/* Prize cards */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16 items-start">
          {prizes.map((prize, index) => (
            <div
              key={index}
              className={`group glass rounded-3xl p-8 text-center transition-all duration-500 ${prize.glow} ${prize.size} relative overflow-hidden`}
            >
              {/* Top gradient border */}
              <div className={`absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r ${prize.borderGradient}`} />

              <div className={`w-20 h-20 rounded-3xl bg-gradient-to-br ${prize.gradient} mx-auto mb-6 flex items-center justify-center opacity-20 group-hover:opacity-30 transition-opacity`}>
                <prize.icon className="w-10 h-10 text-white opacity-100" />
              </div>
              <div className="relative -mt-14 mb-4">
                <prize.icon className={`w-10 h-10 mx-auto bg-gradient-to-br ${prize.gradient} bg-clip-text`} style={{ color: 'transparent', background: `linear-gradient(135deg, var(--tw-gradient-stops))`, WebkitBackgroundClip: 'text', WebkitTextFillColor: 'transparent' }} />
              </div>

              <h3 className="text-xl font-bold text-white mb-2">{prize.title}</h3>
              <div className="text-4xl md:text-5xl font-bold text-white mb-4">{prize.value}</div>
              <p className="text-gray-400 leading-relaxed">{prize.description}</p>
            </div>
          ))}
        </div>

        {/* Additional prizes */}
        <div className="glass rounded-3xl p-10 mb-12">
          <h3 className="text-2xl font-bold text-white mb-8 text-center">Additional Awards</h3>
          <div className="grid grid-cols-2 md:grid-cols-3 gap-4">
            {additionalPrizes.map((prize) => (
              <div key={prize} className="flex items-center space-x-3 p-3 rounded-xl hover:bg-white/5 transition-colors">
                <Star className="w-5 h-5 text-neon-cyan flex-shrink-0" />
                <span className="text-gray-300 text-sm" dangerouslySetInnerHTML={{ __html: prize }} />
              </div>
            ))}
          </div>
        </div>

        {/* Quantum credits */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          {credits.map((credit) => (
            <div key={credit.label} className="glass rounded-2xl p-8 text-center hover:bg-white/[0.03] transition-all duration-300">
              <div className={`text-3xl font-bold ${credit.color} mb-2`}>{credit.value}</div>
              <div className="text-gray-500 text-sm uppercase tracking-wider">{credit.label}</div>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}
