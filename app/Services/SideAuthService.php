<?php

namespace App\Services;

use App\Contracts\SideAuth;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Contracts\User;
use App\Models\User as Model;

class SideAuthService implements SideAuth
{

    public function setUser(User $socialUser, string $network): string
    {
       $user = Model::query()->where('email', $socialUser->getEmail())->first();
       if ($user){
           $user->name = $socialUser->getName();
           $user->avatar = $socialUser->getAvatar();
           if($user->save()){
               Auth::loginUsingId($user->id);
               return route('account');
           };

       }else{
           return redirect('register')->with('error', __('Ошибка авторизации через ' . $network));
       }
        return back()->with('error', __('Ошибка авторизации через ' . $network));
    }
}
