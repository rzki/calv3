<?php

namespace App\Policies;

use App\Models\User;

class AccessPolicy
{
    /**
     * Create a new policy instance.
     */
    public function accessHospitals(User $user)
    {
        return $user->hasRole('Superadmin') || $user->hasRole('Admin');
    }

    public function accessUsers(User $user)
    {
        return $user->hasRole('Superadmin') || $user->hasRole('Admin');
    }
    public function accessRoles(User $user)
    {
        return $user->hasRole('Superadmin');
    }
}
