<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {   
        return view('login');
    }

        public function login(Request $request)
        {
            // Validate input
            $request->validate([
                'username' => 'required|string', // username OR email
                'password' => 'required|string',
            ]);

            // Find user by email OR username
            $user = RegisterUser::where('email', $request->username)
                        ->orWhere('username', $request->username)
                        ->first();

            if (!$user) {
                return back()->with('error', 'No account found with this email/username.');
            }

            // Check password
            if (!Hash::check($request->password, $user->password)) {
                return back()->with('error', 'Incorrect password. Please try again.');
            }

            // Correct → Login
            Auth::login($user);

            return redirect('/')->with('success', 'Logged in successfully!');
        }

    public function logout(Request $request)
    {
        Auth::logout(); // Logs out the user
        $request->session()->invalidate(); // Invalidate session
        $request->session()->regenerateToken(); // CSRF token protection

    return redirect('/')->with('success', 'Logged out successfully.');
    }


    public function store(Request $request)
    {
    
        dd($request->all());
    
    }

    
}


