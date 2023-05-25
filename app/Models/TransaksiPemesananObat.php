<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPemesananObat extends Model
{
    use HasFactory;
    protected $table = 'transaksi_pemesanan_obat';
    protected $fillable = [
        'id_pasien',
        'id_hasil_konsultasi',
        'kode_transaksi',
        'nominal_bayar',
        'harga_lainnya',
        'harga_embalase',
        'id_bank',
        'tgl',
        'foto_pembayaran',
        'status',
        'tgl_ambil_obat',
        'status_pengambilan',
    ];
}
