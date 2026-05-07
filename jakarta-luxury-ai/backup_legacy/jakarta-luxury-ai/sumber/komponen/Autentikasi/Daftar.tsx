
import React, { useState } from 'react';
import { User, AppRoute } from '../../tipe/tipe';
import { layananApi } from '../../layanan/layananApi';

interface RegisterProps {
  onLogin: (user: User) => void;
}

const Register: React.FC<RegisterProps> = ({ onLogin }) => {
  const [formData, setFormData] = useState({
    username: '',
    full_name: '',
    email: '',
    phone: '',
    password: '',
    confirmPassword: ''
  });
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setError('');
    setLoading(true);

    if (formData.password !== formData.confirmPassword) {
      setError('Password tidak cocok.');
      setLoading(false);
      return;
    }

    try {
      const result = await layananApi.register({
        username: formData.username,
        full_name: formData.full_name,
        email: formData.email,
        phone: formData.phone,
        password: formData.password
      });

      if (result.user) {
        onLogin(result.user);
      } else {
        setError(result.message || 'Registrasi gagal. Silakan coba lagi.');
      }
    } catch {
      setError('Terjadi kesalahan. Silakan coba lagi.');
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="min-h-[90vh] flex items-center justify-center px-6 py-12">
      <div className="w-full max-w-lg bg-luxury-card p-10 border border-luxury-gold/20 rounded-lg shadow-2xl">
        <h2 className="text-3xl font-serif text-center mb-8">Daftar Akun <span className="text-luxury-gold">Baru</span></h2>

        {error && <div className="mb-4 p-3 bg-red-900/20 border border-red-500 text-red-400 text-xs rounded">{error}</div>}

        <form onSubmit={handleSubmit} className="space-y-4">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label className="block text-xs uppercase tracking-widest text-gray-500 mb-2">Username</label>
              <input
                type="text"
                required
                value={formData.username}
                onChange={(e) => setFormData({ ...formData, username: e.target.value })}
                className="w-full bg-black border border-white/10 p-3 text-sm focus:border-luxury-gold outline-none transition-all"
                placeholder="kayla_ari"
              />
            </div>
            <div>
              <label className="block text-xs uppercase tracking-widest text-gray-500 mb-2">Nama Lengkap</label>
              <input
                type="text"
                required
                value={formData.full_name}
                onChange={(e) => setFormData({ ...formData, full_name: e.target.value })}
                className="w-full bg-black border border-white/10 p-3 text-sm focus:border-luxury-gold outline-none transition-all"
                placeholder="Kayla Ariellia"
              />
            </div>
            <div>
              <label className="block text-xs uppercase tracking-widest text-gray-500 mb-2">Nomor Telepon</label>
              <input
                type="tel"
                required
                value={formData.phone}
                onChange={(e) => setFormData({ ...formData, phone: e.target.value })}
                className="w-full bg-black border border-white/10 p-3 text-sm focus:border-luxury-gold outline-none transition-all"
                placeholder="0812..."
              />
            </div>
          </div>
          <div>
            <label className="block text-xs uppercase tracking-widest text-gray-500 mb-2">Alamat Email</label>
            <input
              type="email"
              required
              value={formData.email}
              onChange={(e) => setFormData({ ...formData, email: e.target.value })}
              className="w-full bg-black border border-white/10 p-3 text-sm focus:border-luxury-gold outline-none transition-all"
              placeholder="nama@email.com"
            />
          </div>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label className="block text-xs uppercase tracking-widest text-gray-500 mb-2">Password</label>
              <input
                type="password"
                required
                value={formData.password}
                onChange={(e) => setFormData({ ...formData, password: e.target.value })}
                className="w-full bg-black border border-white/10 p-3 text-sm focus:border-luxury-gold outline-none transition-all"
                placeholder="••••••••"
              />
            </div>
            <div>
              <label className="block text-xs uppercase tracking-widest text-gray-500 mb-2">Ulangi Password</label>
              <input
                type="password"
                required
                value={formData.confirmPassword}
                onChange={(e) => setFormData({ ...formData, confirmPassword: e.target.value })}
                className="w-full bg-black border border-white/10 p-3 text-sm focus:border-luxury-gold outline-none transition-all"
                placeholder="••••••••"
              />
            </div>
          </div>
          <button
            type="submit"
            disabled={loading}
            className="w-full py-4 bg-luxury-gold text-black font-bold tracking-widest hover:bg-yellow-600 transition-all rounded-sm uppercase text-xs mt-4 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            {loading ? 'Mendaftar...' : 'Daftar Sekarang'}
          </button>
        </form>

        <p className="mt-8 text-center text-xs text-gray-500">
          Sudah memiliki akun? <a href={`#${AppRoute.LOGIN}`} className="text-luxury-gold hover:underline">Masuk disini</a>
        </p>
      </div>
    </div>
  );
};

export default Register;




