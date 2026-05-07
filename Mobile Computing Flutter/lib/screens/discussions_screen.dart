import 'package:flutter/material.dart';
import 'package:cached_network_image/cached_network_image.dart';
import '../models/discussion_model.dart';
import '../services/api_service.dart';
import '../utils/shared_prefs.dart';
import '../widgets/custom_button.dart';
import '../widgets/custom_textfield.dart';

/// Discussions Screen
/// Forum diskusi dengan create discussion feature
class DiscussionsScreen extends StatefulWidget {
  const DiscussionsScreen({super.key});

  @override
  State<DiscussionsScreen> createState() => _DiscussionsScreenState();
}

class _DiscussionsScreenState extends State<DiscussionsScreen> {
  List<DiscussionModel> _discussions = [];
  bool _isLoading = true;
  final _titleController = TextEditingController();
  final _messageController = TextEditingController();

  @override
  void initState() {
    super.initState();
    _loadDiscussions();
  }

  @override
  void dispose() {
    _titleController.dispose();
    _messageController.dispose();
    super.dispose();
  }

  Future<void> _loadDiscussions() async {
    setState(() {
      _isLoading = true;
    });

    try {
      final discussions = await ApiService.getDiscussions(limit: 50);
      if (mounted) {
        setState(() {
          _discussions = discussions;
          _isLoading = false;
        });
      }
    } catch (e) {
      if (mounted) {
        setState(() {
          _isLoading = false;
        });
      }
    }
  }

  // Show Create Discussion Dialog
  void _showCreateDialog() {
    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        title: const Text('Buat Diskusi Baru'),
        content: SingleChildScrollView(
          child: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              CustomTextField(
                label: 'Judul',
                hint: 'Masukkan judul diskusi',
                controller: _titleController,
              ),
              const SizedBox(height: 16),
              CustomTextField(
                label: 'Pesan',
                hint: 'Tulis pesan Anda',
                controller: _messageController,
                maxLines: 4,
              ),
            ],
          ),
        ),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(context),
            child: const Text('Batal'),
          ),
          ElevatedButton(
            onPressed: _handleCreateDiscussion,
            style: ElevatedButton.styleFrom(
              backgroundColor: const Color(0xFF4F46E5),
            ),
            child: const Text('Kirim'),
          ),
        ],
      ),
    );
  }

  // Handle Create Discussion
  Future<void> _handleCreateDiscussion() async {
    if (_titleController.text.isEmpty || _messageController.text.isEmpty) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(
          content: Text('Judul dan pesan harus diisi'),
          backgroundColor: Color(0xFFEF4444),
        ),
      );
      return;
    }

    try {
      final response = await ApiService.createDiscussion(
        userId: SharedPrefs.getUserId(),
        title: _titleController.text,
        message: _messageController.text,
      );

      if (!mounted) return;

      Navigator.pop(context);

      if (response['success'] == true) {
        _titleController.clear();
        _messageController.clear();

        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            content: Text('Diskusi berhasil dibuat'),
            backgroundColor: Color(0xFF10B981),
          ),
        );

        _loadDiscussions();
      } else {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text(response['message'] ?? 'Gagal membuat diskusi'),
            backgroundColor: const Color(0xFFEF4444),
          ),
        );
      }
    } catch (e) {
      if (mounted) {
        Navigator.pop(context);
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text('Error: $e'),
            backgroundColor: const Color(0xFFEF4444),
          ),
        );
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Forum Diskusi'),
        automaticallyImplyLeading: false,
      ),
      body: RefreshIndicator(
        onRefresh: _loadDiscussions,
        child: _isLoading
            ? const Center(child: CircularProgressIndicator())
            : _discussions.isEmpty
                ? const Center(child: Text('Belum ada diskusi'))
                : ListView.builder(
                    padding: const EdgeInsets.all(16),
                    itemCount: _discussions.length,
                    itemBuilder: (context, index) {
                      final discussion = _discussions[index];
                      return Container(
                        margin: const EdgeInsets.only(bottom: 16),
                        padding: const EdgeInsets.all(16),
                        decoration: BoxDecoration(
                          color: Colors.white,
                          borderRadius: BorderRadius.circular(12),
                          boxShadow: [
                            BoxShadow(
                              color: Colors.black.withOpacity(0.05),
                              blurRadius: 10,
                              offset: const Offset(0, 2),
                            ),
                          ],
                        ),
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            // User Info
                            Row(
                              children: [
                                CircleAvatar(
                                  radius: 18,
                                  backgroundImage: CachedNetworkImageProvider(
                                    discussion.userImage,
                                  ),
                                ),
                                const SizedBox(width: 12),
                                Expanded(
                                  child: Column(
                                    crossAxisAlignment:
                                        CrossAxisAlignment.start,
                                    children: [
                                      Text(
                                        discussion.userName,
                                        style: const TextStyle(
                                          fontWeight: FontWeight.w600,
                                          fontSize: 14,
                                        ),
                                      ),
                                      Text(
                                        _formatDate(discussion.createdAt),
                                        style: const TextStyle(
                                          fontSize: 12,
                                          color: Color(0xFF6B7280),
                                        ),
                                      ),
                                    ],
                                  ),
                                ),
                              ],
                            ),

                            const SizedBox(height: 12),

                            // Title
                            Text(
                              discussion.title,
                              style: const TextStyle(
                                fontSize: 16,
                                fontWeight: FontWeight.bold,
                                color: Color(0xFF1F2937),
                              ),
                            ),

                            const SizedBox(height: 8),

                            // Message
                            Text(
                              discussion.message,
                              style: const TextStyle(
                                fontSize: 14,
                                color: Color(0xFF374151),
                                height: 1.5,
                              ),
                            ),
                          ],
                        ),
                      );
                    },
                  ),
      ),
      floatingActionButton: FloatingActionButton.extended(
        onPressed: _showCreateDialog,
        backgroundColor: const Color(0xFF4F46E5),
        icon: const Icon(Icons.add),
        label: const Text('Buat Diskusi'),
      ),
    );
  }

  String _formatDate(String dateStr) {
    try {
      final date = DateTime.parse(dateStr);
      final now = DateTime.now();
      final diff = now.difference(date);

      if (diff.inDays == 0) {
        if (diff.inHours == 0) {
          return '${diff.inMinutes} menit yang lalu';
        }
        return '${diff.inHours} jam yang lalu';
      } else if (diff.inDays < 7) {
        return '${diff.inDays} hari yang lalu';
      } else {
        return '${date.day}/${date.month}/${date.year}';
      }
    } catch (e) {
      return dateStr;
    }
  }
}
