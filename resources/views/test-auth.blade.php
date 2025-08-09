<!DOCTYPE html>
<html>
<head>
    <title>Test Authentification Admin</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        button { background: #007cba; color: white; padding: 12px 24px; border: none; border-radius: 5px; cursor: pointer; }
        .result { margin-top: 20px; padding: 15px; border-radius: 5px; }
        .success { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="container">
        <h2>🔧 Test d'Authentification Admin</h2>
        
        <div id="users-list">
            <h3>Utilisateurs en base :</h3>
            <div id="users-container">Chargement...</div>
        </div>
        
        <hr>
        
        <form id="test-form">
            <h3>Tester la connexion :</h3>
            <div class="form-group">
                <label>Email :</label>
                <input type="email" id="email" value="admin@immobilier.com" required>
            </div>
            <div class="form-group">
                <label>Mot de passe :</label>
                <input type="password" id="password" value="admin123456" required>
            </div>
            <button type="submit">Tester l'authentification</button>
        </form>
        
        <div id="result"></div>
    </div>

    <script>
        // Charger les utilisateurs
        fetch('/test-users')
            .then(response => response.json())
            .then(users => {
                const container = document.getElementById('users-container');
                container.innerHTML = users.map(user => 
                    `<p><strong>${user.name}</strong> - ${user.email} - ${user.role}</p>`
                ).join('');
            });

        // Tester l'authentification
        document.getElementById('test-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            fetch('/test-auth', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email, password })
            })
            .then(response => response.json())
            .then(data => {
                const result = document.getElementById('result');
                const isSuccess = data.user_found && data.password_correct && data.is_admin;
                
                result.className = `result ${isSuccess ? 'success' : 'error'}`;
                result.innerHTML = `
                    <h4>Résultat du test :</h4>
                    <p><strong>Utilisateur trouvé :</strong> ${data.user_found ? '✅ Oui' : '❌ Non'}</p>
                    <p><strong>Mot de passe correct :</strong> ${data.password_correct ? '✅ Oui' : '❌ Non'}</p>
                    <p><strong>Rôle utilisateur :</strong> ${data.user_role || 'N/A'}</p>
                    <p><strong>Est admin :</strong> ${data.is_admin ? '✅ Oui' : '❌ Non'}</p>
                    <p><strong>Status :</strong> ${isSuccess ? '🟢 Authentification réussie' : '🔴 Échec de l\'authentification'}</p>
                `;
            })
            .catch(error => {
                const result = document.getElementById('result');
                result.className = 'result error';
                result.innerHTML = `<h4>Erreur :</h4><p>${error.message}</p>`;
            });
        });
    </script>
</body>
</html>
