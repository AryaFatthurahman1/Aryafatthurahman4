class Article {
  final String id;
  final String title;
  final String content;
  final String author;
  final String publishedDate;
  final String? imageUrl;

  Article({
    required this.id,
    required this.title,
    required this.content,
    required this.author,
    required this.publishedDate,
    this.imageUrl,
  });

  factory Article.fromJson(Map<String, dynamic> json) {
    return Article(
      id: json['id'].toString(),
      title: json['title'],
      content: json['content'],
      author: json['author'] ?? 'Admin',
      publishedDate: json['published_date'],
      imageUrl: json['image_url'],
    );
  }
}
