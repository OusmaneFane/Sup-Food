<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// Page d'accueil (landing)
Route::get('/', function () {
    return view('landing', [
        'titre' => "Sup'Food - Accueil"
    ]);
});

// Page welcome
Route::get('/welcome', function () {
    return view('welcome', [
        'titre' => "Sup'Food - Bienvenue"
    ]);
});

// Dans routes/web.php
Route::middleware('guest')->group(function () {

// Routes pour l'inscription
    Route::get('/inscription', function () {
        return view('inscription', [
            'titre' => "Sup'Food - Inscription"
        ]);
    })->name('inscription');

    Route::post('/inscription', [AuthController::class,"inscription"]);

// Routes pour la connexion
    Route::get('/connexion', function () {
        return view('connexion', [
            'titre' => "Sup'Food - Connexion"
        ]);
    })->name('connexion');

    Route::post('/connexion', [AuthController::class,"connexion"]);


// Routes pour la réinitialisation du mot de passe
Route::get('/mot-de-passe-oublie', function () {
    return view('editpassword', [
        'titre' => "Sup'Food - Nouveau mot de passe"
    ]);
});
Route::post('/mot-de-passe-oublie', function () {
    // Logique de traitement du changement de mot de passe
    // À implémenter plus tard
    return redirect('/connexion');
});

// Route pour la confirmation de changement de mot de passe
Route::get('/mot-de-passe-change', function () {
    return view('editconfirmation', [
        'titre' => "Sup'Food - Mot de passe changé"
    ]);
});
});



// Routes protégées par JWT
Route::middleware(['jwt.session'])->group(function () {

    // Route pour la page d'accueil après connexion
    Route::get('/accueil', function () {
        return view('accueil', [
            'titre' => "Sup'Food - Accueil",
            'user' => "Seydou" // À remplacer par le nom de l'utilisateur connecté
        ]);
    })->name('accueil');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});



