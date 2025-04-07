<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SUP'FOOD - Accueil</title>
    @php use Illuminate\Support\Str; @endphp

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

            <img src="/images/logo.png" alt="logo" class="h-12" />
            <button id="openMenuProfile">
                <!-- Photo de profil avec déclencheur du menu -->
                <svg class="h-8 w-8 rounded-full border-2 border-orange-500 shadow-md object-cover cursor-pointer text-sky-600"
                    fill="currentColor" viewBox="0 0 448 512" aria-hidden="true">
                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm89.6
           32h-11.8c-22.3 10.3-46.9 16-73.8 16s-51.5-5.7-73.8-16h-11.8A134.4
           134.4 0 0 0 8 422.4v25.6A64 64 0 0 0 72 512h304a64 64 0 0 0
           64-64v-25.6A134.4 134.4 0 0 0 313.6 288z" />
                </svg> </button>
        </div>

        <input id="searchInput" type="text" placeholder="Recherchez ici..."
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
    <!-- Remplacez la section menuProfil par ce code -->
    <div id="menuProfil"
        class="fixed top-0 left-0 h-full w-full bg-white z-50 translate-x-full transition-transform duration-300 ease-in-out overflow-y-auto">
        <!-- Header avec bouton retour -->
        <div class="bg-[#e6f6ff] p-4 rounded-b-3xl flex items-center sticky top-0 z-10">
            <button id="closeMenuProfil" class="text-xl mr-2">←</button>
            <h2 class="text-lg font-bold">Mon Profil</h2>
        </div>

        <!-- Section profil -->
        <div class="p-4">
            <!-- Carte profil -->
            <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-2xl p-6 shadow-sm mb-6 text-center">
                <div class="flex justify-center mb-4">
                    <div class="relative">
                        <img src="{{ auth()->user()->photo ?? '/images/logo.png' }}" alt="Photo de profil"
                            class="h-24 w-24 rounded-full border-4 border-white shadow-md object-cover mx-auto">
                        <button
                            class="absolute bottom-0 right-0 bg-blue-500 text-white rounded-full p-2 shadow-md hover:bg-blue-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <h3 class="text-xl font-bold text-gray-800">{{ $studentInfos['firstname'] }}
                    {{ $studentInfos['lastname'] }}</h3>
                <p class="text-blue-500 text-sm">{{ auth()->user()->email }}</p>

                <div class="flex justify-center space-x-4 mt-4">
                    <div class="text-center">
                        <div class="text-gray-500 text-xs">Commandes</div>
                        <div class="font-bold text-gray-800">{{ $userOrdersCount }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-gray-500 text-xs">Favoris</div>
                        <div class="font-bold text-gray-800">5</div>
                    </div>
                    <div class="text-center">
                        <div class="text-gray-500 text-xs">Depuis</div>
                        <div class="font-bold text-gray-800">{{ auth()->user()->created_at->format('m/Y') }}</div>
                    </div>
                </div>
            </div>

            <!-- Menu options -->
            <div class="space-y-3">
                <!-- Section Informations -->
                <div class="bg-white rounded-xl shadow-sm p-4">
                    <h4 class="font-medium text-gray-500 mb-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Informations personnelles
                    </h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Matricule</span>
                            <span class="font-medium">{{ $studentInfos['username'] }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Email</span>
                            <span class="font-medium">{{ auth()->user()->email }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600">Téléphone</span>
                            <span class="font-medium">{{ $studentInfos['phone'] }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600">Adresse</span>
                            <span class="font-medium">{{ $studentInfos['address'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Bouton Déconnexion -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full bg-red-50 text-red-500 font-medium rounded-xl py-3 mt-6 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Se déconnecter
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ---- Sélection des éléments ----
            const categoryButtons = document.querySelectorAll('#categoryButtons button');
            const products = document.querySelectorAll('#productList .product');
            const searchInput = document.getElementById('searchInput');

            let selectedCategory = 'all'; // catégorie par défaut

            // ---- Fonction de filtrage combiné (catégorie + recherche) ----
            function filterProducts() {
                const query = searchInput.value.toLowerCase().trim();

                products.forEach(product => {
                    const productCategory = product.dataset.category;
                    const productName = product.querySelector('h3').textContent.toLowerCase();

                    // Vérifie si la catégorie correspond OU si 'all' est sélectionné
                    const matchCategory = (selectedCategory === 'all' || productCategory ===
                        selectedCategory);

                    // Vérifie si le nom du produit contient le texte recherché
                    const matchSearch = (query === '' || productName.includes(query));

                    // Affiche ou masque selon les deux conditions
                    if (matchCategory && matchSearch) {
                        product.classList.remove('hidden');
                    } else {
                        product.classList.add('hidden');
                    }
                });
            }

            // ---- Gestion du clic sur les boutons de catégorie ----
            categoryButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Mise à jour du style actif
                    categoryButtons.forEach(btn => {
                        btn.classList.remove('bg-orange-500', 'text-white');
                        btn.classList.add('bg-gray-200', 'text-gray-700');
                    });
                    button.classList.remove('bg-gray-200', 'text-gray-700');
                    button.classList.add('bg-orange-500', 'text-white');

                    // Met à jour la catégorie sélectionnée
                    selectedCategory = button.dataset.category;

                    // Filtre les produits
                    filterProducts();
                });
            });

            // ---- Recherche : écoute de la saisie ----
            if (searchInput) {
                searchInput.addEventListener('input', () => {
                    filterProducts();
                });
            }

            // Menu latéral
            const openMenu = document.getElementById("openMenu");
            const closeMenu = document.getElementById("closeMenu");
            const menu = document.getElementById("menu");

            openMenu.addEventListener("click", () => menu.classList.remove("translate-x-full"));
            closeMenu.addEventListener("click", () => menu.classList.add("translate-x-full"));
        });
    </script>

    <script>
        // Gestion du menu profil
        const openMenuProfile = document.getElementById("openMenuProfile");
        const closeMenuProfil = document.getElementById("closeMenuProfil");
        const menuProfil = document.getElementById("menuProfil");

        openMenuProfile.addEventListener("click", () => {
            menuProfil.classList.remove("translate-x-full");
            document.body.style.overflow = 'hidden';
        });

        closeMenuProfil.addEventListener("click", () => {
            menuProfil.classList.add("translate-x-full");
            document.body.style.overflow = 'auto';
        });
    </script>

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

    <script>
        // Menu
        const openMenuProfile = document.getElementById("openMenuProfile");
        const closeMenuProfil = document.getElementById("closeMenuProfil");
        const menuProfil = document.getElementById("menuProfil");

        openMenuProfile.addEventListener("click", () => menu.classList.remove("translate-x-full"));
        closeMenu.addEventListener("click", () => menu.classList.add("translate-x-full"));
    </script>

</body>

</html>
