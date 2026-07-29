<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Throwable;

class AuthController extends Controller
{
    public function showLoginForm()
    {   
        return view('login');
    }

        public function login(Request $request)
        {
            try {
                $request->validate([
                    'username' => 'required|string',
                    'password' => 'required|string',
                ]);

                $user = RegisterUser::where('email', $request->username)
                    ->orWhere('username', $request->username)
                    ->first();

                if (!$user) {
                    return redirect()->route('login', ['error' => 'No account found with this email/username.']);
                }

                if (!Hash::check($request->password, $user->password)) {
                    return redirect()->route('login', ['error' => 'Incorrect password. Please try again.']);
                }

                Auth::login($user);

                return redirect('/');
            } catch (Throwable $e) {
                report($e);

                return redirect()->route('login', ['error' => $e->getMessage()]);
            }
        }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/');
    }


    public function store(Request $request)
    {
        dd($request->all());
    }

    
}


