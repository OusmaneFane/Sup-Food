<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Rapport de Commandes</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #333;
        }

        header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .logo {
            width: 100px;
            height: auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 4px 6px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f3f3f3;
        }

        .small {
            font-size: 10px;
            color: #666;
        }
    </style>
</head>

<body>

    <header>
        <img src="{{ public_path('images/logo.png') }}" class="logo" alt="Logo">
    </header>


    <h2>
        Rapport de Commandes - {{ ucfirst($type ?? ($period ?? 'période inconnue')) }} du
        {{ \Carbon\Carbon::parse($start ?? $date)->format('d/m/Y') }}
        au {{ \Carbon\Carbon::parse($end ?? $date)->format('d/m/Y') }}
    </h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Client</th>
                <th>Adresse</th>
                <th>Produits</th>
                <th>Total</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($commands as $index => $command)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $command->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        {{ $command->user->name }}<br>
                        <span class="small">{{ $command->user->email }}</span>
                    </td>
                    <td>{{ $command->delivery_address }}</td>
                    <td>
                        @foreach ($command->details as $detail)
                            {{ $detail->product->name ?? 'Produit supprimé' }} (x{{ $detail->quantity }})@if (!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </td>
                    <td>{{ number_format($command->total_price, 0, ',', ' ') }} F CFA</td>
                    <td>{{ ucfirst($command->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
