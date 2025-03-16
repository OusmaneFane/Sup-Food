<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>{{ $titre ?? "Créer un nouveau mot de passe" }}</title>
  </head>
  <body
    class="bg-cover bg-center h-screen flex justify-center items-center"
    style="background-image: url('{{ asset('images/Inscription et connection.png') }}')"
  >
    <main
      class="w-full max-w-md bg-gray-100 rounded-3xl shadow-lg p-8 sm:p-10 relative"
    >
      <!-- Bouton Sortie -->
      <button id="backButton" class="absolute top-4 right-4">
        <img src="{{ asset('images/exit.png') }}" alt="sortie" class="w-8 sm:w-10" />
      </button>

      <!-- Titre -->
      <h1 class="text-2xl sm:text-3xl text-center font-extrabold text-gray-800">
        Créer un nouveau mot de passe
      </h1>

      <!-- Formulaire -->
      <form action="{{ url('/mot-de-passe-oublie') }}" method="POST" class="mt-6" id="resetPasswordForm">
        @csrf
        <input
          type="text"
          name="matricule"
          placeholder="Matricule"
          required
          class="block w-full max-w-xs mx-auto h-14 rounded-2xl px-3 text-lg border border-gray-300 focus:ring-2 focus:ring-blue-500"
        />
        <input
          type="password"
          name="password"
          placeholder="Nouveau mot de passe"
          required
          class="block w-full max-w-xs mx-auto h-14 rounded-2xl px-3 text-lg mt-4 border border-gray-300 focus:ring-2 focus:ring-blue-500"
        />
        <input
          type="password"
          name="password_confirmation"
          placeholder="Confirmer mot de passe"
          required
          class="block w-full max-w-xs mx-auto h-14 rounded-2xl px-3 text-lg mt-4 border border-gray-300 focus:ring-2 focus:ring-blue-500"
        />
        <!-- Bouton Valider -->
        <div class="flex justify-center mt-8">
          <button
            type="submit"
            class="w-40 h-12 bg-green-600 text-white text-2xl sm:text-3xl rounded-2xl font-extrabold shadow-md hover:bg-green-700 transition"
          >
            Valider
          </button>
        </div>
      </form>
    </main>

    <script>
      document.getElementById("backButton").addEventListener("click", () => {
        window.location.href = "{{ url('/connexion') }}";
      });

      // Validation des mots de passe
      document.getElementById("resetPasswordForm").addEventListener("submit", function(event) {
        const password = document.querySelector('input[name="password"]').value;
        const confirmPassword = document.querySelector('input[name="password_confirmation"]').value;

        if (password !== confirmPassword) {
          event.preventDefault();
          alert("Les mots de passe ne correspondent pas !");
        }
      });
    </script>
  </body>
</html>
