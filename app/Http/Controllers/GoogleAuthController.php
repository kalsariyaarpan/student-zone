<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\RegisterUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
       $googleUser = Socialite::driver('google')->stateless()->user();


        $user = RegisterUser::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            $user = RegisterUser::create([
                'first_name' => $googleUser->getName() ?? 'Google',
                'last_name'  => '',
                'username'   => explode('@', $googleUser->getEmail())[0],
                'email'      => $googleUser->getEmail(),
                'password'   => Hash::make(uniqid()), // dummy password
            ]);
        }

        Auth::login($user);

        return redirect()->route('account.profile'); // change if needed
    }
}
