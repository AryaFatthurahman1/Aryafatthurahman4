import 'package:flutter/material.dart';
import 'package:cached_network_image/cached_network_image.dart';
import '../services/api_service.dart';
import '../utils/shared_prefs.dart';
import '../widgets/custom_button.dart';
import '../widgets/custom_textfield.dart';
import 'login_screen.dart';

/// Profile Screen
/// User profile with edit functionality
class ProfileScreen extends StatefulWidget {
  const ProfileScreen({super.key});

  @override
  State<ProfileScreen> createState() => _ProfileScreenState();
}

class _ProfileScreenState extends State<ProfileScreen> {
  final _nameController = TextEditingController();
  final _phoneController = TextEditingController();
  final _bioController = TextEditingController();
  bool _isEditing = false;
  bool _isLoading = false;

  @override
  void initState() {
    super.initState();
    _loadProfile();
  }

  @override
  void dispose() {
    _nameController.dispose();
    _phoneController.dispose();
    _bioController.dispose();
    super.dispose();
  }

  void _loadProfile() {
    _nameController.text = SharedPrefs.getUserName();
    _phoneController.text = SharedPrefs.getUserPhone();
    _bioController.text = SharedPrefs.getUserBio();
  }

  // Handle Update Profile
  Future<void> _handleUpdateProfile() async {
    setState(() {
      _isLoading = true;
    });

    try {
      final response = await ApiService.updateUserProfile(
        userId: SharedPrefs.getUserId(),
        name: _nameController.text,
        phone: _phoneController.text,
        bio: _bioController.text,
      );

      if (!mounted) return;

      if (response['success'] == true) {
        // Update SharedPreferences
        await SharedPrefs.updateUserProfile(
          userName: _nameController.text,
          userPhone: _phoneController.text,
          userBio: _bioController.text,
        );

        setState(() {
          _isEditing = false;
        });

        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            content: Text('Profil berhasil diupdate'),
            backgroundColor: Color(0xFF10B981),
          ),
        );
      } else {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text(response['message'] ?? 'Gagal update profil'),
            backgroundColor: const Color(0xFFEF4444),
          ),
        );
      }
    } catch (e) {
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text('Error: $e'),
            backgroundColor: const Color(0xFFEF4444),
          ),
        );
      }
    } finally {
      if (mounted) {
        setState(() {
          _isLoading = false;
        });
      }
    }
  }

  // Handle Logout (Requirement a - Message Dialog)
  void _handleLogout() {
    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        title: const Text('Konfirmasi Logout'),
        content: const Text('Apakah Anda yakin ingin keluar?'),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(context),
            child: const Text('Batal'),
          ),
          ElevatedButton(
            onPressed: () async {
              await SharedPrefs.logout();
              if (!mounted) return;

              Navigator.of(context).pushAndRemoveUntil(
                MaterialPageRoute(builder: (context) => const LoginScreen()),
                (route) => false,
              );
            },
            style: ElevatedButton.styleFrom(
              backgroundColor: const Color(0xFFEF4444),
            ),
            child: const Text('Logout'),
          ),
        ],
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Profil Saya'),
        automaticallyImplyLeading: false,
        actions: [
          if (!_isEditing)
            IconButton(
              icon: const Icon(Icons.edit),
              onPressed: () {
                setState(() {
                  _isEditing = true;
                });
              },
            ),
        ],
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(20),
        child: Column(
          children: [
            // Profile Image (Requirement k - Network Image)
            Center(
              child: Container(
                width: 120,
                height: 120,
                decoration: BoxDecoration(
                  shape: BoxShape.circle,
                  border: Border.all(
                    color: const Color(0xFF4F46E5),
                    width: 3,
                  ),
                  boxShadow: [
                    BoxShadow(
                      color: const Color(0xFF4F46E5).withOpacity(0.3),
                      blurRadius: 15,
                      offset: const Offset(0, 5),
                    ),
                  ],
                ),
                child: ClipOval(
                  child: CachedNetworkImage(
                    imageUrl: SharedPrefs.getUserImage(),
                    fit: BoxFit.cover,
                    placeholder: (context, url) =>
                        const CircularProgressIndicator(),
                    errorWidget: (context, url, error) =>
                        const Icon(Icons.person, size: 60),
                  ),
                ),
              ),
            ),

            const SizedBox(height: 24),

            // Email (Read-only)
            Container(
              padding: const EdgeInsets.all(16),
              decoration: BoxDecoration(
                color: const Color(0xFFF3F4F6),
                borderRadius: BorderRadius.circular(12),
              ),
              child: Row(
                children: [
                  const Icon(Icons.email_outlined, color: Color(0xFF6B7280)),
                  const SizedBox(width: 12),
                  Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        const Text(
                          'Email',
                          style: TextStyle(
                            fontSize: 12,
                            color: Color(0xFF6B7280),
                          ),
                        ),
                        Text(
                          SharedPrefs.getUserEmail(),
                          style: const TextStyle(
                            fontSize: 16,
                            fontWeight: FontWeight.w600,
                          ),
                        ),
                      ],
                    ),
                  ),
                ],
              ),
            ),

            const SizedBox(height: 20),

            // Editable Fields
            CustomTextField(
              label: 'Nama',
              hint: 'Masukkan nama Anda',
              controller: _nameController,
              prefixIcon: Icons.person_outline,
            ),

            const SizedBox(height: 16),

            CustomTextField(
              label: 'Nomor Telepon',
              hint: 'Masukkan nomor telepon',
              controller: _phoneController,
              keyboardType: TextInputType.phone,
              prefixIcon: Icons.phone_outlined,
            ),

            const SizedBox(height: 16),

            CustomTextField(
              label: 'Bio',
              hint: 'Ceritakan tentang Anda',
              controller: _bioController,
              maxLines: 3,
              prefixIcon: Icons.info_outline,
            ),

            const SizedBox(height: 24),

            // Action Buttons
            if (_isEditing) ...[
              CustomButton(
                text: 'Simpan Perubahan',
                onPressed: _handleUpdateProfile,
                isLoading: _isLoading,
                icon: Icons.save,
              ),
              const SizedBox(height: 12),
              CustomButton(
                text: 'Batal',
                onPressed: () {
                  setState(() {
                    _isEditing = false;
                    _loadProfile();
                  });
                },
                isOutlined: true,
              ),
            ] else ...[
              CustomButton(
                text: 'Logout',
                onPressed: _handleLogout,
                backgroundColor: const Color(0xFFEF4444),
                icon: Icons.logout,
              ),
            ],
          ],
        ),
      ),
    );
  }
}
