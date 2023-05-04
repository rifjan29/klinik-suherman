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
        Schema::create('kasir', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kasir');
            $table->string('jabatan');
            $table->enum('jenis_kelamin', ['1', '2'])->comment("1 : Laki - Laki | 2 : Perempuan");
            $table->foreignId('id_user')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('alamat', 50);
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kasir');
    }
};
