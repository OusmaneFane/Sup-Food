<?php
// app/Http/Controllers/Admin/PaymentController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Command;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentReceipt; 
use Carbon\Carbon;

class PaymentController extends Controller
{
public function index(Request $request)
{
    $query = Payment::with(['command.user', 'user']);

    if ($request->start) {
        $query->where('created_at', '>=', Carbon::parse($request->start));
    }
    if ($request->end) {
        $query->where('created_at', '<=', Carbon::parse($request->end)->endOfDay());
    }
    if ($request->method) {
        $query->where('payment_method', $request->method);
    }
    if ($request->user) {
        $query->whereHas('command', fn($q) => $q->where('user_id', $request->user));
    }

    $payments = $query->latest()->get();

    return view('admins.payments.index', [
        'payments' => $payments,
        'methods' => Payment::distinct()->pluck('payment_method'),
        'clients' => User::whereIn('id', Command::pluck('user_id'))->get(),
        'stats' => [
            'count' => $payments->count(),
            'total' => $payments->sum('amount_given'),
            'change' => $payments->sum('change_due')
        ],
        'filters' => $request->only(['start', 'end', 'method', 'user'])
    ]);
}
    

    public function create($commandId)
    {
        $command = Command::findOrFail($commandId);
        return view('admins.payments.create', compact('command'));
    }

    public function store(Request $request, $commandId)
    {
        $request->validate([
            'amount_given' => 'required|integer|min:0',
            'payment_method' => 'required|string',
        ]);

        $command = Command::findOrFail($commandId);

        if ($command->status !== 'validée') {
            return back()->with('error', 'La commande doit être validée avant paiement.');
        }

        $amountGiven = $request->amount_given;
        $changeDue = max(0, $amountGiven - $command->total_price);

        $payment = Payment::create([
            'command_id' => $command->id,
            'user_id' => Auth::id(),
            'amount_given' => $amountGiven,
            'change_due' => $changeDue,
            'payment_method' => $request->payment_method,
        ]);

        // Générer le reçu PDF
        $pdf = PDF::loadView('admins.pdf.receipt', compact('payment', 'command'));
        $pdfPath = storage_path("app/public/receipt_{$payment->id}.pdf");
        $pdf->save($pdfPath);

        // Envoi d'email avec pièce jointe
        if ($command->user && $command->user->email) {
            try {
                Mail::send('admins.emails.payment_confirmation', compact('command', 'payment'), function ($message) use ($command, $pdfPath) {
                    $message->to($command->user->email)
                            ->subject("Confirmation de paiement - Commande #{$command->id}")
                            ->attach($pdfPath);
                });
                // Ajoutez un message de succès ici si nécessaire
            } catch (\Exception $e) {
                // Gérer l'erreur d'envoi d'email
                return back()->with('error', 'Erreur lors de l\'envoi de l\'email : ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.commands.index')->with('success', 'Paiement enregistré avec succès.');
    }
    public function receipt(Payment $payment)
{
    $pdf = \PDF::loadView('admins.exports.receipt', compact('payment'));
    return $pdf->download('recu-paiement-' . $payment->id . '.pdf');
}


}
