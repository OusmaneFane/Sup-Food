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

    <section class="w-full max-w-3xl p-4">
        <!-- Header -->
        <header class="flex justify-between items-center p-4">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Sup'Food" class="h-10">
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

        <!-- Liste des plats -->
        <div class="mt-6 space-y-4">
            <!-- Item 1 -->
            <div class="bg-white flex items-center rounded-lg shadow-md p-4">
                <img src="{{ asset('images/chawarma.jpg') }}" alt="chawarma" class="w-24 h-24 rounded-lg border-4 border-orange-500 object-cover">
                <div class="ml-4 flex-1">
                    <h3 class="text-lg font-bold">Shawarma viande</h3>
                    <h4 class="text-sm text-gray-600">Prix : 1500fcfa</h4>
                    <img src="{{ asset('images/etoiles.png') }}" alt="Étoiles" class="my-1">
                    <button class="bg-orange-500 text-white px-3 py-1 rounded mt-2 hover:bg-orange-600">Ajouter</button>
                </div>
                <img src="{{ asset('images/favoris-cercle.png') }}" alt="Favoris" class="w-6 h-6">
            </div>

            <!-- Item 2 (Copie) -->
            <div class="bg-white flex items-center rounded-lg shadow-md p-4">
                <img src="{{ asset('images/chawarma.jpg') }}" alt="chawarma" class="w-24 h-24 rounded-lg border-4 border-orange-500 object-cover">
                <div class="ml-4 flex-1">
                    <h3 class="text-lg font-bold">Shawarma viande</h3>
                    <h4 class="text-sm text-gray-600">Prix : 1500fcfa</h4>
                    <img src="{{ asset('images/etoiles.png') }}" alt="Étoiles" class="my-1">
                    <button class="bg-orange-500 text-white px-3 py-1 rounded mt-2 hover:bg-orange-600">Ajouter</button>
                </div>
                <img src="{{ asset('images/favoris-cercle.png') }}" alt="Favoris" class="w-6 h-6">
            </div>

            <!-- Item 3 (Copie) -->
            <div class="bg-white flex items-center rounded-lg shadow-md p-4">
                <img src="{{ asset('images/chawarma.jpg') }}" alt="chawarma" class="w-24 h-24 rounded-lg border-4 border-orange-500 object-cover">
                <div class="ml-4 flex-1">
                    <h3 class="text-lg font-bold">Shawarma viande</h3>
                    <h4 class="text-sm text-gray-600">Prix : 1500fcfa</h4>
                    <img src="{{ asset('images/etoiles.png') }}" alt="Étoiles" class="my-1">
                    <button class="bg-orange-500 text-white px-3 py-1 rounded mt-2 hover:bg-orange-600">Ajouter</button>
                </div>
                <img src="{{ asset('images/favoris-cercle.png') }}" alt="Favoris" class="w-6 h-6">
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="fixed bottom-4 left-1/2 transform -translate-x-1/2 w-4/5 bg-orange-500 shadow-lg rounded-full flex justify-around items-center py-3">
        <a href="{{ url('/favoris') }}" class="text-center">
            <img src="{{ asset('images/favoris.png') }}" alt="Favoris" class="w-8 h-8">
        </a>
        <a href="{{ url('/commandes') }}" class="text-center">
            <img src="{{ asset('images/document.png') }}" alt="Document" class="w-8 h-8">
        </a>
        <a href="{{ url('/accueil') }}" class="text-center">
            <img src="{{ asset('images/home.png') }}" alt="Accueil" class="w-8 h-8">
        </a>
        <a href="{{ url('/notifications') }}" class="text-center">
            <img src="{{ asset('images/alert.png') }}" alt="Alerte" class="w-8 h-8">
        </a>
        <a href="{{ url('/panier') }}" class="text-center">
            <img src="{{ asset('images/basket.png') }}" alt="Panier" class="w-8 h-8">
        </a>
    </footer>
</body>
</html>