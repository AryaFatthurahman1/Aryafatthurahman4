<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use Illuminate\Database\Seeder;

class PelangganSeeder extends Seeder
{
    public function run(): void
    {
        if (Pelanggan::where('nama_pelanggan', 'Anonim')->doesntExist()) {
            Pelanggan::create([
                'nama_pelanggan' => 'Anonim',
                'no_telp' => null,
                'alamat' => null,
            ]);
        }

        if (Pelanggan::where('nama_pelanggan', 'Muhammad Arya Fatthurahman')->doesntExist()) {
            Pelanggan::create([
                'nama_pelanggan' => 'Muhammad Arya Fatthurahman',
                'no_telp' => '081234567890',
                'alamat' => 'Jalan Merdeka No. 10, Bandung',
            ]);
        }
    }
}
