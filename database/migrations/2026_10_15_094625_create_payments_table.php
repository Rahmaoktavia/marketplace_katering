<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->unique()->constrained('orders')->cascadeOnDelete();
            $table->string('nomor_transaksi', 100)->nullable()->unique();
            $table->string('nomor_pesanan_midtrans', 100)->nullable()->unique();
            $table->string('metode_pembayaran', 50)->nullable();
            $table->enum('status_pembayaran', ['menunggu_pembayaran', 'berhasil', 'gagal', 'kedaluwarsa'])->default('menunggu_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
