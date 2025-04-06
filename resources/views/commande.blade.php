<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SUP'FOOD - Mes Commandes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

</head>

<body class="bg-[#f4fbff] text-gray-800 relative min-h-screen pb-20">

    <!-- HEADER -->
    <div class="bg-[#e6f6ff] px-4 pt-6 pb-2 rounded-b-3xl relative">
        <div class="flex justify-between items-center mb-4">
            <button onclick="history.back()" class="text-xl">←</button>
            <h1 class="text-lg font-semibold">Mes Commandes</h1>
            <a href="https://wa.me/22382791234" target="_blank">
                <button class="text-xl text-green-500" aria-label="WhatsApp">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-8 h-8 fill-current">
                        <path d="M380.9 97.1C339 55.3 285.2 32 228.4 32c-105.9 0-192 85.9-192 191.8
             0 33.8 8.9 66.8 25.8 95.7l-25.7 94.2 96.6-25.4c27.4 14.9 58.6 22.8
             90 22.8h.1c105.8 0 191.8-86 191.8-191.9 0-56.8-23.3-110.6-65.1-152.5zM228.4
             403.7h-.1c-28.8 0-56.9-7.9-81.5-22.9l-5.8-3.5-57.3 15.1 15.3-56.1-3.7-5.9c
             -15.9-25.3-24.3-54.3-24.3-84.4 0-86 70-156 156-156 41.6 0 80.7 16.2
             110.2 45.7 29.4 29.4 45.6 68.5 45.6 110.2 0 86-70 156-156 156zm101.6-138.6c
             -5.5-2.7-32.6-16.1-37.7-17.9-5.1-1.9-8.8-2.7-12.5 2.7-3.6 5.3-14.3 17.9
             -17.6 21.6-3.2 3.6-6.5 4.1-12 1.4-32.7-16.3-54.1-29.1-75.6-66.1-5.7-9.8
             5.7-9.1 16.3-30.2 1.8-3.6.9-6.7-.5-9.4-1.4-2.7-12.5-30.1-17.1-41.2-4.5
             -10.8-9.1-9.3-12.5-9.5-3.2-.2-6.8-.2-10.4-.2-3.6 0-9.4 1.3-14.3 6.7-4.9
             5.3-18.8 18.4-18.8 44.9 0 26.5 19.3 52 21.9 55.6 2.7 3.6 37.8 57.8 91.6
             81.1 53.8 23.4 53.8 15.6 63.5 14.7 9.7-.9 31.3-12.7 35.7-25.1
             4.4-12.4 4.4-23.1 3.2-25.1-1.3-2-5-3.6-10.5-6.3z" />
                    </svg>
                </button>

            </a>
        </div>
    </div>

    <!-- Filtres -->
    <div id="statusFilters" class="flex space-x-2 overflow-x-auto px-4 py-3 text-sm font-medium no-scrollbar">
        <button class="px-4 py-1 rounded-full bg-orange-500 text-white" data-status="all">Toutes</button>
        <button class="px-4 py-1 rounded-full bg-gray-200 text-gray-700" data-status="en_attente">En attente</button>
        <button class="px-4 py-1 rounded-full bg-gray-200 text-gray-700" data-status="validée">Validée</button>
        <button class="px-4 py-1 rounded-full bg-gray-200 text-gray-700" data-status="annulée">Annulée</button>
    </div>

    <!-- Liste des commandes -->
    <div id="commandsContainer" class="space-y-4 pb-20">
        @foreach ($commands as $command)
            <div class="command block p-4" data-status="{{ $command->status }}" data-command-id="{{ $command->id }}">
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
                                {{ $command->status === 'annulée' ? 'bg-red-100 text-red-800' : '' }}">
                                @if ($command->status === 'validée')
                                    Validée
                                @elseif($command->status === 'en_attente')
                                    En attente
                                @elseif($command->status === 'annulée')
                                    Annulée
                                @else
                                    {{ $command->status ?? 'En cours' }}
                                @endif
                            </span>
                        </div>
                        @if ($command->status === 'validée')
                            <button
                                class="bg-orange-400 text-white text-sm font-medium px-4 py-1 rounded-full shadow hover:bg-orange-500">
                                ⭐ Évaluer
                            </button>
                        @endif
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

    <!-- Notification Toast -->
    <div id="notificationToast" class="fixed top-4 right-4 z-50 hidden">
        <div
            class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center animate__animated animate__fadeInRight">
            <span id="toastMessage"></span>
            <button onclick="hideToast()" class="ml-4">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Bottom Navigation -->
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

        <!-- Commandes -->
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
        // Variables globales
        let currentFilter = 'all';
        let previousStatuses = {};
        let isFirstLoad = true;
        let audioInitialized = false;

        // Initialisation audio
        function initAudio() {
            const notifSound = new Audio('/sounds/validation.mp3');
            notifSound.volume = 1.0;

            // Trick pour débloquer l'audio
            document.addEventListener('click', () => {
                notifSound.play()
                    .then(() => {
                        notifSound.pause();
                        notifSound.currentTime = 0;
                        audioInitialized = true;
                    })
                    .catch(e => console.log("Audio init error:", e));
            }, {
                once: true
            });

            return notifSound;
        }

        const notifSound = initAudio();

        // Fonction pour jouer le son
        function playSound() {
            if (!audioInitialized) {
                console.log("Audio pas encore initialisé");
                return;
            }

            notifSound.currentTime = 0;
            notifSound.play().catch(error => {
                console.warn("Erreur lecture son:", error);
            });
        }

        // Fonction pour les notifications toast
        function showToast(message) {
            console.log('Affichage toast:', message);
            const toast = document.getElementById('notificationToast');
            const toastMessage = document.getElementById('toastMessage');

            if (!toast || !toastMessage) {
                console.error('Éléments toast non trouvés');
                return;
            }

            toastMessage.textContent = message;
            toast.classList.remove('hidden');
            toast.classList.add('animate__fadeInRight');

            // Masquer après 5 secondes
            setTimeout(() => {
                toast.classList.add('animate__fadeOutRight');
                setTimeout(() => toast.classList.add('hidden'), 500);
            }, 5000);
        }

        // Fonction pour appliquer les filtres
        function applyFilter(status) {
            const commandElements = document.querySelectorAll('.command');
            commandElements.forEach(command => {
                if (status === 'all' || command.dataset.status === status) {
                    command.style.display = 'block';
                } else {
                    command.style.display = 'none';
                }
            });
        }

        // Fonction pour mettre à jour le compteur du panier
        function updateCartCount() {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const count = cart.reduce((sum, item) => sum + item.qty, 0);
            const badge = document.getElementById('cartCount');
            if (badge) {
                badge.textContent = count;
                badge.classList.toggle('hidden', count === 0);
            }
        }

        // Fonction pour détecter les changements de statut
        function checkStatusChanges(newCommands) {
            newCommands.forEach(newCmd => {
                const id = newCmd.dataset.commandId;
                const newStatus = newCmd.dataset.status;

                if (!id || !newStatus) return;

                const oldStatus = previousStatuses[id];

                // Si le statut a changé ET que c'est une validation
                if (oldStatus && oldStatus !== newStatus && newStatus === 'validée') {
                    console.log(`Commande ${id} validée !`);
                    showToast(`Commande n°${id} validée`);
                    playSound();
                }

                previousStatuses[id] = newStatus;
            });
        }

        async function refreshCommands() {
            try {
                const response = await fetch('/etudiant/commandes/live');
                const data = await response.json();
                const parser = new DOMParser();
                const doc = parser.parseFromString(data.html, 'text/html');
                const newCommands = Array.from(doc.querySelectorAll('.command'));

                // Détection des changements avant mise à jour du DOM
                if (!isFirstLoad) {
                    checkStatusChanges(newCommands);
                }

                // Mise à jour HTML
                const container = document.getElementById('commandsContainer');
                if (container) {
                    container.innerHTML = data.html;
                    applyFilter(currentFilter);
                }

                if (isFirstLoad) isFirstLoad = false;

            } catch (error) {
                console.error('Erreur de rafraîchissement :', error);
            }
        }

        // Initialisation au chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            // Sauvegarder les statuts initiaux
            document.querySelectorAll('.command').forEach(cmd => {
                const id = cmd.dataset.commandId;
                const status = cmd.dataset.status;
                if (id && status) {
                    previousStatuses[id] = status;
                }
            });

            // Configurer les filtres
            const filterButtons = document.querySelectorAll('#statusFilters button');
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    currentFilter = this.dataset.status;
                    applyFilter(currentFilter);

                    // Mise à jour UI des boutons
                    filterButtons.forEach(btn => {
                        btn.classList.toggle('bg-orange-500', btn === this);
                        btn.classList.toggle('text-white', btn === this);
                        btn.classList.toggle('bg-gray-200', btn !== this);
                        btn.classList.toggle('text-gray-700', btn !== this);
                    });
                });
            });

            // Initialiser le panier
            updateCartCount();
        });

        // Démarrer le rafraîchissement
        refreshCommands();
        setInterval(refreshCommands, 3000);
    </script>

</body>

</html>
