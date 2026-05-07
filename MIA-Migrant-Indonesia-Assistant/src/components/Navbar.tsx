import { Menu, X } from 'lucide-react';
import { useState } from 'react';

export default function Navbar() {
  const [isOpen, setIsOpen] = useState(false);

  return (
    <nav className="fixed w-full bg-white/80 backdrop-blur-md z-50 border-b border-gray-100">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-between h-16 items-center">
          <div className="flex items-center gap-2">
            <div className="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">
              M
            </div>
            <span className="font-bold text-xl tracking-tight text-gray-900">MIA</span>
          </div>
          
          <div className="hidden md:flex items-center space-x-8">
            <a href="#" className="text-gray-600 hover:text-blue-600 text-sm font-medium transition-colors">Beranda</a>
            <a href="#" className="text-gray-600 hover:text-blue-600 text-sm font-medium transition-colors">Tentang kami</a>
            <a href="#" className="text-gray-600 hover:text-blue-600 text-sm font-medium transition-colors">Blog</a>
            <a href="#" className="text-gray-600 hover:text-blue-600 text-sm font-medium transition-colors">Platform</a>
            <div className="flex items-center gap-1 text-gray-600 text-sm font-medium">
              <span>🇮🇩</span> Indonesia
            </div>
            <button className="bg-blue-600 text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-blue-700 transition-colors">
              Unduh aplikasinya
            </button>
          </div>

          <div className="md:hidden flex items-center">
            <button onClick={() => setIsOpen(!isOpen)} className="text-gray-600">
              {isOpen ? <X size={24} /> : <Menu size={24} />}
            </button>
          </div>
        </div>
      </div>

      {isOpen && (
        <div className="md:hidden bg-white border-b border-gray-100">
          <div className="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="#" className="block px-3 py-2 text-base font-medium text-gray-900">Beranda</a>
            <a href="#" className="block px-3 py-2 text-base font-medium text-gray-600">Tentang kami</a>
            <a href="#" className="block px-3 py-2 text-base font-medium text-gray-600">Blog</a>
            <a href="#" className="block px-3 py-2 text-base font-medium text-gray-600">Platform</a>
            <button className="w-full text-left px-3 py-2 text-base font-medium text-blue-600">
              Unduh aplikasinya
            </button>
          </div>
        </div>
      )}
    </nav>
  );
}
