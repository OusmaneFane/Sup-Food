<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Command;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class StatistiquesController extends Controller
{
    public function index()
    {
        $products = Product::count();
        $orders = Command::count();
        $users = User::count();
        $revenue = Command::sum('total_price');

        // Commandes par mois
        $monthly = Command::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $monthlyLabels = collect(range(1, 12))->map(fn($m) => Carbon::create()->month($m)->locale('fr_FR')->translatedFormat('F'));
        $monthlyOrders = $monthlyLabels->map(fn($month, $index) => $monthly->get($index + 1, 0));

        // Produits les plus commandés
        $topProducts = DB::table('command_details')
            ->join('products', 'command_details.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(command_details.quantity) as total'))
            ->groupBy('products.name')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('admins.statistics', [
            'products' => $products,
            'orders' => $orders,
            'users' => $users,
            'revenue' => $revenue,
            'monthlyLabels' => $monthlyLabels,
            'monthlyOrders' => $monthlyOrders,
            'topProductsLabels' => $topProducts->pluck('name'),
            'topProductsQuantities' => $topProducts->pluck('total'),
        ]);
    }
}
