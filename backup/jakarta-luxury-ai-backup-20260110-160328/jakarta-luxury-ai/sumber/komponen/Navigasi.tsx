
import React, { useState } from 'react';
import { User, AppRoute } from '@tipe/tipe';

interface NavbarProps {
  user: User | null;
  onLogout: () => void;
}

const Navigasi: React.FC<NavbarProps> = ({ user, onLogout }) => {
  const [isMenuOpen, setIsMenuOpen] = useState(false);
  return (
    <nav className="sticky top-0 z-50 glass border-b border-luxury-gold/10 px-6 py-4 flex items-center justify-between backdrop-blur-md bg-luxury-dark/80 transition-all duration-300">
      <div className="flex items-center space-x-2">
        <a href={`#${AppRoute.HOME}`} className="text-2xl font-serif font-bold tracking-tighter text-luxury-gold hover:opacity-80 transition-opacity">
          JAKARTA <span className="text-white font-bold">LUXURY</span>
        </a>
      </div>

      <div className="hidden md:flex items-center space-x-8 text-xs uppercase tracking-[0.2em] font-medium text-gray-300">
        <a href={`#${AppRoute.TRAVEL}`} className="hover:text-luxury-gold transition-colors duration-300 relative group">
          Travel
          <span className="absolute -bottom-1 left-0 w-0 h-[1px] bg-luxury-gold transition-all duration-300 group-hover:w-full"></span>
        </a>
        <a href={`#${AppRoute.CULINARY}`} className="hover:text-luxury-gold transition-colors duration-300 relative group">
          KULINER
          <span className="absolute -bottom-1 left-0 w-0 h-[1px] bg-luxury-gold transition-all duration-300 group-hover:w-full"></span>
        </a>
        <a href={`#${AppRoute.AI_DESIGNER}`} className="hover:text-luxury-gold transition-colors duration-300 relative group">
          AI Designer
          <span className="absolute -bottom-1 left-0 w-0 h-[1px] bg-luxury-gold transition-all duration-300 group-hover:w-full"></span>
        </a>
        <a href={`#${AppRoute.RESERVATION}`} className="hover:text-luxury-gold transition-colors duration-300 relative group">
          Reservasi
          <span className="absolute -bottom-1 left-0 w-0 h-[1px] bg-luxury-gold transition-all duration-300 group-hover:w-full"></span>
        </a>
        {user?.role === 'admin' && (
          <a href={`#${AppRoute.ADMIN}`} className="text-luxury-gold font-bold">Admin Panel</a>
        )}
      </div>

      <div className="flex items-center space-x-6">
        {user ? (
          <div className="flex items-center space-x-6">
            <span className="text-xs text-gray-400 tracking-wider">Halo, {user.name}</span>
            <button
              onClick={onLogout}
              className="px-6 py-2 text-[10px] uppercase tracking-widest border border-luxury-gold/50 text-luxury-gold hover:bg-luxury-gold hover:text-black transition-all duration-300"
            >
              LOGOUT
            </button>
          </div>
        ) : (
          <div className="flex items-center space-x-6">
            <a href={`#${AppRoute.LOGIN}`} className="text-xs uppercase tracking-widest text-gray-400 hover:text-white transition-colors">Login</a>
            <a
              href={`#${AppRoute.REGISTER}`}
              className="px-6 py-2 bg-gradient-to-r from-luxury-gold to-yellow-600 text-black text-[10px] uppercase font-bold tracking-widest hover:shadow-[0_0_15px_rgba(197,160,89,0.3)] transition-all duration-300"
            >
              DAFTAR
            </a>
          </div>
        )}
      </div>
      {/* Mobile Menu Button */}
      <button
        className="md:hidden text-luxury-gold p-2"
        onClick={() => setIsMenuOpen(!isMenuOpen)}
        aria-label={isMenuOpen ? "Tutup Menu" : "Buka Menu"}
        title={isMenuOpen ? "Tutup Menu" : "Buka Menu"}
      >
        <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          {isMenuOpen ? (
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
          ) : (
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 6h16M4 12h16M4 18h16" />
          )}
        </svg>
      </button>

      {/* Mobile Menu Overlay */}
      {isMenuOpen && (
        <div className="absolute top-full left-0 w-full bg-luxury-dark border-b border-luxury-gold/10 p-6 flex flex-col space-y-4 md:hidden shadow-2xl glass">
          <a href={`#${AppRoute.TRAVEL}`} className="text-gray-300 hover:text-luxury-gold tracking-widest uppercase text-xs py-2 border-b border-white/5" onClick={() => setIsMenuOpen(false)}>Travel</a>
          <a href={`#${AppRoute.CULINARY}`} className="text-gray-300 hover:text-luxury-gold tracking-widest uppercase text-xs py-2 border-b border-white/5" onClick={() => setIsMenuOpen(false)}>Kuliner</a>
          <a href={`#${AppRoute.AI_DESIGNER}`} className="text-gray-300 hover:text-luxury-gold tracking-widest uppercase text-xs py-2 border-b border-white/5" onClick={() => setIsMenuOpen(false)}>AI Designer</a>
          <a href={`#${AppRoute.RESERVATION}`} className="text-gray-300 hover:text-luxury-gold tracking-widest uppercase text-xs py-2 border-b border-white/5" onClick={() => setIsMenuOpen(false)}>Reservasi</a>
          {user?.role === 'admin' && (
            <a href={`#${AppRoute.ADMIN}`} className="text-luxury-gold font-bold uppercase text-xs py-2" onClick={() => setIsMenuOpen(false)}>Admin Panel</a>
          )}
        </div>
      )}
    </nav>
  );
};

export default Navigasi;




