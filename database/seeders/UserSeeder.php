<?php

namespace Database\Seeders;

use App\Models\StaffProfile;
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
        User::create([
            'name' => 'Admin Desa',
            'email' => 'admin@desa.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Staff + profil
        $staff = User::create([
            'name' => 'Staff Desa',
            'email' => 'staff@desa.test',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);

        StaffProfile::create([
            'user_id' => $staff->id,
            'nama' => 'Nama Staff',
            'jabatan' => 'Bendahara',
            'foto' => null,
        ]);
    }
}
