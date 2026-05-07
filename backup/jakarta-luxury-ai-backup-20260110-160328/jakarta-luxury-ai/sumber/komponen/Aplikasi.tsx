import React, { useState, useEffect } from 'react';
import { User, AppRoute } from '../tipe/tipe';
import Navigasi from './Navigasi';
import Beranda from './Beranda';
import Masuk from './Autentikasi/Masuk';
import Daftar from './Autentikasi/Daftar';
import Wisata from './Wisata/Wisata';
import MenuKuliner from './Kuliner/MenuKuliner';
import FormulirReservasi from './Reservasi/FormulirReservasi';
import AdminDashboard from './Admin/AdminDashboard';
import AiDesigner from './AI/AiDesigner';
import KakiHalaman from './KakiHalaman';

const Aplikasi: React.FC = () => {
  const [currentUser, setCurrentUser] = useState<User | null>(null);
  const [currentRoute, setCurrentRoute] = useState<AppRoute>(AppRoute.HOME);

  useEffect(() => {
    const savedUser = localStorage.getItem('luxury_user');
    if (savedUser) {
      setCurrentUser(JSON.parse(savedUser));
    }

    const handleHashChange = () => {
      const hash = window.location.hash.replace('#', '') as AppRoute;
      if (Object.values(AppRoute).includes(hash)) {
        setCurrentRoute(hash);
      } else {
        setCurrentRoute(AppRoute.HOME);
      }
    };

    window.addEventListener('hashchange', handleHashChange);
    handleHashChange();

    return () => window.removeEventListener('hashchange', handleHashChange);
  }, []);

  const handleLogin = (user: User) => {
    setCurrentUser(user);
    localStorage.setItem('luxury_user', JSON.stringify(user));
    window.location.hash = AppRoute.HOME;
  };

  const handleLogout = () => {
    setCurrentUser(null);
    localStorage.removeItem('luxury_user');
    window.location.hash = AppRoute.HOME;
  };

  const renderContent = () => {
    switch (currentRoute) {
      case AppRoute.LOGIN:
        return <Masuk onLogin={handleLogin} />;
      case AppRoute.REGISTER:
        return <Daftar onLogin={handleLogin} />;
      case AppRoute.TRAVEL:
        return <Wisata />;
      case AppRoute.CULINARY:
        return <MenuKuliner />;
      case AppRoute.RESERVATION:
        return <FormulirReservasi user={currentUser} />;
      case AppRoute.ADMIN:
        return currentUser?.role === 'admin' ? <AdminDashboard /> : <div className="p-20 text-center">Akses Ditolak</div>;
      case AppRoute.AI_DESIGNER:
        return <AiDesigner />;
      case AppRoute.HOME:
      default:
        return <Beranda />;
    }
  };

  return (
    <div className="min-h-screen flex flex-col font-sans text-luxury-text bg-luxury-dark selection:bg-luxury-gold selection:text-white">
      <Navigasi user={currentUser} onLogout={handleLogout} />
      <main className="flex-grow pt-20">
        {renderContent()}
      </main>
      <KakiHalaman />
    </div>
  );
};

export default Aplikasi;




