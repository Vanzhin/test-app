<?php

namespace App\Contracts;

use Laravel\Socialite\Contracts\User;

interface SideAuth
{
    /**
     * @param User $socialUser
     * @param string $network
     * @return string
     */
    public function setUser(User $socialUser, string $network) : string;

}
