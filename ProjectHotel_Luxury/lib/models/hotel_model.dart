class Hotel {
  final String id;
  final String name;
  final String description;
  final double pricePerNight;
  final String location;
  final String imageUrl;
  final String amenities;
  final double rating;

  Hotel({
    required this.id,
    required this.name,
    required this.description,
    required this.pricePerNight,
    required this.location,
    required this.imageUrl,
    required this.amenities,
    required this.rating,
  });

  factory Hotel.fromJson(Map<String, dynamic> json) {
    return Hotel(
      id: json['id'].toString(),
      name: json['name'],
      description: json['description'] ?? '',
      pricePerNight: double.tryParse(json['price_per_night'].toString()) ?? 0.0,
      location: json['location'],
      imageUrl: json['image_url'],
      amenities: json['amenities'] ?? '',
      rating: double.tryParse(json['rating'].toString()) ?? 0.0,
    );
  }
}
