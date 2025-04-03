@extends('layouts.main')
@php use Illuminate\Support\Str; @endphp
@section('content')
    <div class="min-h-screen bg-gray-50 p-6">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                    📦 Gestion des Commandes
                </h1>
                <p class="text-sm text-gray-500">Mis à jour à {{ now()->format('H:i') }}</p>
            </div>

            <!-- Filtres -->
            <div class="flex gap-2 flex-wrap mb-6">
                <x-admin.command-filter label="Toutes" route="admin.commands.index" :active="request('status') === null" />
                <x-admin.command-filter label="En attente" route="admin.commands.index" :params="['status' => 'en_attente']" :active="request('status') === 'en_attente'" />
                <x-admin.command-filter label="Validées" route="admin.commands.index" :params="['status' => 'validée']" :active="request('status') === 'validée'" />
                <x-admin.command-filter label="Annulées" route="admin.commands.index" :params="['status' => 'annulée']" :active="request('status') === 'annulée'" />
            </div>
            <form method="GET" class="mb-6 flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Rechercher..."
                    class="px-4 py-2 border border-gray-200 rounded-lg shadow-sm w-full md:w-64 focus:outline-none focus:ring focus:border-blue-300">
                @if (request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-all">
                    Rechercher
                </button>
            </form>

            <!-- Liste des commandes -->
            <div class="grid gap-4">
                @forelse ($commands as $command)
                    <div class="bg-white rounded-xl shadow border border-gray-100 p-5 space-y-4">
                        <div class="flex justify-between items-start md:items-center flex-col md:flex-row gap-4">
                            <div class="flex items-center gap-3">
                                <div class="p-3 bg-blue-50 rounded-lg">
                                    <svg class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-800">{{ $command->user->name }}</h2>
                                    <p class="text-sm text-gray-500">{{ Str::limit($command->delivery_address, 40) }}</p>
                                    <p class="text-xs text-gray-400 mt-1">{{ $command->created_at->format('d/m/Y H:i') }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 flex-wrap">
                                @if ($command->status === 'en_attente')
                                    <x-admin.command-action :command="$command" />
                                @elseif ($command->status === 'validée' && !$command->payment)
                                    <a href="{{ route('admin.payments.create', $command->id) }}"
                                        class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm shadow">
                                        💵 Effectuer le Paiement
                                    </a>
                                @elseif ($command->payment)
                                    <a href="{{ route('admin.payments.receipt', $command->payment->id) }}"
                                        class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm shadow">
                                        👁 Voir Paiement
                                    </a>
                                @endif

                                <span
                                    class="px-3 py-1 rounded-full text-xs font-medium
                                {{ $command->status === 'validée'
                                    ? 'bg-green-100 text-green-700'
                                    : ($command->status === 'annulée'
                                        ? 'bg-red-100 text-red-700'
                                        : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ ucfirst($command->status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Détails -->
                        <details class="bg-gray-50 rounded-lg p-4">
                            <summary class="cursor-pointer text-sm text-blue-600 font-medium">
                                Voir les détails de la commande
                            </summary>
                            <div class="mt-4 space-y-2">
                                @foreach ($command->details as $detail)
                                    <div class="flex justify-between items-center text-sm text-gray-700">
                                        <span>{{ $detail->product->name }} × {{ $detail->quantity }}</span>
                                        <span>{{ number_format($detail->unit_price * $detail->quantity, 0, ',', ' ') }} F
                                            CFA</span>
                                    </div>
                                @endforeach
                                <div class="border-t pt-2 mt-2 text-sm font-semibold text-gray-800 flex justify-between">
                                    <span>Total:</span>
                                    <span>{{ number_format($command->total_price, 0, ',', ' ') }} F CFA</span>
                                </div>
                                <div class="text-sm text-gray-600">
                                    Paiement: {{ ucfirst($command->payment_method) }}
                                </div>
                                @if ($command->payment)
                                    <div class="text-sm text-green-700 mt-1">
                                        💰 Payée par {{ $command->payment->user->name }} –
                                        Montant donné : {{ number_format($command->payment->amount_given, 0, ',', ' ') }} F
                                        |
                                        Rendu : {{ number_format($command->payment->change_due, 0, ',', ' ') }} F
                                    </div>
                                @endif
                            </div>
                        </details>
                    </div>
                @empty
                    <div class="bg-white p-6 rounded-lg text-center shadow">
                        <p class="text-gray-500">Aucune commande trouvée.</p>
                    </div>
                @endforelse
                <div class="mt-6">
                    {{ $commands->withQueryString()->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
