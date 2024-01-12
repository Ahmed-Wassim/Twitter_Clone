<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store()
    {

        $validated = request()->validate([
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8'
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);


        return redirect()->route('dashboard')->with('success', 'Account created successfully');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate()
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt($credentials)) {
            request()->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {

        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('dashboard');
    }
}
