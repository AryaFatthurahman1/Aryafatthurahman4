'use client'

import { useState, useEffect } from 'react'
import { Menu, X, Atom, ChevronDown } from 'lucide-react'
import { cn } from '@/lib/utils'

export default function Navigation() {
  const [isScrolled, setIsScrolled] = useState(false)
  const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false)
  const [activeSection, setActiveSection] = useState('')

  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 50)
      const sections = ['about', 'challenges', 'prizes', 'judges', 'agenda', 'faq']
      for (const section of sections.reverse()) {
        const el = document.getElementById(section)
        if (el && window.scrollY >= el.offsetTop - 100) {
          setActiveSection(section)
          break
        }
      }
    }
    window.addEventListener('scroll', handleScroll)
    return () => window.removeEventListener('scroll', handleScroll)
  }, [])

  const navItems = [
    { name: 'About', href: '#about' },
    { name: 'Challenges', href: '#challenges' },
    { name: 'Prizes', href: '#prizes' },
    { name: 'Judges', href: '#judges' },
    { name: 'Agenda', href: '#agenda' },
    { name: 'FAQ', href: '#faq' },
  ]

  return (
    <nav
      className={cn(
        'fixed top-0 left-0 right-0 z-50 transition-all duration-500',
        isScrolled
          ? 'bg-surface-0/80 backdrop-blur-xl border-b border-white/5 shadow-2xl shadow-black/20'
          : 'bg-transparent'
      )}
    >
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-20">
          <a href="#" className="flex items-center space-x-3 group">
            <div className="relative">
              <Atom className="w-9 h-9 text-neon-cyan group-hover:rotate-180 transition-transform duration-700" />
              <div className="absolute inset-0 w-9 h-9 bg-neon-cyan/20 rounded-full blur-lg group-hover:bg-neon-cyan/40 transition-colors" />
            </div>
            <div className="flex flex-col">
              <span className="text-lg font-bold tracking-tight text-white">
                AntiGravity
              </span>
              <span className="text-[10px] font-medium tracking-[0.3em] uppercase text-neon-cyan/70">
                Quantum
              </span>
            </div>
          </a>

          <div className="hidden lg:flex items-center space-x-1">
            {navItems.map((item) => (
              <a
                key={item.name}
                href={item.href}
                className={cn(
                  'relative px-4 py-2 text-sm font-medium transition-colors duration-300 rounded-lg',
                  activeSection === item.href.slice(1)
                    ? 'text-white'
                    : 'text-gray-400 hover:text-white'
                )}
              >
                {activeSection === item.href.slice(1) && (
                  <span className="absolute inset-0 bg-white/5 rounded-lg" />
                )}
                <span className="relative">{item.name}</span>
              </a>
            ))}
          </div>

          <div className="hidden lg:flex items-center space-x-4">
            <a href="#" className="text-sm text-gray-400 hover:text-white transition-colors">
              Sign In
            </a>
            <button className="relative group px-6 py-2.5 rounded-full text-sm font-semibold text-white overflow-hidden">
              <span className="absolute inset-0 quantum-gradient opacity-90 group-hover:opacity-100 transition-opacity" />
              <span className="absolute inset-0 rounded-full p-[1px] bg-gradient-to-r from-neon-purple via-neon-blue to-neon-cyan opacity-50 group-hover:opacity-80 transition-opacity" style={{ WebkitMask: 'linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0)', mask: 'linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0)', WebkitMaskComposite: 'xor', maskComposite: 'exclude' }} />
              <span className="relative">Register Now</span>
            </button>
          </div>

          <button
            className="lg:hidden relative w-10 h-10 flex items-center justify-center rounded-lg hover:bg-white/5 transition-colors"
            onClick={() => setIsMobileMenuOpen(!isMobileMenuOpen)}
            aria-label={isMobileMenuOpen ? 'Close menu' : 'Open menu'}
          >
            {isMobileMenuOpen ? <X className="w-5 h-5 text-white" /> : <Menu className="w-5 h-5 text-white" />}
          </button>
        </div>
      </div>

      <div
        className={cn(
          'lg:hidden overflow-hidden transition-all duration-500',
          isMobileMenuOpen ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0'
        )}
      >
        <div className="bg-surface-0/95 backdrop-blur-xl border-t border-white/5 px-4 py-6 space-y-1">
          {navItems.map((item) => (
            <a
              key={item.name}
              href={item.href}
              className={cn(
                'block px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200',
                activeSection === item.href.slice(1)
                  ? 'text-white bg-white/5'
                  : 'text-gray-400 hover:text-white hover:bg-white/5'
              )}
              onClick={() => setIsMobileMenuOpen(false)}
            >
              {item.name}
            </a>
          ))}
          <div className="pt-4 border-t border-white/5">
            <button className="w-full quantum-gradient px-6 py-3 rounded-full text-white font-semibold text-sm">
              Register Now
            </button>
          </div>
        </div>
      </div>
    </nav>
  )
}
