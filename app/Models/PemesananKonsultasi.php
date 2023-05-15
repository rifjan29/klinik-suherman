<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananKonsultasi extends Model
{
    use HasFactory;
    protected $table = 'pemesanan_konsultasi';
    protected $fillable = [
        'kode_pemesanan',
        'id_pasien_konsultasi',
        'id_dokter',
        'id_bank',
        'total_nominal',
        'bukti_pembayaran',
        'tgl',
    ];
}
