<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request){
        try{
            $user = Auth::user();
            $type = $request->type;
            $value = $request->value;
    
            switch($type){
                case 'nama':
                    $request->validate(['value' => 'required|string|max:255']);
                    $user->full_name = $request->value;
                    $user->save();
                    break;

                case 'email':
                    $request->validate(['value' => 'required|string|email|max:255|unique:users,email']);
                    $user->email = $request->value;
                    $user->save();
                    break;
                    
                case 'password':
                    if (!Hash::check($request->currentPassword, $user->password)){
                        return back()->with('error', 'Error: Password saat ini salah.');
                    }

                    $request->validate(['newPassword' => 'required|string|min:8|confirmed']);
                    $user->password = Hash::make($request->newPassword);
                    $user->save();
                    break;
            }
    
            return back()->with('success', 'Berhasil diganti.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}