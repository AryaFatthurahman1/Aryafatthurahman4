import { ArrowRight, ShieldCheck, Globe, CheckCircle2 } from 'lucide-react';

export default function Hero() {
  return (
    <div className="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
      <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-blue-50 via-white to-white -z-10"></div>
      
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div className="grid lg:grid-cols-2 gap-12 lg:gap-8 items-center">
          <div className="max-w-2xl">
            <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-sm font-medium mb-6 border border-blue-100">
              <ShieldCheck size={16} />
              <span>Platform Resmi & Terverifikasi</span>
            </div>
            
            <h1 className="text-5xl lg:text-7xl font-bold tracking-tight text-gray-900 mb-6 leading-[1.1]">
              Kerja di luar negeri dengan <br/>
              <span className="text-blue-600">resmi. terencana. aman.</span>
            </h1>
            
            <p className="text-lg text-gray-600 mb-8 leading-relaxed max-w-xl">
              Platform digital berbasis AI yang mendampingi perjalanan karir global Anda melalui sistem yang terintegrasi dan terpercaya.
            </p>
            
            <div className="flex flex-col sm:flex-row gap-4">
              <button className="inline-flex justify-center items-center gap-2 bg-blue-600 text-white px-8 py-4 rounded-full text-base font-semibold hover:bg-blue-700 transition-all shadow-lg shadow-blue-600/20">
                Unduh MIA Sekarang
                <ArrowRight size={20} />
              </button>
              <button className="inline-flex justify-center items-center gap-2 bg-white text-gray-900 px-8 py-4 rounded-full text-base font-semibold border border-gray-200 hover:border-gray-300 hover:bg-gray-50 transition-all">
                Pelajari Lebih Lanjut
              </button>
            </div>

            <div className="mt-10 flex items-center gap-6 text-sm text-gray-500">
              <div className="flex items-center gap-2">
                <CheckCircle2 size={16} className="text-green-500" />
                <span>Gratis digunakan</span>
              </div>
              <div className="flex items-center gap-2">
                <CheckCircle2 size={16} className="text-green-500" />
                <span>Dukungan 24/7</span>
              </div>
            </div>
          </div>
          
          <div className="relative lg:ml-auto">
            <div className="absolute inset-0 bg-gradient-to-tr from-blue-100 to-blue-50 rounded-[2.5rem] transform rotate-3 scale-105 -z-10"></div>
            <img 
              src="https://picsum.photos/seed/migrant/800/1000" 
              alt="Pekerja Migran Indonesia" 
              className="rounded-[2rem] shadow-2xl object-cover w-full max-w-md mx-auto lg:max-w-none"
              referrerPolicy="no-referrer"
            />
            
            {/* Floating Stats Card */}
            <div className="absolute -bottom-6 -left-6 bg-white p-6 rounded-2xl shadow-xl border border-gray-100 max-w-xs animate-bounce" style={{ animationDuration: '3s' }}>
              <div className="flex items-center gap-4">
                <div className="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                  <Globe size={24} />
                </div>
                <div>
                  <div className="text-2xl font-bold text-gray-900">500+</div>
                  <div className="text-sm text-gray-500">Lowongan Tersedia</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
