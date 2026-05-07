<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('transaksi')) {
            Schema::create('transaksi', function (Blueprint $table) {
                $table->id('id_transaksi');
                $table->string('no_transaksi', 100)->unique();
                $table->dateTime('tanggal');
                $table->foreignId('id_pelanggan')->constrained('pelanggan', 'id_pelanggan');
                $table->foreignId('id_kasir')->constrained('kasir', 'id_kasir');
                $table->unsignedInteger('total_item')->default(0);
                $table->unsignedBigInteger('total_harga')->default(0);
                $table->unsignedBigInteger('tunai')->default(0);
                $table->unsignedBigInteger('kembalian')->default(0);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
