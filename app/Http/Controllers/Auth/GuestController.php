<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GuestController extends Controller
{
    public function store()
    {
        $user = User::create([
            'name' => 'Guest',
            'email' => 'guest_' . Str::random(16) . '@guest.local',
            'password' => bcrypt(Str::random(32)),
            'is_guest' => true,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}