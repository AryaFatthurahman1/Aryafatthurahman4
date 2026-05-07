import { Users, Building2, GraduationCap, Briefcase, Landmark, Shield } from 'lucide-react';

const roles = [
  { icon: Users, title: 'CPMI/PMI', desc: 'Calon Pekerja Migran Indonesia' },
  { icon: Building2, title: 'P3MI', desc: 'Perusahaan Penempatan' },
  { icon: GraduationCap, title: 'LPK', desc: 'Lembaga Pelatihan Kerja' },
  { icon: Briefcase, title: 'Perusahaan', desc: 'Pemberi Kerja Luar Negeri' },
  { icon: Landmark, title: 'Institusi Keuangan', desc: 'Dukungan Finansial' },
  { icon: Shield, title: 'Regulator', desc: 'Pemerintah & Pengawas' },
];

export default function Ecosystem() {
  return (
    <section className="py-24 bg-gray-50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center max-w-3xl mx-auto mb-16">
          <h2 className="text-sm font-bold tracking-widest text-blue-600 uppercase mb-3">MIA untuk seluruh ekosistem</h2>
          <h3 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
            Menghubungkan seluruh peran dalam ekosistem pekerja migran Indonesia
          </h3>
          <p className="text-lg text-gray-600">
            Hadir dan berperan dalam mendampingi pekerja migran Indonesia dari pra-keberangkatan hingga kepulangan dengan sistem yang terintegrasi.
          </p>
        </div>

        <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
          {roles.map((role, index) => (
            <div key={index} className="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow text-center group cursor-pointer">
              <div className="w-12 h-12 mx-auto bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                <role.icon size={24} />
              </div>
              <h4 className="font-semibold text-gray-900 mb-1">{role.title}</h4>
              <p className="text-xs text-gray-500">{role.desc}</p>
            </div>
          ))}
        </div>

        <div className="mt-16 bg-white rounded-3xl p-8 md:p-12 shadow-sm border border-gray-100 flex flex-col md:flex-row items-center gap-8">
          <div className="flex-1">
            <h4 className="text-2xl font-bold text-gray-900 mb-4">Perusahaan penempatan pekerja migran Indonesia.</h4>
            <p className="text-gray-600 leading-relaxed">
              MIA menyediakan screening awal berbasis WRS & AI yang siap dipakai. Dokumen kandidat tersusun lengkap dan tervalidasi sehingga mempercepat proses matching. Alur kepatuhan lebih rapi dengan notifikasi status dan audit yang otomatis.
            </p>
          </div>
          <div className="w-full md:w-1/3">
            <img 
              src="https://picsum.photos/seed/dashboard/600/400" 
              alt="Dashboard Preview" 
              className="rounded-xl shadow-lg border border-gray-100"
              referrerPolicy="no-referrer"
            />
          </div>
        </div>
      </div>
    </section>
  );
}
