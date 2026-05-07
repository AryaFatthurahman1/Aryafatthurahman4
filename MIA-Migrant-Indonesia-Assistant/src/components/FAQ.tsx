import { ChevronDown } from 'lucide-react';
import { useState } from 'react';

export default function FAQ() {
  const faqs = [
    {
      q: "MIA itu apa?",
      a: "MIA (Migran Indonesia Assistant) adalah aplikasi resmi buat bantu kamu cari kerja di luar negeri yang legal dan aman. Di dalamnya ada info lowongan, perusahaan, dan panduan proses migrasi."
    },
    {
      q: "MIA gratis, kan?",
      a: "Iya, MIA gratis untuk diunduh dan dipakai. Kamu bisa akses semua fitur tanpa biaya, termasuk cari lowongan, Tanya MIA AI, dan panduan dokumen."
    },
    {
      q: "Lowongan di MIA aman?",
      a: "Lowongan dan perusahaan lewat verifikasi. Kami kolaborasi dengan Kementerian Pelindungan Pekerja Migran (KP2MI), Kementerian Ketenagakerjaan, KBRI, dan pihak terkait untuk memastikan legalitasnya."
    },
    {
      q: "Prosesnya berapa lama?",
      a: "Rata-rata 2–6 bulan, tergantung negara tujuan dan kelengkapan dokumen. Di MIA kamu bisa lihat tahapan dan perkiraan timeline-nya."
    },
    {
      q: "Bisa tanya kalau ada masalah?",
      a: "Bisa. Fitur Tanya MIA siap bantu 24/7. Kalau butuh pendampingan lanjutan, kamu bisa hubungi instansi terkait lewat info kontak di aplikasi."
    }
  ];

  const [openIdx, setOpenIdx] = useState<number | null>(0);

  return (
    <section className="py-24 bg-gray-50">
      <div className="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-16">
          <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
            Frequently Asked Questions
          </h2>
          <p className="text-lg text-gray-600">
            Jawaban cepat untuk pertanyaan yang sering kamu tanyakan
          </p>
        </div>

        <div className="space-y-4">
          {faqs.map((faq, idx) => (
            <div 
              key={idx} 
              className="bg-white border border-gray-200 rounded-2xl overflow-hidden transition-all duration-200"
            >
              <button 
                className="w-full px-6 py-5 text-left flex justify-between items-center focus:outline-none"
                onClick={() => setOpenIdx(openIdx === idx ? null : idx)}
              >
                <span className="font-semibold text-gray-900 pr-8">{faq.q}</span>
                <ChevronDown 
                  className={`text-gray-400 transition-transform duration-200 flex-shrink-0 ${openIdx === idx ? 'rotate-180' : ''}`} 
                  size={20} 
                />
              </button>
              
              <div 
                className={`px-6 overflow-hidden transition-all duration-300 ease-in-out ${
                  openIdx === idx ? 'max-h-48 pb-5 opacity-100' : 'max-h-0 opacity-0'
                }`}
              >
                <p className="text-gray-600 leading-relaxed">{faq.a}</p>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
