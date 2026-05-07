import 'package:flutter/material.dart';

class NotePage extends StatefulWidget {const NotePage({super.key});
@override
State<NotePage> createState() => _NotePageState();
}

class _NotePageState extends State<NotePage> {
  final List<String> _notes = ["Hari ini fokus UAS.", "Jangan lupa istirahat."];
  final TextEditingController _noteController = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text("Catatan Harian Arya")),
      body: Column(
        children: [
          Padding(
            padding: const EdgeInsets.all(15),
            child: TextField(
              controller: _noteController,
              decoration: InputDecoration(
                labelText: "Tulis momen hari ini...",
                suffixIcon: IconButton(icon: const Icon(Icons.save), onPressed: () {
                  setState(() { _notes.add(_noteController.text); _noteController.clear(); });
                }),
              ),
            ),
          ),
          Expanded(
            child: ListView.builder(
              itemCount: _notes.length,
              itemBuilder: (context, index) => Card(
                margin: const EdgeInsets.all(10),
                child: ListTile(title: Text(_notes[index]), leading: const Icon(Icons.notes)),
              ),
            ),
          ),
        ],
      ),
    );
  }
}