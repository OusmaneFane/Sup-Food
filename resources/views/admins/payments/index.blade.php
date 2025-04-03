@extends('layouts.main')
@section('title', '💳 Paiements')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header avec stats -->
            <div class="py-6">
                <div class="py-6">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">💳 Gestion des Paiements</h1>
                            <p class="text-gray-600 mt-1">Historique complet des transactions</p>
                        </div>
                        <div class="mt-4 md:mt-0 grid grid-cols-2 md:grid-cols-3 gap-4">
                            <!-- Total des paiements (montant donné) -->
                            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                                <div class="flex items-center">
                                    <div class="p-2 rounded-full bg-blue-50 text-blue-600 mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Total encaissé</p>
                                        <p class="text-lg font-semibold text-blue-600">
                                            {{ number_format($stats['total'], 0, ',', ' ') }} F CFA</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Total payé (montant net = donné - rendu) -->
                            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                                <div class="flex items-center">
                                    <div class="p-2 rounded-full bg-green-50 text-green-600 mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Montant net</p>
                                        <p class="text-lg font-semibold text-green-600">
                                            {{ number_format($stats['total'] - $stats['change'], 0, ',', ' ') }} F CFA</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Total rendu -->
                            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                                <div class="flex items-center">
                                    <div class="p-2 rounded-full bg-purple-50 text-purple-600 mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Total rendu</p>
                                        <p class="text-lg font-semibold text-purple-600">
                                            {{ number_format($stats['change'], 0, ',', ' ') }} F CFA</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bouton pour ouvrir le modal -->
                    <div class="mb-6">
                        <button onclick="openFilterModal()"
                            class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                    clip-rule="evenodd" />
                            </svg>
                            Filtres
                        </button>

                        <!-- Affichage des filtres actifs -->
                        @if (isset($filters) && count(array_filter($filters)) > 0)
                            <div class="mt-3 flex flex-wrap gap-2">
                                @if ($filters['method'] ?? false)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Méthode: {{ ucfirst(str_replace('_', ' ', $filters['method'])) }}
                                        <button onclick="removeFilter('method')"
                                            class="ml-1.5 inline-flex text-blue-400 hover:text-blue-600">
                                            &times;
                                        </button>
                                    </span>
                                @endif
                                @if ($filters['start'] ?? false)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        À partir du: {{ Carbon\Carbon::parse($filters['start'])->format('d/m/Y') }}
                                        <button onclick="removeFilter('start')"
                                            class="ml-1.5 inline-flex text-green-400 hover:text-green-600">
                                            &times;
                                        </button>
                                    </span>
                                @endif
                                @if ($filters['end'] ?? false)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Jusqu'au: {{ Carbon\Carbon::parse($filters['end'])->format('d/m/Y') }}
                                        <button onclick="removeFilter('end')"
                                            class="ml-1.5 inline-flex text-green-400 hover:text-green-600">
                                            &times;
                                        </button>
                                    </span>
                                @endif
                                @if ($filters['user'] ?? false)
                                    @php
                                        $client = $clients->firstWhere('id', $filters['user']);
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        Client: {{ $client->name ?? 'Inconnu' }}
                                        <button onclick="removeFilter('user')"
                                            class="ml-1.5 inline-flex text-purple-400 hover:text-purple-600">
                                            &times;
                                        </button>
                                    </span>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Tableau des paiements -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden mb-8">
                    <div class="overflow-x-auto">
                        <table id="paymentsTable" class="w-full text-sm">
                            <thead class="bg-gray-50 text-gray-600 border-b">
                                <tr>
                                    <th class="px-6 py-3 text-left font-medium">Réf</th>
                                    <th class="px-6 py-3 text-left font-medium">Client</th>
                                    <th class="px-6 py-3 text-left font-medium">Montant donné</th>
                                    <th class="px-6 py-3 text-left font-medium">Commande</th>
                                    <th class="px-6 py-3 text-left font-medium">Rendu</th>
                                    <th class="px-6 py-3 text-left font-medium">Méthode</th>
                                    <th class="px-6 py-3 text-left font-medium">Caissier</th>
                                    <th class="px-6 py-3 text-left font-medium">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($payments as $payment)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 font-semibold text-blue-600">#{{ $payment->id }}</td>
                                        <td class="px-6 py-4">{{ $payment->command->user->name }}</td>
                                        <td class="px-6 py-4">{{ number_format($payment->amount_given, 0, ',', ' ') }} F
                                            CFA
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-medium">{{ number_format($payment->command->total_price, 0, ',', ' ') }}
                                                    F CFA</span>
                                                <div class="text-xs text-gray-500 mt-1">
                                                    @foreach ($payment->command->details as $detail)
                                                        <span class="block">• {{ $detail->product->name }} ×
                                                            {{ $detail->quantity }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">{{ number_format($payment->change_due, 0, ',', ' ') }} F
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $methodColors = [
                                                    'cash' => 'bg-green-100 text-green-800',
                                                    'card' => 'bg-blue-100 text-blue-800',
                                                    'mobile_money' => 'bg-purple-100 text-purple-800',
                                                ];
                                            @endphp
                                            <span
                                                class="px-2 py-1 rounded-full text-xs font-medium {{ $methodColors[$payment->payment_method] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">{{ $payment->user->name }}</td>
                                        <td class="px-6 py-4">{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal de filtres -->
            <div id="filterModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75" onclick="closeFilterModal()"></div>
                    </div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div
                        class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                        <div>
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Filtres avancés
                                </h3>
                                <button onclick="closeFilterModal()" class="text-gray-400 hover:text-gray-500">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <form id="filterForm" method="GET" class="space-y-4">
                                <div>
                                    <label for="method" class="block text-sm font-medium text-gray-700">Méthode de
                                        paiement</label>
                                    <select id="method" name="method"
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                        <option value="">Toutes les méthodes</option>
                                        @foreach ($methods as $method)
                                            <option value="{{ $method }}"
                                                {{ ($filters['method'] ?? '') === $method ? 'selected' : '' }}>
                                                {{ ucfirst(str_replace('_', ' ', $method)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="user" class="block text-sm font-medium text-gray-700">Client</label>
                                    <select id="user" name="user"
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                        <option value="">Tous les clients</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}"
                                                {{ ($filters['user'] ?? '') == $client->id ? 'selected' : '' }}>
                                                {{ $client->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label for="start" class="block text-sm font-medium text-gray-700">Date de
                                            début</label>
                                        <input type="date" id="start" name="start"
                                            value="{{ $filters['start'] ?? '' }}"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="end" class="block text-sm font-medium text-gray-700">Date de
                                            fin</label>
                                        <input type="date" id="end" name="end"
                                            value="{{ $filters['end'] ?? '' }}"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                            <button type="button" onclick="applyFilters()"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:col-start-2 sm:text-sm">
                                Appliquer les filtres
                            </button>
                            <button type="button" onclick="resetFilters()"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:col-start-1 sm:text-sm">
                                Réinitialiser
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script>
            // Gestion du modal
            function openFilterModal() {
                document.getElementById('filterModal').classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }

            function closeFilterModal() {
                document.getElementById('filterModal').classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }

            // Appliquer les filtres
            function applyFilters() {
                document.getElementById('filterForm').submit();
            }

            // Réinitialiser les filtres
            function resetFilters() {
                window.location.href = "{{ route('admin.payments.index') }}";
            }

            // Supprimer un filtre spécifique
            function removeFilter(filterName) {
                const url = new URL(window.location.href);
                url.searchParams.delete(filterName);
                window.location.href = url.toString();
            }

            // Ouvrir le modal si des erreurs de validation existent
            @if ($errors->any())
                document.addEventListener('DOMContentLoaded', function() {
                    openFilterModal();
                });
            @endif
        </script>

        <!-- DataTables Scripts -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $('#paymentsTable').DataTable({
                    responsive: true,
                    language: {
                        search: "<div class='flex items-center'><svg class='w-4 h-4 mr-2 text-gray-400' fill='none' stroke='currentColor' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'></path></svg> Rechercher :</div>",
                        lengthMenu: "Afficher _MENU_ paiements",
                        zeroRecords: "Aucun paiement trouvé",
                        info: "Affichage de _START_ à _END_ sur _TOTAL_ paiements",
                        infoEmpty: "Aucun paiement disponible",
                        infoFiltered: "(filtrés depuis _MAX_ paiements)",
                        paginate: {
                            previous: "← Précédent",
                            next: "Suivant →"
                        }
                    },
                    dom: '<"flex justify-between items-center mb-4"lf>rt<"flex justify-between items-center mt-4"ip>',
                    pageLength: 10
                });
            });
        </script>
    @endpush
