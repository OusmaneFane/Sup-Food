@extends('layouts.main')
@php
    use Illuminate\Support\Str;
@endphp

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

            <!-- Filtres Rapides (status) -->
            <div class="flex gap-2 flex-wrap mb-6">
                <x-admin.command-filter label="Toutes" route="admin.commands.index" :active="request('status') === null" />
                <x-admin.command-filter label="En attente" route="admin.commands.index" :params="['status' => 'en_attente']" :active="request('status') === 'en_attente'" />
                <x-admin.command-filter label="Validées" route="admin.commands.index" :params="['status' => 'validée']" :active="request('status') === 'validée'" />
                <x-admin.command-filter label="Annulées" route="admin.commands.index" :params="['status' => 'annulée']" :active="request('status') === 'annulée'" />
                <button onclick="document.getElementById('filterModal').classList.remove('hidden')"
                    class="ml-auto flex items-center gap-2 bg-orange-500 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                            clip-rule="evenodd" />
                    </svg>
                    Filtres
                </button>
            </div>



            <!-- Barre de recherche simple -->
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
                    <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 space-y-5">
                        {{-- Informations principales --}}
                        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                            {{-- Infos client --}}
                            <div class="flex items-start gap-4">
                                <div class="bg-blue-100 p-3 rounded-full">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                </div>
                                <div class="space-y-1">
                                    <h2 class="text-lg font-semibold text-gray-800">{{ $command->user->name }}</h2>
                                    <p class="text-sm text-gray-500">{{ Str::limit($command->delivery_address, 60) }}</p>
                                    <p class="text-xs text-gray-400">{{ $command->created_at->format('d/m/Y à H:i') }}</p>

                                    {{-- Récupération --}}
                                    @if ($command->recuperation && $command->recuperation->recuperee)
                                        <p class="text-green-600 text-sm font-semibold">✅ Commande récupérée</p>
                                    @else
                                        <p class="text-yellow-500 text-sm font-semibold">⏳ En attente de récupération</p>
                                    @endif
                                </div>
                            </div>

                            {{-- Actions et statut --}}
                            <div class="flex flex-col md:items-end gap-3">
                                <div class="flex flex-wrap gap-2">
                                    @if ($command->status === 'en_attente')
                                        <x-admin.command-action :command="$command" />
                                    @elseif ($command->status === 'validée' && !$command->payment)
                                        <a href="{{ route('admin.payments.create', $command->id) }}"
                                            class="bg-green-600 hover:bg-green-700 text-white text-sm px-4 py-2 rounded-lg shadow inline-flex items-center gap-2">
                                            💵 Paiement
                                        </a>
                                    @elseif ($command->payment)
                                        <a href="{{ route('admin.payments.receipt', $command->payment->id) }}"
                                            class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm px-4 py-2 rounded-lg shadow inline-flex items-center gap-2">
                                            👁 Voir Paiement
                                        </a>
                                    @endif

                                    @if ($command->recuperation && !$command->recuperation->recuperee)
                                        <form method="POST" action="{{ route('admin.commands.recuperer', $command->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-4 py-2 rounded-lg shadow">
                                                ✅ Marquer comme récupérée
                                            </button>
                                        </form>
                                    @endif
                                </div>

                                {{-- Badge Statut --}}
                                <span
                                    class="mt-2 px-3 py-1 rounded-full text-xs font-medium self-start md:self-auto
                    {{ $command->status === 'validée' ? 'bg-green-100 text-green-700' : ($command->status === 'annulée' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ ucfirst($command->status) }}
                                </span>
                            </div>
                        </div>

                        {{-- Détails produits --}}
                        <details class="bg-gray-50 rounded-xl p-4">
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

                                <div class="border-t pt-2 mt-2 flex justify-between font-semibold text-sm text-gray-800">
                                    <span>Total :</span>
                                    <span>{{ number_format($command->total_price, 0, ',', ' ') }} F CFA</span>
                                </div>

                                <div class="text-sm text-gray-600">Mode de paiement :
                                    {{ ucfirst($command->payment_method) }}</div>

                                @if ($command->payment)
                                    <div class="text-sm text-green-700 mt-1">
                                        💰 Payée par {{ $command->payment->user->name }} –
                                        Donné : {{ number_format($command->payment->amount_given, 0, ',', ' ') }} F |
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


    <!-- Modal Filtre Avancé -->
    <div id="filterModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-md relative">
            <!-- Bouton fermeture -->
            <button class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"
                onclick="document.getElementById('filterModal').classList.add('hidden')">
                ✕
            </button>

            <h2 class="text-lg font-bold mb-4">Filtrer par Date</h2>

            <form method="GET" action="{{ route('admin.commands.index') }}" class="space-y-4">
                <!-- On garde la search si on veut la conserver -->
                @if (request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                <!-- On garde le status actuel si l'utilisateur l'a déjà choisi via un bouton -->
                @if (request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif

                <!-- Filtrer par date de début -->
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Date de début</label>
                    <input type="date" id="start_date" name="start_date"
                        value="{{ old('start_date', $startDate ?? '') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
                </div>

                <!-- Filtrer par date de fin -->
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700">Date de fin</label>
                    <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $endDate ?? '') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
                </div>

                <!-- (Optionnel) Refiltrer le status directement ici -->
                <div>
                    <label for="status_modal" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="status_modal" name="status"
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                        <option value="">-- Tous --</option>
                        <option value="en_attente"
                            {{ request('status') === 'en_attente' || (isset($status) && $status === 'en_attente') ? 'selected' : '' }}>
                            En attente
                        </option>
                        <option value="validée"
                            {{ request('status') === 'validée' || (isset($status) && $status === 'validée') ? 'selected' : '' }}>
                            Validées
                        </option>
                        <option value="annulée"
                            {{ request('status') === 'annulée' || (isset($status) && $status === 'annulée') ? 'selected' : '' }}>
                            Annulées
                        </option>
                    </select>
                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" class="bg-gray-300 px-4 py-2 rounded"
                        onclick="document.getElementById('filterModal').classList.add('hidden')">
                        Annuler
                    </button>
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Appliquer
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
