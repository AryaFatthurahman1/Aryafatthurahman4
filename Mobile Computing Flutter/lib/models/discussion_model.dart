class DiscussionModel {
  final int id;
  final String title;
  final String message;
  final String createdAt;
  final int userId;
  final String userName;
  final String userImage;

  DiscussionModel({
    required this.id,
    required this.title,
    required this.message,
    required this.createdAt,
    required this.userId,
    required this.userName,
    required this.userImage,
  });

  // Create DiscussionModel from JSON
  factory DiscussionModel.fromJson(Map<String, dynamic> json) {
    return DiscussionModel(
      id: json['id'] ?? 0,
      title: json['title'] ?? '',
      message: json['message'] ?? '',
      createdAt: json['created_at'] ?? '',
      userId: json['user']['id'] ?? 0,
      userName: json['user']['name'] ?? '',
      userImage: json['user']['profile_image'] ?? '',
    );
  }

  // Convert DiscussionModel to JSON
  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'title': title,
      'message': message,
      'created_at': createdAt,
      'user': {
        'id': userId,
        'name': userName,
        'profile_image': userImage,
      }
    };
  }
}
