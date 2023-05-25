<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksiObat extends Model
{
    use HasFactory;
    protected $table = 'detail_transaksi_pemesanan_obat';
    protected $fillable = [
        'id_transaksi_obat',
        'id_obat',
        'qty',
    ];
}
