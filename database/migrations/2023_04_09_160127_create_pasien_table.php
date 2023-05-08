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
        Schema::create('pasien', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->enum('gender', ['L', 'P'])->nullable();//L = male, P = female
            $table->enum('status', ['1', '0'])->nullable();//1 = married, 0 = single
            $table->string('born');
            $table->string('job');
            $table->string('religion');
            $table->text('address');
            $table->string('phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};
