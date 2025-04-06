<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'name' => 'required|string',
        'password' => 'required|string'
    ]);

    // 2. Sinon vérifier avec l'API externe
    $apiResponse = Http::post('https://api-staging.supmanagement.ml/auth/login', [
        'username' => $credentials['name'],
        'password' => $credentials['password'],
        'rememberMe' => true
    ]);
    // 1. Vérifier localement d'abord
    $localUser = User::where('name', $credentials['name'])->first();

    if ($localUser && Hash::check($credentials['password'], $localUser->password)) {
          Auth::login($localUser);
         $token = $apiResponse->body();
         $request->session()->put('PasseUser', $token);

        $apiResponse = Http::withToken($token)->get(
                'https://api-staging.supmanagement.ml/users/current'
            );
            $studentInfos = $apiResponse->json();
           
        return $this->redirectByRole($localUser, $studentInfos);
    }

    
    //dd($response->body());
     $data = $apiResponse->json();
    if ($data == null) {
        $token = $apiResponse->body();
        $apiResponse = Http::withToken($token)->get(
                'https://api-staging.supmanagement.ml/users/current'
            );
            //dd($apiResponse->ok());
        $apiUser = $apiResponse->json();
         dd($apiUser);
        if (!$apiResponse->ok()) {
            return back()->withErrors([
                'name' => 'Impossible de récupérer les informations de l’utilisateur distant.',
            ]);
        }

         // 4. Création de l'utilisateur local
    $newUser = User::create([
       'name' => $apiUser['username'],
        'email' => $apiUser['email'] ?? $credentials['name'] . '@externe.com',
        'password' => bcrypt($credentials['password']),
        'role' => $apiUser['role'] ?? 'etudiant'
    ]);

    Auth::login($newUser);
    $request->session()->regenerate();

    return $this->redirectByRole($newUser);
    }

    return back()->withErrors([
        'name' => 'Identifiants incorrects.',
    ]);
}

// Redirection selon rôle
protected function redirectByRole($user,  $studentInfos = null)
{
    switch ($user->role) {
        case 'superadmin':
        case 'admin':
        case 'gestionnaire':
            return redirect()->intended('/dashboard');
        case 'etudiant':
           return redirect()->intended('/accueil')->with('studentInfos', $studentInfos);
        default:
            Auth::logout();
            return redirect('/login')->withErrors([
                'name' => 'Rôle utilisateur inconnu.',
            ]);
    }
}



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
