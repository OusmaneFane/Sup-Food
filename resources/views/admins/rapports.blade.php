@extends('layouts.main')
@section('title', '📊 Rapports Analytiques')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 p-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                        <span class="bg-blue-100 p-3 rounded-xl text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </span>
                        <span>Analytiques & Rapports</span>
                    </h1>
                    <p class="text-gray-500 mt-1 ml-12">Données complètes sur l'activité de votre restaurant</p>
                </div>

                <div class="flex gap-3">
                    <!-- Téléchargement Journalier -->
                    <div class="relative">
                        <button onclick="toggleDropdown('dailyDropdown')"
                            class="flex items-center gap-2 bg-white border border-blue-200 text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50">
                            📅 Rapport Journalier
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div id="dailyDropdown"
                            class="absolute hidden mt-1 bg-white border border-gray-200 rounded-md shadow-md z-10">
                            <a href="{{ route('reports.download', ['type' => 'daily', 'format' => 'pdf']) }}"
                                class="block px-4 py-2 hover:bg-gray-100">📄 PDF</a>
                            <a href="{{ route('reports.download', ['type' => 'daily', 'format' => 'excel']) }}"
                                class="block px-4 py-2 hover:bg-gray-100">📊 Excel</a>
                        </div>
                    </div>

                    <!-- Téléchargement Mensuel -->
                    <div class="relative">
                        <button onclick="toggleDropdown('monthlyDropdown')"
                            class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            📆 Rapport Mensuel
                            <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div id="monthlyDropdown"
                            class="absolute hidden mt-1 bg-white border border-gray-200 rounded-md shadow-md z-10">
                            <a href="{{ route('reports.download', ['type' => 'monthly', 'format' => 'pdf']) }}"
                                class="block px-4 py-2 hover:bg-gray-100">📄 PDF</a>
                            <a href="{{ route('reports.download', ['type' => 'monthly', 'format' => 'excel']) }}"
                                class="block px-4 py-2 hover:bg-gray-100">📊 Excel</a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Filtres -->
            <form method="GET" action="{{ route('reports.index') }}" class="bg-white p-5 rounded-xl shadow-sm mb-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date de début</label>
                        <div class="relative">
                            <input type="date" name="start_date" value="{{ request('start_date') }}"
                                class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date de fin</label>
                        <div class="relative">
                            <input type="date" name="end_date" value="{{ request('end_date') }}"
                                class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Appliquer les filtres
                        </button>
                    </div>
                    @if (request('start_date') || request('end_date'))
                        <div>
                            <a href="{{ route('reports.index') }}"
                                class="w-full flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2.5 rounded-lg transition-colors">
                                Réinitialiser
                            </a>
                        </div>
                    @endif
                </div>
            </form>

            <!-- Statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <x-report-card
                    icon="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                    label="Total Commandes" :value="$stats['total_orders']" color="blue" trend="up" />

                <x-report-card
                    icon="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                    label="Chiffre d'Affaires" :value="number_format($stats['revenue'], 0, ',', ' ') . ' F CFA'" color="green" trend="up" />

                <x-report-card
                    icon="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                    label="Utilisateurs Actifs" :value="$stats['active_users']" color="purple" trend="stable" />
            </div>

            <!-- Détails des commandes -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-5 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="font-medium text-gray-800 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Détails des commandes
                    </h3>
                    <span class="text-sm text-gray-500">{{ $commands->count() }} commandes trouvées</span>
                </div>

                <div class="overflow-x-auto">
                    <table id="reportTable" class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left font-medium">Date</th>
                                <th class="px-6 py-3 text-left font-medium">Client</th>
                                <th class="px-6 py-3 text-left font-medium">Adresse</th>
                                <th class="px-6 py-3 text-left font-medium">Produits</th>
                                <th class="px-6 py-3 text-left font-medium">Total</th>
                                <th class="px-6 py-3 text-left font-medium">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($commands as $cmd)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="flex-shrink-0 h-10 w-10 bg-blue-50 rounded-lg flex items-center justify-center mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $cmd->created_at->format('d/m/Y') }}</div>
                                                <div class="text-sm text-gray-500">{{ $cmd->created_at->format('H:i') }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $cmd->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $cmd->user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs truncate">{{ $cmd->delivery_address }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex -space-x-2">
                                            @foreach ($cmd->details->take(3) as $detail)
                                                <img class="h-8 w-8 rounded-full border-2 border-white"
                                                    src="{{ $detail->product->image ? asset('storage/' . $detail->product->image) : 'https://via.placeholder.com/150' }}"
                                                    alt="{{ $detail->product->name ?? 'Produit' }}"
                                                    title="{{ $detail->product->name ?? 'Produit supprimé' }} × {{ $detail->quantity }}">
                                            @endforeach
                                            @if ($cmd->details->count() > 3)
                                                <span
                                                    class="h-8 w-8 rounded-full border-2 border-white bg-gray-100 flex items-center justify-center text-xs font-medium">
                                                    +{{ $cmd->details->count() - 3 }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-orange-600">
                                        {{ number_format($cmd->total_price, 0, ',', ' ') }} F CFA
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2.5 py-1 rounded-full text-xs font-medium flex items-center gap-1 w-fit
                                    {{ $cmd->status === 'validée'
                                        ? 'bg-green-100 text-green-800'
                                        : ($cmd->status === 'refusée'
                                            ? 'bg-red-100 text-red-800'
                                            : 'bg-yellow-100 text-yellow-800') }}">
                                            @if ($cmd->status === 'validée')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                            @elseif($cmd->status === 'refusée')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @endif
                                            {{ ucfirst($cmd->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $('#reportTable').DataTable({
                    responsive: true,
                    language: {
                        search: '<div class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>Rechercher :</div>',
                        lengthMenu: "Afficher _MENU_ entrées",
                        zeroRecords: "Aucune commande trouvée",
                        info: "Affichage de _START_ à _END_ sur _TOTAL_ commandes",
                        paginate: {
                            previous: '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>',
                            next: '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>'
                        }
                    },
                    dom: '<"flex flex-col md:flex-row items-center justify-between"<"mb-4 md:mb-0"l><"md:ml-4"f>>rt<"flex flex-col md:flex-row items-center justify-between"<"mb-4 md:mb-0"i><"md:ml-4"p>>',
                    initComplete: function() {
                        $('.dataTables_filter input').addClass(
                            'border border-gray-300 rounded-lg px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent'
                        );
                        $('.dataTables_length select').addClass(
                            'border border-gray-300 rounded-lg px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent'
                        );
                    }
                });
            });
        </script>
    @endpush
    @push('scripts')
        <script>
            function toggleDropdown(id) {
                document.querySelectorAll('.absolute.z-10').forEach(el => el.classList.add('hidden'));
                document.getElementById(id).classList.toggle('hidden');
            }

            document.addEventListener('click', function(e) {
                if (!e.target.closest('.relative')) {
                    document.querySelectorAll('.absolute.z-10').forEach(el => el.classList.add('hidden'));
                }
            });
        </script>
    @endpush

@endsection
