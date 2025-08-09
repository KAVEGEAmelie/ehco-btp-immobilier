<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin - EHCO Immobilier</title>
    {{-- On ne charge PAS le CSS global ici pour éviter les conflits de thème --}}

    <style>
        /* Styles généraux pour la page de connexion seule */
        body, html {
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .admin-login-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #1a1a1a 0%, #2c2c2c 100%); /* Fond sombre cohérent */
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Styles de la carte de connexion */
        .admin-login-card {
            background: #2c2c2c;
            border: 1px solid #444;
            border-radius: 24px;
            padding: 45px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 32px 64px rgba(0, 0, 0, 0.4);
        }

        .admin-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .admin-logo h1 {
            color: #00aaff; /* Couleur primaire du thème */
            font-size: 3rem;
            font-weight: 800;
            margin: 0;
        }

        .admin-logo p {
            color: #e1e1e1;
            margin: 8px 0 0 0;
            font-size: 1.2rem;
        }

        /* Styles du formulaire */
        .form-group {
            margin-bottom: 25px;
        }

        /* NOUVEAU: Conteneur pour le mot de passe + icône */
        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
            color: #e1e1e1; /* Texte clair visible sur fond sombre */
            font-weight: 600;
            font-size: 1.1rem;
        }

        .form-input {
            width: 100%;
            padding: 18px 24px;
            border: 2px solid #444; /* Bordure plus visible */
            border-radius: 16px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            background: #1a1a1a; /* Fond de l'input */
            color: #e1e1e1; /* Couleur du texte dans l'input */
        }

        /* NOUVEAU: Style pour l'input quand il y a une icône */
        .form-input-with-icon {
            padding-right: 60px; /* Espace pour l'icône */
        }

        .form-input:focus {
            outline: none;
            border-color: #00aaff;
            box-shadow: 0 0 0 4px rgba(0, 170, 255, 0.2);
            background: #252525;
        }

        .form-input.error {
            border-color: #dc2626;
            background: rgba(220, 38, 38, 0.1);
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 5px;
            display: block;
        }

        .btn-admin-login {
            width: 100%;
            padding: 18px;
            background: #00aaff; /* Couleur primaire solide */
            color: white;
            border: none;
            border-radius: 16px;
            font-size: 1.2rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-admin-login:hover {
            background: #0088cc;
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0, 170, 255, 0.3);
        }

        /* NOUVEAU: Styles pour le bouton de l'œil */
        .toggle-password {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            width: 60px;
            background: transparent;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
        }
        .toggle-password:hover {
            color: #00aaff;
        }

        .back-link {
            text-align: center;
            margin-top: 25px;
        }

        .back-link a {
            color: #00aaff;
            text-decoration: none;
            font-weight: 600;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="admin-login-container">
        <div class="admin-login-card">
            <div class="admin-logo">
                <h1>EHCO</h1>
                <p>Espace d'Administration</p>
            </div>

            @if ($errors->any())
                <div class="error-message" style="background: rgba(231, 76, 60, 0.1); border: 1px solid rgba(231, 76, 60, 0.3); border-radius: 12px; padding: 15px; margin-bottom: 25px; color: #f2a0a0;">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="#">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Adresse E-mail</label>
                    <input type="email"
                           id="email"
                           name="email"
                           class="form-input @error('email') error @enderror"
                           value="{{ old('email') }}"
                           required
                           autocomplete="email"
                           autofocus
                           placeholder="admin@ehco.com">
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Mot de passe</label>
                    <!-- MODIFIÉ: Ajout du conteneur et du bouton -->
                    <div class="password-wrapper">
                        <input type="password"
                               id="password"
                               name="password"
                               class="form-input form-input-with-icon @error('password') error @enderror"
                               required
                               autocomplete="current-password"
                               placeholder="••••••••">
                        <button type="button" class="toggle-password" id="togglePassword">
                            <!-- SVG pour l'œil (visible par défaut) -->
                            <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                            <!-- SVG pour l'œil barré (caché par défaut) -->
                            <svg id="icon-eye-off" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-admin-login">
                    Se connecter
                </button>
            </form>

            <div class="back-link">
                <a href="/">← Retour au site</a>
            </div>
        </div>
    </div>

    <!-- NOUVEAU: Script pour gérer l'affichage du mot de passe -->
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const iconEye = document.getElementById('icon-eye');
        const iconEyeOff = document.getElementById('icon-eye-off');

        togglePassword.addEventListener('click', function () {
            // Récupère le type actuel de l'input ('password' ou 'text')
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Change l'icône en fonction du type
            if (type === 'password') {
                iconEye.style.display = 'block';
                iconEyeOff.style.display = 'none';
            } else {
                iconEye.style.display = 'none';
                iconEyeOff.style.display = 'block';
            }
        });
    </script>
</body>
</html>
