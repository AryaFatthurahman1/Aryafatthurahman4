
import React, { useState, useEffect } from 'react';
import { layananApi } from '../../layanan/layananApi';

interface CulinaryItem {
  id: number;
  name: string;
  description: string;
  category: string;
  price: number;
  restaurant_name: string;
  location: string;
  image_url: string;
  rating: number;
  featured: boolean;
}

interface Order {
  id: number;
  name: string;
  total_price: number;
  quantity: number;
  status: string;
  created_at: string;
  image_url: string;
  item_id: number;
}

const FoodMenu: React.FC = () => {
  const [items, setItems] = useState<CulinaryItem[]>([]);
  const [orders, setOrders] = useState<Order[]>([]);
  const [showOrders, setShowOrders] = useState(false);
  const [loading, setLoading] = useState(true);
  const [selectedOrders, setSelectedOrders] = useState<number[]>([]);

  // Modal States
  const [selectedItem, setSelectedItem] = useState<CulinaryItem | null>(null);
  const [isPaymentOpen, setIsPaymentOpen] = useState(false);
  const [paymentStep, setPaymentStep] = useState<'method' | 'processing' | 'success'>('method');

  // Fetch items from the PHP backend API
  const fetchItems = async () => {
    try {
      const result = await layananApi.getCulinaryItems();
      if (result.records) setItems(result.records);
    } catch (error) {
      console.error("Error fetching items", error);
    } finally {
      setLoading(false);
    }
  };

  // Fetch orders - Only pending orders for cart
  const fetchOrders = async () => {
    try {
      const result = await layananApi.getOrders(1);
      if (result.success) {
        // Only show pending orders in the cart
        // Confirmed orders will be hidden (already processed)
        const pendingOrders = result.orders.filter((o: Order) => o.status === 'pending');
        setOrders(pendingOrders);
        // Reset selected orders when fetching
        setSelectedOrders([]);
      }
    } catch (error) {
      console.error("Error fetching orders", error);
    }
  };

  // Place a new order
  const handleOrder = async (item: CulinaryItem) => {
    // if (!confirm(`Pesan ${item.name}?`)) return; // Removed confirmation for smoother UX
    try {
      const result = await layananApi.placeOrder({
        user_id: 1, // Mock user
        item_id: item.id,
        quantity: 1,
        total_price: item.price
      });
      if (result.success) {
        // alert('Pesanan berhasil dibuat! Cek "Pesanan Saya".');
        fetchOrders();
        setShowOrders(true);
        if (selectedItem) setSelectedItem(null); // Close modal if open
      } else {
        alert('Gagal membuat pesanan.');
      }
    } catch (error) {
      console.error("Error ordering", error);
    }
  };

  // Cancel/Delete an existing order
  const handleCancelOrder = async (orderId: number) => {
    try {
      const result = await layananApi.cancelOrder(orderId);
      if (result.success) {
        // Remove from selected orders if it was selected
        setSelectedOrders(prev => prev.filter(id => id !== orderId));
        fetchOrders(); // Refresh list - cancelled items will be filtered out
      }
    } catch (error) {
      console.error("Error cancelling", error);
    }
  };

  // Generate appropriate food image based on name and description
  const getFoodImage = (itemName: string, description: string, currentImage: string) => {
    // If current image is not the default fallback, return it
    if (!currentImage.includes('ba9599a7e63c') && currentImage.startsWith('/assets/')) {
      return currentImage;
    }

    const name = itemName.toLowerCase();
    const desc = description.toLowerCase();
    
    // Food-specific image mappings - using local assets
    if (name.includes('wagyu') || desc.includes('beef')) {
      return '/assets/culinary/wagyu_ph.jpg';
    }
    if (name.includes('rijsttafel') || desc.includes('rice table')) {
      return '/assets/culinary/rijsttafel.jpg';
    }
    if (name.includes('rendang')) {
      return '/assets/culinary/rendang.jpg';
    }
    if (name.includes('truffle') || name.includes('nasi goreng')) {
      return '/assets/culinary/nasi_goreng_ph.jpg';
    }
    if (name.includes('satay') || name.includes('sate')) {
      if (name.includes('ayam')) {
        return '/assets/culinary/sate_ayam_ph.jpg';
      }
      return '/assets/culinary/sate_ayam_ph.jpg';
    }
    if (name.includes('ikan bakar')) {
      return '/assets/culinary/ikan_bakar_ph.jpg';
    }
    if (name.includes('lobster') || name.includes('laksa')) {
      return '/assets/culinary/lobster_laksa.jpg';
    }
    if (name.includes('ayam goreng')) {
      return '/assets/culinary/nasi_goreng_ph.jpg'; // placeholder
    }
    if (name.includes('soto')) {
      return '/assets/culinary/soto_betawi.jpg';
    }
    if (name.includes('pempek')) {
      return '/assets/culinary/pempek_ph.jpg';
    }
    if (name.includes('cendol') || name.includes('es cendol')) {
      return '/assets/culinary/es_cendol.jpg';
    }
    if (name.includes('es teler')) {
      return '/assets/culinary/es_teler_ph.jpg';
    }
    if (name.includes('bakso')) {
      return '/assets/culinary/soto_betawi.jpg'; // placeholder
    }
    if (name.includes('nasi uduk')) {
      return '/assets/culinary/nasi_uduk.jpg';
    }
    if (name.includes('kerak telor')) {
      return '/assets/culinary/rendang.jpg'; // placeholder
    }
    if (name.includes('martabak')) {
      return '/assets/culinary/martabak_ph.jpg';
    }
    if (name.includes('gado-gado')) {
      return '/assets/culinary/gado_gado_ph.jpg';
    }
    if (name.includes('tahu gejrot')) {
      return '/assets/culinary/pempek_ph.jpg'; // placeholder
    }
    if (name.includes('klepon')) {
      return '/assets/culinary/klepon_ph.jpg';
    }
    
    // Default Indonesian food image
    return '/assets/culinary/nasi_goreng_ph.jpg';
  };

  // Search on Google for restaurant/location
  const handleSearchGoogle = (query: string) => {
    const searchQuery = encodeURIComponent(`${query} Jakarta luxury restaurant review`);
    window.open(`https://www.google.com/search?q=${searchQuery}`, '_blank');
  };


  const handlePayment = async () => {
    setPaymentStep('processing');

    try {
      // Simulate processing time for UX
      await new Promise(resolve => setTimeout(resolve, 2000));

      // Pay selected orders
      const ordersToPay = orders.filter(o => selectedOrders.includes(o.id));

      for (const order of ordersToPay) {
        await layananApi.payOrder(order.id);
      }

      setPaymentStep('success');
      setTimeout(() => {
        setIsPaymentOpen(false);
        setPaymentStep('method');
        setSelectedOrders([]);
        // Refresh orders - confirmed orders will be hidden automatically
        fetchOrders();
      }, 2000);
    } catch (error) {
      console.error("Payment failed", error);
      alert("Pembayaran gagal. Silakan coba lagi.");
      setIsPaymentOpen(false);
      setPaymentStep('method');
    }
  };

  useEffect(() => {
    fetchItems();
    fetchOrders();
  }, []);

  const formatPrice = (price: number) => {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(price);
  };

  const calculateTotal = () => {
    const ordersToCalculate = selectedOrders.length > 0
      ? orders.filter(o => selectedOrders.includes(o.id))
      : orders;
    return ordersToCalculate.reduce((sum, order) => sum + Number(order.total_price), 0);
  };

  const toggleOrderSelection = (orderId: number) => {
    setSelectedOrders(prev =>
      prev.includes(orderId)
        ? prev.filter(id => id !== orderId)
        : [...prev, orderId]
    );
  };

  const toggleSelectAll = () => {
    if (selectedOrders.length === orders.length) {
      setSelectedOrders([]);
    } else {
      setSelectedOrders(orders.map(o => o.id));
    }
  };

  const updateOrderQuantity = async (orderId: number, newQuantity: number) => {
    if (newQuantity < 1) {
      handleCancelOrder(orderId);
      return;
    }

    try {
      const order = orders.find(o => o.id === orderId);
      if (!order) return;

      const item = items.find(i => i.id === order.item_id);
      if (!item) return;

      const newTotalPrice = newQuantity * item.price;

      const result = await layananApi.updateOrderQuantity(orderId, newQuantity, newTotalPrice);
      if (result.success) {
        fetchOrders();
      }
    } catch (error) {
      console.error("Error updating quantity", error);
    }
  };

  return (
    <div className="py-20 px-6 max-w-7xl mx-auto min-h-screen relative">
      {/* Header */}
      <div className="flex flex-col md:flex-row justify-between items-end mb-16 gap-4 animate-fade-in">
        <div>
          <h2 className="text-4xl md:text-5xl font-serif mb-4">Mahakarya <span className="text-luxury-gold">Kuliner</span></h2>
          <div className="w-24 h-1 bg-luxury-gold mb-6"></div>
          <p className="text-gray-400 max-w-xl">Setiap gigitan adalah perjalanan rasa yang mendalam, dikurasi dari kekayaan nusantara.</p>
        </div>
        <button
          onClick={() => setShowOrders(!showOrders)}
          className="px-6 py-3 border border-luxury-gold text-luxury-gold uppercase tracking-widest text-xs font-bold hover:bg-luxury-gold hover:text-black transition-all"
        >
          {showOrders ? 'Sembunyikan Pesanan' : `Keranjang Saya (${orders.length})`}
        </button>
      </div>

      {/* My Orders Panel */}
      {showOrders && (
        <div className="mb-20 bg-white/5 border border-white/10 rounded-xl p-8 animate-fade-in backdrop-blur-md">
          <div className="flex justify-between items-center border-b border-white/10 pb-4 mb-6">
            <h3 className="text-2xl font-serif text-white">Riwayat Pesanan</h3>
            <div className="text-right">
              <span className="text-luxury-gold text-xl font-bold block">{formatPrice(calculateTotal())}</span>
              {selectedOrders.length > 0 && (
                <span className="text-gray-400 text-xs">{selectedOrders.length} item dipilih</span>
              )}
            </div>
          </div>

          {orders.length > 0 && (
            <div className="mb-4 flex items-center gap-2">
              <input
                type="checkbox"
                id="selectAll"
                checked={selectedOrders.length === orders.length && orders.length > 0}
                onChange={toggleSelectAll}
                className="w-4 h-4 text-luxury-gold bg-black border-luxury-gold/30 rounded focus:ring-luxury-gold focus:ring-2"
                aria-label="Pilih semua pesanan"
              />
              <label htmlFor="selectAll" className="text-sm text-gray-400 cursor-pointer hover:text-white">
                Pilih Semua ({orders.length})
              </label>
            </div>
          )}

          <div className="space-y-4 max-h-96 overflow-y-auto pr-2 custom-scrollbar mb-8">
            {orders.length === 0 ? (
              <p className="text-gray-500 italic text-center py-8">Keranjang Anda kosong. Pilih menu untuk menambahkan ke keranjang.</p>
            ) : (
              orders.map(order => (
                <div key={order.id} className={`flex flex-col md:flex-row items-center justify-between bg-black/40 p-4 rounded-lg border transition-colors ${selectedOrders.includes(order.id) ? 'border-luxury-gold/50 bg-luxury-gold/10' : 'border-white/5 hover:border-luxury-gold/30'
                  }`}>
                  <div className="flex items-center gap-4 mb-4 md:mb-0 w-full md:w-auto">
                    <input
                      type="checkbox"
                      checked={selectedOrders.includes(order.id)}
                      onChange={() => toggleOrderSelection(order.id)}
                      className="w-4 h-4 text-luxury-gold bg-black border-luxury-gold/30 rounded focus:ring-luxury-gold focus:ring-2"
                      aria-label={`Pilih pesanan ${order.name}`}
                    />
                    <img
                      src={getFoodImage(order.name, '', order.image_url)}
                      className="w-16 h-16 object-cover rounded-md border border-white/10"
                      alt={order.name}
                      onError={(e) => {
                        const target = e.target as HTMLImageElement;
                        target.src = getFoodImage(order.name, '', '');
                      }}
                      loading="lazy"
                    />
                    <div className="flex-1">
                      <h4 className="font-bold text-white text-lg">{order.name}</h4>
                      <div className="flex items-center gap-2 mt-2">
                        <button
                          onClick={() => updateOrderQuantity(order.id, (order.quantity || 1) - 1)}
                          className="w-6 h-6 bg-white/10 hover:bg-luxury-gold hover:text-black rounded text-xs font-bold transition-colors"
                        >
                          -
                        </button>
                        <span className="text-luxury-gold font-mono text-sm min-w-[2rem] text-center">{order.quantity || 1}</span>
                        <button
                          onClick={() => updateOrderQuantity(order.id, (order.quantity || 1) + 1)}
                          className="w-6 h-6 bg-white/10 hover:bg-luxury-gold hover:text-black rounded text-xs font-bold transition-colors"
                        >
                          +
                        </button>
                      </div>
                      <p className="text-luxury-gold text-sm font-mono mt-1">{formatPrice(order.total_price)}</p>
                      <p className="text-[10px] text-gray-500 mt-1">{order.created_at}</p>
                    </div>
                  </div>
                  <div className="flex items-center gap-4 w-full md:w-auto justify-between md:justify-end">
                    <button
                      onClick={() => handleCancelOrder(order.id)}
                      className="px-4 py-2 bg-red-500/20 text-red-500 text-xs hover:bg-red-500 hover:text-white font-bold uppercase tracking-wider border border-red-500/30 hover:border-red-500 rounded transition-all"
                    >
                      Hapus
                    </button>
                  </div>
                </div>
              ))
            )}
          </div>

          {orders.length > 0 && (
            <div className="flex justify-end">
              <button
                onClick={() => setIsPaymentOpen(true)}
                disabled={selectedOrders.length === 0}
                className={`px-8 py-3 font-bold uppercase tracking-widest transition-all shadow-[0_0_20px_rgba(197,160,89,0.3)] ${selectedOrders.length === 0
                  ? 'bg-gray-600 text-gray-400 cursor-not-allowed'
                  : 'bg-luxury-gold text-black hover:bg-white hover:text-black'
                  }`}
              >
                {selectedOrders.length > 0
                  ? `Bayar ${selectedOrders.length} Item`
                  : 'Pilih Item untuk Dibayar'}
              </button>
            </div>
          )}
        </div>
      )}

      {/* Menu Grid */}
      {loading ? (
        <div className="text-center py-20">
          <div className="inline-block w-8 h-8 border-2 border-luxury-gold border-t-transparent rounded-full animate-spin mb-4"></div>
          <div className="text-gray-500 uppercase tracking-widest text-xs">Menyiapkan hidangan...</div>
        </div>
      ) : (
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
          {items.map((item) => (
            <div key={item.id} className="group bg-luxury-card rounded-xl overflow-hidden border border-white/5 hover:border-luxury-gold/50 transition-all duration-500 hover:shadow-[0_10px_40px_-10px_rgba(0,0,0,0.5)] cursor-pointer" onClick={() => setSelectedItem(item)}>
              <div className="relative h-64 overflow-hidden bg-luxury-card">
                <img
                  src={getFoodImage(item.name, item.description, item.image_url)}
                  alt={item.name}
                  className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                  onError={(e) => {
                    const target = e.target as HTMLImageElement;
                    target.src = getFoodImage(item.name, item.description, '');
                  }}
                  loading="lazy"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-60"></div>
                <div className="absolute top-4 right-4 bg-black/80 backdrop-blur px-3 py-1 rounded-full flex items-center gap-1 border border-white/10">
                  <span className="text-luxury-gold text-sm">★</span>
                  <span className="text-white text-xs font-bold">{item.rating}</span>
                </div>
              </div>

              <div className="p-8">
                <div className="mb-2">
                  <h3 className="text-xl font-serif text-white group-hover:text-luxury-gold transition-colors">{item.name}</h3>
                </div>
                <p className="text-gray-400 text-sm mb-6 line-clamp-2 h-10 leading-relaxed">{item.description}</p>

                <div className="flex items-center justify-between border-t border-white/10 pt-6 mt-4">
                  <div>
                    <p className="text-luxury-gold font-serif text-lg font-bold">{formatPrice(Number(item.price))}</p>
                    <p className="text-[10px] text-gray-500 uppercase tracking-wider truncate max-w-[120px]">{item.restaurant_name}</p>
                  </div>
                  <button
                    onClick={(e) => {
                      e.stopPropagation();
                      handleOrder(item);
                    }}
                    className="px-6 py-2 bg-white/5 hover:bg-luxury-gold text-luxury-gold hover:text-black border border-luxury-gold/30 hover:border-luxury-gold transition-all duration-300 text-[10px] uppercase font-bold tracking-widest rounded-sm active:scale-95"
                  >
                    Pesan
                  </button>
                </div>
              </div>
            </div>
          ))}
        </div>
      )}

      {/* DETAIL MODAL */}
      {selectedItem && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm animate-fade-in" onClick={() => setSelectedItem(null)}>
          <div className="bg-luxury-card max-w-4xl w-full rounded-2xl overflow-hidden border border-white/10 shadow-2xl flex flex-col md:flex-row" onClick={e => e.stopPropagation()}>
            <div className="w-full md:w-1/2 h-64 md:h-auto bg-luxury-card">
              <img
                src={getFoodImage(selectedItem.name, selectedItem.description, selectedItem.image_url)}
                alt={selectedItem.name}
                className="w-full h-full object-cover"
                onError={(e) => {
                  const target = e.target as HTMLImageElement;
                  target.src = getFoodImage(selectedItem.name, selectedItem.description, '');
                }}
                loading="lazy"
              />
            </div>
            <div className="w-full md:w-1/2 p-8 md:p-12 relative">
              <button
                onClick={() => setSelectedItem(null)}
                className="absolute top-4 right-4 text-gray-400 hover:text-white"
              >
                ✕
              </button>

              <div className="mb-6">
                <span className="text-luxury-gold text-xs font-bold tracking-widest uppercase mb-2 block">{selectedItem.category}</span>
                <h2 className="text-3xl md:text-4xl font-serif text-white mb-4">{selectedItem.name}</h2>
                <div className="flex items-center gap-2 mb-6">
                  <span className="bg-white/10 px-2 py-0.5 rounded text-xs text-white">★ {selectedItem.rating}</span>
                  <span className="text-gray-500 text-xs">•</span>
                  <span className="text-gray-400 text-xs">{selectedItem.restaurant_name}</span>
                </div>
                <p className="text-gray-300 leading-relaxed mb-8">{selectedItem.description}</p>
                
                {/* Location and Search */}
                <div className="mb-6">
                  <p className="text-gray-400 text-sm mb-2">
                    <span className="text-white">Lokasi:</span> {selectedItem.location}
                  </p>
                  <button
                    onClick={() => handleSearchGoogle(`${selectedItem.restaurant_name} ${selectedItem.location}`)}
                    className="px-4 py-2 bg-blue-500/20 text-blue-400 text-xs hover:bg-blue-500 hover:text-white font-bold uppercase tracking-wider border border-blue-500/30 hover:border-blue-500 rounded transition-all"
                  >
                    Cari di Google
                  </button>
                </div>
                
                <div className="flex items-center justify-between">
                  <span className="text-3xl font-serif text-luxury-gold">{formatPrice(Number(selectedItem.price))}</span>
                  <button
                    onClick={() => handleOrder(selectedItem)}
                    className="px-8 py-3 bg-luxury-gold text-black font-bold uppercase tracking-widest rounded hover:bg-white transition-all shadow-lg"
                  >
                    Masukan Keranjang
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      )}

      {/* PAYMENT MODAL */}
      {isPaymentOpen && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/90 backdrop-blur-md animate-fade-in">
          <div className="bg-[#1a1a1a] max-w-md w-full rounded-2xl border border-luxury-gold/20 shadow-[0_0_50px_rgba(0,0,0,0.8)] p-8">
            <h2 className="text-2xl font-serif text-white mb-6 text-center">Pembayaran</h2>

            {paymentStep === 'method' && (
              <div className="space-y-4">
                <p className="text-gray-400 text-center mb-2">
                  {selectedOrders.length} item akan dibayar
                </p>
                <p className="text-gray-400 text-center mb-6">Total Tagihan: <span className="text-luxury-gold font-bold text-xl">{formatPrice(calculateTotal())}</span></p>
                <button onClick={handlePayment} className="w-full p-4 bg-white/5 border border-white/10 rounded-lg flex items-center gap-4 hover:border-luxury-gold hover:bg-white/10 transition-all text-left group">
                  <div className="w-10 h-10 rounded-full bg-luxury-gold/10 flex items-center justify-center text-luxury-gold group-hover:bg-luxury-gold group-hover:text-black">💳</div>
                  <div>
                    <h4 className="font-bold text-white">Kartu Kredit / Debit</h4>
                    <p className="text-xs text-gray-500">Visa, Mastercard, JCB</p>
                  </div>
                </button>
                <button onClick={handlePayment} className="w-full p-4 bg-white/5 border border-white/10 rounded-lg flex items-center gap-4 hover:border-luxury-gold hover:bg-white/10 transition-all text-left group">
                  <div className="w-10 h-10 rounded-full bg-luxury-gold/10 flex items-center justify-center text-luxury-gold group-hover:bg-luxury-gold group-hover:text-black">📱</div>
                  <div>
                    <h4 className="font-bold text-white">QRIS / E-Wallet</h4>
                    <p className="text-xs text-gray-500">GoPay, OVO, Dana</p>
                  </div>
                </button>
                <button onClick={() => setIsPaymentOpen(false)} className="w-full py-3 text-gray-500 hover:text-white text-sm mt-4">Batalkan</button>
              </div>
            )}

            {paymentStep === 'processing' && (
              <div className="text-center py-10">
                <div className="animate-spin w-16 h-16 border-4 border-luxury-gold border-t-transparent rounded-full mx-auto mb-6"></div>
                <h3 className="text-xl text-white font-bold mb-2">Memproses Pembayaran...</h3>
                <p className="text-gray-400 text-sm">Mohon jangan tutup halaman ini.</p>
              </div>
            )}

            {paymentStep === 'success' && (
              <div className="text-center py-10">
                <div className="w-20 h-20 bg-green-500/10 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6 text-4xl border border-green-500/20">✓</div>
                <h3 className="text-xl text-white font-bold mb-2">Pembayaran Berhasil!</h3>
                <p className="text-gray-400 text-sm">Pesanan Anda sedang disiapkan.</p>
              </div>
            )}
          </div>
        </div>
      )}
    </div>
  );
};

export default FoodMenu;




