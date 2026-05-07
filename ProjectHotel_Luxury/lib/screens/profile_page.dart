import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';

class ProfilePage extends StatefulWidget {
  const ProfilePage({super.key});
  @override
  State<ProfilePage> createState() => _ProfilePageState();
}

class _ProfilePageState extends State<ProfilePage> {
  final TextEditingController _nameController = TextEditingController();
  String currentPhoto = "https://i.pravatar.cc/150?u=arya";

  @override
  void initState() {
    super.initState();
    _loadProfile();
  }

  void _loadProfile() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      _nameController.text = prefs.getString('name') ?? "Muhammad Arya Fatthurahman";
      currentPhoto = prefs.getString('photo') ?? "https://i.pravatar.cc/150?u=arya";
    });
  }

  void _saveProfile() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    await prefs.setString('name', _nameController.text);
    await prefs.setString('photo', currentPhoto);
    
    if (!mounted) return;
    ScaffoldMessenger.of(context).showSnackBar(
      const SnackBar(content: Text('Profil Berhasil Diperbarui!')),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text("PENGATURAN PROFIL")),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(25),
        child: Column(
          children: [
            Stack(
              children: [
                CircleAvatar(radius: 60, backgroundImage: NetworkImage(currentPhoto)),
                Positioned(
                  bottom: 0, right: 0,
                  child: CircleAvatar(
                    backgroundColor: const Color(0xFFE94560),
                    child: IconButton(
                      icon: const Icon(Icons.camera_alt, color: Colors.white),
                      onPressed: () {
                        // Simulasi ganti foto
                        setState(() {
                          currentPhoto = "https://i.pravatar.cc/150?u=${DateTime.now().millisecond}";
                        });
                      },
                    ),
                  ),
                ),
              ],
            ),
            const SizedBox(height: 30),
            TextField(
              controller: _nameController,
              decoration: const InputDecoration(labelText: "Nama Lengkap", border: OutlineInputBorder()),
            ),
            const SizedBox(height: 10),
            const Text("NIM: 2023230006", style: TextStyle(color: Colors.grey)),
            const SizedBox(height: 30),
            ElevatedButton(
              onPressed: _saveProfile,
              style: ElevatedButton.styleFrom(minimumSize: const Size(double.infinity, 50)),
              child: const Text("SIMPAN PERUBAHAN"),
            ),
          ],
        ),
      ),
    );
  }
}
