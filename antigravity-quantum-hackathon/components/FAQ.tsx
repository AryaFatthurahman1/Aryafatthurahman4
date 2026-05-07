'use client'

import { ChevronDown, HelpCircle } from 'lucide-react'
import { useState } from 'react'
import { cn } from '@/lib/utils'

export default function FAQ() {
  const [openIndex, setOpenIndex] = useState<number | null>(0)

  const faqs = [
    {
      question: 'Who can participate in the hackathon?',
      answer: "Anyone with an interest in quantum computing can participate! Whether you're a student, researcher, developer, or quantum enthusiast, you're welcome to join. Teams can have 1-4 members."
    },
    {
      question: 'Do I need prior quantum computing experience?',
      answer: "While prior experience is helpful, it's not required. We provide workshops, tutorials, and mentorship to help beginners get started. There are challenges suitable for all skill levels."
    },
    {
      question: 'What tools and platforms will be available?',
      answer: 'Participants will have access to IBM Quantum Experience, Google Cirq, IonQ Quantum Cloud, and various quantum computing frameworks like Qiskit, Cirq, and PennyLane.'
    },
    {
      question: 'Is there a registration fee?',
      answer: 'No! The hackathon is completely free to attend. We provide meals, snacks, and swag throughout the event.'
    },
    {
      question: 'Can I participate remotely?',
      answer: 'Yes! We offer both in-person and remote participation options. Remote participants will have virtual access to all workshops, mentorship, and presentation sessions.'
    },
    {
      question: 'What should I bring?',
      answer: "Bring your laptop, charger, and any other devices you need for development. If you're joining in person, we'll provide workspace, power, and internet. Don't forget comfortable clothes!"
    }
  ]

  return (
    <section id="faq" className="py-32 bg-surface-50 relative overflow-hidden">
      <div className="absolute inset-0 grid-pattern opacity-15" />
      <div className="absolute top-0 right-0 w-[500px] h-[500px] bg-neon-cyan/5 rounded-full blur-[150px]" />

      <div className="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section header */}
        <div className="text-center mb-16">
          <div className="inline-flex items-center space-x-2 glass rounded-full px-4 py-1.5 mb-6">
            <HelpCircle className="w-3.5 h-3.5 text-neon-cyan" />
            <span className="text-xs font-medium uppercase tracking-wider text-gray-400">FAQ</span>
          </div>
          <h2 className="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 tracking-tight">
            Frequently Asked
            <br />
            <span className="quantum-gradient-text">Questions</span>
          </h2>
          <p className="text-gray-400 text-lg">
            Got questions? We&apos;ve got answers.
          </p>
        </div>

        {/* FAQ items */}
        <div className="space-y-3">
          {faqs.map((faq, index) => (
            <div
              key={index}
              className={cn(
                'glass rounded-2xl overflow-hidden transition-all duration-300',
                openIndex === index && 'bg-white/[0.03]'
              )}
            >
              <button
                className="w-full flex items-center justify-between p-6 text-left group"
                onClick={() => setOpenIndex(openIndex === index ? null : index)}
              >
                <span className="text-white font-medium pr-4 group-hover:text-neon-cyan transition-colors">{faq.question}</span>
                <ChevronDown
                  className={cn(
                    'w-5 h-5 text-gray-400 flex-shrink-0 transition-transform duration-300',
                    openIndex === index && 'rotate-180 text-neon-cyan'
                  )}
                />
              </button>
              <div
                className={cn(
                  'overflow-hidden transition-all duration-300',
                  openIndex === index ? 'max-h-48 opacity-100' : 'max-h-0 opacity-0'
                )}
              >
                <div className="px-6 pb-6 text-gray-400 leading-relaxed">
                  {faq.answer}
                </div>
              </div>
            </div>
          ))}
        </div>

        <div className="mt-12 text-center">
          <p className="text-gray-400 mb-4">Still have questions?</p>
          <button className="quantum-gradient px-6 py-3 rounded-full text-white font-semibold hover:opacity-90 transition-opacity">
            Contact Us
          </button>
        </div>
      </div>
    </section>
  )
}
