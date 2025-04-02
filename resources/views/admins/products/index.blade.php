@extends('layouts.main')

@section('content')
<div class="p-6 bg-white rounded-xl shadow-lg">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-primary">Produits</h2>
        <a href="{{ route('products.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg shadow hover:bg-primary/90 transition">
            ➕ Ajouter
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <table id="productTable" class="w-full table-auto text-sm text-gray-800">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2">Image</th>
                <th class="px-4 py-2">Nom</th>
                <th class="px-4 py-2">Catégorie</th>
                <th class="px-4 py-2">Prix</th>
                <th class="px-4 py-2 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-12 h-12 object-cover rounded-md" alt="">
                        @else
                            <span class="text-gray-400 italic">Aucune</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 font-medium">{{ $product->name }}</td>
                    <td class="px-4 py-2">{{ $product->category->name ?? '-' }}</td>
                    <td class="px-4 py-2 text-orange-600 font-bold">{{ number_format($product->price, 0, ',', ' ') }} F CFA</td>
                    <td class="px-4 py-2 text-right space-x-2">
                        <a href="{{ route('products.edit', $product) }}" class="text-blue-600 hover:text-blue-800" title="Modifier">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer ce produit ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700" title="Supprimer">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css" />
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#productTable').DataTable();
        });
    </script>
@endpush
