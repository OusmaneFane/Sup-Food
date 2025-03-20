<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $titre ?? "Sup'Food - Inscription" }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body
    class="bg-cover bg-no-repeat min-h-screen flex flex-col items-center"
    style="background-image: url('{{ asset('images/Inscription et connection.png') }}')"
  >
    <!-- Bouton Retour -->
    <button class="fixed top-10 left-5 z-50">
      <img src="{{ asset('images/leftarrow.png') }}" alt="Retour" class="w-16 sm:w-20 mt-40" />
    </button>

    <!-- Contenu Principal -->
    <main class="flex flex-col items-center w-full px-6 sm:px-0 mt-72">
      <h1 class="text-3xl sm:text-4xl text-center mt-28 sm:mt-36 text-amber-50">
        INSCRIPTION
      </h1>

      <!-- Barre de séparation -->
      <div class="w-full flex justify-center mt-4">
        <div class="w-16 sm:w-20 h-2 bg-amber-50 rounded-2xl"></div>
        <div class="ml-2 w-2 h-2 bg-amber-50 rounded-2xl"></div>
        <div class="ml-2 w-16 sm:w-20 h-2 bg-amber-50 rounded-2xl"></div>
      </div>

      <!-- Formulaire -->
      <form action="{{ url('/inscription') }}" method="POST" class="mt-6 flex flex-col items-center w-full max-w-md">
        @csrf
        <input
          type="text"
          name="name"
          placeholder="Nom"
          value={{old("name","Supmanagement")}}
          required
          class="w-full h-14 sm:h-16 rounded-2xl pl-4 text-lg border  focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
          @error("name")
                {{$message}}
          @enderror
        <input
          type="number"
          name="matricule"
          placeholder="Matricule"
          value={{old("matricule","0000000")}}
          required
          class="w-full h-14 sm:h-16 rounded-2xl pl-4 text-lg border border-gray-300 mt-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
          @error("matricule")
          {{$message}}
          @enderror
      <input
          type="email"
          name="email"
          placeholder="exemple@supmanagement.ml"
          value={{old("email","resto@supmanagement.ml")}}
          required
          class="w-full h-14 sm:h-16 rounded-2xl pl-4 text-lg border border-gray-300 mt-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
      />
          @error("email")
          {{$message}}
          @enderror
        <input
          type="password"
          name="password"
          placeholder="Mot de passe"
          value={{old("password","test1@tset")}}
          required
          class="w-full h-14 sm:h-16 rounded-2xl pl-4 text-lg border border-gray-300 mt-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
          @error("password")
          {{$message}}
          @enderror
        <input
          type="password"
          name="password_confirmation"
          placeholder="Confirmer mot de passe"
          required

          value={{old('password_confirmation',"test1@tset")}}

          class="w-full h-14 sm:h-16 rounded-2xl pl-4 text-lg border border-gray-300 mt-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
          @error("password_confirmation")
          {{$message}}
          @enderror
        <!-- Bouton d'Inscription -->
        <button
          type="submit"
          class="mt-8 h-12 w-40 text-black bg-white rounded-2xl hover:bg-blue-500 font-bold shadow-md"
        >
          S'inscrire
        </button>
      </form>
    </main>

    <script>
      // sur le bouton de retour
      const backButton = document.querySelector(".fixed");
      backButton.addEventListener("click", () => {
        window.location.href = "{{ url('/welcome') }}";
      });
    </script>
  </body>
</html>
