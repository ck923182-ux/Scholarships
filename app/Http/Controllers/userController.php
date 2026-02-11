<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\userRegisterValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;





class userController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(userRegisterValidation $request)
    {

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registration successful! Please log in.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }
        return redirect('/login')->with('error', 'Invalid credentials. Please try again.');
    }
}
