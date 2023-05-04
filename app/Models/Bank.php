<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $table = 'bank';
    protected $fillabel = [
        'nama_bank',
        'no_rekening',
        'id_user',
        'foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id_user','id');
    }
}
