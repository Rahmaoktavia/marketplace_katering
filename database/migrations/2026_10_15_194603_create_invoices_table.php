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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->unique()->constrained('orders')->cascadeOnDelete();
            $table->string('nomor_invoice', 40)->unique();
            $table->timestamp('tanggal_terbit')->useCurrent();
            $table->date('tanggal_jatuh_tempo')->nullable();
            $table->enum('status_pembayaran', ['menunggu_pembayaran', 'berhasil', 'gagal', 'kedaluwarsa'])->default('menunggu_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
