import React, { useState, useEffect } from 'react';

interface DashboardStats {
  revenue: string;
  reservations: number;
  activeMembers: number;
  pendingOrders: number;
}

interface StatItem {
  label: string;
  value: string | number;
  icon: string;
  color: string;
  rawValue?: number;
}

interface Order {
  id: number;
  name: string;
  total_price: number;
  status: string;
  created_at: string;
  image_url: string;
  user_id: number;
}

const AdminDashboard: React.FC = () => {
  const [activeTab, setActiveTab] = useState<'overview' | 'sales' | 'reservations'>('overview');
  const [stats, setStats] = useState<DashboardStats>({
    revenue: "Rp 0",
    reservations: 0,
    activeMembers: 1420,
    pendingOrders: 0
  });
  const [recentOrders, setRecentOrders] = useState<Order[]>([]);

  // Fetch real data
  useEffect(() => {
    const fetchData = async () => {
      try {
        // Fetch all orders (mocking admin access by fetching user 1 for now, in real app would be different endpoint)
        const response = await fetch('/api/kuliner/orders.php?user_id=1');
        const data = await response.json();

        if (data.success && data.orders) {
          const orders: Order[] = data.orders;
          setRecentOrders(orders);

          // Calculate stats
          const totalRevenue = orders.reduce((sum, order) => sum + (order.status !== 'cancelled' ? Number(order.total_price) : 0), 0);
          const pending = orders.filter(o => o.status === 'pending').length;

          setStats(prev => ({
            ...prev,
            revenue: new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(totalRevenue),
            pendingOrders: pending,
            reservations: orders.length // Treating orders as reservations for this context
          }));
        }
      } catch (error) {
        console.error("Error fetching admin data", error);
      }
    };
    fetchData();
  }, []);

  const handleStatusUpdate = async (id: number, newStatus: string) => {
    // In a real app this would call an API
    // For now we just update local state to demonstrate UI
    setRecentOrders(prev => prev.map(o => o.id === id ? { ...o, status: newStatus } : o));
  };


  return (
    <div className="min-h-screen pt-24 px-6 pb-12 bg-black">
      <div className="max-w-7xl mx-auto">

        {/* Header */}
        <div className="flex justify-between items-center mb-10">
          <div>
            <h1 className="text-3xl md:text-4xl font-serif text-white mb-2">Executive <span className="text-luxury-gold">Dashboard</span></h1>
            <p className="text-gray-400">Welcome back, Admin.</p>
          </div>
          <div className="flex gap-4">
            <button onClick={() => setActiveTab('overview')} className={`px-4 py-2 text-xs uppercase tracking-widest rounded-sm transition-all ${activeTab === 'overview' ? 'bg-luxury-gold text-black font-bold' : 'border border-white/20 text-gray-400 hover:text-white'}`}>Overview</button>
            <button onClick={() => setActiveTab('sales')} className={`px-4 py-2 text-xs uppercase tracking-widest rounded-sm transition-all ${activeTab === 'sales' ? 'bg-luxury-gold text-black font-bold' : 'border border-white/20 text-gray-400 hover:text-white'}`}>Sales Management</button>
          </div>
        </div>

        {/* Stats Grid */}
        <div className="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
          {[
            { label: "Total Revenue", value: stats.revenue, icon: "💰", color: "text-green-500" },
            { label: "Total Orders", value: stats.reservations, icon: "📅", color: "text-blue-500" },
            { label: "Active Members", value: stats.activeMembers.toLocaleString(), icon: "💎", color: "text-purple-500" },
            { label: "Pending Actions", value: stats.pendingOrders, icon: "⚠️", color: "text-yellow-500", rawValue: stats.pendingOrders },
          ].map((stat: StatItem, idx) => (
            <div key={idx} className="bg-white/5 border border-white/10 p-6 rounded-xl backdrop-blur-sm">
              <div className="flex justify-between items-start mb-4">
                <div className={`p-3 rounded-lg bg-white/5 ${stat.color} text-2xl`}>{stat.icon}</div>
                {idx === 3 && stat.rawValue && stat.rawValue > 0 && <span className="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>}
              </div>
              <h3 className="text-2xl font-bold text-white mb-1">{stat.value}</h3>
              <p className="text-xs text-gray-400 uppercase tracking-widest">{stat.label}</p>
            </div>
          ))}
        </div>

        {/* Main Content */}
        {activeTab === 'overview' && (
          <div className="bg-white/5 border border-white/10 rounded-xl p-8">
            <h2 className="text-xl font-serif text-white mb-6">Recent Activity</h2>
            {recentOrders.length === 0 ? (
              <p className="text-gray-500 italic">No activity recorded.</p>
            ) : (
              <div className="space-y-4">
                {recentOrders.slice(0, 5).map(order => (
                  <div key={order.id} className="flex items-center justify-between p-4 border-b border-white/5 last:border-0 hover:bg-white/5 transition-colors rounded-lg">
                    <div className="flex items-center gap-4">
                      <img src={order.image_url} className="w-12 h-12 rounded object-cover" alt="Order" />
                      <div>
                        <p className="text-white font-bold">{order.name}</p>
                        <p className="text-xs text-gray-500">{order.created_at}</p>
                      </div>
                    </div>
                    <span className={`px-3 py-1 rounded-full text-[10px] uppercase font-bold ${order.status === 'pending' ? 'bg-yellow-900/40 text-yellow-500' :
                      order.status === 'confirmed' ? 'bg-green-900/40 text-green-500' :
                        'bg-red-900/40 text-red-500'
                      }`}>{order.status}</span>
                  </div>
                ))}
              </div>
            )}
          </div>
        )}

        {activeTab === 'sales' && (
          <div className="bg-white/5 border border-white/10 rounded-xl p-8">
            <h2 className="text-xl font-serif text-white mb-6">Sales Management</h2>
            <div className="overflow-x-auto">
              <table className="w-full text-left">
                <thead className="bg-black/40 text-gray-400 text-xs uppercase tracking-widest">
                  <tr>
                    <th className="p-4 rounded-tl-lg">Item</th>
                    <th className="p-4">Price</th>
                    <th className="p-4">Status</th>
                    <th className="p-4">Date</th>
                    <th className="p-4 rounded-tr-lg text-right">Actions</th>
                  </tr>
                </thead>
                <tbody className="text-sm">
                  {recentOrders.map((order) => (
                    <tr key={order.id} className="border-b border-white/5 hover:bg-white/5 transition-colors">
                      <td className="p-4">
                        <div className="flex items-center gap-4">
                          <img src={order.image_url} className="w-16 h-16 rounded-lg object-cover" alt={order.name} />
                          <span className="font-bold text-white">{order.name}</span>
                        </div>
                      </td>
                      <td className="p-4 text-luxury-gold font-mono">{new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(order.total_price)}</td>
                      <td className="p-4">
                        <span className={`px-3 py-1 rounded-full text-[10px] uppercase font-bold ${order.status === 'pending' ? 'bg-yellow-900/40 text-yellow-500' :
                          order.status === 'confirmed' ? 'bg-green-900/40 text-green-500' :
                            'bg-red-900/40 text-red-500'
                          }`}>{order.status}</span>
                      </td>
                      <td className="p-4 text-gray-400">{order.created_at}</td>
                      <td className="p-4 text-right space-x-2">
                        {order.status === 'pending' && (
                          <>
                            <button onClick={() => handleStatusUpdate(order.id, 'confirmed')} className="p-2 bg-green-900/30 text-green-500 rounded hover:bg-green-900/50 transition-colors" title="Approve">✓</button>
                            <button onClick={() => handleStatusUpdate(order.id, 'cancelled')} className="p-2 bg-red-900/30 text-red-500 rounded hover:bg-red-900/50 transition-colors" title="Reject">✕</button>
                          </>
                        )}
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>
        )}

      </div>
    </div>
  );
};

export default AdminDashboard;




