<?php

namespace App\Policies;

use App\Models\User;

class AccessPolicy
{
    /**
     * Create a new policy instance.
     */

    // Role-based Access
    public function adminAccess(User $user)
    {
        return $user->hasRole('Superadmin') || $user->hasRole('Admin');
    }
    public function managerAccess(User $user)
    {
        return $user->hasRole('Manager');
    }
    public function technicianAccess(User $user)
    {
        return $user->hasRole('Teknisi');
    }
    public function userAccess(User $user)
    {
        return $user->hasRole('User');
    }

    public function internal(User $user)
    {
        return $user->hasRole('Superadmin') || $user->hasRole('Admin') || $user->hasRole('Teknisi');
    }

    // Per Menu Access
    public function devices(User $user)
    {
        return $user->hasRole('Superadmin') || $user->hasRole('Admin') || $user->hasRole('Teknisi');
    }
    public function device_names(User $user)
    {
        return $user->hasRole('Superadmin') || $user->hasRole('Admin');
    }
    public function inventories(User $user)
    {
        return $user->hasRole('Admin')  ;
    }
}
