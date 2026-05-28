<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request){
        $validated = $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required|string|max:100',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'email' => $validated['email'],
            'name' => $validated['name'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect('/tickets');
    }
    
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|max:255',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if(!$user){
            return back()->withErrors([
                'email' => 'No account with this email',
            ])->onlyInput('email');
        };
        
        if(!Auth::attempt($credentials)){
            return back()->withErrors([
                'password' => 'Wrong password',
            ])->onlyInput('name');
        };

        $request->session()->regenerate();
        return redirect()->intended('/tickets');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'You have been logged out');
    }
}
