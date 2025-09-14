<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    public function redirect(string $provider)
    {
        $driver = Socialite::driver($provider);
        if ($provider === 'facebook') {
            $driver = $driver->scopes(['email']); // Facebook often needs this
        }
        return $driver->redirect();  // if you get state errors locally, try ->stateless()->redirect()
    }

    public function callback(string $provider)
    {
        $social = Socialite::driver($provider)->user();

        $email  = $social->getEmail();
        $name   = $social->getName() ?: $social->getNickname() ?: 'User';
        $avatar = $social->getAvatar();

        if ($email) {
            $user = User::firstOrCreate(
                ['email' => $email],
                ['name' => $name, 'password' => bcrypt(Str::random(32))]
            );
        } else {
            $user = User::firstOrCreate(
                ['provider_name' => $provider, 'provider_id' => $social->getId()],
                ['name' => $name, 'password' => bcrypt(Str::random(32))]
            );
        }

        $user->provider_name = $provider;
        $user->provider_id   = $social->getId();

        if ($avatar) {
            if ($provider === 'google') {
                $avatar = preg_replace('/=s\d+-c/', '=s256-c', $avatar);
                if (!str_contains($avatar, 'sz=')) {
                    $avatar .= (str_contains($avatar, '?') ? '&' : '?') . 'sz=256';
                }
            } else if ($provider === 'facebook') {
                $avatar = "https://graph.facebook.com/{$social->getId()}/picture?type=large&width=256&height=256";
            }
        }

        if ($avatar && empty($user->avatar)) {
            $user->avatar = $avatar;
        }
        $user->save();

        Auth::login($user, remember: true);
        return redirect()->intended('/dashboard');
    }
}
