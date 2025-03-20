<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ConnexionRequest;
use App\Http\Requests\inscriptionRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    function inscription(inscriptionRequest $request){
        $user = new User();
        $hashedPwd = Hash::make($request['password'], [
            'rounds' => 12,
        ]);
        $user->name = $request['name'];
        $user->matricule = $request['matricule'];
        $user->email = $request['email'];
        $user->password  = $hashedPwd;

        $user->save();

        return   to_route('connexion',["success"=>"Inscription avec success"]);
    }

    function connexion(ConnexionRequest $request){
        $validated = $request->validated();

        $credentials = $request->only('email', 'password');

        $user = null;
        if (filter_var($credentials['email'], FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $credentials['email'])->first();
        } else {
            if (preg_match('/^\d{7}$/', $credentials['email'])) {
                $user = User::where('matricule', $credentials['email'])->first();
            }
        }

        if ($user && Hash::check($credentials['password'], $user->password)) {
            $token = JWTAuth::fromUser($user);
            session(['jwt_token' => $token]);
            Auth::login($user);
            return redirect()->intended('/accueil')->with('success', 'Connexion réussie');
        }
        return back()->withErrors([
            'email' => 'Les informations de connexion sont incorrectes.',
        ]);


    }

    // Déconnexion
    function logout()
    {
        try {
            $token = session('jwt_token');
            if ($token) {
                JWTAuth::invalidate($token);
            }
            Auth::logout();
            session()->forget('jwt_token');

            return redirect()->route('connexion')->with('message', 'Déconnexion réussie');
        } catch (JWTException $e) {
            return redirect()->route('acceuil')->withErrors(['error' => 'Erreur lors de la déconnexion']);
        }
    }
}
