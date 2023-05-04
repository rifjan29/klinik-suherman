<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    use HasFactory;
    protected $table = 'kasir';
    protected $fillable = [
        'nama_kasir',
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
