class ArticleModel {
  final int id;
  final String title;
  final String content;
  final String? contentPreview;
  final String imageUrl;
  final String category;
  final int views;
  final String authorName;
  final String authorImage;
  final String createdAt;
  final String? updatedAt;

  ArticleModel({
    required this.id,
    required this.title,
    required this.content,
    this.contentPreview,
    required this.imageUrl,
    required this.category,
    required this.views,
    required this.authorName,
    required this.authorImage,
    required this.createdAt,
    this.updatedAt,
  });

  // Create ArticleModel from JSON (for list)
  factory ArticleModel.fromJson(Map<String, dynamic> json) {
    return ArticleModel(
      id: json['id'] ?? 0,
      title: json['title'] ?? '',
      content: json['content'] ?? '',
      contentPreview: json['content_preview'],
      imageUrl: json['image_url'] ?? '',
      category: json['category'] ?? '',
      views: json['views'] ?? 0,
      authorName: json['author_name'] ?? '',
      authorImage: json['author_image'] ?? '',
      createdAt: json['created_at'] ?? '',
      updatedAt: json['updated_at'],
    );
  }

  // Create ArticleModel from detail JSON
  factory ArticleModel.fromDetailJson(Map<String, dynamic> json) {
    return ArticleModel(
      id: json['id'] ?? 0,
      title: json['title'] ?? '',
      content: json['content'] ?? '',
      imageUrl: json['image_url'] ?? '',
      category: json['category'] ?? '',
      views: json['views'] ?? 0,
      authorName: json['author']['name'] ?? '',
      authorImage: json['author']['profile_image'] ?? '',
      createdAt: json['created_at'] ?? '',
      updatedAt: json['updated_at'],
    );
  }

  // Convert ArticleModel to JSON
  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'title': title,
      'content': content,
      'content_preview': contentPreview,
      'image_url': imageUrl,
      'category': category,
      'views': views,
      'author_name': authorName,
      'author_image': authorImage,
      'created_at': createdAt,
      'updated_at': updatedAt,
    };
  }
}
