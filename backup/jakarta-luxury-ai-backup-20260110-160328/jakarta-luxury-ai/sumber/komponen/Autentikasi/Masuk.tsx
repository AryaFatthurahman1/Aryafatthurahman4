
import React, { useState } from 'react';
import { User, AppRoute } from '../../tipe/tipe';
import { layananApi } from '../../layanan/layananApi';

interface LoginProps {
  onLogin: (user: User) => void;
}

const Login: React.FC<LoginProps> = ({ onLogin }) => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');

  const [loading, setLoading] = useState(false);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setError('');
    setLoading(true);

    try {
      const result = await layananApi.login(email, password);

      if (result.user) {
        onLogin(result.user);
      } else {
        setError(result.message || 'Login gagal. Silakan coba lagi.');
      }
    } catch {
      setError('Terjadi kesalahan. Silakan coba lagi.');
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="min-h-[80vh] flex items-center justify-center px-6">
      <div className="w-full max-w-md bg-luxury-card p-10 border border-luxury-gold/20 rounded-lg shadow-2xl">
        <h2 className="text-3xl font-serif text-center mb-8">Masuk ke <span className="text-luxury-gold">Akun</span></h2>

        {error && <div className="mb-4 p-3 bg-red-900/20 border border-red-500 text-red-400 text-xs rounded">{error}</div>}

        <form onSubmit={handleSubmit} className="space-y-6">
          <div>
            <label className="block text-xs uppercase tracking-widest text-gray-500 mb-2">Alamat Email</label>
            <input
              type="email"
              required
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              className="w-full bg-black border border-white/10 p-3 text-sm focus:border-luxury-gold outline-none transition-all"
              placeholder="nama@email.com"
            />
          </div>
          <div>
            <label className="block text-xs uppercase tracking-widest text-gray-500 mb-2">Password</label>
            <input
              type="password"
              required
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              className="w-full bg-black border border-white/10 p-3 text-sm focus:border-luxury-gold outline-none transition-all"
              placeholder="••••••••"
            />
          </div>
          <button
            type="submit"
            disabled={loading}
            className="w-full py-4 bg-luxury-gold text-black font-bold tracking-widest hover:bg-yellow-600 transition-all rounded-sm uppercase text-xs disabled:opacity-50 disabled:cursor-not-allowed"
          >
            {loading ? 'Memproses...' : 'Masuk Sekarang'}
          </button>
        </form>

        <p className="mt-8 text-center text-xs text-gray-500">
          Belum punya akun? <a href={`#${AppRoute.REGISTER}`} className="text-luxury-gold hover:underline">Daftar disini</a>
        </p>

        <div className="mt-6 pt-6 border-t border-white/10">
          <p className="text-[10px] text-gray-600 text-center uppercase tracking-widest">Login Admin Demo: admin@luxury.com / admin123</p>
        </div>
      </div>
    </div>
  );
};

export default Login;




