<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUP'FOOD - Mon Panier</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f4fbff] text-gray-800 pb-24 min-h-screen relative">
    <div class="bg-[#e6f6ff] px-4 pt-6 pb-2 rounded-b-3xl relative">
        <div class="flex justify-between items-center mb-4">
            <button onclick="history.back()" class="text-xl">←</button>
            <h1 class="text-center text-lg font-semibold">Mon panier</h1>
            <button class="text-xl text-blue-500">📞</button>
        </div>
    </div>
    <!-- HEADER -->


    <!-- CONTENU DU PANIER -->
    <div id="cartItems" class="p-4 space-y-4"></div>

    <!-- TOTAL -->
    <div class="mt-8 px-4 space-y-3">
        <div class="flex justify-between text-sm text-gray-600">
            <span>Nombre d'articles</span>
            <span id="itemCount">0</span>
        </div>
        <div class="flex justify-between font-semibold text-gray-800 border-t border-blue-100 pt-2">
            <span>Total</span>
            <span id="totalPrice">0 F CFA</span>
        </div>
        <a href="{{ route('commande') }}">
            <button class="bg-blue-600 text-white py-3 w-full rounded-full mt-4">Commander</button>
        </a>

    </div>

    <!-- NAVIGATION -->
    <nav
        class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 flex justify-around items-center h-16 z-10">

        <!-- Accueil -->
        <a href="{{ url('/accueil') }}"
            class="flex flex-col items-center {{ request()->is('accueil') ? 'text-blue-600' : 'text-gray-400' }}">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8m4-8l2 2" />
            </svg>
            <span class="text-xs mt-1">Accueil</span>
        </a>

        <!-- Commandes (icône reçue 🧾) -->
        <a href="{{ url('/commandes') }}"
            class="flex flex-col items-center {{ request()->is('commandes') ? 'text-blue-600' : 'text-gray-400' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6M9 16h6M7 4h10l1 2H6l1-2zm0 0v16l2-2 2 2 2-2 2 2 2-2V4" />
            </svg>
            <span class="text-xs mt-1">Commandes</span>
        </a>

        <!-- Panier -->
        <a href="{{ url('/panier') }}"
            class="relative flex flex-col items-center {{ request()->is('panier') ? 'text-blue-600' : 'text-gray-400' }}">
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



    <!-- JS: Panier -->
    <script>
        function getCart() {
            return JSON.parse(localStorage.getItem('cart')) || [];
        }

        function renderCart() {
            const cart = getCart();
            const container = document.getElementById('cartItems');
            const totalEl = document.getElementById('totalPrice');
            const countEl = document.getElementById('itemCount');
            container.innerHTML = '';
            let total = 0;
            let count = 0;

            cart.forEach(item => {
                const itemTotal = item.qty * item.price;
                total += itemTotal;
                count += item.qty;

                const div = document.createElement('div');
                div.className = "bg-white shadow rounded-xl flex items-center p-3 space-x-3";

                div.innerHTML = `
          <img src="${item.image}" class="w-16 h-16 rounded-md object-cover" />
          <div class="flex-1">
            <h3 class="text-sm font-medium leading-tight">${item.name}</h3>
            <p class="text-orange-500 font-semibold mt-1">${item.price.toLocaleString()} F CFA</p>
          </div>
          <div class="bg-gray-100 rounded-full flex items-center space-x-3 px-3 py-1 text-lg font-medium text-gray-700">
            <button onclick="changeQty(${item.id}, -1)">−</button>
            <span>${item.qty}</span>
            <button onclick="changeQty(${item.id}, 1)">＋</button>
          </div>
        `;
                container.appendChild(div);
            });

            totalEl.textContent = `${total.toLocaleString()} F CFA`;
            countEl.textContent = count;
        }

        function changeQty(id, delta) {
            const cart = getCart();
            const item = cart.find(p => p.id === id);
            if (item) {
                item.qty += delta;
                if (item.qty <= 0) {
                    const index = cart.findIndex(p => p.id === id);
                    cart.splice(index, 1);
                }
                localStorage.setItem('cart', JSON.stringify(cart));
                renderCart();
            }
        }

        // Réinitialiser le panier après la validation de la commande
        function resetCart() {
            localStorage.setItem('cart', JSON.stringify([])); // Réinitialisation du panier
            updateCartCount(); // Mettre à jour le compteur du panier
        }

        document.addEventListener('DOMContentLoaded', renderCart);
    </script>
    <script>
        function getCart() {
            return JSON.parse(localStorage.getItem('cart')) || [];
        }

        function updateCartCount() {
            const cart = getCart();
            const count = cart.reduce((sum, item) => sum + item.qty, 0);
            const badge = document.getElementById('cartCount');
            if (badge) {
                badge.textContent = count;
                badge.classList.toggle('hidden', count === 0);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateCartCount();
        });
    </script>

</body>

</html>
