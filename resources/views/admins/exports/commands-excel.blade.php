<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Heure</th>
            <th>Client</th>
            <th>Email</th>
            <th>Adresse</th>
            <th>Produits</th>
            <th>Total (F CFA)</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($commands as $cmd)
            <tr>
                <td>{{ $cmd->created_at->format('d/m/Y') }}</td>
                <td>{{ $cmd->created_at->format('H:i') }}</td>
                <td>{{ $cmd->user->name }}</td>
                <td>{{ $cmd->user->email }}</td>
                <td>{{ $cmd->delivery_address }}</td>
                <td>
                    @foreach ($cmd->details as $detail)
                        {{ $detail->product->name ?? 'Produit supprimé' }} × {{ $detail->quantity }}
                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </td>
                <td>{{ number_format($cmd->total_price, 0, ',', ' ') }}</td>
                <td>{{ ucfirst($cmd->status) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
