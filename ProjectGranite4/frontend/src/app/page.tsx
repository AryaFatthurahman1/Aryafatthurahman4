"use client";

import { motion } from "framer-motion";
import { 
  Trophy, 
  Settings, 
  Activity, 
  MessageSquare, 
  Zap,
  ChevronRight,
  ShieldCheck
} from "lucide-react";
import { useState } from "react";
import { 
  LineChart, 
  Line, 
  XAxis, 
  YAxis, 
  CartesianGrid, 
  Tooltip, 
  ResponsiveContainer,
  AreaChart,
  Area
} from "recharts";

const telemetryData = [
  { time: "0s", speed: 280, tire: 100 },
  { time: "10s", speed: 310, tire: 98 },
  { time: "20s", speed: 295, tire: 95 },
  { time: "30s", speed: 320, tire: 92 },
  { time: "40s", speed: 305, tire: 88 },
  { time: "50s", speed: 330, tire: 85 },
];

export default function Home() {
  const [isAnalyzing, setIsAnalyzing] = useState(false);
  const [insight, setInsight] = useState<string | null>(null);

  const handleAnalyze = async () => {
    setIsAnalyzing(true);
    // Simulate API call to backend
    setTimeout(() => {
      setInsight("Based on current tire degradation (85%) and the FIA Sporting Regulation Article 24.4, we recommend switching to HARD compound at Lap 18 to ensure finishing without an extra stop.");
      setIsAnalyzing(false);
    }, 2000);
  };

  return (
    <main className="min-h-screen grid-bg text-white p-6 md:p-12 overflow-hidden">
      {/* Header */}
      <header className="flex justify-between items-center mb-12">
        <div className="flex items-center gap-3">
          <div className="w-10 h-10 racing-gradient rounded-lg flex items-center justify-center shadow-lg shadow-red-500/20">
            <Trophy className="text-white w-6 h-6" />
          </div>
          <h1 className="text-2xl font-bold tracking-tighter">RACESENSE <span className="text-red-500 underline decoration-2 underline-offset-4">AI</span></h1>
        </div>
        <div className="flex items-center gap-4">
          <div className="hidden md:flex items-center gap-2 px-3 py-1 bg-green-500/10 text-green-500 rounded-full text-xs font-medium border border-green-500/20">
            <Activity className="w-3 h-3" />
            LIVE TELEMETRY
          </div>
          <Settings className="text-white/40 hover:text-white cursor-pointer transition-colors" />
        </div>
      </header>

      <div className="grid grid-cols-1 lg:grid-cols-12 gap-6 max-w-7xl mx-auto">
        {/* Left Column - Telemetry & Strategy */}
        <div className="lg:col-span-8 space-y-6">
          {/* Main Dashboard Card */}
          <motion.div 
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            className="glass p-6"
          >
            <div className="flex justify-between items-center mb-6">
              <div>
                <h2 className="text-xl font-semibold">Race Performance Dashboard</h2>
                <p className="text-white/40 text-sm">Real-time analysis from Car #44</p>
              </div>
              <div className="text-right">
                <span className="text-3xl font-black text-red-500 italic tracking-tighter">LAP 14/56</span>
              </div>
            </div>

            <div className="h-[300px] w-full">
              <ResponsiveContainer width="100%" height="100%">
                <AreaChart data={telemetryData}>
                  <defs>
                    <linearGradient id="colorSpeed" x1="0" y1="0" x2="0" y2="1">
                      <stop offset="5%" stopColor="#ff3e3e" stopOpacity={0.3}/>
                      <stop offset="95%" stopColor="#ff3e3e" stopOpacity={0}/>
                    </linearGradient>
                  </defs>
                  <CartesianGrid strokeDasharray="3 3" stroke="#ffffff10" />
                  <XAxis dataKey="time" stroke="#ffffff40" fontSize={12} />
                  <YAxis stroke="#ffffff40" fontSize={12} />
                  <Tooltip 
                    contentStyle={{ background: '#111', border: '1px solid #333', borderRadius: '8px' }}
                  />
                  <Area type="monotone" dataKey="speed" stroke="#ff3e3e" fillOpacity={1} fill="url(#colorSpeed)" />
                  <Area type="monotone" dataKey="tire" stroke="#4ade80" fillOpacity={0.1} fill="#4ade80" />
                </AreaChart>
              </ResponsiveContainer>
            </div>

            <div className="grid grid-cols-3 gap-4 mt-6">
              <div className="p-4 bg-white/5 rounded-xl border border-white/5">
                <p className="text-white/40 text-xs uppercase mb-1">Top Speed</p>
                <p className="text-2xl font-bold italic tracking-tighter">334 <span className="text-xs text-white/40 not-italic">KM/H</span></p>
              </div>
              <div className="p-4 bg-white/5 rounded-xl border border-white/5">
                <p className="text-white/40 text-xs uppercase mb-1">Tire Wear</p>
                <p className="text-2xl font-bold italic tracking-tighter text-yellow-500">85%</p>
              </div>
              <div className="p-4 bg-white/5 rounded-xl border border-white/5">
                <p className="text-white/40 text-xs uppercase mb-1">Fuel Delta</p>
                <p className="text-2xl font-bold italic tracking-tighter text-green-500">+0.42 <span className="text-xs text-white/40 not-italic">KG</span></p>
              </div>
            </div>
          </motion.div>

          {/* Strategy Simulation Card */}
          <motion.div 
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 0.2 }}
            className="glass p-6 overflow-hidden relative"
          >
            <div className="absolute top-0 right-0 p-4 opacity-10">
              <Zap className="w-24 h-24 text-red-500" />
            </div>
            
            <h3 className="text-lg font-semibold mb-4 flex items-center gap-2">
              <ShieldCheck className="text-red-500 w-5 h-5" />
              Strategy Simulation
            </h3>
            
            <p className="text-white/60 mb-6 max-w-lg">
              Simulate race outcomes based on current regulations and historical patterns powered by <span className="text-white font-bold tracking-tight">IBM GRANITE</span>.
            </p>

            <button 
              onClick={handleAnalyze}
              disabled={isAnalyzing}
              className="px-6 py-3 racing-gradient rounded-xl font-bold text-sm tracking-wide flex items-center gap-2 hover:scale-105 transition-transform disabled:opacity-50 disabled:hover:scale-100"
            >
              {isAnalyzing ? "RUNNING SIMULATION..." : "GENERATE PIT STRATEGY"}
              <ChevronRight className="w-4 h-4" />
            </button>

            {insight && (
              <motion.div 
                initial={{ opacity: 0, height: 0 }}
                animate={{ opacity: 1, height: "auto" }}
                className="mt-6 p-4 bg-red-500/10 border border-red-500/20 rounded-xl"
              >
                <p className="text-red-100/90 leading-relaxed italic">
                  " {insight} "
                </p>
              </motion.div>
            )}
          </motion.div>
        </div>

        {/* Right Column - AI Copilot Chat */}
        <div className="lg:col-span-4">
          <motion.div 
            initial={{ opacity: 0, x: 20 }}
            animate={{ opacity: 1, x: 0 }}
            transition={{ delay: 0.3 }}
            className="glass h-[calc(100vh-140px)] flex flex-col"
          >
            <div className="p-4 border-b border-white/10 flex items-center justify-between">
              <div className="flex items-center gap-2">
                <MessageSquare className="text-red-500 w-5 h-5" />
                <h3 className="font-semibold">Race Engineer AI</h3>
              </div>
              <div className="flex gap-1">
                <div className="w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse"></div>
              </div>
            </div>

            <div className="flex-1 p-4 overflow-y-auto space-y-4">
              <div className="flex justify-start">
                <div className="max-w-[85%] p-3 bg-white/5 rounded-2xl rounded-tl-none border border-white/5 text-sm">
                  Hello Commander. I am ready to assist Car #44. I've parsed the FIA regulations using <span className="text-red-400 font-mono">Docling</span>. What's our focus?
                </div>
              </div>
              <div className="flex justify-end">
                <div className="max-w-[85%] p-3 racing-gradient rounded-2xl rounded-tr-none text-sm font-medium">
                  What is the speed limit in the pit lane for this track?
                </div>
              </div>
              <div className="flex justify-start">
                <div className="max-w-[85%] p-3 bg-white/5 rounded-2xl rounded-tl-none border border-white/5 text-sm">
                  Checking Sporting Regulations Article 34.7... The limit is <span className="text-white font-bold">80km/h</span>. Warning: Red Bull just received a 5s penalty for exceeding this.
                </div>
              </div>
            </div>

            <div className="p-4 border-t border-white/10">
              <div className="relative">
                <input 
                  type="text" 
                  placeholder="Ask the car..." 
                  className="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-red-500/50 transition-colors"
                />
                <button className="absolute right-2 top-1.5 p-1.5 bg-red-500 rounded-lg">
                  <ChevronRight className="w-4 h-4 text-white" />
                </button>
              </div>
            </div>
          </motion.div>
        </div>
      </div>
    </main>
  );
}
