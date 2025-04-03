<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Client</th>
            <th>Total Commande</th>
            <th>Montant Donné</th>
            <th>Monnaie Rendue</th>
            <th>Méthode</th>
            <th>Effectué par</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payments as $payment)
            <tr>
                <td>{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $payment->command->user->name }}</td>
                <td>{{ $payment->command->total_price }}</td>
                <td>{{ $payment->amount_given }}</td>
                <td>{{ $payment->change_due }}</td>
                <td>{{ $payment->payment_method }}</td>
                <td>{{ $payment->user->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
