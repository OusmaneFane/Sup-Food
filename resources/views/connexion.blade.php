<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>{{ $titre ?? "Connexion" }}</title>
  </head>
  <body
    class="bg-cover bg-center h-screen flex justify-center items-center"
    style="background-image: url('{{ asset('images/Inscription et connection.png') }}')"
  >
    <!-- Bouton Retour -->
    <button class="fixed top-10 left-5 z-50 mt-40">
      <img src="{{ asset('images/leftarrow.png') }}" alt="Retour" class="w-16 sm:w-20" />
    </button>

    <main class="w-full max-w-md bg-opacity-10 p-8 mt-60">
      <!-- Titre -->
      <h1 class="text-4xl text-center text-amber-50 font-bold">CONNEXION</h1>

      <!-- Séparateur -->
      <div class="w-full flex justify-center mt-4">
        <div class="w-16 sm:w-20 h-2 bg-amber-50 rounded-2xl"></div>
        <div class="ml-2 w-2 h-2 bg-amber-50 rounded-2xl"></div>
        <div class="ml-2 w-16 sm:w-20 h-2 bg-amber-50 rounded-2xl"></div>
      </div>

      <!-- Formulaire -->
      <form action="{{ url('/connexion') }}" method="POST" class="mt-6 flex flex-col items-center w-full">
        @csrf
        <input
          type="text"
          name="email"
          placeholder="Matricule / Email"
          value={{old("email","resto@supmanagement.ml")}}
          required
          class="w-full max-w-md h-14 sm:h-16 rounded-2xl pl-4 text-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
          @error("email")
          {{$message}}
          @enderror

        <input
          type="password"
          name="password"
          placeholder="Mot de passe"
          value={{old('password',"test1@tset")}}
          required
          class="w-full max-w-md h-14 sm:h-16 rounded-2xl pl-4 text-lg border border-gray-300 mt-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
          @error("password")
          {{$message}}
          @enderror
        <div class="flex items-center">
          <a href="{{ url('/mot-de-passe-oublie') }}"
             class="ml-2 mr-2.5 text-white underline underline-offset-4">
            Mot de passe oublié ?
          </a>

          <button
            type="submit"
            class="mr-2 mt-8 h-10 w-40 text-black bg-white rounded-2xl hover:bg-blue-500"
          >
            Se connecter
          </button>
        </div>
      </form>
    </main>

    <script>
      const buttonBack = document.querySelector(".fixed");
      buttonBack.addEventListener("click", function () {
        window.location.href = "{{ url('/welcome') }}";
      });
    </script>
  </body>
</html>
