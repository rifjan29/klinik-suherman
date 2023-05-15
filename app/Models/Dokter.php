<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;
    protected $table = 'dokter';
    protected $fillable = [
        'nama_dokter',
        'id_poli',
        'spesialis',
        'mulai_dari',
        'akhir_dari',
        'jenis_kelamin',
        'umur',
        'alamat',
        'no_telp',
        'id_user',
        'foto',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id_user','id');
    }
}
