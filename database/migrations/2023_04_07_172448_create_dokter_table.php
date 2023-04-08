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
        Schema::create('dokter', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokter');
            $table->foreignId('id_poli')->references('id')->on('poli');
            $table->string('spesialis');
            $table->time('mulai_dari');
            $table->time('akhir_dari');
            $table->enum('jenis_kelamin', ['1', '2'])->comment("1 : Laki - Laki | 2 : Perempuan");
            $table->string('umur', 2);
            $table->string('alamat', 50);
            $table->string('no_telp', 13);
            $table->foreignId('id_user')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokter');
    }
};
