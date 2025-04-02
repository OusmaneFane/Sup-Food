@extends('layouts.main')

@section('content')
<div class="p-6 bg-white rounded-xl shadow-lg max-w-lg mx-auto">
    <h2 class="text-xl font-bold text-primary mb-4">➕ Nouvelle catégorie</h2>

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <label class="block mb-2 font-medium">Nom de la catégorie</label>
        <input type="text" name="name" class="w-full p-3 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary" required placeholder="Ex: Alimentation">

        <button type="submit" class="mt-6 w-full bg-primary text-white py-2 rounded-lg hover:bg-primary/90 transition">
            Enregistrer
        </button>
    </form>
</div>
@endsection
