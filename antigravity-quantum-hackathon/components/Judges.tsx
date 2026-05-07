import { Users, ExternalLink } from 'lucide-react'

export default function Judges() {
  const judges = [
    {
      name: 'Dr. Sarah Chen',
      role: 'Quantum Research Lead',
      org: 'IBM Quantum',
      image: 'SC',
      gradient: 'from-neon-purple to-neon-blue',
    },
    {
      name: 'Prof. Michael Rodriguez',
      role: 'Director',
      org: 'MIT Quantum Computing Center',
      image: 'MR',
      gradient: 'from-neon-blue to-neon-cyan',
    },
    {
      name: 'Dr. Emily Watson',
      role: 'Chief Scientist',
      org: 'Google Quantum AI',
      image: 'EW',
      gradient: 'from-neon-cyan to-neon-pink',
    },
    {
      name: 'Dr. James Liu',
      role: 'CTO',
      org: 'IonQ',
      image: 'JL',
      gradient: 'from-neon-pink to-neon-purple',
    }
  ]

  const partners = [
    'IBM Quantum', 'Google Quantum AI', 'IonQ', 'Quantinuum', 'Rigetti', 'PsiQuantum', 'OQC', 'Atom Computing'
  ]

  return (
    <section id="judges" className="py-32 bg-surface-50 relative overflow-hidden">
      <div className="absolute inset-0 grid-pattern opacity-15" />
      <div className="absolute bottom-0 left-0 w-[500px] h-[500px] bg-neon-purple/5 rounded-full blur-[150px]" />

      <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section header */}
        <div className="text-center mb-20">
          <div className="inline-flex items-center space-x-2 glass rounded-full px-4 py-1.5 mb-6">
            <Users className="w-3.5 h-3.5 text-neon-purple" />
            <span className="text-xs font-medium uppercase tracking-wider text-gray-400">Judges</span>
          </div>
          <h2 className="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 tracking-tight">
            Expert
            <br />
            <span className="quantum-gradient-text">Judging Panel</span>
          </h2>
          <p className="text-gray-400 text-lg max-w-2xl mx-auto leading-relaxed">
            Meet the distinguished panel of quantum computing experts who will evaluate your projects.
          </p>
        </div>

        {/* Judge cards */}
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-20">
          {judges.map((judge, index) => (
            <div
              key={index}
              className="group glass rounded-3xl p-8 text-center hover:bg-white/[0.03] transition-all duration-500 relative overflow-hidden"
            >
              <div className={`absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r ${judge.gradient} opacity-0 group-hover:opacity-100 transition-opacity duration-500`} />

              <div className={`w-20 h-20 rounded-2xl bg-gradient-to-br ${judge.gradient} mx-auto mb-6 flex items-center justify-center text-white text-xl font-bold shadow-lg group-hover:scale-110 transition-transform duration-300`}>
                {judge.image}
              </div>
              <h3 className="text-lg font-bold text-white mb-1">{judge.name}</h3>
              <p className="text-neon-cyan text-sm font-medium mb-1">{judge.role}</p>
              <p className="text-gray-500 text-sm">{judge.org}</p>
            </div>
          ))}
        </div>

        {/* Partners */}
        <div className="text-center">
          <h3 className="text-sm font-medium uppercase tracking-wider text-gray-500 mb-8">Partner Organizations</h3>
          <div className="flex flex-wrap justify-center items-center gap-6 md:gap-10">
            {partners.map((partner) => (
              <div
                key={partner}
                className="text-gray-500 hover:text-gray-300 transition-colors duration-300 font-semibold text-sm md:text-base cursor-pointer"
              >
                {partner}
              </div>
            ))}
          </div>
        </div>
      </div>
    </section>
  )
}
