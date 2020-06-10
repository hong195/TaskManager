<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function changePassword() {
        if (!Auth::check()) {
            return redirect('/');
        }
        return view('auth.change-password');
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,User $user){
        $request->validate([
            'password' => 'required'
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/');
    }
}
