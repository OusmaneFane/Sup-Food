<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Command;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Events\CommandeValidee;
 use Carbon\Carbon;

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
    $status     = $request->get('status');
    $search     = $request->get('search');
    $startDate  = $request->get('start_date');
    $endDate    = $request->get('end_date');

    // Si aucun filtre de date n’est spécifié, on met par défaut la date du jour
    if (!$startDate && !$endDate) {
        $startDate = Carbon::today()->format('Y-m-d');
        $endDate   = Carbon::today()->format('Y-m-d');
    }

    $commands = Command::with(['user', 'details.product', 'payment'])
        ->when($status, fn($q) => $q->where('status', $status))
        ->when($search, function ($q) use ($search) {
            $q->whereHas('user', fn($query) =>
                $query->where('name', 'like', "%{$search}%")
            )
            ->orWhere('delivery_address', 'like', "%{$search}%");
        })

        // Filtre par date
        ->when($startDate, fn($q) => $q->whereDate('created_at', '>=', $startDate))
        ->when($endDate,   fn($q) => $q->whereDate('created_at', '<=', $endDate))

        ->latest()
        ->paginate(10);

    return view('admins.commands.index', [
        'commands'  => $commands,
        'startDate' => $startDate,
        'endDate'   => $endDate,
        'status'    => $status,
        'search'    => $search
    ]);
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
    
    public function fetchLive()
{
    $commands = \App\Models\Command::with('details.product')
        ->where('user_id', Auth::id())
        ->latest()
        ->get();

    return response()->json([
        'html' => view('partials.commands', compact('commands'))->render()
    ]);
}
public function admin_index_partial(Request $request)
{
    $status = $request->status;
    $search = $request->search;
    $date   = $request->date;  // si tu veux filtrer par date

    $query = Command::with(['user', 'details.product', 'payment'])
        ->when($status, fn($q) => $q->where('status', $status))
        ->when($search, function ($q) use ($search) {
            $q->whereHas('user', fn($query) => $query->where('name', 'like', "%$search%"))
              ->orWhere('delivery_address', 'like', "%$search%");
        });

    // Exemple de filtre par date du jour
    // "date" peut être '2023-04-05', ou 'today', etc.
    if ($date === 'today') {
        $query->whereDate('created_at', '=', now()->toDateString());
    }

    $commands = $query->latest()->paginate(10);

    // On renvoie seulement la partial
    return view('admins.commands.list', compact('commands'));
}



}
