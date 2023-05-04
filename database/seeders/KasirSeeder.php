<?php

namespace Database\Seeders;

use App\Models\Kasir;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KasirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $petugas = new Kasir;
        $petugas->nama_kasir = 'Kasir 1';
        $petugas->jabatan = 'Kasir';
        $petugas->jenis_kelamin = '1';
        $petugas->alamat = 'Probolinggo';
        $petugas->id_user = 5;
        $petugas->save();
    }
}
