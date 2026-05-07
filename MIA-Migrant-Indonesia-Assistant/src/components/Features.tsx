import { CheckCircle, ShieldCheck, FileSearch, Lock } from 'lucide-react';

export default function Features() {
  const reasons = [
    { title: "Resmi dan terpercaya.", desc: "Bekerja sama dengan lembaga pemerintah dan mitra resmi untuk menjamin keamanan proses." },
    { title: "Transparansi & terarah.", desc: "Semua informasi dan panduan tersedia dalam satu platform secara transparan dan terarah." },
    { title: "Pendampingan nyata.", desc: "Asisten digital MIA siap bantu setiap langkah hingga benar-benar siap berangkat." },
    { title: "Aman & terlindungi.", desc: "Data terlindungi, proses legal dijamin, dan perjalanan kerja di luar negeri jadi lebih pasti." }
  ];

  const security = [
    { icon: Lock, title: "Proteksi data pribadi.", desc: "Informasi PMI & mitra dilindungi dengan enkripsi end-to-end, kontrol akses, dan sistem pencegahan kebocoran data." },
    { icon: FileSearch, title: "Audit dan jejak proses.", desc: "Setiap aktivitas & tindakan, dari unggah dokumen hingga persetujuan, tercatat oleh sistem dan dapat diaudit." },
    { icon: ShieldCheck, title: "Kepatuhan regulasi.", desc: "Seluruh proses di MIA mengikuti standar penempatan, perlindungan PMI, dan kebijakan pemerintah yang berlaku." }
  ];

  return (
    <section className="py-24 bg-gray-900 text-white">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {/* Mengapa Memilih MIA */}
        <div className="mb-32">
          <div className="text-center max-w-3xl mx-auto mb-16">
            <h2 className="text-3xl md:text-4xl font-bold mb-6">Mengapa memilih MIA?</h2>
            <p className="text-xl text-gray-400">
              MIA menyederhanakan seluruh proses pekerja migran & terintegrasi dengan berbagai lembaga resmi.
            </p>
          </div>

          <div className="grid md:grid-cols-2 gap-8">
            {reasons.map((reason, idx) => (
              <div key={idx} className="flex gap-4 p-6 rounded-2xl bg-gray-800/50 border border-gray-700">
                <CheckCircle className="text-blue-500 flex-shrink-0" size={24} />
                <div>
                  <h3 className="text-lg font-bold mb-2">{reason.title}</h3>
                  <p className="text-gray-400 leading-relaxed">{reason.desc}</p>
                </div>
              </div>
            ))}
          </div>
        </div>

        {/* Keamanan dan Kepatuhan */}
        <div>
          <div className="grid lg:grid-cols-2 gap-16 items-center">
            <div>
              <h2 className="text-3xl md:text-4xl font-bold mb-6">Keamanan dan kepatuhan</h2>
              <p className="text-xl text-gray-400 mb-12">
                MIA dirancang untuk memastikan seluruh proses penempatan PMI berjalan aman, terkontrol, dan sesuai regulasi resmi melalui sistem keamanan dan kepatuhan terintegrasi.
              </p>

              <div className="space-y-8">
                {security.map((item, idx) => (
                  <div key={idx} className="flex gap-4">
                    <div className="w-12 h-12 rounded-full bg-blue-900/50 flex items-center justify-center text-blue-400 flex-shrink-0">
                      <item.icon size={24} />
                    </div>
                    <div>
                      <h3 className="text-lg font-bold mb-2">{item.title}</h3>
                      <p className="text-gray-400 leading-relaxed">{item.desc}</p>
                    </div>
                  </div>
                ))}
              </div>
            </div>

            <div className="bg-gray-800 rounded-3xl p-8 border border-gray-700 relative overflow-hidden">
              <div className="absolute top-0 right-0 w-64 h-64 bg-blue-600/20 rounded-full blur-3xl"></div>
              <ShieldCheck size={48} className="text-blue-500 mb-6" />
              <h3 className="text-2xl font-bold mb-4">Catatan kepatuhan.</h3>
              <p className="text-gray-400 leading-relaxed">
                MIA bukan lembaga rekrutmen atau penempatan tenaga kerja. MIA merupakan mitra teknologi yang membantu ekosistem LPK, P3MI, employer, regulator, serta institusi keuangan agar prosesnya makin tertib, transparan, dan terstandardisasi.
              </p>
            </div>
          </div>
        </div>

      </div>
    </section>
  );
}
