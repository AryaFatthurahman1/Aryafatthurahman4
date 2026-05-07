<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['kode_barang' => 'AYM001', 'nama_barang' => 'Ayam Rolade Chicken 225gr', 'satuan' => 'pcs', 'harga_satuan' => 9900],
            ['kode_barang' => 'SHU001', 'nama_barang' => 'P.Catch Shrimp Shumai 250gr', 'satuan' => 'pcs', 'harga_satuan' => 18500],
            ['kode_barang' => 'KEN001', 'nama_barang' => 'FF Kentang Manis Putih 545gr', 'satuan' => 'pcs', 'harga_satuan' => 17900],
            ['kode_barang' => 'KTL001', 'nama_barang' => 'Kental Manis Putih 545gr', 'satuan' => 'pcs', 'harga_satuan' => 17900],
            ['kode_barang' => 'MIN001', 'nama_barang' => 'Kampak Emas Minyak Goreng 300', 'satuan' => 'pcs', 'harga_satuan' => 12300],
            ['kode_barang' => 'CBL001', 'nama_barang' => 'Dua belibis Chili Sauce 235ml', 'satuan' => 'pcs', 'harga_satuan' => 4500],
            ['kode_barang' => 'LRX001', 'nama_barang' => 'Laurier Xtra Maxi Non Wing 2', 'satuan' => 'pcs', 'harga_satuan' => 17900],
            ['kode_barang' => 'UBS001', 'nama_barang' => 'Unibis Marie Susu 198g', 'satuan' => 'pcs', 'harga_satuan' => 7500],
        ];

        foreach ($items as $item) {
            if (Barang::where('kode_barang', $item['kode_barang'])->doesntExist()) {
                Barang::create($item);
            }
        }
    }
}
