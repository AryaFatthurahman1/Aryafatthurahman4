export default function HowItWorks() {
  const steps = [
    {
      num: "01",
      title: "Buat akun dan personalisasi awal.",
      desc: "Profil calon pekerja migran akan dianalisis untuk melihat minat terhadap negara dan jenis pekerjaan tujuan."
    },
    {
      num: "02",
      title: "Cek kesiapan kerja sesuai tujuan.",
      desc: "Skoring terhadap dokumen dan kemampuan yang dimiliki untuk mengetahui kesiapan kerja & rekomendasi pelatihan yang sesuai."
    },
    {
      num: "03",
      title: "Tingkatkan pengetahuan dengan AI asisten.",
      desc: "Belajar bersama asisten MIA yang siap menjelaskan proses migran, aturan negara tujuan, dan tips penting seputar proses migran."
    },
    {
      num: "04",
      title: "Tingkatkan skill dan dapatkan sertifikasi.",
      desc: "Akses latihan interview dan berbagai pelatihan bersertifikasi yang relevan agar kamu lebih siap dan memenuhi standar kerja luar negeri."
    },
    {
      num: "05",
      title: "Lamar pekerjaan melalui job matching.",
      desc: "Temukan lowongan yang sesuai dengan profil, kemampuan, dan minatmu. Semua direkomendasikan secara otomatis oleh MIA."
    }
  ];

  return (
    <section className="py-24 bg-white">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid lg:grid-cols-2 gap-16 items-start">
          <div className="sticky top-32">
            <h2 className="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-6">
              Bagaimana <br/>
              <span className="text-blue-600">MIA Dapat Membantu</span> <br/>
              Calon Pekerja Migran?
            </h2>
            <p className="text-lg text-gray-600 mb-8">
              Langkah demi langkah perjalananmu menuju karir global yang sukses dan aman bersama MIA.
            </p>
            <div className="relative mx-auto max-w-[280px] lg:mx-0">
              {/* Phone Mockup Placeholder */}
              <div className="aspect-[9/19] bg-gray-900 rounded-[2.5rem] border-[8px] border-gray-900 shadow-2xl overflow-hidden relative">
                <img 
                  src="https://picsum.photos/seed/app/400/800" 
                  alt="App Interface" 
                  className="w-full h-full object-cover opacity-80"
                  referrerPolicy="no-referrer"
                />
              </div>
            </div>
          </div>

          <div className="space-y-12 lg:pt-12">
            {steps.map((step, index) => (
              <div key={index} className="flex gap-6 group">
                <div className="flex-shrink-0">
                  <div className="font-serif text-5xl font-bold text-gray-200 group-hover:text-blue-600 transition-colors">
                    {step.num}
                  </div>
                </div>
                <div>
                  <h3 className="text-xl font-bold text-gray-900 mb-2">{step.title}</h3>
                  <p className="text-gray-600 leading-relaxed">{step.desc}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </section>
  );
}
