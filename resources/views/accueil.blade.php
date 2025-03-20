<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $titre ?? "Sup'Food - Accueil" }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex justify-center bg-cover bg-center bg-no-repeat min-h-screen"
      style="background-image: url('{{ asset('images/acceuil.png') }}');">

    <!-- Formes décoratives -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <!-- Cercle orange -->
        <div class="absolute top-20 -right-20 w-96 h-96 bg-orange-500 rounded-full mix-blend-multiply blur-3xl opacity-20"></div>

        <!-- Cercle bleu -->
        <div class="absolute -bottom-32 -left-40 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply blur-3xl opacity-10"></div>

        <!-- Forme organique -->
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-yellow-400 rounded-blob blur-2xl opacity-10"></div>
    </div>

    <section class="w-full max-w-3xl p-4 relative z-10">
        <!-- Header -->
        <header class="flex justify-between items-center p-4">
            <div class="logo">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo Sup'Food" class="h-10">
            </div>
            <nav>
                <a href="{{ url('/navigation') }}">
                    <img src="{{ asset('images/menu.png') }}" alt="Menu" class="h-8">
                </a>
            </nav>
        </header>

        <!-- Menu -->
        <div class="text-center text-white">
            <h1 class="text-3xl font-bold">Menu du jour</h1>
            <div class="flex items-center justify-center gap-4 my-4">
                <div class="w-1/4 h-1 bg-white rounded-full"></div>
                <div class="w-2 h-2 bg-white rounded-full"></div>
                <div class="w-1/4 h-1 bg-white rounded-full"></div>
            </div>
            <p class="text-lg font-light">
                Hey, {{ $user ?? 'Utilisateur' }} ! T'as une dalle ? <br>
                Qu'est-ce qui te fera plaisir aujourd'hui ?
            </p>
        </div>

        <!-- Barre de recherche -->
        <div class="mt-6 text-center">
            <input type="text" placeholder="🔍 Recherche Menu" class="w-4/5 p-3 border-2 border-gray-300 rounded-full text-lg">
        </div>

        <!-- Ajoutez ceci après la barre de recherche -->
        <div class="relative mt-6">
            <!-- Forme en arrière-plan -->
            <div class="absolute -top-10 right-0 w-72 h-72 bg-orange-500 rounded-full blur-3xl opacity-20"></div>

            <!-- Votre contenu existant -->
            <div class="relative z-10">
                <!-- Liste des plats -->
                <div class="space-y-4">
                    <!-- Item 1 -->
                    <div class="bg-white flex items-center rounded-lg shadow-md p-4">
                        <img src="{{ asset('images/Chawarma.jpg') }}" alt="chawarma" class="w-24 h-24 rounded-lg border-4 border-orange-500 object-cover">
                        <div class="ml-4 flex-1">
                            <h3 class="text-lg font-bold">Shawarma viande</h3>
                            <h4 class="text-sm text-gray-600">Prix : 1500fcfa</h4>
                            <!-- Système d'étoiles -->
                            <div class="flex space-x-1 my-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5 text-yellow-400">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5 text-yellow-400">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5 text-yellow-400">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5 text-yellow-400">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5 text-gray-300">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            </div>
                            <button class="bg-orange-500 text-white px-3 py-1 rounded mt-2 hover:bg-orange-600">Ajouter</button>
                        </div>
                        <!-- Bouton favoris -->
                        <button class="favorite-button p-2 rounded-full hover:bg-gray-100 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400 hover:text-red-500 transition-colors">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </button>


                    </div>

                    <!-- Item 2 (Copie) -->
                    <div class="bg-white flex items-center rounded-lg shadow-md p-4">
                        <img src="{{ asset('images/main dishes.jpg') }}" alt="chawarma" class="w-24 h-24 rounded-lg border-4 border-orange-500 object-cover">
                        <div class="ml-4 flex-1">
                            <h3 class="text-lg font-bold">Main Dishes</h3>
                            <h4 class="text-sm text-gray-600">Prix : 1500fcfa</h4>
                            <!-- Système d'étoiles -->
                            <div class="flex space-x-1 my-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5 text-yellow-400">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5 text-yellow-400">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5 text-yellow-400">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5 text-yellow-400">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5 text-gray-300">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            </div>
                            <button class="bg-orange-500 text-white px-3 py-1 rounded mt-2 hover:bg-orange-600">Ajouter</button>
                        </div>
                        <!-- Bouton favoris -->
                        <button class="favorite-button p-2 rounded-full hover:bg-gray-100 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400 hover:text-red-500 transition-colors">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </button>
                    </div>

                    <!-- Item 3 (Copie) -->
                    <div class="bg-white flex items-center rounded-lg shadow-md p-4">
                        <img src="{{ asset('images/bissap.jpg') }}" alt="chawarma" class="w-24 h-24 rounded-lg border-4 border-orange-500 object-cover">
                        <div class="ml-4 flex-1">
                            <h3 class="text-lg font-bold">Bissap</h3>
                            <h4 class="text-sm text-gray-600">Prix : 1500fcfa</h4>
                            <!-- Système d'étoiles -->
                            <div class="flex space-x-1 my-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5 text-yellow-400">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5 text-yellow-400">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5 text-yellow-400">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5 text-yellow-400">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5 text-gray-300">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            </div>
                            <button class="bg-orange-500 text-white px-3 py-1 rounded mt-2 hover:bg-orange-600">Ajouter</button>
                        </div>
                        <!-- Bouton favoris -->
                        <button class="favorite-button p-2 rounded-full hover:bg-gray-100 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400 hover:text-red-500 transition-colors">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="fixed bottom-4 left-1/2 transform -translate-x-1/2 w-4/5 bg-orange-500 shadow-lg rounded-full flex justify-around items-center py-3">
        <a href="{{ url('/favoris') }}" class="text-center text-white hover:text-blue-400 transition-colors duration-200">
            <!-- Icône Favoris -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
            </svg>
        </a>
        <a href="{{ url('/commandes') }}" class="text-center text-white hover:text-blue-400 transition-colors duration-200">
            <!-- Heroicon document-text -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
        </a>
        <a href="{{ url('/accueil') }}" class="text-center text-white hover:text-blue-400 transition-colors duration-200">
            <!-- Heroicon home -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
        </a>
        <a href="{{ url('/notifications') }}" class="text-center text-white hover:text-blue-400 transition-colors duration-200">
            <!-- Heroicon bell -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
            </svg>
        </a>
        <a href="{{ url('/panier') }}" class="text-center text-white hover:text-blue-400 transition-colors duration-200">
            <!-- Heroicon shopping-cart -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
            </svg>
        </a>

        @auth
        <a href="{{ url('/logout') }}" class="text-center text-white hover:text-blue-400 transition-colors duration-200">
            <!-- Heroicon shopping-cart -->
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M10.5 6h-6a2.25
           2.25 0 00-2.25 2.25v7.5A2.25
           2.25 0 004.5 18h6m0-12h7.5a2.25
           2.25 0 012.25 2.25v7.5a2.25
           2.25 0 01-2.25 2.25h-7.5m0-12v3m0
           0l-3-3m3 3l3-3m-3 9v-3m0
           0l-3 3m3-3l3 3"
                    />
                </svg>

        </a>
        @endauth
    </footer>

    <!-- Ajoutez ce script à la fin du body -->
    <script>
        // Pour les boutons favoris
        document.querySelectorAll('.favorite-button').forEach(button => {
            button.addEventListener('click', function() {
                const icon = this.querySelector('svg');
                if (icon.getAttribute('fill') === 'none') {
                    icon.setAttribute('fill', 'currentColor');
                    icon.classList.add('text-red-500');
                    icon.classList.remove('text-gray-400');
                } else {
                    icon.setAttribute('fill', 'none');
                    icon.classList.add('text-gray-400');
                    icon.classList.remove('text-red-500');
                }
            });
        });
    </script>
</body>
</html>
