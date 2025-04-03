{{-- resources/views/pdf/receipt.blade.php --}}

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Reçu Paiement</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 15px;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Reçu de Paiement</h2>
        <p>Commande #{{ $command->id }}</p>
        <p>{{ $command->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <div class="section">
        <p><span class="bold">Client :</span> {{ $command->user->name }}</p>
        <p><span class="bold">Adresse :</span> {{ $command->delivery_address }}</p>
    </div>

    <div class="section">
        <p><span class="bold">Montant total :</span> {{ number_format($command->total_price, 0, ',', ' ') }} F CFA</p>
        <p><span class="bold">Montant donné :</span> {{ number_format($payment->amount_given, 0, ',', ' ') }} F CFA</p>
        <p><span class="bold">Monnaie rendue :</span> {{ number_format($payment->change_due, 0, ',', ' ') }} F CFA</p>
        <p><span class="bold">Mode de paiement :</span> {{ $payment->payment_method }}</p>
    </div>

    <div class="section">
        <p>Payé par : {{ $payment->user->name }}</p>
    </div>
</body>

</html>
