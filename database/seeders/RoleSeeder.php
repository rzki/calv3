<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'roleId' => Str::orderedUuid(),
            'name' => 'Superadmin',
            'code' => 'superadmin',
        ]);

        Role::create([
            'roleId' => Str::orderedUuid(),
            'name' => 'Admin',
            'code' => 'admin',
        ]);

        Role::create([
            'roleId' => Str::orderedUuid(),
            'name' => 'Teknisi',
            'code' => 'teknisi',
        ]);
    }
}
