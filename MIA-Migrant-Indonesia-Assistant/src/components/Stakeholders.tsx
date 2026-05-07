export default function Stakeholders() {
  const partners = [
    "Kementerian Ketenagakerjaan Republik Indonesia",
    "Kementerian Luar Negeri Republik Indonesia",
    "Kementerian Pelindungan Pekerja Migran (KP2MI)",
    "Asosiasi Perusahaan Jasa Tenaga Kerja Indonesia (APJATI)",
    "Asosiasi Perusahaan Penempatan Pekerja Indonesia (ASPATAKI)",
    "International Organization for Migration (IOM)"
  ];

  return (
    <section className="py-24 bg-white border-b border-gray-100">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center max-w-3xl mx-auto mb-16">
          <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
            Kolaborasi dengan pemangku kepentingan
          </h2>
          <p className="text-lg text-gray-600">
            MIA bekerja sama dengan berbagai pihak untuk menciptakan ekosistem yang komprehensif bagi pekerja migran Indonesia.
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {partners.map((partner, idx) => (
            <div key={idx} className="flex items-center justify-center p-8 bg-gray-50 rounded-2xl border border-gray-100 text-center hover:bg-white hover:shadow-md transition-all cursor-default">
              <span className="font-semibold text-gray-700">{partner}</span>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
