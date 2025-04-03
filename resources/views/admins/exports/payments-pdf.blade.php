<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Rapport de Paiements</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 6px 8px;
            border: 1px solid #ccc;
            text-align: left;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h2>📄 Rapport de Paiements</h2>

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
                    <td>{{ number_format($payment->command->total_price, 0, ',', ' ') }} F</td>
                    <td>{{ number_format($payment->amount_given, 0, ',', ' ') }} F</td>
                    <td>{{ number_format($payment->change_due, 0, ',', ' ') }} F</td>
                    <td>{{ ucfirst($payment->payment_method) }}</td>
                    <td>{{ $payment->user->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
