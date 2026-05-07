<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('detail_transaksi')) {
            Schema::create('detail_transaksi', function (Blueprint $table) {
                $table->id('id_detail_transaksi');
                $table->foreignId('id_transaksi')->constrained('transaksi', 'id_transaksi')->cascadeOnDelete();
                $table->foreignId('id_barang')->constrained('barang', 'id_barang');
                $table->unsignedInteger('qty')->default(1);
                $table->unsignedBigInteger('harga_satuan');
                $table->unsignedBigInteger('subtotal');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};
