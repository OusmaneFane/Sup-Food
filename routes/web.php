<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CommandesController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\StatistiquesController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\PaymentController;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

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

// Route pour la page d'accueil après connexion
Route::get('/accueil', [HomeController::class, 'index'])->name('accueil');

Route::get('/commandes', [CommandesController::class, 'index'])->name('commandes.liste');
Route::get('/panier', [PanierController::class, 'index']);

Route::get('/dashboard', [AdminsController::class, 'index'])->name('admin.dashboard');


// CRUD utilisateurs (sans middleware pour l’instant)
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

Route::prefix('admin')->group(function () {
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
});
Route::get('/confirm-commande', [CommandesController::class, 'showCommande'])->name('commande');
Route::post('/commander', [CommandesController::class, 'store'])->name('commander.store');

// routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/commandes', [CommandesController::class, 'admin_index'])->name('admin.commands.index');
    Route::post('/admin/commandes/{id}/valider', [CommandesController::class, 'valider'])->name('admin.commands.valider');
    Route::post('/admin/commandes/{id}/annuler', [CommandesController::class, 'annuler'])->name('admin.commands.annuler');
});

Route::get('/admin/stats', [StatistiquesController::class, 'index'])
    ->name('admin.statistiques')
    ->middleware('auth');

Route::prefix('admin')->group(function () {
    Route::get('/rapports', [ReportsController::class, 'index'])->name('reports.index');
// ✅ Routes de téléchargement journalier et mensuel
    Route::get('/reports/download/{type}', [ReportsController::class, 'download'])->name('reports.download');
    // ✅ Optionnel : route d’export spécifique avec une date
    Route::get('/reports/export/{date}/{format}', [ReportsController::class, 'export'])->name('admin.reports.export');});

    // routes/web.php

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/commandes/{command}/paiement', [PaymentController::class, 'create'])->name('admin.payments.create');
    Route::post('/commandes/{command}/paiement', [PaymentController::class, 'store'])->name('admin.payments.store');
    Route::get('/admin/payments/{payment}/receipt', [PaymentController::class, 'receipt'])->name('admin.payments.receipt');
    Route::get('/paiements', [PaymentController::class, 'index'])->name('admin.payments.index');
    Route::get('/payments/export/{format}', [PaymentController::class, 'export'])->name('admin.payments.export');

});



