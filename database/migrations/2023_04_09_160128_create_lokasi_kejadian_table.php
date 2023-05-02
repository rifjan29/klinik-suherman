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
        Schema::create('lokasi_kejadian', function (Blueprint $table) {
            $table->id();
            $table->string('long')->nullable();
            $table->string('lang')->nullable();
            $table->bigInteger('id_provinsi');
            $table->bigInteger('id_kota');
            $table->bigInteger('id_kecamatan');
            $table->bigInteger('id_desa');
            $table->text('alamat')->nullable();
            $table->foreignId('id_pasien_ambu')->nullable()->constrained('pasien_ambulance')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_kejadian');
    }
};
