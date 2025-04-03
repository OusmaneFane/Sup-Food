<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Redirection selon le rôle
        $role = Auth::user()->role;
        
        switch ($role) {
            case 'superadmin':
                return redirect()->intended('/dashboard');
            case 'admin':
                return redirect()->intended('/dashboard');
            case 'gestionnaire':
                return redirect()->intended('/dashboard');
            case 'etudiant':
                return redirect()->intended('/accueil');
            default:
                Auth::logout();
                return redirect('/login')->withErrors([
                    'email' => 'Rôle utilisateur inconnu.',
                ]);
        }
    }

    return back()->withErrors([
        'email' => 'Email ou mot de passe incorrect.',
    ]);
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
