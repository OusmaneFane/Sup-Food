@extends('layouts.main')
@section('title', 'Dashboard')

@section('content')
    <div class="min-h-screen bg-gray-50 py-10 px-6">
        <div class="max-w-7xl mx-auto space-y-8">

            <!-- Header -->
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-800">📊 Tableau de Bord</h1>
            </div>

            <!-- Statistiques principales -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl p-5 shadow hover:shadow-md transition">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 text-xl">📦</div>
                        <div>
                            <p class="text-sm text-gray-500">Produits</p>
                            <p class="text-xl font-bold">{{ $productsCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-5 shadow hover:shadow-md transition">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 text-xl">📥</div>
                        <div>
                            <p class="text-sm text-gray-500">Commandes</p>
                            <p class="text-xl font-bold">{{ $commandsCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-5 shadow hover:shadow-md transition">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 rounded-full bg-green-100 text-green-600 text-xl">👥</div>
                        <div>
                            <p class="text-sm text-gray-500">Utilisateurs</p>
                            <p class="text-xl font-bold">{{ $usersCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-5 shadow hover:shadow-md transition">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-600 text-xl">💰</div>
                        <div>
                            <p class="text-sm text-gray-500">Chiffre d'affaires</p>
                            <p class="text-xl font-bold">{{ number_format($totalRevenue, 0, ',', ' ') }} CFA</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Graphiques -->
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700">📈 Évolution des commandes</h3>
                    <canvas id="ordersChart" height="200"></canvas>
                </div>
                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700">🧾 Répartition des statuts</h3>
                    <canvas id="statusChart" height="200"></canvas>
                </div>
            </div>

            <!-- Liste des commandes -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">🕒 Commandes récentes</h3>
                <div class="overflow-x-auto">
                    <table id="datatable" class="w-full text-sm">
                        <thead>
                            <tr class="text-left border-b">
                                <th>#ID</th>
                                <th>Client</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentCommands as $command)
                                <tr class="hover:bg-gray-50">
                                    <td>#{{ $command->id }}</td>
                                    <td>{{ $command->user->name }}</td>
                                    <td>{{ number_format($command->total_price, 0, ',', ' ') }} F CFA</td>
                                    <td>{{ $command->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <span
                                            class="text-xs px-2 py-1 rounded-full 
                                    {{ $command->status === 'validée'
                                        ? 'bg-green-100 text-green-700'
                                        : ($command->status === 'refusée'
                                            ? 'bg-red-100 text-red-700'
                                            : 'bg-yellow-100 text-yellow-700') }}">
                                            {{ ucfirst($command->status) }}
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

    <!-- Chart.js & DataTables -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            new Chart(document.getElementById('ordersChart'), {
                type: 'line',
                data: {
                    labels: @json($weeklyLabels),
                    datasets: [{
                        label: 'Commandes',
                        data: @json($weeklyOrders),
                        borderColor: '#2563eb',
                        backgroundColor: 'rgba(37, 99, 235, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                }
            });

            new Chart(document.getElementById('statusChart'), {
                type: 'doughnut',
                data: {
                    labels: ['Validée', 'En attente', 'Refusée'],
                    datasets: [{
                        data: @json([$statusCount['validée'] ?? 0, $statusCount['en_attente'] ?? 0, $statusCount['refusée'] ?? 0]),
                        backgroundColor: ['#22c55e', '#facc15', '#ef4444']
                    }]
                }
            });

            $('#datatable').DataTable({
                paging: false,
                info: false,
                language: {
                    search: "🔍 Rechercher :",
                    zeroRecords: "Aucune commande trouvée"
                }
            });
        });
    </script>
@endsection
