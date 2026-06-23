<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $users = User::all();
        return view('role.index', compact('users'));
    }

    public function update(Request $request){
        try{
            $user = User::find($request->user_id);
    
            $user->role = $request->role;
            $user->save();
    
            return back()->with('success', 'Berhasil diganti.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
