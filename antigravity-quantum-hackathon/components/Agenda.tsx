import { Calendar, Clock, MapPin, Mic, BookOpen, Flag, Coffee } from 'lucide-react'

export default function Agenda() {
  const agenda = [
    {
      day: 'Day 1',
      date: 'May 15',
      events: [
        { time: '09:00', title: 'Registration & Check-in', type: 'general', icon: Calendar },
        { time: '10:00', title: 'Opening Ceremony & Keynote', type: 'keynote', icon: Mic },
        { time: '11:00', title: 'Team Formation & Networking', type: 'general', icon: Calendar },
        { time: '12:00', title: 'Lunch', type: 'break', icon: Coffee },
        { time: '13:00', title: 'Workshop: Introduction to Qiskit', type: 'workshop', icon: BookOpen },
        { time: '15:00', title: 'Challenge Announcements', type: 'general', icon: Calendar },
        { time: '16:00', title: 'Hackathon Begins!', type: 'milestone', icon: Flag },
        { time: '18:00', title: 'Dinner', type: 'break', icon: Coffee },
        { time: '20:00', title: 'Mentor Office Hours', type: 'workshop', icon: BookOpen },
      ]
    },
    {
      day: 'Day 2',
      date: 'May 16',
      events: [
        { time: '08:00', title: 'Breakfast', type: 'break', icon: Coffee },
        { time: '09:00', title: 'Workshop: Quantum Machine Learning', type: 'workshop', icon: BookOpen },
        { time: '11:00', title: 'Mid-point Check-ins', type: 'general', icon: Calendar },
        { time: '12:00', title: 'Lunch', type: 'break', icon: Coffee },
        { time: '13:00', title: 'Workshop: Quantum Optimization', type: 'workshop', icon: BookOpen },
        { time: '15:00', title: 'Team Presentations (Round 1)', type: 'milestone', icon: Flag },
        { time: '18:00', title: 'Dinner', type: 'break', icon: Coffee },
        { time: '20:00', title: 'Night Hacking Continues', type: 'general', icon: Calendar },
      ]
    },
    {
      day: 'Day 3',
      date: 'May 17',
      events: [
        { time: '08:00', title: 'Breakfast', type: 'break', icon: Coffee },
        { time: '09:00', title: 'Final Project Submissions', type: 'milestone', icon: Flag },
        { time: '10:00', title: 'Team Presentations (Final Round)', type: 'milestone', icon: Flag },
        { time: '12:00', title: 'Lunch', type: 'break', icon: Coffee },
        { time: '13:00', title: 'Judging & Deliberations', type: 'general', icon: Calendar },
        { time: '15:00', title: 'Awards Ceremony', type: 'keynote', icon: Mic },
        { time: '16:00', title: 'Closing Ceremony', type: 'keynote', icon: Mic },
        { time: '17:00', title: 'Networking Reception', type: 'general', icon: Calendar },
      ]
    }
  ]

  const getTypeStyle = (type: string) => {
    switch (type) {
      case 'keynote': return { dot: 'bg-neon-purple', text: 'text-neon-purple', bg: 'bg-neon-purple/5' }
      case 'workshop': return { dot: 'bg-neon-blue', text: 'text-neon-blue', bg: 'bg-neon-blue/5' }
      case 'milestone': return { dot: 'bg-neon-cyan', text: 'text-neon-cyan', bg: 'bg-neon-cyan/5' }
      case 'break': return { dot: 'bg-gray-600', text: 'text-gray-500', bg: 'bg-white/[0.02]' }
      default: return { dot: 'bg-gray-500', text: 'text-gray-400', bg: 'bg-white/[0.02]' }
    }
  }

  return (
    <section id="agenda" className="py-32 bg-surface-0 relative overflow-hidden">
      <div className="absolute inset-0 grid-pattern opacity-20" />
      <div className="absolute top-1/2 left-0 w-[500px] h-[500px] bg-neon-blue/5 rounded-full blur-[150px]" />

      <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section header */}
        <div className="text-center mb-20">
          <div className="inline-flex items-center space-x-2 glass rounded-full px-4 py-1.5 mb-6">
            <Calendar className="w-3.5 h-3.5 text-neon-blue" />
            <span className="text-xs font-medium uppercase tracking-wider text-gray-400">Agenda</span>
          </div>
          <h2 className="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 tracking-tight">
            Three Days of
            <br />
            <span className="quantum-gradient-text">Quantum Innovation</span>
          </h2>
          <p className="text-gray-400 text-lg max-w-2xl mx-auto leading-relaxed">
            Three days of intensive hacking, learning, and innovation. Here&apos;s what to expect.
          </p>
        </div>

        {/* Event info pills */}
        <div className="flex flex-wrap justify-center gap-4 mb-16">
          <div className="glass rounded-full px-5 py-2 flex items-center space-x-2">
            <Calendar className="w-4 h-4 text-neon-cyan" />
            <span className="text-sm text-gray-300">May 15-17, 2026</span>
          </div>
          <div className="glass rounded-full px-5 py-2 flex items-center space-x-2">
            <Clock className="w-4 h-4 text-neon-cyan" />
            <span className="text-sm text-gray-300">48 Hours of Hacking</span>
          </div>
          <div className="glass rounded-full px-5 py-2 flex items-center space-x-2">
            <MapPin className="w-4 h-4 text-neon-cyan" />
            <span className="text-sm text-gray-300">Berlin, Germany</span>
          </div>
        </div>

        {/* Agenda columns */}
        <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
          {agenda.map((day, dayIndex) => (
            <div key={dayIndex} className="glass rounded-3xl overflow-hidden">
              {/* Day header */}
              <div className="px-8 py-6 border-b border-white/5">
                <div className="text-neon-cyan text-sm font-medium uppercase tracking-wider mb-1">{day.day}</div>
                <div className="text-2xl font-bold text-white">{day.date}</div>
              </div>

              {/* Events */}
              <div className="p-6 space-y-3">
                {day.events.map((event, eventIndex) => {
                  const style = getTypeStyle(event.type)
                  return (
                    <div
                      key={eventIndex}
                      className={`flex items-start space-x-4 p-3 rounded-xl ${style.bg} transition-colors hover:bg-white/[0.04]`}
                    >
                      <div className="flex flex-col items-center">
                        <div className={`w-2 h-2 rounded-full ${style.dot} mt-2`} />
                        {eventIndex < day.events.length - 1 && (
                          <div className="w-px h-full bg-white/5 mt-1" />
                        )}
                      </div>
                      <div className="flex-1 min-w-0">
                        <div className={`text-xs font-mono ${style.text} mb-1`}>{event.time}</div>
                        <div className="text-sm text-white font-medium">{event.title}</div>
                      </div>
                    </div>
                  )
                })}
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}
