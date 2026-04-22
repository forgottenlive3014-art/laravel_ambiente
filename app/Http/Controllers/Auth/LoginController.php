<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        $email = Cookie::get('user_email');
        return view('auth.login', compact('email'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'remember' => 'boolean'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Credenciales incorrectas']);
        }

        if ($user->isBlocked()) {
            $minutos = now()->diffInMinutes($user->blocked_until);
            return back()->withErrors(['email' => "Usuario bloqueado. Intente en {$minutos} minutos"]);
        }

        if (Auth::attempt($request->only('email', 'password'), $request->remember)) {
            $user->resetLoginAttempts();
            
            if ($request->remember) {
                Cookie::queue('user_email', $request->email, 43200);
            }
            
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        $user->incrementLoginAttempts();
        return back()->withErrors(['email' => 'Credenciales incorrectas']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Cookie::queue(Cookie::forget('user_email'));
        return redirect('/');
    }
}