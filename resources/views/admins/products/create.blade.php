@extends('layouts.main')

@section('content')
<div class="p-6 bg-white rounded-xl shadow-lg max-w-xl mx-auto">
    <h2 class="text-xl font-bold text-primary mb-4">➕ Nouveau produit</h2>

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf

        <label class="block mb-2 font-medium">Nom du produit</label>
        <input type="text" name="name" class="w-full p-3 rounded-lg border border-gray-300 focus:ring-primary" required>

        <label class="block mt-4 mb-2 font-medium">Prix (F CFA)</label>
        <input type="number" name="price" class="w-full p-3 rounded-lg border border-gray-300 focus:ring-primary" required>

        <label class="block mt-4 mb-2 font-medium">Catégorie</label>
        <select name="category_id" class="w-full p-3 rounded-lg border border-gray-300 focus:ring-primary" required>
            <option value="">-- Sélectionner --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <label class="block mt-4 mb-2 font-medium">Image</label>
        <input type="file" name="image" class="w-full p-2 border rounded">

        <button type="submit" class="mt-6 w-full bg-primary text-white py-2 rounded-lg hover:bg-primary/90 transition">
            Enregistrer
        </button>
    </form>
</div>
@endsection
