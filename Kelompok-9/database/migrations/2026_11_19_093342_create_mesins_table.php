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
        Schema::create('mesins', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mesin');
            $table->string('jenis', 30)->default('mesin_cuci');
            $table->unsignedSmallInteger('kapasitas_kg')->nullable();
            $table->string('status', 20)->default('tersedia');
            $table->date('perawatan_terakhir')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mesins');
    }
};
