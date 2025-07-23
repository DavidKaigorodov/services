<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\Login\LoginRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function login(){
        return Inertia::render('auth/Login');
    }

    public function auhtificate(LoginRequest $request){
        if (Auth::attempt($request->only('email', 'password')))
            return redirect()->route('home');

        return back()->withErrors(['form' => 'Неверный логин или пароль' ]);
    }
}
