@props(['command'])

<div class="flex items-center gap-2">

    {{-- 🔎 Bouton consulter --}}
    <a href="{{ route('admin.commands.show', $command->id) }}"
        class="text-blue-500 hover:text-blue-700 flex items-center gap-1 text-sm" title="Voir la commande">
        👁️
    </a>

    {{-- ✅ Si la commande est en attente, afficher valider/annuler --}}
    @if ($command->status === 'en_attente')
        <form method="POST" action="{{ route('admin.commands.valider', $command->id) }}">
            @csrf
            <button type="submit" class="text-green-500 hover:text-green-700" title="Valider">
                ✅
            </button>
        </form>

        <form method="POST" action="{{ route('admin.commands.annuler', $command->id) }}">
            @csrf
            <button type="submit" class="text-red-500 hover:text-red-700" title="Annuler">
                ❌
            </button>
        </form>
    @endif

    {{-- 💰 Si commande validée mais non payée --}}
    @if ($command->status === 'validée' && !$command->payment)
        <a href="{{ route('admin.payments.create', $command->id) }}"
            class="text-sm bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-full shadow"
            title="Effectuer le Paiement">
            💵 Paiement
        </a>
    @endif

    {{-- 🔖 Afficher reçu si payé --}}
    @if ($command->payment)
        <a href="{{ route('admin.payments.receipt', $command->payment->id) }}"
            class="text-indigo-600 hover:text-indigo-800 text-sm underline" title="Voir le reçu">
            📄 Reçu
        </a>
    @endif
</div>
