<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        //dd(User::first()->permission->level_access);
        return view('layouts.users');
    }

    public function changePassword() {
        if (!Auth::check()) {
            return redirect('/');
        }
        return view('auth.change-password');
    }

    public function create(){
        return 1;
    }
    public function store(){
        return 2;
    }
    public function show(){
        return 3;
    }


    public function edit(){

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
    public function destroy(){
        return 6;

    }
}
