<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiKejadian extends Model
{
    use HasFactory;
    protected $table = 'lokasi_kejadian';
    protected $fillable = [
        'long',
        'lang',
        'id_provinsi',
        'id_kota',
        'id_kecamatan',
        'id_desa',
        'alamat',
        'id_pasien_ambu',
    ];
}
