import { MapPin, GraduationCap, Wallet } from 'lucide-react';

export default function Jobs() {
  const jobs = [
    { title: "Caregiver", company: "Sakura Elder Care", country: "Jepang", flag: "🇯🇵", edu: "Minimal SMA", salary: "¥180.000 - ¥250.000 / bulan" },
    { title: "Factory Operator", company: "Mega Manufacturing", country: "Korea Selatan", flag: "🇰🇷", edu: "Minimal SMA", salary: "₩2.100.000 - ₩2.800.000 / bulan" },
    { title: "Housekeeper", company: "Luxury Home Service", country: "Singapura", flag: "🇸🇬", edu: "Minimal SMA", salary: "SGD 1.600 - 2.200 / bulan" },
    { title: "Warehouse Staff", company: "Asia Logistic Corp", country: "Taiwan", flag: "🇹🇼", edu: "Minimal SMA", salary: "NT$28.000 - NT$38.000 / bulan" },
    { title: "Baby Sitter", company: "Happy Child Agency", country: "Hong Kong", flag: "🇭🇰", edu: "Minimal SMA", salary: "HKD 9.000 - 12.000 / bulan" },
    { title: "Restaurant Kitchen Staff", company: "Osaka Food Group", country: "Jepang", flag: "🇯🇵", edu: "Minimal SMP", salary: "¥160.000 - ¥220.000 / bulan" },
  ];

  return (
    <section className="py-24 bg-gray-50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
          <div className="max-w-2xl">
            <h2 className="text-sm font-bold tracking-widest text-blue-600 uppercase mb-3">Terdapat lebih dari 500+ lowongan</h2>
            <h3 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
              Temukan pekerjaan, siapkan dirimu bersama MIA
            </h3>
            <p className="text-lg text-gray-600">
              Berbagai peluang kerja luar negeri yang aman dan terpercaya bisa kamu temukan di MIA, dengan proses yang mudah dan transparan.
            </p>
          </div>
          <button className="bg-white text-gray-900 px-6 py-3 rounded-full text-sm font-semibold border border-gray-200 hover:border-gray-300 hover:bg-gray-50 transition-all whitespace-nowrap">
            Lihat Semua Lowongan
          </button>
        </div>

        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          {jobs.map((job, idx) => (
            <div key={idx} className="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all flex flex-col h-full">
              <div className="mb-4">
                <h4 className="text-xl font-bold text-gray-900 mb-1">{job.title}</h4>
                <p className="text-gray-500 text-sm">{job.company}</p>
              </div>
              
              <div className="space-y-3 mb-8 flex-grow">
                <div className="flex items-center gap-3 text-sm text-gray-600">
                  <MapPin size={16} className="text-gray-400" />
                  <span>{job.flag} {job.country}</span>
                </div>
                <div className="flex items-center gap-3 text-sm text-gray-600">
                  <GraduationCap size={16} className="text-gray-400" />
                  <span>{job.edu}</span>
                </div>
                <div className="flex items-center gap-3 text-sm text-gray-600">
                  <Wallet size={16} className="text-gray-400" />
                  <span className="font-medium text-gray-900">{job.salary}</span>
                </div>
              </div>

              <button className="w-full bg-blue-50 text-blue-600 py-3 rounded-xl font-semibold hover:bg-blue-600 hover:text-white transition-colors">
                Lamar sekarang
              </button>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
