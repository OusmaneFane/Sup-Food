<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>{{ $titre ?? "Mot de passe changé" }}</title>
  </head>
  <body
    class="bg-cover bg-center h-screen flex justify-center items-center"
    style="background-image: url('{{ asset('images/Inscription et connection.png') }}')"
  >
    <main
      class="w-full max-w-md bg-gray-100 rounded-3xl shadow-lg p-8 text-center"
    >
      <!-- Titre -->
      <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-800">
        Votre mot de passe a été changé
      </h1>

      <!-- Image Validé -->
      <div class="flex justify-center mt-10">
        <img src="{{ asset('images/Valide.png') }}" alt="Validé" class="w-24 sm:w-32" />
      </div>

      <!-- Bouton OK -->
      <div class="flex justify-center mt-10">
        <button
          type="button"
          onclick="window.location.href='{{ url('/connexion') }}'"
          class="w-24 h-14 bg-green-600 text-white text-2xl sm:text-4xl rounded-2xl font-extrabold shadow-md hover:bg-green-700 transition"
        >
          OK
        </button>
      </div>
    </main>
  </body>
</html>
