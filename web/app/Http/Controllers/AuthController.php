<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() { return view('login'); }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('admin')->attempt($credentials, false)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        if (Auth::guard('support')->attempt($credentials, false)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        if (Auth::guard('web')->attempt($credentials, false)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['error' => 'Acceso denegado.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
