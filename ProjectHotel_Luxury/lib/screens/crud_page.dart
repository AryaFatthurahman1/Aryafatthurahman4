import 'package:flutter/material.dart';
import 'package:http/http.dart' as http; // Pastikan tambah http di pubspec
import 'dart:convert';

class CrudPage extends StatefulWidget {
  const CrudPage({super.key});
  @override
  State<CrudPage> createState() => _CrudPageState();
}

class _CrudPageState extends State<CrudPage> {
  final List<String> months = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nov", "Des"];
  int selectedMonth = DateTime.now().month - 1;
  final List<Map<String, dynamic>> tasks = [];
  final TextEditingController _taskCtrl = TextEditingController();
  final TextEditingController _numCtrl = TextEditingController();

  // Point 4: API Structure Simulation
  Future<void> syncToDatabase() async {
    // try {
    //   final response = await http.post(
    //     Uri.parse('https://hosting-arya.com/api/save_tasks'),
    //     body: json.encode(tasks),
    //   );
    //   if(response.statusCode == 200) print("Berhasil Sinkron");
    // } catch (e) { print(e); }
  }

  void _addOrEditTask({int? index}) {
    if (index != null) {
      _taskCtrl.text = tasks[index]['title'];
      _numCtrl.text = tasks[index]['num'];
    }
    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        title: Text(index == null ? "Tambah Tugas" : "Edit Tugas"),
        content: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            TextField(controller: _taskCtrl, decoration: const InputDecoration(labelText: "Nama Tugas")),
            TextField(controller: _numCtrl, keyboardType: TextInputType.number, decoration: const InputDecoration(labelText: "Angka/Prioritas")),
          ],
        ),
        actions: [
          ElevatedButton(onPressed: () {
            setState(() {
              if (index == null) {
                tasks.add({"title": _taskCtrl.text, "num": _numCtrl.text, "month": months[selectedMonth]});
              } else {
                tasks[index] = {"title": _taskCtrl.text, "num": _numCtrl.text, "month": months[selectedMonth]};
              }
            });
            _taskCtrl.clear(); _numCtrl.clear();
            Navigator.pop(context);
            syncToDatabase();
          }, child: const Text("SIMPAN"))
        ],
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text("KALENDER & CRUD")),
      body: Column(
        children: [
          // Navigasi Bulan (Jan - Des)
          SizedBox(
            height: 60,
            child: ListView.builder(
              scrollDirection: Axis.horizontal,
              itemCount: months.length,
              itemBuilder: (context, index) => GestureDetector(
                onTap: () => setState(() => selectedMonth = index),
                child: Container(
                  width: 80,
                  alignment: Alignment.center,
                  margin: const EdgeInsets.all(5),
                  decoration: BoxDecoration(
                    color: selectedMonth == index ? const Color(0xFFE94560) : Colors.white10,
                    borderRadius: BorderRadius.circular(10),
                  ),
                  child: Text(months[index], style: const TextStyle(fontWeight: FontWeight.bold)),
                ),
              ),
            ),
          ),
          const Divider(),
          // List Data (Point f)
          Expanded(
            child: ListView.builder(
              itemCount: tasks.length,
              itemBuilder: (context, index) {
                if (tasks[index]['month'] != months[selectedMonth]) return const SizedBox();
                return Card(
                  margin: const EdgeInsets.symmetric(horizontal: 15, vertical: 5),
                  child: ListTile(
                    leading: CircleAvatar(backgroundColor: const Color(0xFFE94560), child: Text(tasks[index]['num'])),
                    title: Text(tasks[index]['title']),
                    subtitle: Text("Bulan: ${tasks[index]['month']}"),
                    trailing: Row(
                      mainAxisSize: MainAxisSize.min,
                      children: [
                        IconButton(icon: const Icon(Icons.edit, color: Colors.blue), onPressed: () => _addOrEditTask(index: index)),
                        IconButton(icon: const Icon(Icons.delete, color: Colors.red), onPressed: () => setState(() => tasks.removeAt(index))),
                      ],
                    ),
                  ),
                );
              },
            ),
          ),
        ],
      ),
      floatingActionButton: FloatingActionButton(onPressed: () => _addOrEditTask(), child: const Icon(Icons.add)),
    );
  }
}
