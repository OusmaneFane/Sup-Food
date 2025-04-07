<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sup'Food - Connexion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #6C5CE7;
            --secondary-color: #00CEFF;
            --dark-color: #2D3436;
            --light-color: #F5F6FA;
            --success-color: #00B894;
            --warning-color: #FDCB6E;
            --error-color: #D63031;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: url('/images/banniere2.JPG') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 0;
        }

        .login-container {
            position: relative;
            width: 90%;
            max-width: 450px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            z-index: 10;
            transition: transform 0.5s ease, box-shadow 0.5s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 50px rgba(0, 0, 0, 0.4);
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;

        }

        .logo img {
            width: 312px;
            height: 150px;
            object-fit: contain;
            margin-bottom: 15px;
            filter: drop-shadow(0 0 10px rgba(108, 92, 231, 0.7));
        }

        .logo h1 {
            color: var(--light-color);
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .logo p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .input-group {
            position: relative;
            margin-bottom: 25px;
        }

        .input-group input {
            width: 100%;
            padding: 15px 20px 15px 45px;
            background: rgba(255, 255, 255, 0.15);
            border: none;
            border-radius: 50px;
            color: var(--light-color);
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .input-group input:focus {
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 0 15px rgba(108, 92, 231, 0.6);
            border-color: var(--secondary-color);
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .input-group input:focus+i {
            color: var(--secondary-color);
            transform: translateY(-50%) scale(1.1);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 0.9rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, 0.8);
        }

        .remember-me input {
            margin-right: 8px;
            accent-color: var(--primary-color);
        }

        .forgot-password a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 50px;
            color: var(--light-color);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(108, 92, 231, 0.5);
            position: relative;
            overflow: hidden;
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(108, 92, 231, 0.7);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .register-link a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .social-login {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            gap: 15px;
        }

        .social-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .social-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }

        .food-image {
            position: absolute;
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border: 2px solid rgba(255, 255, 255, 0.3);
            z-index: 5;
            transition: all 0.5s ease;
        }

        .food-image.top-left {
            top: -50px;
            left: -50px;
            transform: rotate(-15deg);
        }

        .food-image.bottom-right {
            bottom: -50px;
            right: -50px;
            transform: rotate(15deg);
        }

        .login-container:hover .food-image.top-left {
            transform: rotate(-10deg) translateY(-10px);
        }

        .login-container:hover .food-image.bottom-right {
            transform: rotate(10deg) translateY(-10px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-container {
                padding: 30px;
                width: 95%;
            }

            .logo h1 {
                font-size: 2rem;
            }

            .food-image {
                width: 100px;
                height: 100px;
            }

            .food-image.top-left {
                top: -30px;
                left: -30px;
            }

            .food-image.bottom-right {
                bottom: -30px;
                right: -30px;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 25px 20px;
            }

            .input-group input {
                padding: 12px 15px 12px 40px;
            }

            .input-group i {
                font-size: 1rem;
                left: 12px;
            }

            .remember-forgot {
                flex-direction: column;
                align-items: flex-start;
            }

            .forgot-password {
                margin-top: 10px;
            }

            .food-image {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80"
            alt="Healthy food" class="food-image top-left">
        <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80"
            alt="Delicious pizza" class="food-image bottom-right">

        <div class="logo">
            <img src="/images/logo.png" alt="Sup'Food Logo">

            <p>Moins D'attente - Plus de plaisir</p>
        </div>

        <form method="POST" action="/login">
            @csrf

            {{-- Message d'erreur global --}}
            @if ($errors->any())
                <div style="color: var(--error-color); margin-bottom: 1rem; text-align: center;">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="name" placeholder="Matricule" required value="{{ old('name') }}">
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Mot de passe" required>
            </div>

            <div class="remember-forgot">
                <div class="remember-me">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Se souvenir de moi</label>
                </div>
                <div class="forgot-password">
                    <a href="#">Mot de passe oublié ?</a>
                </div>
            </div>

            <button type="submit" class="login-btn">Se connecter</button>

            <div class="social-login">
                <a href="#" class="social-btn"><i class="fab fa-google"></i></a>
                <a href="#" class="social-btn"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-btn"><i class="fab fa-apple"></i></a>
            </div>

            <div class="register-link">
                <p>Nouveau sur Sup'Food ? <a href="#">Créer un compte</a></p>
            </div>
        </form>

    </div>

    <script>
        // Animation pour les images de nourriture
        document.addEventListener('mousemove', function(e) {
            const container = document.querySelector('.login-container');
            const containerRect = container.getBoundingClientRect();
            const containerCenterX = containerRect.left + containerRect.width / 2;
            const containerCenterY = containerRect.top + containerRect.height / 2;

            const mouseX = e.clientX;
            const mouseY = e.clientY;

            const angleX = (mouseY - containerCenterY) / 20;
            const angleY = (containerCenterX - mouseX) / 20;

            container.style.transform = `translateY(-5px) rotateX(${angleX}deg) rotateY(${angleY}deg)`;

            const topLeftImg = document.querySelector('.food-image.top-left');
            const bottomRightImg = document.querySelector('.food-image.bottom-right');

            if (topLeftImg) {
                topLeftImg.style.transform =
                    `rotate(-15deg) translate(${(mouseX - containerCenterX) / 50}px, ${(mouseY - containerCenterY) / 50}px)`;
            }

            if (bottomRightImg) {
                bottomRightImg.style.transform =
                    `rotate(15deg) translate(${(mouseX - containerCenterX) / 50}px, ${(mouseY - containerCenterY) / 50}px)`;
            }
        });
    </script>
</body>

</html>
