<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // On récupère le token depuis la session (ou depuis un cookie, un header, selon ton choix)
        $token = session('jwt_token');
        if (! $token) {
            // Si pas de token, on redirige vers la connexion
            return redirect()->route('connexion')->withErrors(['error' => 'Aucun token trouvé']);
        }

        // Vérification du token
        try {
            // On "set" le token qu'on veut tester
            $user = JWTAuth::setToken($token)->authenticate();
            if (!$user) {
                return redirect()->route('connexion')->withErrors(['error' => 'Token invalide']);
            }
        } catch (JWTException $e) {
            return redirect()->route('connexion')->withErrors(['error' => 'Token expiré ou invalide']);
        }

        // Si tout est OK, on continue la requête
        return $next($request);
    }
}
