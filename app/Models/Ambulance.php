<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    use HasFactory;
    protected $table = 'ambulance';
    protected $fillable = [
        'foto',
        'nama_mobil',
        'plat',
        'tahun_mobil',
        'asal_mobil',
        'status_mobil'
    ];
}
