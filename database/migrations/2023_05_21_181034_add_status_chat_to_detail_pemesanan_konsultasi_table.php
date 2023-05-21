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
        Schema::table('detail_pemesanan_konsultasi', function (Blueprint $table) {
            $table->enum('status_chat',['pending','selesai'])->default('pending')->after('status_pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_pemesanan_konsultasi', function (Blueprint $table) {
            //
        });
    }
};
