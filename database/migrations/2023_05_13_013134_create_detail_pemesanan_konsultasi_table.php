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
        Schema::create('detail_pemesanan_konsultasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pemesanan_konsultasi')->constrained('pemesanan_konsultasi')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('status_pembayaran',['pending','lunas','ditolak']);
            $table->bigInteger('id_user')->nullable();
            $table->text('keterangan')->nullable()->comment('jika ditolak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pemesanan_konsultasi');
    }
};
