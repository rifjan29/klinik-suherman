<?php

namespace Database\Seeders;

use App\Models\Petugas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $petugas = new Petugas;
        $petugas->nama_petugas = 'petugas';
        $petugas->jabatan = 'Sopir';
        $petugas->jenis_kelamin = '1';
        $petugas->alamat = 'Probolinggo';
        $petugas->id_user = 3;
        $petugas->save();
    }
}
