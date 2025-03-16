<?php

use Illuminate\Support\Facades\Route;

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

// Routes pour l'inscription
Route::get('/inscription', function () {
    return view('inscription', [
        'titre' => "Sup'Food - Inscription"
    ]);
});

Route::post('/inscription', function () {
    // Logique de traitement du formulaire d'inscription
    // À implémenter plus tard
    return redirect('/connexion');
});

// Routes pour la connexion
Route::get('/connexion', function () {
    return view('connexion', [
        'titre' => "Sup'Food - Connexion"
    ]);
});

Route::post('/connexion', function () {
    // Logique de traitement du formulaire de connexion
    // À implémenter plus tard
    return redirect('/welcome');
});

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

