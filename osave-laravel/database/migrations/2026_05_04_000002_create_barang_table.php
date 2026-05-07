<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('barang')) {
            Schema::create('barang', function (Blueprint $table) {
                $table->id('id_barang');
                $table->string('kode_barang', 25)->unique();
                $table->string('nama_barang', 150);
                $table->string('satuan', 30)->default('pcs');
                $table->unsignedBigInteger('harga_satuan');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
