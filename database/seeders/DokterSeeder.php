<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $poli = new Poli;
        $poli->nama_poli = 'dummy';
        $poli->save();
        $dokter = new Dokter;
        $dokter->nama_dokter = 'Dummy';
        $dokter->id_poli = $poli->id;
        $dokter->spesialis = '';
        $dokter->mulai_dari = time();
        $dokter->akhir_dari = time();
        $dokter->jenis_kelamin = '1';
        $dokter->umur = '20';
        $dokter->alamat = 'test';
        $dokter->no_sip = '12';
        $dokter->no_str = '12515';
        $dokter->nominal = 20000;
        $dokter->no_telp = '12515';
        $dokter->id_user =4;
        $dokter->save();
    }
}
