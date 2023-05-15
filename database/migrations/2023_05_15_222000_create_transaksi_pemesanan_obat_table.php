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
        Schema::create('transaksi_pemesanan_obat', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pasien')->nullable();
            $table->bigInteger('id_hasil_konsultasi')->nullable();
            $table->string('kode_transaksi')->nullable();
            $table->bigInteger('nominal_bayar')->nullable();
            $table->bigInteger('id_bank')->nullable();
            $table->date('tgl')->nullable();
            $table->string('foto_pembayaran')->nullable();
            $table->enum('status',['pending','lunas','ditolak'])->default('pending');
            $table->datetime('tgl_ambil_obat');
            $table->enum('status_pengambilan',['pending','diterima']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_pemesanan_obat');
    }
};
