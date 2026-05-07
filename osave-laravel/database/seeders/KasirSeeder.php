<?php

namespace Database\Seeders;

use App\Models\Kasir;
use Illuminate\Database\Seeder;

class KasirSeeder extends Seeder
{
    public function run(): void
    {
        $kasirs = [
            ['nama_kasir' => 'Siti Nur Aisyah', 'username' => 'kasir01'],
            ['nama_kasir' => 'Ani Wulandari', 'username' => 'kasir02'],
            ['nama_kasir' => 'Rina Marlina', 'username' => 'kasir03'],
        ];

        foreach ($kasirs as $data) {
            if (Kasir::where('username', $data['username'])->doesntExist()) {
                Kasir::create($data);
            }
        }
    }
}
