<?php

namespace App\Imports;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row): ?\Illuminate\Database\Eloquent\Model
    {
        $user = User::create([
            'userId' => Str::orderedUuid(),
            'name' => $row['name'],
            'username' => strtolower(str_replace(' ', '_', $row['name'])),
            'email' => strtolower($row['email']),
            'password' => Hash::make('Calibration24!')
        ]);
        $role = Role::findById($row['role_id']);
        $user->assignRole($role);
        return $user;
    }
}
