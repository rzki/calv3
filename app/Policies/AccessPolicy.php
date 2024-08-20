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
    // Alat
    public function devices(User $user)
    {
        return $user->hasRole('Superadmin') || $user->hasRole('Admin') || $user->hasRole('Teknisi') || $user->hasRole('Manager');
    }
    public function createDevices(User $user)
    {
        return $user->hasRole('Superadmin') || $user->hasRole('Admin') || $user->hasRole('Teknisi');
    }
    public function editDevices(User $user)
    {
        return $user->hasRole('Superadmin') || $user->hasRole('Admin') || $user->hasRole('Teknisi');
    }

    public function inventories(User $user)
    {
        return $user->hasRole('Admin') ;
    }

    // LogBook
    public function logbooks(User $user)
    {
        return $user->hasRole('Superadmin') || $user->hasRole('Admin') || $user->hasRole('Teknisi') || $user->hasRole('Manager');
    }
    public function createLogbooks(User $user)
    {
        return $user->hasRole('Superadmin') || $user->hasRole('Admin') || $user->hasRole('Teknisi');
    }
    public function editLogbooks(User $user)
    {
        return $user->hasRole('Superadmin') || $user->hasRole('Admin') || $user->hasRole('Teknisi');
    }
    public function userRS(User $user)
    {
        return $user->hasRole('Superadmin') || $user->hasRole('Admin') ||  $user->hasRole('User');
    }
}
