const API_BASE_URL = 'http://localhost/jakarta-luxury-ai/api';

export const layananApi = {
  // Authentication
  async login(email: string, password: string) {
    const response = await fetch(`${API_BASE_URL}/auth/login.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ email, password }),
    });
    return response.json();
  },

  async register(userData: {
    username: string;
    email: string;
    password: string;
    full_name: string;
    phone?: string;
  }) {
    const response = await fetch(`${API_BASE_URL}/auth/register.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(userData),
    });
    return response.json();
  },

  // Travel Destinations
  async getDestinations(filters?: {
    category?: string;
    featured?: boolean;
  }) {
    const params = new URLSearchParams();
    if (filters?.category) params.append('category', filters.category);
    if (filters?.featured) params.append('featured', 'true');

    const response = await fetch(`${API_BASE_URL}/wisata/destinations.php?${params}`);
    return response.json();
  },

  async getDestination(id: number) {
    const response = await fetch(`${API_BASE_URL}/wisata/destinations.php?id=${id}`);
    return response.json();
  },

  // Culinary Items
  async getCulinaryItems(filters?: {
    category?: string;
    featured?: boolean;
    restaurant?: string;
  }) {
    const params = new URLSearchParams();
    if (filters?.category) params.append('category', filters.category);
    if (filters?.featured) params.append('featured', 'true');
    if (filters?.restaurant) params.append('restaurant', filters.restaurant);

    const response = await fetch(`${API_BASE_URL}/kuliner/items.php?${params}`);
    return response.json();
  },

  async getCulinaryItem(id: number) {
    const response = await fetch(`${API_BASE_URL}/kuliner/items.php?id=${id}`);
    return response.json();
  },

  // Reservations
  async createReservation(reservationData: {
    user_id: number;
    type: 'travel' | 'culinary';
    item_id: number;
    reservation_date: string;
    reservation_time?: string;
    number_of_people?: number;
    special_requests?: string;
    total_price: number;
  }) {
    const response = await fetch(`${API_BASE_URL}/reservasi/create.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(reservationData),
    });
    return response.json();
  },

  // AI Chat
  async chatWithAI(message: string, user_id: number) {
    const response = await fetch(`${API_BASE_URL}/ai/chat.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ message, user_id }),
    });
    return response.json();
  },
  // Orders (Culinary)
  async getOrders(userId: number) {
    const response = await fetch(`${API_BASE_URL}/kuliner/orders.php?user_id=${userId}`);
    return response.json();
  },

  async placeOrder(orderData: {
    user_id: number;
    item_id: number;
    quantity: number;
    total_price: number;
  }) {
    const response = await fetch(`${API_BASE_URL}/kuliner/orders.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(orderData),
    });
    return response.json();
  },

  async cancelOrder(orderId: number) {
    const response = await fetch(`${API_BASE_URL}/kuliner/cancel_order.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ order_id: orderId }),
    });
    return response.json();
  },
  async payOrder(orderId: number) {
    const response = await fetch(`${API_BASE_URL}/kuliner/orders.php`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ id: orderId, status: 'confirmed' }),
    });
    return response.json();
  },
  async acceptOrder(orderId: number) {
    const response = await fetch(`${API_BASE_URL}/kuliner/orders.php`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ id: orderId, status: 'confirmed' }),
    });
    return response.json();
  },

  async updateOrderQuantity(orderId: number, quantity: number, totalPrice: number) {
    const response = await fetch(`${API_BASE_URL}/kuliner/orders.php`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ id: orderId, quantity, total_price: totalPrice }),
    });
    return response.json();
  },
};


