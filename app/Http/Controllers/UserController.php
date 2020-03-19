<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        dd(User::first()->permission->level_access);
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
        return 4;
    }
    public function update(){
        return 5;
    }
    public function destroy(){
        return 6;

    }
}
