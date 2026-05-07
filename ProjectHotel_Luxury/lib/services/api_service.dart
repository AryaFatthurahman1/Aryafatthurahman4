import 'dart:convert';
import 'package:http/http.dart' as http;
import '../models/hotel_model.dart';
import '../models/article_model.dart';
import '../models/booking_model.dart';

class ApiService {
  // Use 10.0.2.2 for Android Emulator, or your local IP for physical device
  // Update this BASE_URL to your specific machine IP if running on a real device
  static const String baseUrl = "http://10.0.2.2/ProjectHotel_Luxury/api";

  // Auth
  Future<Map<String, dynamic>> login(String username, String password) async {
    final response = await http.post(
      Uri.parse('$baseUrl/login.php'),
      body: {'username': username, 'password': password},
    );
    return json.decode(response.body);
  }

  Future<Map<String, dynamic>> register(
    String fullName,
    String nim,
    String email,
    String username,
    String password,
  ) async {
    final response = await http.post(
      Uri.parse('$baseUrl/register.php'),
      body: {
        'full_name': fullName,
        'nim': nim,
        'email': email,
        'username': username,
        'password': password,
      },
    );
    return json.decode(response.body);
  }

  // Hotels
  Future<List<Hotel>> getHotels() async {
    final response = await http.get(Uri.parse('$baseUrl/hotels.php'));
    if (response.statusCode == 200) {
      final data = json.decode(response.body);
      if (data['status'] == 'success') {
        List<dynamic> list = data['data'];
        return list.map((e) => Hotel.fromJson(e)).toList();
      }
    }
    return [];
  }

  // Articles
  Future<List<Article>> getArticles() async {
    final response = await http.get(Uri.parse('$baseUrl/articles.php'));
    if (response.statusCode == 200) {
      final data = json.decode(response.body);
      if (data['status'] == 'success') {
        List<dynamic> list = data['data'];
        return list.map((e) => Article.fromJson(e)).toList();
      }
    }
    return [];
  }

  // Bookings
  Future<bool> createBooking(
    String userId,
    String hotelId,
    String checkIn,
    String checkOut,
    double totalPrice,
  ) async {
    final response = await http.post(
      Uri.parse('$baseUrl/bookings.php'),
      body: {
        'user_id': userId,
        'hotel_id': hotelId,
        'check_in': checkIn,
        'check_out': checkOut,
        'total_price': totalPrice.toString(),
      },
    );
    final data = json.decode(response.body);
    return data['status'] == 'success';
  }

  Future<List<Booking>> getUserBookings(String userId) async {
    final response = await http.get(
      Uri.parse('$baseUrl/bookings.php?user_id=$userId'),
    );
    if (response.statusCode == 200) {
      final data = json.decode(response.body);
      if (data['status'] == 'success') {
        List<dynamic> list = data['data'];
        return list.map((e) => Booking.fromJson(e)).toList();
      }
    }
    return [];
  }

  // Profile
  Future<Map<String, dynamic>> updateProfile(
    String id,
    String fullName,
    String email,
    String phone,
    String address,
  ) async {
    final response = await http.post(
      Uri.parse('$baseUrl/profile.php'),
      body: {
        'id': id,
        'full_name': fullName,
        'email': email,
        'phone': phone,
        'address': address,
      },
    );
    return json.decode(response.body);
  }
}
