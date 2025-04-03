<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Command;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Events\CommandeValidee;


class CommandesController extends Controller
{
     public function index()
    {
        // Récupère toutes les commandes de l'utilisateur connecté avec les détails
        $commands = auth()->user()->commands()
                        ->with('details.product') // Charge les relations
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('commande', compact('commands'));
    }

    public function showCommande()
{
    return view('students.confirm-commande');
}
   public function store(Request $request)
{
    $validated = $request->validate([
        'delivery_address' => 'required|string',
        'payment_method' => 'required|string',
        'cart_json' => 'required|json'
    ]);

    $cart = json_decode($validated['cart_json'], true);

    // Calcul des totaux
    $totalItems = array_sum(array_column($cart, 'qty'));
    $totalPrice = array_sum(array_map(function($item) {
        return $item['price'] * $item['qty'];
    }, $cart));

    // Création de la commande
    $command = Command::create([
        'user_id' => auth()->id(),
        'delivery_address' => $validated['delivery_address'],
        'payment_method' => $validated['payment_method'],
        'total_items' => $totalItems,
        'total_price' => $totalPrice
    ]);

    // Ajout des détails
    foreach ($cart as $item) {
        $command->details()->create([
            'product_id' => $item['id'],
            'quantity' => $item['qty'],
            'unit_price' => $item['price'],
        ]);
    }
   


    return redirect()->route('commandes.liste')->with('success', 'Commandes éffectué');
}
   public function admin_index(Request $request)
{
    $status = $request->status;
    $search = $request->search;

    $commands = Command::with(['user', 'details.product', 'payment'])
        ->when($status, fn($q) => $q->where('status', $status))
        ->when($search, function ($q) use ($search) {
            $q->whereHas('user', fn($query) => $query->where('name', 'like', "%$search%"))
              ->orWhere('delivery_address', 'like', "%$search%");
        })
        ->latest()
        ->paginate(10);

    return view('admins.commands.index', compact('commands'));
}

     public function valider($id)
    {
        $command = Command::findOrFail($id);
        $command->status = 'validée';
        $command->save();
        // ⚡ Émettre l'événement pour informer l'utilisateur en temps réel
        broadcast(new CommandeValidee($command))->toOthers();
        return redirect()->back()->with('success', 'Commande validée.');
    }

    public function annuler($id)
    {
        $command = Command::findOrFail($id);
        $command->status = 'annulée';
        $command->save();

        return redirect()->back()->with('success', 'Commande annulée.');
    }



}
