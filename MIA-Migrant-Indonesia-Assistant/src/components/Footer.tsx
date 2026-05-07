import { Instagram, Twitter, MessageCircle } from 'lucide-react';

export default function Footer() {
  return (
    <footer className="bg-gray-900 text-white pt-20 pb-10">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
          <div className="lg:col-span-1">
            <div className="flex items-center gap-2 mb-6">
              <div className="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                M
              </div>
              <span className="font-bold text-xl tracking-tight text-white">MIA</span>
            </div>
            <p className="text-gray-400 text-sm leading-relaxed mb-6">
              Platform digital resmi untuk mendukung kesiapan calon pekerja migran Indonesia menuju pasar kerja global.
            </p>
            <div className="flex gap-4">
              <a href="#" className="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-blue-600 hover:text-white transition-colors">
                <Instagram size={18} />
              </a>
              <a href="#" className="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-blue-600 hover:text-white transition-colors">
                <Twitter size={18} />
              </a>
              <a href="#" className="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-blue-600 hover:text-white transition-colors">
                <MessageCircle size={18} />
              </a>
            </div>
          </div>

          <div>
            <h4 className="font-semibold text-lg mb-6">Kantor Pusat</h4>
            <address className="not-italic text-gray-400 text-sm leading-relaxed space-y-4">
              <p>
                Skyline Building 16th Floor North Wing Unit 01-02, Jl.M.H Thamrin No. 9 2, RT.02 RW. 01, Kebon Sirih, Menteng, Kota Jakarta Pusat, DKI Jakarta 10340
              </p>
              <p className="flex items-center gap-2">
                <span className="font-medium text-white">WhatsApp:</span>
                <a href="tel:+6281198895586" className="hover:text-blue-400 transition-colors">+62 811-9889-5586</a>
              </p>
            </address>
          </div>

          <div>
            <h4 className="font-semibold text-lg mb-6">Produk</h4>
            <ul className="space-y-4 text-sm text-gray-400">
              <li><a href="#" className="hover:text-blue-400 transition-colors">Aplikasi MIA</a></li>
              <li><a href="#" className="hover:text-blue-400 transition-colors">MIA untuk employers</a></li>
              <li><a href="#" className="hover:text-blue-400 transition-colors">MIA untuk P3MI</a></li>
            </ul>
          </div>

          <div>
            <h4 className="font-semibold text-lg mb-6">Perusahaan</h4>
            <ul className="space-y-4 text-sm text-gray-400">
              <li><a href="#" className="hover:text-blue-400 transition-colors">Tentang kami</a></li>
              <li><a href="#" className="hover:text-blue-400 transition-colors">Blog MIA</a></li>
              <li><a href="#" className="hover:text-blue-400 transition-colors">Pusat bantuan</a></li>
              <li><a href="#" className="hover:text-blue-400 transition-colors">Syarat dan ketentuan</a></li>
              <li><a href="#" className="hover:text-blue-400 transition-colors">Kebijakan privasi</a></li>
            </ul>
          </div>
        </div>

        <div className="pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-500">
          <p>© 2026 MIA adalah merek milik PT Migran Indonesia Intelligence.</p>
          <p>Terdaftar pada Direktorat Jendral Kekayaan Intelektual Republik Indonesia.</p>
        </div>
      </div>
    </footer>
  );
}
