import 'dart:convert';
import 'package:http/http.dart' as http;
import '../utils/constants.dart';
import '../models/user_model.dart';
import '../models/article_model.dart';
import '../models/discussion_model.dart';

/// API Service Class
/// Handles all HTTP requests to backend API
class ApiService {
  // Login
  static Future<Map<String, dynamic>> login(
      String email, String password) async {
    try {
      final response = await http.post(
        Uri.parse(Constants.loginEndpoint),
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode({
          'email': email,
          'password': password,
        }),
      );

      return jsonDecode(response.body);
    } catch (e) {
      return {
        'success': false,
        'message': 'Koneksi ke server gagal: $e',
      };
    }
  }

  // Register
  static Future<Map<String, dynamic>> register({
    required String name,
    required String email,
    required String password,
    String? phone,
    String? bio,
  }) async {
    try {
      final response = await http.post(
        Uri.parse(Constants.registerEndpoint),
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode({
          'name': name,
          'email': email,
          'password': password,
          'phone': phone ?? '',
          'bio': bio ?? '',
        }),
      );

      return jsonDecode(response.body);
    } catch (e) {
      return {
        'success': false,
        'message': 'Koneksi ke server gagal: $e',
      };
    }
  }

  // Get Articles List
  static Future<List<ArticleModel>> getArticles({
    int page = 1,
    int limit = 10,
    String? search,
    String? category,
  }) async {
    try {
      var url = '${Constants.articlesListEndpoint}?page=$page&limit=$limit';
      if (search != null && search.isNotEmpty) {
        url += '&search=$search';
      }
      if (category != null && category.isNotEmpty) {
        url += '&category=$category';
      }

      final response = await http.get(Uri.parse(url));
      final data = jsonDecode(response.body);

      if (data['success'] == true) {
        List<ArticleModel> articles = [];
        for (var item in data['data']['articles']) {
          articles.add(ArticleModel.fromJson(item));
        }
        return articles;
      }
      return [];
    } catch (e) {
      print('Error getting articles: $e');
      return [];
    }
  }

  // Get Article Detail
  static Future<ArticleModel?> getArticleDetail(int articleId) async {
    try {
      final response = await http.get(
        Uri.parse('${Constants.articleDetailEndpoint}?id=$articleId'),
      );

      final data = jsonDecode(response.body);

      if (data['success'] == true) {
        return ArticleModel.fromDetailJson(data['data']);
      }
      return null;
    } catch (e) {
      print('Error getting article detail: $e');
      return null;
    }
  }

  // Get Discussions List
  static Future<List<DiscussionModel>> getDiscussions({
    int page = 1,
    int limit = 20,
    int? userId,
  }) async {
    try {
      var url = '${Constants.discussionsListEndpoint}?page=$page&limit=$limit';
      if (userId != null) {
        url += '&user_id=$userId';
      }

      final response = await http.get(Uri.parse(url));
      final data = jsonDecode(response.body);

      if (data['success'] == true) {
        List<DiscussionModel> discussions = [];
        for (var item in data['data']['discussions']) {
          discussions.add(DiscussionModel.fromJson(item));
        }
        return discussions;
      }
      return [];
    } catch (e) {
      print('Error getting discussions: $e');
      return [];
    }
  }

  // Create Discussion
  static Future<Map<String, dynamic>> createDiscussion({
    required int userId,
    required String title,
    required String message,
  }) async {
    try {
      final response = await http.post(
        Uri.parse(Constants.discussionCreateEndpoint),
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode({
          'user_id': userId,
          'title': title,
          'message': message,
        }),
      );

      return jsonDecode(response.body);
    } catch (e) {
      return {
        'success': false,
        'message': 'Koneksi ke server gagal: $e',
      };
    }
  }

  // Get User Profile
  static Future<UserModel?> getUserProfile(int userId) async {
    try {
      final response = await http.get(
        Uri.parse('${Constants.userProfileEndpoint}?id=$userId'),
      );

      final data = jsonDecode(response.body);

      if (data['success'] == true) {
        return UserModel.fromJson(data['data']);
      }
      return null;
    } catch (e) {
      print('Error getting user profile: $e');
      return null;
    }
  }

  // Update User Profile
  static Future<Map<String, dynamic>> updateUserProfile({
    required int userId,
    String? name,
    String? phone,
    String? bio,
  }) async {
    try {
      final body = <String, dynamic>{'id': userId};
      if (name != null) body['name'] = name;
      if (phone != null) body['phone'] = phone;
      if (bio != null) body['bio'] = bio;

      final response = await http.put(
        Uri.parse(Constants.userProfileEndpoint),
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode(body),
      );

      return jsonDecode(response.body);
    } catch (e) {
      return {
        'success': false,
        'message': 'Koneksi ke server gagal: $e',
      };
    }
  }
}
