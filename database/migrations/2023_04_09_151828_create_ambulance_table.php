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
        Schema::create('ambulance', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('nama_mobil')->nullable();
            $table->string('plat')->nullable();
            $table->string('tahun_mobil')->nullable();
            $table->string('asal_mobil')->nullable()->default('milik pribadi');
            $table->enum('status_mobil',['dipesan','tersedia'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ambulance');
    }
};
