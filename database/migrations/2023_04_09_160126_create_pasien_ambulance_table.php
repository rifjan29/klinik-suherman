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
        Schema::create('pasien_ambulance', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wali')->nullable();
            $table->string('lokasi_tujuan')->nullable();
            $table->string('lokasi_awal')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('keadaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien_ambulance');
    }
};
