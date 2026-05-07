class User {
  final String id;
  final String fullName;
  final String nim;
  final String username;
  final String email;
  final String? phone;
  final String? address;
  final String? photo;
  final String role;

  User({
    required this.id,
    required this.fullName,
    required this.nim,
    required this.username,
    required this.email,
    this.phone,
    this.address,
    this.photo,
    required this.role,
  });

  factory User.fromJson(Map<String, dynamic> json) {
    return User(
      id: json['id'].toString(),
      fullName: json['full_name'],
      nim: json['nim'],
      username: json['username'],
      email: json['email'],
      phone: json['phone'],
      address: json['address'],
      photo: json['photo'],
      role: json['role'] ?? 'user',
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'full_name': fullName,
      'nim': nim,
      'username': username,
      'email': email,
      'phone': phone,
      'address': address,
      'photo': photo,
      'role': role,
    };
  }
}
