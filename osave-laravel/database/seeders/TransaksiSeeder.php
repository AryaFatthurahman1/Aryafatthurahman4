<?php

namespace Database\Seeders;

use App\Models\Kasir;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $pelanggan = Pelanggan::firstOrCreate(
            ['nama_pelanggan' => 'Muhammad Arya Fatthurahman'],
            ['no_telp' => '081234567890', 'alamat' => 'Jalan Merdeka No. 10, Bandung']
        );

        $kasir = Kasir::firstOrCreate(
            ['username' => 'kasir01'],
            ['nama_kasir' => 'Siti Nur Aisyah']
        );

        if (Transaksi::where('no_transaksi', '020.1.2004.290185.01/05/2026')->doesntExist()) {
            Transaksi::create([
                'no_transaksi' => '020.1.2004.290185.01/05/2026',
                'tanggal' => '2026-05-01 14:27:00',
                'id_pelanggan' => $pelanggan->id_pelanggan,
                'id_kasir' => $kasir->id_kasir,
                'total_item' => 9,
                'total_harga' => 103500,
                'tunai' => 103500,
                'kembalian' => 0,
            ]);
        }
    }
}
