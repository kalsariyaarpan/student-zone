<?php

namespace App\Http\Controllers;

use App\Models\RegisterUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class RegisterUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // asc, desc
        $users =  RegisterUser::orderBy('created_at' , 'desc')->take(1)->get();
        return view('fields.index',compact('users')); 
   }



    //reset passsword:-         
        public function accountSettings()
        {
            return view('account.settings');
        }

        public function updatePassword(Request $request)
        {
            $request->validate([
                'current_password' => 'required',
                'password' => 'required',
                'password_confirmation' => 'required'
            ]);
            $user = Auth::user();

            if (!$user) {
                return back()->with('error', 'User not found.');
            }
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('error', 'Current password is incorrect.');
            }

            $user->password = Hash::make($request->password);
            $user->save();
            return back()->with('success', 'Password updated successfully!');
        }

        public function updateTheme(Request $request)
        {
            $request->validate([
                'theme' => 'required|in:light,dark',
            ]);

            $user = Auth::user();
            if (!$user) {
                return back()->with('error', 'User not found.');
            }

            $user->theme = $request->input('theme');
            $user->save();

            return back()->with('success', 'Theme updated successfully!');
        }
   
        /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {

    //     $validated = $request->validate([
    //     'username'    => 'required|string|max:50|unique:register_users,username',
    //     'first_name'  => 'required|string|max:50',
    //     'last_name'   => 'required|string|max:50',
    //     'email'       => 'required|email|unique:register_users,email',
    //     'password'    => 'required|string|min:6|confirmed',
    // ]);

    //      $user = RegisterUser::create([
    //     'username'    => $validated['username'],
    //     'first_name'  => $validated['first_name'],
    //     'last_name'   => $validated['last_name'],
    //     'email'       => $validated['email'],
    //     'password'    => Hash::make($validated['password']),
    // ]);

    //     // Auth::login($user); 
        
    //     return redirect()->back()->with('success', 'User registered successfully!');
    // }

// public function store(Request $request)
// {
//     $validated = $request->validate([
//         'username'    => 'required|string|max:50|unique:register_users,username',
//         'first_name'  => 'required|string|max:50',
//         'last_name'   => 'required|string|max:50',
//         'email'       => 'required|email|unique:register_users,email',
//         'password'    => 'required|string|min:6|confirmed',
//     ]);

//     $user = RegisterUser::create([
//         'username'    => $validated['username'],
//         'first_name'  => $validated['first_name'],
//         'last_name'   => $validated['last_name'],
//         'email'       => $validated['email'],
//         'password'    => Hash::make($validated['password']),
//     ]);

//     // MAKE SURE THIS IS REMOVED:
//     // Auth::login($user);

//     // return redirect()
//     //     ->route('login')
//     //     ->with('Account created successfully! You can now log in.');

//     return redirect()
//     ->route('login')
//     ->with('success', 'Account created successfully! You can now log in.');


//     }


public function store(Request $request)
{
    $validated = $request->validate([
        'username'    => 'required|string|max:50|unique:register_users,username',
        'first_name'  => 'required|string|max:50',
        'last_name'   => 'required|string|max:50',
        'email'       => 'required|email|unique:register_users,email',
        'password'    => 'required|string|min:6|confirmed',
    ]);

    RegisterUser::create([
        'username'    => $validated['username'],
        'first_name'  => $validated['first_name'],
        'last_name'   => $validated['last_name'],
        'email'       => $validated['email'],
        'password'    => Hash::make($validated['password']),
    ]);

    return redirect()
        ->route('login')
        ->with('success', 'Account created successfully! You can now log in.');
}


    /**
     * Display the specified resource.
     */
    public function show(RegisterUser $registerUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RegisterUser $registerUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RegisterUser $registerUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RegisterUser $registerUser)
    {
        //
    }

  public function checkEmail(Request $request)
{
    return response()->json([
        'exists' => RegisterUser::where('email', $request->email)->exists()
    ]);
}


}
