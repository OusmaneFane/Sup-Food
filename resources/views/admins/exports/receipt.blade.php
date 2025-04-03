<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Reçu de Paiement</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 20px;
        }

        .label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>SUP'FOOD - Reçu de Paiement</h2>
        <p>Date : {{ $payment->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <div class="section">
        <p><span class="label">Client :</span> {{ $payment->command->user->name }}</p>
        <p><span class="label">Commande :</span> #{{ $payment->command->id }}</p>
        <p><span class="label">Adresse :</span> {{ $payment->command->delivery_address }}</p>
    </div>

    <div class="section">
        <p><span class="label">Montant Total :</span> {{ number_format($payment->command->total_price, 0, ',', ' ') }} F
            CFA</p>
        <p><span class="label">Montant Donné :</span> {{ number_format($payment->amount_given, 0, ',', ' ') }} F CFA</p>
        <p><span class="label">Monnaie Rendue :</span> {{ number_format($payment->change_due, 0, ',', ' ') }} F CFA</p>
        <p><span class="label">Méthode de Paiement :</span> {{ $payment->payment_method }}</p>
    </div>

    <div class="section">
        <p><span class="label">Payé par :</span> {{ $payment->user->name }}</p>
    </div>

    <p style="text-align: center; margin-top: 40px;">Merci pour votre confiance 🙏</p>
</body>

</html>
