<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = User::create([
            'userId' => Str::orderedUuid(),
            'name' => 'Superadmin',
            'email' => 'superadmin@medquest.co.id',
            'username' => strtolower(str_replace(' ', '_', 'Superadmin')),
            'password' => Hash::make('SuperadminITD'),
        ]);
        $superadmin->assignRole('Superadmin');

        $superadmin2 = User::create([
            'userId' => Str::orderedUuid(),
            'name' => 'Muh Ardyansyah',
            'email' => 'muh.ardyansyah@medquest.co.id',
            'username' => 'muh.ardyansyah',
            'password' => Hash::make('Calibration24!'),
        ]);
        $superadmin2->assignRole('Superadmin');

        $manager = User::create([
            'userId' => Str::orderedUuid(),
            'name' => 'Galuh Kurniawan',
            'email' => 'galuh.kurniawan@medquest.co.id',
            'username' => 'galuh.kurniawan',
            'password' => Hash::make('Calibration24!'),
        ]);
        $manager->assignRole('Manager');

        $admin = User::create([
            'userId' => Str::orderedUuid(),
            'name' => 'Admin',
            'email' => 'admin@medquest.co.id',
            'username' => 'admin',
            'password' => Hash::make('Calibration24!'),
        ]);
        $admin->assignRole('Admin');

        $teknisi = User::create([
            'userId' => Str::orderedUuid(),
            'name' => 'Teknisi',
            'email' => 'teknisi@medquest.co.id',
            'username' => 'teknisi',
            'password' => Hash::make('Calibration24!'),
        ]);
        $teknisi->assignRole('Teknisi');

        $user = User::create([
            'userId' => Str::orderedUuid(),
            'name' => 'User Rumah Sakit',
            'email' => 'user@medquest.co.id',
            'username' => 'user',
            'password' => Hash::make('Calibration24!'),
        ]);
        $user->assignRole('User');
    }
}
