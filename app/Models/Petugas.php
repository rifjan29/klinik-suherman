<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;
    protected $table = 'petugas';
    protected $fillable = [
        'nama_petugas',
        'jabatan',
        'jenis_kelamin',
        'id_user',
        'alamat',
        'foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id_user','id');
    }
}
