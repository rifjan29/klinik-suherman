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
        Schema::create('pemesanan_konsultasi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pemesanan')->nullable();
            $table->foreignId('id_pasien_konsultasi')->constrained('pasien')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_dokter')->constrained('dokter')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_bank')->constrained('bank')->cascadeOnDelete()->cascadeOnUpdate();
            $table->bigInteger('total_nominal')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->date('tgl')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan_konsultasi');
    }
};
