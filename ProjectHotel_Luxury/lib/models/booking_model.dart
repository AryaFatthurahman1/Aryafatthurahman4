class Booking {
  final String id;
  final String userId;
  final String hotelId;
  final String checkIn;
  final String checkOut;
  final double totalPrice;
  final String status;
  final String? hotelName;
  final String? hotelImage;

  Booking({
    required this.id,
    required this.userId,
    required this.hotelId,
    required this.checkIn,
    required this.checkOut,
    required this.totalPrice,
    required this.status,
    this.hotelName,
    this.hotelImage,
  });

  factory Booking.fromJson(Map<String, dynamic> json) {
    return Booking(
      id: json['id'].toString(),
      userId: json['user_id'].toString(),
      hotelId: json['hotel_id'].toString(),
      checkIn: json['check_in'],
      checkOut: json['check_out'],
      totalPrice: double.tryParse(json['total_price'].toString()) ?? 0.0,
      status: json['status'],
      hotelName: json['hotel_name'],
      hotelImage: json['hotel_image'],
    );
  }
}
