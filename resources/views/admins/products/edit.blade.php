@extends('layouts.main')

@section('content')
<div class="p-6 bg-white rounded-xl shadow-lg max-w-xl mx-auto">
    <h2 class="text-xl font-bold text-primary mb-4">✏️ Modifier le produit</h2>

    <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label class="block mb-2 font-medium">Nom</label>
        <input type="text" name="name" value="{{ $product->name }}" class="w-full p-3 rounded-lg border border-gray-300 focus:ring-primary" required>

        <label class="block mt-4 mb-2 font-medium">Prix</label>
        <input type="number" name="price" value="{{ $product->price }}" class="w-full p-3 rounded-lg border border-gray-300 focus:ring-primary" required>

        <label class="block mt-4 mb-2 font-medium">Catégorie</label>
        <select name="category_id" class="w-full p-3 rounded-lg border border-gray-300 focus:ring-primary" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected($product->category_id == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <label class="block mt-4 mb-2 font-medium">Image (optionnel)</label>
        <input type="file" name="image" class="w-full p-2 border rounded">
        @if($product->image)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $product->image) }}" class="h-20 rounded shadow">
            </div>
        @endif

        <button type="submit" class="mt-6 w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
            Mettre à jour
        </button>
    </form>
</div>
@endsection
