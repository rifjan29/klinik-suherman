<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPemesananKonsultasi extends Model
{
    use HasFactory;
    protected $table = 'detail_transaksi_ambulance';
    protected $fillable = [
        'id_transaksi',
        'id_user',
        'biaya_total',
        'jumlah_biaya',
        'total_kembalian',
        'status',
    ];
}
