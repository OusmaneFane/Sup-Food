@extends('layouts.main')
@php use Illuminate\Support\Str; @endphp
@section('content')
    <div class="min-h-screen bg-gray-50 p-6">
        <div class="max-w-6xl mx-auto">
            <!-- Header avec recherche -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span>Gestion des Commandes</span>
                    </h1>
                    <p class="text-gray-500 mt-1 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Mis à jour à {{ now()->format('H:i') }}
                    </p>
                </div>

                <div class="relative w-full md:w-64">
                    <input type="text" placeholder="Rechercher une commande..."
                        class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Filtres fonctionnels -->
            <div class="flex flex-wrap gap-2 mb-6">
                <a href="{{ route('admin.commands.index') }}"
                    class="flex items-center px-4 py-2 rounded-full bg-white shadow-xs border hover:shadow-sm transition-all duration-200 {{ request('status') === null ? 'bg-blue-50 border-blue-200 text-blue-600' : 'border-gray-200 text-gray-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Toutes
                </a>

                <a href="{{ route('admin.commands.index', ['status' => 'en_attente']) }}"
                    class="flex items-center px-4 py-2 rounded-full bg-white shadow-xs border hover:shadow-sm transition-all duration-200 {{ request('status') === 'en_attente' ? 'bg-yellow-50 border-yellow-200 text-yellow-600' : 'border-gray-200 text-gray-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    En attente
                </a>

                <a href="{{ route('admin.commands.index', ['status' => 'validée']) }}"
                    class="flex items-center px-4 py-2 rounded-full bg-white shadow-xs border hover:shadow-sm transition-all duration-200 {{ request('status') === 'validée' ? 'bg-green-50 border-green-200 text-green-600' : 'border-gray-200 text-gray-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Validées
                </a>

                <a href="{{ route('admin.commands.index', ['status' => 'annulée']) }}"
                    class="flex items-center px-4 py-2 rounded-full bg-white shadow-xs border hover:shadow-sm transition-all duration-200 {{ request('status') === 'annulée' ? 'bg-red-50 border-red-200 text-red-600' : 'border-gray-200 text-gray-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Annulées
                </a>
            </div>

            <!-- Liste des commandes -->
            <div class="grid gap-4">
                @forelse ($commands as $command)
                    <div
                        class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 border border-gray-100 overflow-hidden">
                        <div class="p-5">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div class="flex items-start gap-4">
                                    <div class="bg-blue-50 p-3 rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                    </div>

                                    <div class="flex-1">
                                        <div class="flex items-center gap-2">
                                            <h3 class="font-semibold text-gray-800">{{ $command->user->name }}</h3>
                                            <span
                                                class="px-2 py-1 rounded-full text-xs font-medium flex items-center gap-1
                                        {{ $command->status === 'validée'
                                            ? 'bg-green-100 text-green-700'
                                            : ($command->status === 'annulée'
                                                ? 'bg-red-100 text-red-700'
                                                : 'bg-yellow-100 text-yellow-800') }}">
                                                @if ($command->status === 'validée')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                @elseif($command->status === 'annulée')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                @endif
                                                {{ ucfirst($command->status) }}
                                            </span>
                                        </div>

                                        <div class="mt-2 flex flex-wrap gap-x-4 gap-y-2 text-sm text-gray-600">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                {{ Str::limit($command->delivery_address, 40) }}
                                            </div>

                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                {{ $command->created_at->format('d/m/Y H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2">
                                    <button onclick="toggleDetails('details-{{ $command->id }}')"
                                        class="text-blue-500 hover:text-blue-700 flex items-center gap-1 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                        Détails
                                    </button>

                                    @if ($command->status === 'en_attente')
                                        <div class="flex gap-2">
                                            <form method="POST"
                                                action="{{ route('admin.commands.valider', $command->id) }}">
                                                @csrf
                                                <button class="text-green-500 hover:text-green-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </button>
                                            </form>

                                            <form method="POST"
                                                action="{{ route('admin.commands.annuler', $command->id) }}">
                                                @csrf
                                                <button class="text-red-500 hover:text-red-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Détails de la commande (cachés par défaut) -->
                            <div id="details-{{ $command->id }}" class="hidden mt-6 pt-6 border-t border-gray-100">
                                <h4 class="font-medium text-gray-700 mb-3 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    Articles commandés
                                </h4>

                                <div class="space-y-4">
                                    @foreach ($command->details as $detail)
                                        <div class="flex items-start gap-4 p-3 bg-gray-50 rounded-lg">
                                            <img src="{{ $detail->product->image ? asset('storage/' . $detail->product->image) : 'https://via.placeholder.com/150' }}"
                                                alt="{{ $detail->product->name }}"
                                                class="w-16 h-16 object-cover rounded-md">

                                            <div class="flex-1">
                                                <h5 class="font-medium text-gray-800">{{ $detail->product->name }}</h5>
                                                <div class="flex justify-between mt-1 text-sm text-gray-600">
                                                    <span>Quantité: {{ $detail->quantity }}</span>
                                                    <span>{{ number_format($detail->unit_price, 0, ',', ' ') }} F
                                                        CFA/unité</span>
                                                </div>
                                            </div>

                                            <div class="font-medium text-gray-800">
                                                {{ number_format($detail->unit_price * $detail->quantity, 0, ',', ' ') }} F
                                                CFA
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-6 pt-4 border-t border-gray-200">
                                    <div class="flex justify-between font-medium text-gray-700">
                                        <span>Total articles:</span>
                                        <span>{{ number_format($command->total_price, 0, ',', ' ') }} F CFA</span>
                                    </div>

                                    <div class="flex justify-between mt-2 text-gray-600">
                                        <span>Méthode de paiement:</span>
                                        <span class="capitalize">{{ $command->payment_method }}</span>
                                    </div>

                                    <div class="flex justify-between mt-2 text-gray-600">
                                        <span>Date de livraison estimée:</span>
                                        <span>{{ $command->created_at->addDays(2)->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-700">Aucune commande trouvée</h3>
                        <p class="mt-1 text-gray-500">Aucune commande ne correspond à vos critères de recherche</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        function toggleDetails(id) {
            const element = document.getElementById(id);
            element.classList.toggle('hidden');

            // Rotation de l'icône flèche
            const button = event.currentTarget;
            const icon = button.querySelector('svg');
            icon.classList.toggle('transform');
            icon.classList.toggle('rotate-180');
        }
    </script>
@endsection
