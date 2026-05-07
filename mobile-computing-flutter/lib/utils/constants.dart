class Constants {
  // API Configuration
  // IMPORTANT: Ganti dengan URL hosting Anda saat deploy
  static const String baseUrl =
      'http://localhost/Mobile%20Computing%20Flutter/api';

  // API Endpoints
  static const String loginEndpoint = '$baseUrl/auth/login.php';
  static const String registerEndpoint = '$baseUrl/auth/register.php';
  static const String articlesListEndpoint = '$baseUrl/articles/list.php';
  static const String articleDetailEndpoint = '$baseUrl/articles/detail.php';
  static const String discussionsListEndpoint = '$baseUrl/discussions/list.php';
  static const String discussionCreateEndpoint =
      '$baseUrl/discussions/create.php';
  static const String userProfileEndpoint = '$baseUrl/users/profile.php';

  // SharedPreferences Keys
  static const String keyIsLoggedIn = 'is_logged_in';
  static const String keyUserId = 'user_id';
  static const String keyUserName = 'user_name';
  static const String keyUserEmail = 'user_email';
  static const String keyUserPhone = 'user_phone';
  static const String keyUserImage = 'user_image';
  static const String keyUserBio = 'user_bio';
  static const String keyUserToken = 'user_token';

  // App Colors
  static const int primaryColor = 0xFF4F46E5;
  static const int secondaryColor = 0xFF10B981;
  static const int accentColor = 0xFFF59E0B;
  static const int errorColor = 0xFFEF4444;
  static const int successColor = 0xFF10B981;

  // App Strings
  static const String appName = 'EduConnect';
  static const String appTagline = 'Belajar Lebih Mudah, Lebih Menyenangkan';
}
