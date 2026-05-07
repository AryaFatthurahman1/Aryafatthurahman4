import { Github, Twitter, Linkedin, Mail, Atom, ArrowUpRight } from 'lucide-react'

export default function Footer() {
  const quickLinks = [
    { name: 'About', href: '#about' },
    { name: 'Challenges', href: '#challenges' },
    { name: 'Prizes', href: '#prizes' },
    { name: 'Agenda', href: '#agenda' },
    { name: 'FAQ', href: '#faq' },
  ]

  const partners = [
    { name: 'IBM Quantum', href: '#' },
    { name: 'Google Quantum AI', href: '#' },
    { name: 'Quantinuum', href: '#' },
    { name: 'IonQ', href: '#' },
    { name: 'PsiQuantum', href: '#' },
    { name: 'OQC', href: '#' },
  ]

  const socials = [
    { icon: Twitter, href: '#', label: 'Twitter' },
    { icon: Github, href: '#', label: 'GitHub' },
    { icon: Linkedin, href: '#', label: 'LinkedIn' },
    { icon: Mail, href: '#', label: 'Email' },
  ]

  return (
    <footer className="bg-surface-0 border-t border-white/5 relative overflow-hidden">
      <div className="absolute bottom-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-neon-purple/3 rounded-full blur-[200px]" />

      <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Main footer */}
        <div className="py-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
          {/* Brand */}
          <div className="lg:col-span-2">
            <div className="flex items-center space-x-3 mb-6">
              <div className="relative">
                <Atom className="w-8 h-8 text-neon-cyan" />
                <div className="absolute inset-0 w-8 h-8 bg-neon-cyan/20 rounded-full blur-lg" />
              </div>
              <div className="flex flex-col">
                <span className="text-lg font-bold tracking-tight text-white">AntiGravity</span>
                <span className="text-[10px] font-medium tracking-[0.3em] uppercase text-neon-cyan/70">Quantum</span>
              </div>
            </div>
            <p className="text-gray-400 text-sm mb-6 max-w-md leading-relaxed">
              Where Innovation Meets Entanglement. Join the most exciting quantum computing
              hackathon of 2026 and help shape the future of quantum technology.
            </p>
            <div className="flex space-x-3">
              {socials.map((social) => (
                <a
                  key={social.label}
                  href={social.href}
                  className="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/10 transition-all duration-300"
                  aria-label={social.label}
                >
                  <social.icon className="w-4 h-4" />
                </a>
              ))}
            </div>
          </div>

          {/* Quick Links */}
          <div>
            <h3 className="text-sm font-semibold uppercase tracking-wider text-gray-500 mb-4">Quick Links</h3>
            <ul className="space-y-3">
              {quickLinks.map((link) => (
                <li key={link.name}>
                  <a href={link.href} className="text-gray-400 hover:text-white transition-colors text-sm">
                    {link.name}
                  </a>
                </li>
              ))}
            </ul>
          </div>

          {/* Partners */}
          <div>
            <h3 className="text-sm font-semibold uppercase tracking-wider text-gray-500 mb-4">Partners</h3>
            <ul className="space-y-3">
              {partners.map((partner) => (
                <li key={partner.name}>
                  <a href={partner.href} className="text-gray-400 hover:text-white transition-colors text-sm inline-flex items-center space-x-1 group">
                    <span>{partner.name}</span>
                    <ArrowUpRight className="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity" />
                  </a>
                </li>
              ))}
            </ul>
          </div>
        </div>

        {/* Bottom bar */}
        <div className="border-t border-white/5 py-8 flex flex-col md:flex-row items-center justify-between gap-4">
          <p className="text-gray-500 text-sm">
            &copy; 2026 AntiGravity Quantum Hackathon. All rights reserved.
          </p>
          <div className="flex items-center space-x-6 text-sm text-gray-500">
            <a href="#" className="hover:text-gray-300 transition-colors">Privacy Policy</a>
            <a href="#" className="hover:text-gray-300 transition-colors">Terms of Service</a>
            <a href="#" className="hover:text-gray-300 transition-colors">Code of Conduct</a>
          </div>
        </div>
      </div>
    </footer>
  )
}
