<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Command;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CommandsExport;

class ReportsController extends Controller
{
 public function index(Request $request)
    {
        $period = $request->period;
        $date = $request->date;

        // Filtres personnalisés
        if ($period === 'day' && $date) {
            $start = Carbon::parse($date)->startOfDay();
            $end = Carbon::parse($date)->endOfDay();
        } elseif ($period === 'month' && $date) {
            $start = Carbon::parse($date)->startOfMonth();
            $end = Carbon::parse($date)->endOfMonth();
        } else {
            // Filtre classique : intervalle personnalisé ou ce mois
            $start = $request->start_date ? Carbon::parse($request->start_date) : now()->startOfMonth();
            $end = $request->end_date ? Carbon::parse($request->end_date) : now()->endOfDay();
        }

        $commands = Command::with('user')
            ->whereBetween('created_at', [$start, $end])
            ->latest()
            ->get();

        $stats = [
            'total_orders' => $commands->count(),
            'revenue' => $commands->sum('total_price'),
            'active_users' => $commands->groupBy('user_id')->count(),
        ];

        return view('admins.rapports', compact('commands', 'stats'));
    }

    public function export(Request $request, $format)
    {
        $period = $request->period;
        $date = $request->date;

        if (!$period || !$date) {
            return back()->with('error', 'Période ou date non spécifiée.');
        }

        // Récupération des commandes selon la période
        if ($period === 'day') {
            $start = Carbon::parse($date)->startOfDay();
            $end = Carbon::parse($date)->endOfDay();
        } elseif ($period === 'month') {
            $start = Carbon::parse($date)->startOfMonth();
            $end = Carbon::parse($date)->endOfMonth();
        } else {
            return back()->with('error', 'Période invalide.');
        }

        $commands = Command::with('user')
            ->whereBetween('created_at', [$start, $end])
            ->get();

        if ($format === 'pdf') {
            $pdf = PDF::loadView('admins.exports.commands-pdf', compact('commands', 'period', 'date'));
            return $pdf->download("rapport_{$period}_{$date}.pdf");
        }

        if ($format === 'excel') {
            return Excel::download(new CommandsExport($commands), "rapport_{$period}_{$date}.xlsx");
        }

        return back()->with('error', 'Format non supporté.');
    }
    public function download(Request $request, $type)
{
    $format = $request->query('format', 'pdf'); // par défaut pdf

    if (!in_array($format, ['pdf', 'excel'])) {
        return back()->with('error', 'Format non supporté.');
    }

    if ($type === 'daily') {
        $start = now()->startOfDay();
        $end = now()->endOfDay();
    } elseif ($type === 'monthly') {
        $start = now()->startOfMonth();
        $end = now()->endOfMonth();
    } else {
        return back()->with('error', 'Type de rapport invalide.');
    }

    $commands = Command::with(['user', 'details.product'])
        ->whereBetween('created_at', [$start, $end])
        ->get();

$period = $type; // pour être cohérent avec la vue
$date = now()->format('Y-m-d');
$filename = "rapport-{$type}-" . now()->format('Ymd_His');

    if ($format === 'pdf') {
        $pdf = PDF::loadView('admins.exports.commands-pdf', compact('commands', 'type', 'date', 'period', 'start', 'end'));
        return $pdf->download("{$filename}.pdf");
    }

    if ($format === 'excel') {
        return Excel::download(new \App\Exports\ReportExport($commands), "{$filename}.xlsx");
    }

    return back()->with('error', 'Une erreur est survenue.');
}


}
