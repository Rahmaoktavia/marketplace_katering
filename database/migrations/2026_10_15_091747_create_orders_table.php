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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pesanan', 40)->unique();
            $table->foreignId('customer_id')->constrained('customers')->restrictOnDelete();
            $table->foreignId('merchant_id')->constrained('merchants')->restrictOnDelete();
            $table->date('tanggal_pengiriman');
            $table->text('alamat_pengiriman');
            $table->text('catatan')->nullable();
            $table->decimal('total_harga', 12, 2)->default(0);
            $table->enum('status_pesanan', ['menunggu_konfirmasi', 'dikonfirmasi', 'diproses', 'selesai', 'dibatalkan'])->default('menunggu_konfirmasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
