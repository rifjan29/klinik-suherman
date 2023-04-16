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
        Schema::create('transaksi_ambulance', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pesanan');
            $table->foreignId('id_ambulance')->constrained('ambulance')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('id_pasien')->constrained('pasien_ambulance')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('id_petugas')->nullable()->constrained('petugas')->cascadeOnUpdate()->cascadeOnDelete();

            $table->enum('status_kejadian',['0','1'])->nullable()->comment('0 = darurat 1 = tidak darurat');
            $table->string('ket_kasir')->nullable();
            $table->string('nominal')->nullable();
            $table->enum('status_pembayaran',['lunas','pending','ditolak'])->default('pending');
            $table->enum('status_kendaraan',['0','1','2'])->default('0')->comment('0 : proses pengecekan 1 : dalam perjalanan 2 : tiba dilokasi');
            $table->date('tanggal')->nullable();
            $table->date('tanggal_jemput')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_ambulance');
    }
};
