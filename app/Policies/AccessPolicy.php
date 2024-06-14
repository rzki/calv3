<?php

namespace App\Policies;

use App\Models\User;

class AccessPolicy
{
    /**
     * Create a new policy instance.
     */
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
}
