@extends('layouts.main')
@section('title', 'Statistiques')

@section('content')
    <div class="p-6 bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">📊 Statistiques Générales</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white rounded-lg shadow p-5">
                <p class="text-gray-500 text-sm">Nombre de Produits</p>
                <p class="text-3xl font-bold text-blue-600">{{ $products }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-5">
                <p class="text-gray-500 text-sm">Nombre de Commandes</p>
                <p class="text-3xl font-bold text-purple-600">{{ $orders }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-5">
                <p class="text-gray-500 text-sm">Utilisateurs</p>
                <p class="text-3xl font-bold text-green-600">{{ $users }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-5">
                <p class="text-gray-500 text-sm">Chiffre d'affaires</p>
                <p class="text-3xl font-bold text-orange-500">{{ number_format($revenue, 0, ',', ' ') }} F CFA</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <h2 class="text-lg font-bold mb-4 text-gray-700">📈 Commandes par Mois</h2>
            <canvas id="ordersChart" height="100"></canvas>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-bold mb-4 text-gray-700">🛒 Produits les plus commandés</h2>
            <canvas id="productsChart"></canvas>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ordersCtx = document.getElementById('ordersChart').getContext('2d');
        const ordersChart = new Chart(ordersCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($monthlyLabels) !!},
                datasets: [{
                    label: 'Commandes',
                    data: {!! json_encode($monthlyOrders) !!},
                    backgroundColor: '#3b82f6'
                }]
            }
        });

        const productsCtx = document.getElementById('productsChart').getContext('2d');
        const productsChart = new Chart(productsCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($topProductsLabels) !!},
                datasets: [{
                    label: 'Quantité',
                    data: {!! json_encode($topProductsQuantities) !!},
                    backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6']
                }]
            }
        });
    </script>
@endpush
