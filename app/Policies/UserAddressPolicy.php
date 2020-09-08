<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserAddressPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    /**
     * 判断是否是自己的地址
     * @param User $user
     * @param UserAddress $userAddress
     * @return bool
     */
    public function own(User $user, UserAddress $userAddress)
    {
        return $user->id == $userAddress->user_id;
    }
}
