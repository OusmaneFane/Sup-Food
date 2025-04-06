<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Command;
use App\Models\Product;
use App\Models\User;
class AdminsController extends Controller
{
       public function index()
{
    return view('admins.dashboard', [
        'productsCount' => Product::count(),
        'commandsCount' => Command::count(),
        'usersCount' => User::count(),
        'totalRevenue' => Command::where('status', 'validée')->sum('total_price'),
        'recentCommands' => Command::latest()->with('user')->take(5)->get(),
        'weeklyLabels' => ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
        'weeklyOrders' => [5, 12, 9, 7, 14, 8, 11],
        'statusCount' => [
            'validée' => Command::where('status', 'validée')->count(),
            'en_attente' => Command::where('status', 'en_attente')->count(),
            'refusée' => Command::where('status', 'refusée')->count(),
        ]
    ]);
}

    public function marquerCommeRecuperee(Command $command)
{
    $command->recuperation()->update([
        'recuperee' => true,
        'recuperee_at' => now()
    ]);

    return back()->with('success', 'Commande marquée comme récupérée');
}




}
