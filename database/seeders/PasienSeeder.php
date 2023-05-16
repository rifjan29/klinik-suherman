<?php

namespace Database\Seeders;

use App\Models\ModelPasien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pasien = new ModelPasien;
        $pasien->nama = 'Pasien';
        $pasien->username = 'pasien';
        $pasien->password = Hash::make('Pasien123');
        $pasien->email = 'pasien@gmail.com';
        $pasien->alamat = 'Jember';
        $pasien->no_hp = '085746234123';
        $pasien->save();
    }
}
