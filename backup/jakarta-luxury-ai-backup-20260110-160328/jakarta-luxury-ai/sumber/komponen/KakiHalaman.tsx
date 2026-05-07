import React from 'react';

const Footer: React.FC = () => {
  const currentYear = new Date().getFullYear();

  return (
    <footer className="bg-black border-t border-luxury-gold/10 pt-20 pb-10 px-6 relative overflow-hidden">
      {/* Background Glow */}
      <div className="absolute top-0 left-1/2 -translate-x-1/2 w-[500px] h-[500px] bg-luxury-gold/5 blur-[150px] rounded-full pointer-events-none"></div>

      <div className="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12 mb-16 relative z-10">
        <div className="col-span-1 md:col-span-2 space-y-6">
          <h2 className="text-3xl font-serif font-bold tracking-tighter text-luxury-gold">
            JAKARTA <span className="text-white font-light">LUXURY</span>
          </h2>
          <p className="text-gray-500 max-w-sm leading-relaxed text-sm">
            Platform AI terdepan untuk eksplorasi travel dan culinary design di Jakarta. Menghadirkan kemewahan melalui teknologi mutakhir.
          </p>
          <div className="flex space-x-4">
            <a href="#" aria-label="Instagram" className="p-3 bg-white/5 rounded-full hover:bg-luxury-gold hover:text-black transition-all duration-300 group ring-1 ring-white/10 hover:ring-luxury-gold">
              <svg className="w-5 h-5 fill-gray-400 group-hover:fill-black transition-colors" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.17.054 1.805.249 2.227.412.56.216.96.475 1.382.897.422.422.681.822.897 1.382.164.422.358 1.057.412 2.227.059 1.266.071 1.646.071 4.85s-.012 3.584-.071 4.85c-.054 1.17-.249 1.805-.412 2.227-.216.56-.475.96-.897 1.382-.422.422-.822.681-1.382.897-.422.164-1.057.358-2.227.412-1.266.059-1.646.071-4.85.071s-3.584-.012-4.85-.071c-1.17-.054-1.805-.249-2.227-.412-.56-.216-.96-.475-1.382-.897-.422-.422-.681-.822-.897-1.382-.164-.422-.358-1.057-.412-2.227-.059-1.266-.071-1.646-.071-4.85s.012-3.584.071-4.85c.054-1.17.249-1.805.412-2.227.216-.56.475-.96.897-1.382.422-.422.822-.681 1.382-.897.422-.164 1.057-.358 2.227-.412 1.266-.059 1.646-.071 4.85-.071zm0-2.163c-3.259 0-3.667.014-4.947.072-1.277.058-2.148.261-2.911.558-.788.306-1.457.715-2.122 1.381s-1.075 1.334-1.381 2.122c-.297.763-.5 1.634-.558 2.911-.058 1.28-.072 1.688-.072 4.947s.014 3.667.072 4.947c.058 1.277.261 2.148.558 2.911.306.788.715 1.457 1.381 2.122s1.334 1.075 2.122 1.381c.763.297 1.634.5 2.911.558 1.28.058 1.688.072 4.947.072s3.667-.014 4.947-.072c1.277-.058 2.148-.261 2.911-.558.788-.306 1.457-.715 2.122-1.381s1.075-1.334 1.381-2.122c.297-.763.5-1.634.558-2.911.058-1.28.072-1.688.072-4.947s-.014-3.667-.072-4.947c-.058-1.277-.261-2.148-.558-2.911-.306-.788-.715-1.457-1.381-2.122s-1.334-1.075-2.122-1.381c-.763-.297-1.634-.5-2.911-.558-1.28-.058-1.688-.072-4.947-.072zM12 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.162 6.162 6.162 6.162-2.759 6.162-6.162-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.791-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.209-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" /></svg>
            </a>
            <a href="#" aria-label="Facebook" className="p-3 bg-white/5 rounded-full hover:bg-luxury-gold hover:text-black transition-all duration-300 group ring-1 ring-white/10 hover:ring-luxury-gold">
              <svg className="w-5 h-5 fill-gray-400 group-hover:fill-black transition-colors" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" /></svg>
            </a>
          </div>
        </div>

        <div>
          <h4 className="text-white font-bold uppercase tracking-widest text-xs mb-6 border-b border-luxury-gold/20 pb-2 inline-block">Navigasi Cepat</h4>
          <ul className="space-y-4 text-sm text-gray-500">
            <li><a href="#travel" className="hover:text-luxury-gold transition-colors duration-300 flex items-center gap-2 group"><span className="w-1 h-1 rounded-full bg-luxury-gold opacity-0 group-hover:opacity-100 transition-opacity"></span>Travel Packages</a></li>
            <li><a href="#culinary" className="hover:text-luxury-gold transition-colors duration-300 flex items-center gap-2 group"><span className="w-1 h-1 rounded-full bg-luxury-gold opacity-0 group-hover:opacity-100 transition-opacity"></span>Culinary Design</a></li>
            <li><a href="#reservation" className="hover:text-luxury-gold transition-colors duration-300 flex items-center gap-2 group"><span className="w-1 h-1 rounded-full bg-luxury-gold opacity-0 group-hover:opacity-100 transition-opacity"></span>Reservasi Online</a></li>
            <li><a href="#ai-designer" className="hover:text-luxury-gold transition-colors duration-300 flex items-center gap-2 group"><span className="w-1 h-1 rounded-full bg-luxury-gold opacity-0 group-hover:opacity-100 transition-opacity"></span>AI Interior Design</a></li>
          </ul>
        </div>

        <div>
          <h4 className="text-white font-bold uppercase tracking-widest text-xs mb-6 border-b border-luxury-gold/20 pb-2 inline-block">Kelompok 13</h4>
          <ul className="space-y-3 text-[11px] text-gray-500 uppercase tracking-wider">
            <li className="flex items-center justify-between hover:text-white transition-colors border-b border-white/5 pb-2">
              <span>Kayla Ariellia M.</span>
              <span className="text-luxury-gold/70 font-mono">2023230048</span>
            </li>
            <li className="flex items-center justify-between hover:text-white transition-colors border-b border-white/5 pb-2">
              <span>M. Fachri Ardana</span>
              <span className="text-luxury-gold/70 font-mono">2023230035</span>
            </li>
            <li className="flex items-center justify-between hover:text-white transition-colors border-b border-white/5 pb-2">
              <span>M. Arya F.</span>
              <span className="text-luxury-gold/70 font-mono">2023230006</span>
            </li>
            <li className="flex items-center justify-between hover:text-white transition-colors border-b border-white/5 pb-2">
              <span>Novi Yanti S.</span>
              <span className="text-luxury-gold/70 font-mono">2023230052</span>
            </li>
          </ul>
        </div>
      </div>

      <div className="max-w-7xl mx-auto pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center text-[10px] text-gray-600 uppercase tracking-[0.2em]">
        <p className="hover:text-luxury-gold/50 transition-colors">© {currentYear} JAKARTA LUXURY AI DESIGN.</p>
        <div className="flex space-x-8 mt-4 md:mt-0">
          <a href="#" className="hover:text-white transition-colors">Privacy</a>
          <a href="#" className="hover:text-white transition-colors">Terms</a>
          <a href="#" className="hover:text-white transition-colors">Sitemap</a>
        </div>
      </div>
    </footer>
  );
};

export default Footer;




