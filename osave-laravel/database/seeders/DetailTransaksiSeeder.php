<?php

namespace Database\Seeders;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Database\Seeder;

class DetailTransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $transaksi = Transaksi::where('no_transaksi', '020.1.2004.290185.01/05/2026')->first();

        if ($transaksi && DetailTransaksi::where('id_transaksi', $transaksi->id_transaksi)->doesntExist()) {
            $details = [
                ['id_barang' => 1, 'qty' => 1, 'harga_satuan' => 9900, 'subtotal' => 9900],
                ['id_barang' => 2, 'qty' => 1, 'harga_satuan' => 18500, 'subtotal' => 18500],
                ['id_barang' => 3, 'qty' => 1, 'harga_satuan' => 17900, 'subtotal' => 17900],
                ['id_barang' => 4, 'qty' => 1, 'harga_satuan' => 17900, 'subtotal' => 17900],
                ['id_barang' => 5, 'qty' => 1, 'harga_satuan' => 12300, 'subtotal' => 12300],
                ['id_barang' => 6, 'qty' => 1, 'harga_satuan' => 4500, 'subtotal' => 4500],
                ['id_barang' => 7, 'qty' => 1, 'harga_satuan' => 17900, 'subtotal' => 17900],
                ['id_barang' => 8, 'qty' => 4, 'harga_satuan' => 7500, 'subtotal' => 30000],
            ];

            foreach ($details as $detail) {
                $transaksi->detailTransaksi()->create($detail);
            }
        }
    }
}
