<?php

namespace App\Policies;

use App\Models\User;

class AccessPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewHospitals(User $user)
    {
        return $user->hasRole('Superadmin') || $user->hasRole('Admin');
    }

    public function viewUsers(User $user)
    {
        return $user->hasRole('Superadmin') || $user->hasRole('Admin');
    }
    public function viewRoles(User $user)
    {
        return $user->hasRole('Superadmin');
    }
}
