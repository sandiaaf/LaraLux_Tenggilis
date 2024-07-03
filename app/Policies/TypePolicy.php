<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class TypePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function delete(User $user)
    {
        return ($user->role=='owner'
            ? Response::allow()
            : Response::deny('You must be an administrator'));
    }
    public function deleteCustomer(User $user)
    {
        return ($user->role=='customer'
            ? Response::allow()
            : Response::deny('You must be an administrator'));
    }

}
