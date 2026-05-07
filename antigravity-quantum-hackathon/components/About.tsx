import { Users, Target, Award, Globe, Sparkles, CheckCircle2 } from 'lucide-react'

export default function About() {
  const stats = [
    { icon: Users, label: 'Participants', value: '500+', color: 'text-neon-purple' },
    { icon: Target, label: 'Challenges', value: '10+', color: 'text-neon-blue' },
    { icon: Award, label: 'Prize Pool', value: '$100K', color: 'text-neon-cyan' },
    { icon: Globe, label: 'Countries', value: '50+', color: 'text-neon-pink' },
  ]

  const benefits = [
    'Access to real quantum processors (IBM Q, Google Sycamore, IonQ)',
    'Mentorship from quantum computing experts',
    'Workshops on Qiskit, Cirq, and PennyLane',
    'Networking opportunities with industry leaders',
    'Career opportunities at top quantum companies',
    'Exclusive quantum computing credits and resources',
  ]

  return (
    <section id="about" className="py-32 bg-surface-0 relative overflow-hidden">
      <div className="absolute inset-0 grid-pattern opacity-20" />
      <div className="absolute top-0 left-0 w-[600px] h-[600px] bg-neon-purple/5 rounded-full blur-[150px]" />
      <div className="absolute bottom-0 right-0 w-[500px] h-[500px] bg-neon-cyan/5 rounded-full blur-[120px]" />

      <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section header */}
        <div className="text-center mb-20">
          <div className="inline-flex items-center space-x-2 glass rounded-full px-4 py-1.5 mb-6">
            <Sparkles className="w-3.5 h-3.5 text-neon-cyan" />
            <span className="text-xs font-medium uppercase tracking-wider text-gray-400">About the Event</span>
          </div>
          <h2 className="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 tracking-tight">
            Redefining What&apos;s
            <br />
            <span className="quantum-gradient-text">Possible with Quantum</span>
          </h2>
          <p className="text-gray-400 text-lg max-w-2xl mx-auto leading-relaxed">
            Join the world&apos;s most innovative quantum computing event where developers,
            researchers, and enthusiasts come together to push the boundaries of quantum technology.
          </p>
        </div>

        {/* Two-column layout */}
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-20">
          <div className="glass rounded-3xl p-10 hover:bg-white/[0.03] transition-all duration-500 group">
            <div className="w-12 h-12 rounded-2xl bg-neon-purple/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
              <Target className="w-6 h-6 text-neon-purple" />
            </div>
            <h3 className="text-2xl font-bold text-white mb-4">Our Mission</h3>
            <p className="text-gray-400 leading-relaxed mb-4">
              The AntiGravity Quantum Hackathon aims to accelerate quantum computing innovation
              by bringing together the brightest minds in the field. We believe in the power of
              collaboration and open-source development.
            </p>
            <p className="text-gray-400 leading-relaxed">
              Whether you&apos;re a quantum computing expert or just starting your journey,
              this hackathon provides the perfect environment to learn, innovate, and network
              with industry leaders.
            </p>
          </div>

          <div className="glass rounded-3xl p-10 hover:bg-white/[0.03] transition-all duration-500 group">
            <div className="w-12 h-12 rounded-2xl bg-neon-cyan/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
              <Sparkles className="w-6 h-6 text-neon-cyan" />
            </div>
            <h3 className="text-2xl font-bold text-white mb-4">What You&apos;ll Get</h3>
            <ul className="space-y-3">
              {benefits.map((benefit) => (
                <li key={benefit} className="flex items-start space-x-3">
                  <CheckCircle2 className="w-5 h-5 text-neon-cyan flex-shrink-0 mt-0.5" />
                  <span className="text-gray-400">{benefit}</span>
                </li>
              ))}
            </ul>
          </div>
        </div>

        {/* Stats */}
        <div className="grid grid-cols-2 md:grid-cols-4 gap-6">
          {stats.map((stat) => (
            <div key={stat.label} className="glass rounded-2xl p-8 text-center hover:bg-white/[0.03] transition-all duration-300 group">
              <stat.icon className={`w-10 h-10 ${stat.color} mx-auto mb-4 group-hover:scale-110 transition-transform`} />
              <div className="text-3xl md:text-4xl font-bold text-white mb-2">{stat.value}</div>
              <div className="text-gray-500 text-sm uppercase tracking-wider">{stat.label}</div>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}
