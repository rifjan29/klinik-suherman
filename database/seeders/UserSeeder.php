<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Dokter;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = [
            'admin',
            'apotek',
            'petugas',
            'dokter',
        ];
        for ($i=0; $i < count($role); $i++) {
            $user = new User;
            $user->name = $role[$i];
            $user->email = $role[$i]."@mail.com";
            $user->password = Hash::make($role[$i].'123');
            $user->role = $role[$i];
            $user->save();
        }
        $admin = new Admin;
        $admin->nama_admin = 'administrator';
        $admin->jabatan = 'direktur';
        $admin->jenis_kelamin = '1';
        $admin->alamat = 'Probolinggo';
        $admin->id_user = 1;
        $admin->save();
    }
}
