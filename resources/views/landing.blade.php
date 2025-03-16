
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $titre ?? "Sup'Food" }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 0;
            margin: 0;
        }

        .home {
            background-image: url('{{ asset('images/landingback.png') }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: black;
        }

        .logo img {
            width: 250px;
            margin-bottom: 20px;
        }

        @media (min-width: 640px) {
            .fleche img {
                width: 8rem;
            }
        }

        @media (min-width: 768px) {
            .fleche img {
                width: 12rem;
            }
        }

        @media (min-width: 1024px) {
            .fleche img {
                width: 16rem;
            }
        }

        .text sup {
            font-style: bold;
        }

        .text {
            font-size: 15px;
        }

        .fleche img {
            /* width: 50px; */
            width: 4rem
            margin-top: 30px;
            animation: bounce 2s;
            cursor: pointer;

        }
    </style>
</head>
<body>
    <section class="home">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Sup'Food">
        </div>
        <div class="text">
            <p>Moins d'attente,<br> plus de plaisir <strong class="sup">SUP'FOOD</strong> a <br>votre service</p>
        </div>
        <div class="fleche">
            <a href="{{ url('/welcome') }}">
                <img src="{{ asset('images/suivant.png') }}" alt="Flèche suivante">
            </a>
        </div>
    </section>
</body>
</html>
