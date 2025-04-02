<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SUP'FOOD - Mes Commandes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f4fbff] text-gray-800 relative min-h-screen pb-20">

    <!-- HEADER -->
    <div class="bg-[#e6f6ff] px-4 pt-6 pb-2 rounded-b-3xl relative">
        <div class="flex justify-between items-center mb-4">
            <button onclick="history.back()" class="text-xl">←</button>
            <h1 class="text-lg font-semibold">Mes Commandes</h1>
            <button class="text-xl text-blue-500">📞</button>
        </div>
    </div>

    <!-- Filtres -->
    <div id="statusFilters" class="flex space-x-2 overflow-x-auto px-4 py-3 text-sm font-medium no-scrollbar">
        <button class="px-4 py-1 rounded-full bg-orange-500 text-white" data-status="all">Toutes</button>
        <button class="px-4 py-1 rounded-full bg-gray-200 text-gray-700" data-status="en_attente">En attente</button>
        <button class="px-4 py-1 rounded-full bg-gray-200 text-gray-700" data-status="validée">Validée</button>
        <button class="px-4 py-1 rounded-full bg-gray-200 text-gray-700" data-status="refusée">Refusée</button>
    </div>

    <!-- Liste des commandes -->
    <div id="commandsContainer" class="space-y-4 pb-20">
        @foreach ($commands as $command)
            <div class="command p-4" data-status="{{ $command->status }}">
                <div class="bg-white shadow-md rounded-2xl p-4 space-y-3">
                    <!-- Infos commande -->
                    <div class="flex justify-between items-center text-sm text-gray-600">
                        <div class="flex space-x-2">
                            <span class="bg-gray-100 px-3 py-1 rounded-full">
                                {{ $command->created_at->format('d/m/Y') }}
                            </span>
                            <span
                                class="status-badge bg-gray-100 px-3 py-1 rounded-full
                            {{ $command->status === 'validée' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $command->status === 'en_attente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $command->status === 'refusée' ? 'bg-red-100 text-red-800' : '' }}">
                                @if ($command->status === 'validée')
                                    Validée
                                @elseif($command->status === 'en_attente')
                                    En attente
                                @elseif($command->status === 'refusée')
                                    Refusée
                                @else
                                    {{ $command->status ?? 'En cours' }}
                                @endif
                            </span>
                        </div>
                        <button
                            class="bg-orange-400 text-white text-sm font-medium px-4 py-1 rounded-full shadow hover:bg-orange-500">
                            ⭐ Évaluer
                        </button>
                    </div>

                    <!-- Liste des produits -->
                    @foreach ($command->details as $detail)
                        <div class="flex items-center gap-3 py-2 border-b border-gray-100 last:border-0">
                            <img src="{{ asset('storage/' . $detail->product->image) }}"
                                alt="{{ $detail->product->name ?? 'Produit' }}"
                                class="w-16 h-16 rounded-lg object-cover" />
                            <div class="flex-1">
                                <p class="text-sm font-medium">
                                    {{ $detail->product->name ?? 'Produit non disponible' }} × {{ $detail->quantity }}
                                </p>
                                <p class="text-orange-500 font-semibold mt-1">
                                    {{ number_format($detail->unit_price * $detail->quantity, 0, ',', ' ') }} F CFA
                                </p>
                            </div>
                        </div>
                    @endforeach

                    <!-- Total commande -->
                    <div class="pt-2 border-t border-gray-200">
                        <div class="flex justify-between font-semibold">
                            <span>Total</span>
                            <span class="text-orange-500">
                                {{ number_format($command->total_price, 0, ',', ' ') }} F CFA
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <nav
        class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 flex justify-around items-center h-16 z-10">

        <!-- Accueil -->
        <a href="{{ url('/accueil') }}"
            class="flex flex-col items-center {{ request()->is('accueil') ? 'text-orange-500' : 'text-gray-400' }}">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8m4-8l2 2" />
            </svg>
            <span class="text-xs mt-1">Accueil</span>
        </a>

        <!-- Commandes (icône reçue 🧾) -->
        <a href="{{ url('/commandes') }}"
            class="flex flex-col items-center {{ request()->is('commandes') ? 'text-orange-500' : 'text-gray-400' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6M9 16h6M7 4h10l1 2H6l1-2zm0 0v16l2-2 2 2 2-2 2 2 2-2V4" />
            </svg>
            <span class="text-xs mt-1">Commandes</span>
        </a>

        <!-- Panier -->
        <a href="{{ url('/panier') }}"
            class="relative flex flex-col items-center {{ request()->is('panier') ? 'text-orange-500' : 'text-gray-400' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18l-1 13H4L3 3z" />
            </svg>
            <span class="text-xs mt-1">Panier</span>
            <span id="cartCount"
                class="absolute -top-1 -right-2 bg-red-500 text-white text-xs w-5 h-5 flex items-center justify-center hidden">
            </span>
        </a>

    </nav>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('#statusFilters button');
            const commandElements = document.querySelectorAll('.command');

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const status = this.dataset.status;
                    console.log('Filtre sélectionné:', status);

                    // Mise à jour de l'apparence des boutons
                    filterButtons.forEach(btn => {
                        btn.classList.remove('bg-orange-500', 'text-white');
                        btn.classList.add('bg-gray-200', 'text-gray-700');
                    });
                    this.classList.remove('bg-gray-200', 'text-gray-700');
                    this.classList.add('bg-orange-500', 'text-white');

                    // Filtrage des commandes
                    commandElements.forEach(command => {
                        console.log('État de la commande:', command.dataset.status);
                        if (status === 'all' || command.dataset.status === status) {
                            command.style.display = 'block';
                        } else {
                            command.style.display = 'none';
                        }
                    });
                });
            });

            // Initialiser le compteur du panier
            function updateCartCount() {
                const cart = JSON.parse(localStorage.getItem('cart')) || [];
                const count = cart.reduce((sum, item) => sum + item.qty, 0);
                const badge = document.getElementById('cartCount');
                if (badge) {
                    badge.textContent = count;
                    badge.classList.toggle('hidden', count === 0);
                }
            }
            updateCartCount();
        });
    </script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="/js/app.js"></script>

    <audio id="successSound" src="/sounds/validate.mp3" preload="auto"></audio>

    <script>
        Echo.private('user.commands.{{ Auth::id() }}')
            .listen('CommandValidated', (e) => {
                console.log('Commande validée !', e);
                alert(e.message); // Ou notification UI
                document.getElementById('successSound').play();
                location.reload(); // Recharge les commandes
            });
    </script>


</body>

</html>
