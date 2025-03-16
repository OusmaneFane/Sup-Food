
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $titre ?? "Sup'Food - Bienvenue" }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body
    class="h-screen bg-cover bg-center bg-no-repeat"
    style="background-image: url('{{ asset('images/aa.png') }}')"
  >
    <!-- Logo en haut à droite -->
    <div class="flex justify-end p-4">
      <img src="{{ asset('images/logo.jpg') }}" alt="le logo" class="w-16 h-16 sm:w-20 sm:h-20" />
    </div>

    <!-- Contenu principal -->
    <div class="flex flex-col justify-center items-center h-full px-6">
      <div class="w-full max-w-md text-center p-6 rounded-lg -translate-y-20">
        <!-- Titre -->
        <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-6">
          BIENVENUE !
        </h1>

        <!-- Boutons -->
        <div class="space-y-4">
          <a
            href="{{ url('/inscription') }}"
            class="block w-full bg-blue-500 text-white py-2 rounded-md text-2xl sm:text-3xl hover:bg-blue-600 transition"
            >INSCRIPTION</a
          >
          <a
            href="{{ url('/connexion') }}"
            class="block w-full bg-blue-500 text-white py-2 rounded-md text-2xl sm:text-3xl hover:bg-blue-600 transition"
            >CONNEXION</a
          >
        </div>

        <!-- Texte d'info -->
        <div class="mt-6 text-gray-900 text-xl sm:text-2xl">
          <p>Connectez-vous</p>
          <p class="mt-2">Si vous avez déjà un compte !</p>
        </div>
      </div>
    </div>
  </body>
</html>
