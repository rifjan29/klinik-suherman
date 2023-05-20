<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatChat extends Model
{
    use HasFactory;
    protected $table = "riwayat_chat";
    protected $fillable = [
        'kode_transaksi_konsultasi',
        'pesan_dokter',
        'pesan_pasien',
        'tgl_dokter',
        'tgl_pasien',
        'sender_id',
        'receiver_id'
    ];
}
