<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUP'FOOD Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2198B9',
                        accent: '#EC8A1C',
                    },
                },
            },
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('styles')
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 hidden md:flex flex-col bg-white shadow-lg p-6 min-h-screen">
            <h1 class="text-2xl font-bold text-primary mb-6">Sup'Food Admin</h1>
            <nav class="space-y-3 text-sm font-medium">
                <a href="{{ route('admin.dashboard') }}"
                    class="block px-4 py-2 rounded-lg hover:bg-primary/10 {{ request()->is('dashboard') ? 'bg-primary text-white' : '' }}">
                    📊 Tableau de board
                    <a href="{{ route('users.index') }}"
                        class="block px-4 py-2 rounded-lg hover:bg-primary/10 {{ request()->is('users*') ? 'bg-primary text-white' : '' }}">
                        👤 Utilisateurs
                    </a>

                    <a href="{{ route('categories.index') }}"
                        class="block px-4 py-2 rounded-lg hover:bg-primary/10 {{ request()->is('admin/categories*') ? 'bg-primary text-white' : '' }}">
                        🗂️ Catégories
                    </a>

                    <a href="{{ route('products.index') }}"
                        class="block px-4 py-2 rounded-lg hover:bg-primary/10 {{ request()->is('admin/products*') ? 'bg-primary text-white' : '' }}">
                        📦 Produits
                    </a>

                    <a href="{{ url('/admin/commandes') }}"
                        class="block px-4 py-2 rounded-lg hover:bg-primary/10 {{ request()->is('admin/commandes*') ? 'bg-primary text-white' : '' }}">
                        📋 Commandes
                    </a>

                    <a href="{{ url('/admin/stats') }}"
                        class="block px-4 py-2 rounded-lg hover:bg-primary/10 {{ request()->is('admin/stats*') ? 'bg-primary text-white' : '' }}">
                        📊 Statistiques
                    </a>
                    <a href="{{ url('/admin/rapports') }}"
                        class="block px-4 py-2 rounded-lg hover:bg-primary/10 {{ request()->is('admin/rapports*') ? 'bg-primary text-white' : '' }}">
                        📈 Rapports
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 rounded-lg text-red-500 hover:bg-red-100">
                            🚪 Déconnexion
                        </button>
                    </form>
            </nav>
        </aside>

        @auth
            <!-- Main content -->
            <div class="flex-1 flex flex-col">
                <!-- Topbar -->
                <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
                    <h2 class="text-lg font-semibold">@yield('title', 'Tableau de bord')</h2>
                    <div class="flex items-center space-x-3">
                        <span>{{ auth()->user()->name }}</span>
                        <img src="https://i.pravatar.cc/40" alt="avatar" class="w-8 h-8 rounded-full">
                    </div>
                </header>

                <!-- Page content -->
                <main class="p-6">
                    @yield('content')
                    @stack('scripts')
                </main>
            </div>
        @endauth
    </div>

</body>

</html>
