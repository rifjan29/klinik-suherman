<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilKonsultasi extends Model
{
    use HasFactory;
    protected $table = 'hasil_konsultasi';
    protected $fillable = [
        'kode_transaksi_konsultasi',
        'id_pasien',
        'kesimpulan',
        'resep_obat',
        'status',
    ];
}
