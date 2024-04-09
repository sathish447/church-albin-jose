<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route( 'admin.dashboard' );;
        }

        return back()->withError('The provided credentials do not match our records.')->withInput($request->only('email'));
    }

    public function logout(Request $request )
    {
       // $this->guard()->logout();
        $request->session()->invalidate();
        return redirect()->route('login');
    }
}
