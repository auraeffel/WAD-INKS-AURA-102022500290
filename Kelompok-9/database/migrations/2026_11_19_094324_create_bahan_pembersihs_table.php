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
        Schema::create('bahan_pembersihs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bahan');
            $table->string('jenis', 30)->default('deterjen');
            $table->decimal('stok', 10, 2)->default(0);
            $table->string('satuan', 20)->default('liter');
            $table->decimal('stok_minimum', 10, 2)->default(0);
            $table->unsignedInteger('harga_satuan')->default(0);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahan_pembersihs');
    }
};
