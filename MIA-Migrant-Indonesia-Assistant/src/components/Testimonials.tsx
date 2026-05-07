import { Star } from 'lucide-react';

export default function Testimonials() {
  const testimonials = [
    { name: "Siti Nurhaliza", initial: "S", quote: "MIA membantu saya mempersiapkan dokumen dengan mudah dan transparan. Proses seleksi kerja menjadi lebih terstruktur dan jelas." },
    { name: "Ahmad Wijaya", initial: "A", quote: "Dengan MIA, kami bisa mengakses calon pekerja terverifikasi dengan mudah. Sistem matching-nya sangat efisien dan terpercaya." },
    { name: "Budi Santoso", initial: "B", quote: "Platform ini memberikan transparansi penuh dalam proses penempatan. Dukungan tim MIA sangat responsif dan membantu." },
    { name: "Rini Lestari", initial: "R", quote: "Sebagai lembaga pelatihan, MIA membantu kami terhubung langsung dengan peluang kerja global. Ini game changer bagi CPMI kami." },
    { name: "Hendra Gunawan", initial: "H", quote: "Fitur verifikasi dokumen otomatis menghemat waktu kami hingga 70%. Teknologi AI-nya benar-benar membantu efisiensi operasional." },
    { name: "Dewi Laksmi", initial: "D", quote: "Saya sangat terkesan dengan user experience MIA. Aplikasi ini membuat proses persiapan kerja luar negeri jadi lebih mudah dan tidak menakutkan." },
  ];

  return (
    <section className="py-24 bg-white overflow-hidden">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 text-center">
        <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
          Dipercaya Pekerja dan Lembaga
        </h2>
        <p className="text-lg text-gray-600 max-w-2xl mx-auto">
          Jadilah bagian dari ekosistem yang mentransformasi 4,5jt pekerja Indonesia bersama Migran Indonesia Asisten.
        </p>
      </div>

      <div className="relative flex overflow-x-hidden">
        <div className="animate-marquee w-max flex gap-6 py-4 px-3">
          {[...testimonials, ...testimonials].map((t, idx) => (
            <div key={idx} className="w-80 flex-shrink-0 bg-gray-50 rounded-2xl p-6 border border-gray-100 whitespace-normal">
              <div className="flex text-yellow-400 mb-4">
                {[...Array(5)].map((_, i) => <Star key={i} size={16} fill="currentColor" />)}
              </div>
              <p className="text-gray-700 italic mb-6 leading-relaxed">"{t.quote}"</p>
              <div className="flex items-center gap-3">
                <div className="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">
                  {t.initial}
                </div>
                <span className="font-semibold text-gray-900">{t.name}</span>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
