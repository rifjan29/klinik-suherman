<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new Admin;
        $admin->nama_admin = 'Diretur';
        $admin->jabatan = 'manager';
        $admin->jenis_kelamin = '1';
        $admin->alamat = 'Probolinggo';
        $admin->id_user = 6;
        $admin->save();
    }
}
