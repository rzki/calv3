<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Superadmin',
        ]);
        Role::create([
            'name' => 'Manager'
        ]);
        Role::create([
            'name' => 'Admin',
        ]);
        Role::create([
            'name' => 'Teknisi',
        ]);
        Role::create([
            'name' => 'User',
        ]);
    }
}
