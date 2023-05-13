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
        Schema::create('kritik_saran', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('responden', ['pasien', 'pengunjung']);
            $table->enum('kepuasan', ['0', '1', '2', '3']);// 0 = sangat tidak puas, 1 = tidak puas, 2 = puas, 3 = sangat puas
            $table->enum('profesional', ['0', '1', '2', '3']);// 0 = sangat tidak puas, 1 = tidak puas, 2 = puas, 3 = sangat puas
            $table->enum('fasilitas', ['0', '1', '2', '3']);// 0 = sangat tidak puas, 1 = tidak puas, 2 = puas, 3 = sangat puas
            $table->enum('waktu', ['0', '1', '2', '3']);// 0 = sangat tidak puas, 1 = tidak puas, 2 = puas, 3 = sangat puas
            $table->enum('biaya', ['0', '1', '2', '3']);// 0 = sangat tidak puas, 1 = tidak puas, 2 = puas, 3 = sangat puas
            $table->enum('layanan', ['ambulan', 'konsultasi', 'apotek']);
            $table->text('kritik_saran');
            $table->string('no_hp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kritik_saran');
    }
};
