<?php

namespace Database\Seeders;

use App\Models\Apotek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApotekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apotek = new Apotek;
        $apotek->nama_apotek = 'apotek';
        $apotek->jabatan = 'Sopir';
        $apotek->jenis_kelamin = '1';
        $apotek->alamat = 'Probolinggo';
        $apotek->id_user = 2;
        $apotek->save();
    }
}
