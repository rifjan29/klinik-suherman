<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admin';
    protected $fillable = [
        'nama_admin',
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
