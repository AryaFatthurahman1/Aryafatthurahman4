import 'package:shared_preferences/shared_preferences.dart';

/// SharedPreferences Helper Class
/// Untuk menyimpan dan mengambil data user session
class SharedPrefs {
  static SharedPreferences? _prefs;

  // Initialize SharedPreferences
  static Future<void> init() async {
    _prefs = await SharedPreferences.getInstance();
  }

  // Save login session
  static Future<bool> saveLoginSession({
    required int userId,
    required String userName,
    required String userEmail,
    required String userPhone,
    required String userImage,
    required String userBio,
    required String token,
  }) async {
    await _prefs?.setBool('is_logged_in', true);
    await _prefs?.setInt('user_id', userId);
    await _prefs?.setString('user_name', userName);
    await _prefs?.setString('user_email', userEmail);
    await _prefs?.setString('user_phone', userPhone);
    await _prefs?.setString('user_image', userImage);
    await _prefs?.setString('user_bio', userBio);
    await _prefs?.setString('user_token', token);
    return true;
  }

  // Check if user is logged in
  static bool isLoggedIn() {
    return _prefs?.getBool('is_logged_in') ?? false;
  }

  // Get user ID
  static int getUserId() {
    return _prefs?.getInt('user_id') ?? 0;
  }

  // Get user name
  static String getUserName() {
    return _prefs?.getString('user_name') ?? '';
  }

  // Get user email
  static String getUserEmail() {
    return _prefs?.getString('user_email') ?? '';
  }

  // Get user phone
  static String getUserPhone() {
    return _prefs?.getString('user_phone') ?? '';
  }

  // Get user image
  static String getUserImage() {
    return _prefs?.getString('user_image') ?? '';
  }

  // Get user bio
  static String getUserBio() {
    return _prefs?.getString('user_bio') ?? '';
  }

  // Get user token
  static String getUserToken() {
    return _prefs?.getString('user_token') ?? '';
  }

  // Update user profile
  static Future<bool> updateUserProfile({
    String? userName,
    String? userPhone,
    String? userBio,
  }) async {
    if (userName != null) {
      await _prefs?.setString('user_name', userName);
    }
    if (userPhone != null) {
      await _prefs?.setString('user_phone', userPhone);
    }
    if (userBio != null) {
      await _prefs?.setString('user_bio', userBio);
    }
    return true;
  }

  // Clear all data (logout)
  static Future<bool> clearAll() async {
    return await _prefs?.clear() ?? false;
  }

  // Logout
  static Future<bool> logout() async {
    await _prefs?.setBool('is_logged_in', false);
    await _prefs?.remove('user_id');
    await _prefs?.remove('user_name');
    await _prefs?.remove('user_email');
    await _prefs?.remove('user_phone');
    await _prefs?.remove('user_image');
    await _prefs?.remove('user_bio');
    await _prefs?.remove('user_token');
    return true;
  }
}
