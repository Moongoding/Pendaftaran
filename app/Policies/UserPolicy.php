<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function isUser(User $user)
    {
        return $user->hasRole('User'); // Sesuaikan dengan logika Anda
    }

    public function isAdmin(User $user)
    {
        return $user->hasRole('Admin'); // Sesuaikan dengan logika Anda
    }

    public function isSuperAdmin(User $user)
    {
        return $user->hasRole('Super Admin'); // Sesuaikan dengan logika Anda
    }
}
