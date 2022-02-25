<?php

namespace App\Http\Controllers;

use App\Contracts\SideAuth;
use App\Events\LoginEvent;
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
        dd($network, $service, Socialite::driver($network)->user());
        return redirect($service->setUser(
            Socialite::driver($network)->user(),
            $network
        ));


    }
}
