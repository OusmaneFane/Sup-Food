<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SUP'FOOD - Accueil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryButtons = document.querySelectorAll('#categoryButtons button');
        const products = document.querySelectorAll('#productList .product');

        categoryButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Mise à jour du style actif
                categoryButtons.forEach(btn => {
                    btn.classList.remove('bg-orange-500', 'text-white');
                    btn.classList.add('bg-gray-200', 'text-gray-700');
                });

                button.classList.remove('bg-gray-200', 'text-gray-700');
                button.classList.add('bg-orange-500', 'text-white');

                const selectedCategory = button.dataset.category;

                products.forEach(product => {
                    const productCategory = product.dataset.category;

                    if (selectedCategory === 'all' || selectedCategory ===
                        productCategory) {
                        product.classList.remove('hidden');
                    } else {
                        product.classList.add('hidden');
                    }
                });
            });
        });
    });
</script>

<body class="bg-[#f4fbff] text-gray-800 overflow-x-hidden relative">

    <!-- HEADER -->
    <div class="bg-[#e6f6ff] px-4 pt-6 pb-2 rounded-b-3xl relative">
        <div class="flex justify-between items-center mb-4">
            <button id="openMenu" class="text-xl">☰</button>
            <img src="/images/logo.png" alt="logo" class="h-6" />
            <button class="text-2xl">⤴️</button>
        </div>
        <input type="text" placeholder="Recherchez ici..."
            class="w-full p-3 rounded-full bg-white text-sm focus:outline-none" />
    </div>

    <!-- FILTRES -->
    <div id="categoryButtons" class="flex space-x-2 overflow-x-auto px-4 py-3 text-sm font-medium">
        <button class="px-4 py-1 rounded-full bg-orange-500 text-white" data-category="all">Toutes</button>
        @foreach ($categories as $category)
            <button class="px-4 py-1 rounded-full bg-gray-200 text-gray-700"
                data-category="{{ Str::slug($category->name) }}">
                {{ $category->name }}
            </button>
        @endforeach
    </div>

    <!-- PRODUITS -->
    <div id="productList" class="grid grid-cols-2 gap-4 p-4 pb-20">
        @foreach ($products as $product)
            <div class="bg-white rounded-xl shadow-sm p-2 product"
                data-category="{{ Str::slug($product->category->name ?? 'autre') }}">
                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/150' }}"
                    class="rounded-xl mb-2 w-full h-32 object-cover" />
                <h3 class="text-sm font-medium">{{ $product->name }}</h3>
                <p class="text-orange-500 font-semibold mt-1">
                    {{ number_format($product->price, 0, ',', ' ') }} F CFA
                </p>
                <button class="add-to-cart w-full text-white bg-orange-500 rounded-lg py-2"
                    data-product="{{ htmlspecialchars(
                        json_encode([
                            'id' => $product->id,
                            'name' => $product->name,
                            'price' => $product->price,
                            'image' => $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/150',
                        ]),
                        ENT_QUOTES,
                        'UTF-8',
                        true,
                    ) }}">
                    🛒 Ajouter au Panier
                </button>
            </div>
        @endforeach
    </div>

    <!-- NAVIGATION -->
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
    <!-- MENU SLIDE -->
    <div id="menu"
        class="fixed top-0 left-0 h-full w-full bg-white z-50 translate-x-full transition-transform duration-300 ease-in-out">
        <div class="bg-[#e6f6ff] p-4 rounded-b-3xl flex items-center">
            <button id="closeMenu" class="text-xl mr-2">←</button>
            <h2 class="text-lg font-bold">Menu</h2>
        </div>

        <div class="p-4 space-y-4">
            <div class="bg-[#f3f9f8] rounded-xl flex items-center justify-between px-4 py-3">
                <div class="flex items-center space-x-2">
                    <span>📍</span>
                    <span>Adresses de Livraison</span>
                </div>
                <span>›</span>
            </div>
            <div class="bg-[#f3f9f8] rounded-xl flex items-center justify-between px-4 py-3">
                <div class="flex items-center space-x-2">
                    <span>🌐</span>
                    <span>Langues</span>
                </div>
                <span>›</span>
            </div>
            <div class="bg-[#f3f9f8] rounded-xl flex items-center justify-between px-4 py-3">
                <div class="flex items-center space-x-2">
                    <span>🎧</span>
                    <span>Compte</span>
                </div>
                <span>›</span>
            </div>
            <div
                class="bg-[#f3f9f8] mt-12 rounded-xl flex items-center justify-between px-4 py-3 text-red-500 font-semibold">
                <div class="flex items-center space-x-2">
                    <span>🚪</span>
                    <span>Se déconnecter</span>
                </div>
                <span>›</span>
            </div>
        </div>
    </div>

    <script>
        // Menu
        const openMenu = document.getElementById("openMenu");
        const closeMenu = document.getElementById("closeMenu");
        const menu = document.getElementById("menu");

        openMenu.addEventListener("click", () => menu.classList.remove("translate-x-full"));
        closeMenu.addEventListener("click", () => menu.classList.add("translate-x-full"));

        // Filtres produits
        const categoryButtons = document.querySelectorAll("#categoryButtons button");
        const products = document.querySelectorAll(".product");

        categoryButtons.forEach((btn) => {
            btn.addEventListener("click", () => {
                categoryButtons.forEach((b) => b.classList.remove("bg-orange-500", "text-white"));
                btn.classList.add("bg-orange-500", "text-white");

                const selected = btn.dataset.category;
                products.forEach((p) => {
                    if (selected === "all" || p.dataset.category === selected) {
                        p.classList.remove("hidden");
                    } else {
                        p.classList.add("hidden");
                    }
                });
            });
        });
    </script>

    <!-- JS -->
    <script>
        function getCart() {
            return JSON.parse(localStorage.getItem('cart')) || [];
        }

        function saveCart(cart) {
            localStorage.setItem('cart', JSON.stringify(cart));
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

            document.querySelectorAll('.add-to-cart').forEach(btn => {
                btn.addEventListener('click', function() {
                    try {
                        // Vérification que l'attribut existe
                        if (!btn.dataset.product) {
                            throw new Error('No product data found');
                        }

                        // Décodage du HTML entities avant le parse JSON
                        const decodedData = decodeURIComponent(btn.dataset.product
                            .replace(/&quot;/g, '"')
                            .replace(/&#039;/g, "'"));

                        const product = JSON.parse(decodedData);

                        // Reste de votre logique...
                        const cart = getCart();
                        const existing = cart.find(item => item.id === product.id);

                        if (existing) {
                            existing.qty++;
                        } else {
                            cart.push({
                                ...product,
                                qty: 1
                            });
                        }

                        saveCart(cart);
                        updateCartCount();

                        // Feedback visuel
                        btn.innerHTML = '✓ Ajouté';
                        btn.classList.add('bg-green-500');

                        setTimeout(() => {
                            btn.innerHTML = '🛒 Ajouter au Panier';
                            btn.classList.remove('bg-green-500');
                        }, 2000);

                    } catch (error) {
                        console.error('Error processing product:', error);
                        // Fallback ou message d'erreur à l'utilisateur
                        btn.innerHTML = 'Erreur';
                        btn.classList.add('bg-red-500');
                        setTimeout(() => {
                            btn.innerHTML = '🛒 Ajouter au Panier';
                            btn.classList.remove('bg-red-500');
                        }, 2000);
                    }
                });
            });
        });
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
