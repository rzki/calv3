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
        return $user->hasRole('Superadmin') || $user->hasRole('Manager') ||$user->hasRole('Admin');
    }
}
