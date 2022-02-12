<?php

namespace App\Http\Controllers;

use App\Contracts\SideAuth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SideAuthController extends Controller
{
    public function redirect(string $network)
    {
        return Socialite::driver($network)->redirect();
    }

    public function callback(string $network, SideAuth $service)
    {
        return redirect($service->setUser(
            Socialite::driver($network)->user(),
            $network
        ));


    }
}
