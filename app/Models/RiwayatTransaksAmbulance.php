<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatTransaksAmbulance extends Model
{
    use HasFactory;
    protected $table = 'transaksi_ambulance';
    protected $fillable = [
        'kode_pesanan',
        'id_ambulance',
        'id_pasien',
        'id_petugas',
        'status_kejadian',
        'ket_kasir',
        'nominal',
        'status_pembayaran',
        'status_kendaraan',
        'tanggal',
        'tanggal_jemput'
    ];

    public function pasien_ambulance()
    {
        return $this->belongsTo(PasienAmbulance::class,'id_pasien','id');
    }

    public function ambulance()
    {
        return $this->belongsTo(Ambulance::class,'id_ambulance','id');

    }
}
