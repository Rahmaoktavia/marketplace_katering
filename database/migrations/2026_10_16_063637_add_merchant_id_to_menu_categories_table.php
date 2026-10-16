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
        Schema::table('menu_categories', function (Blueprint $table) {
            $table->foreignId('merchant_id')
                ->nullable()
                ->after('id')
                ->constrained('merchants');
        });

        Schema::table('menu_categories', function (Blueprint $table) {
            $table->dropUnique('menu_categories_nama_kategori_unique');

            $table->unique(
                ['merchant_id', 'nama_kategori'],
                'menu_categories_merchant_nama_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_categories', function (Blueprint $table) {
            $table->dropUnique('menu_categories_merchant_nama_unique');
        });

        Schema::table('menu_categories', function (Blueprint $table) {
            $table->dropConstrainedForeignId('merchant_id');

            $table->unique(
                'nama_kategori',
                'menu_categories_nama_kategori_unique'
            );
        });
    }
};
