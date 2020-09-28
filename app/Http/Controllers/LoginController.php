<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        $credential = $request->only('email', 'password');

        if (Auth::attempt($credential)) {
            return redirect()->intended('admin');
        }
        return redirect('login')->with('error', 'Opps| You have entered invalid credentials');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
