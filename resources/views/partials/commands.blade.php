@foreach ($commands as $command)
    <div class="command p-4" data-id="{{ $command->id }}" data-status="{{ $command->status }}">

        <div class="bg-white shadow-md rounded-2xl p-4 space-y-3">
            <div class="flex justify-between items-center text-sm text-gray-600">
                <div class="flex space-x-2">
                    <span class="bg-gray-100 px-3 py-1 rounded-full">
                        {{ $command->created_at->format('d/m/Y') }}
                    </span>
                    <span
                        class="status-badge bg-gray-100 px-3 py-1 rounded-full
                        {{ $command->status === 'validée' ? 'bg-green-100 text-green-800' : '' }}
                        {{ $command->status === 'en_attente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $command->status === 'refusée' ? 'bg-red-100 text-red-800' : '' }}">
                        {{ ucfirst($command->status) }}
                    </span>
                </div>
                <button
                    class="bg-orange-400 text-white text-sm font-medium px-4 py-1 rounded-full shadow hover:bg-orange-500">
                    ⭐ Évaluer
                </button>
            </div>

            @foreach ($command->details as $detail)
                <div class="flex items-center gap-3 py-2 border-b border-gray-100 last:border-0">
                    <img src="{{ asset('storage/' . $detail->product->image) }}"
                        alt="{{ $detail->product->name ?? 'Produit' }}" class="w-16 h-16 rounded-lg object-cover" />
                    <div class="flex-1">
                        <p class="text-sm font-medium">
                            {{ $detail->product->name ?? 'Produit non disponible' }} × {{ $detail->quantity }}
                        </p>
                        <p class="text-orange-500 font-semibold mt-1">
                            {{ number_format($detail->unit_price * $detail->quantity, 0, ',', ' ') }} F CFA
                        </p>
                    </div>
                </div>
            @endforeach

            <div class="pt-2 border-t border-gray-200">
                <div class="flex justify-between font-semibold">
                    <span>Total</span>
                    <span class="text-orange-500">
                        {{ number_format($command->total_price, 0, ',', ' ') }} F CFA
                    </span>
                </div>
            </div>
            @if ($command->recuperation && $command->recuperation->recuperee)
                <span class="text-green-600 text-sm font-semibold">✅ Récupérée</span>
            @else
                <span class="text-yellow-500 text-sm font-semibold">⏳ En attente de récupération</span>
            @endif
        </div>
    </div>
@endforeach
