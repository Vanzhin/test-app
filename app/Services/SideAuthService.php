<?php

namespace App\Services;

use App\Contracts\SideAuth;
use App\Events\LoginEvent;
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
           $user->last_login_at = now('Asia/Yekaterinburg');

           if($user->save()){
               Auth::loginUsingId($user->id);
               return route('index');
           };

       }else{
           session()->put([
               'socialUser.name' => $socialUser->getName(),
               'socialUser.email' => $socialUser->getEmail(),
               'socialUser.avatar' => $socialUser->getAvatar(),

           ]);
           //TODO удаляю данные сессии в представлении register.blade
           return route('register');
       }
        return back()->with('error', __('Ошибка авторизации через ' . $network));
    }
}
