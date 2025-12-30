<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function edit(User $user)
    {
        // $user é admin ou não
        return $user->roles()->where('name', 'admin')->exists();
    }
    public function destroy(User $user)
    {
        // $user é admin ou não
        return $user->roles()->where('name', 'admin')->exists();
    }
}
