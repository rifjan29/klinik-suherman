<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriObat extends Model
{
    use HasFactory;
    protected $table = 'category_obat';
    protected $fillable = [
        'name',
    ];
}
