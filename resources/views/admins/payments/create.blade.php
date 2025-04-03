{{-- resources/views/admin/payments/create.blade.php --}}

@extends('layouts.main')
@section('title', 'Paiement Commande')

@section('content')
    <div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow mt-10">
        <h2 class="text-xl font-semibold mb-4">💰 Paiement de la commande #{{ $command->id }}</h2>

        <form method="POST" action="{{ route('admin.payments.store', $command->id) }}">
            @csrf
            <div class="mb-4">
                <label class="block font-medium mb-1">Montant à payer</label>
                <div class="bg-gray-100 p-2 rounded">{{ number_format($command->total_price, 0, ',', ' ') }} F CFA</div>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Montant donné</label>
                <input type="number" name="amount_given" required min="{{ $command->total_price }}"
                    class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Mode de paiement</label>
                <select name="payment_method" class="w-full border p-2 rounded" required>
                    <option value="Espèce">Espèce</option>
                    <option value="Carte">Carte</option>
                    <option value="Orange Money">Orange Money</option>
                </select>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">💳 Valider Paiement</button>
        </form>
    </div>
@endsection
