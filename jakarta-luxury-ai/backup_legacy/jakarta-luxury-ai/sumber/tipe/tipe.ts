
export interface User {
  id: string;
  name: string;
  email: string;
  phone: string;
  role: 'admin' | 'customer';
}

export interface Reservation {
  id: string;
  userId: string;
  name: string;
  address: string;
  date: string;
  time: string;
  peopleCount: number;
  packageType: string;
  status: 'pending' | 'confirmed' | 'cancelled';
}

export interface Product {
  id: string;
  name: string;
  description: string;
  price: number;
  category: 'travel' | 'culinary';
  image: string;
}

export enum AppRoute {
  HOME = 'home',
  LOGIN = 'login',
  REGISTER = 'register',
  TRAVEL = 'travel',
  CULINARY = 'culinary',
  RESERVATION = 'reservation',
  ADMIN = 'admin',
  AI_DESIGNER = 'ai-designer'
}


