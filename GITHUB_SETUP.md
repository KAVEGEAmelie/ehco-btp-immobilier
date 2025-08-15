# 📝 Instructions pour publier sur GitHub

## 1. Créer le repository sur GitHub.com

1. Allez sur [GitHub.com](https://github.com) et connectez-vous
2. Cliquez sur le bouton "+" en haut à droite → "New repository"
3. Configurez le repository :
   - **Repository name** : `ehco-btp-immobilier` (ou le nom de votre choix)
   - **Description** : `🏠 EHCO Immobilier - Plateforme immobilière moderne avec Laravel 11`
   - **Visibilité** : Public ou Private selon votre préférence
   - ⚠️ **N'initialisez PAS** avec README, .gitignore ou licence (nous avons déjà tout configuré)
4. Cliquez sur "Create repository"

## 2. Connecter le repository local à GitHub

Une fois le repository créé sur GitHub, copiez l'URL du repository et exécutez ces commandes :

```bash
# Ajouter l'origin remote (remplacez YOUR_USERNAME par votre nom d'utilisateur GitHub)
git remote add origin https://github.com/YOUR_USERNAME/ehco-btp-immobilier.git

# Configurer la branche principale
git branch -M main

# Pousser le code vers GitHub
git push -u origin main
```

## 3. Vérification

Après avoir exécuté ces commandes :
- Actualisez la page de votre repository sur GitHub
- Vous devriez voir tous vos fichiers et le README.md affiché automatiquement
- Le projet sera maintenant accessible publiquement (ou privé selon votre choix)

## 4. Commands utiles pour la suite

```bash
# Ajouter des modifications
git add .
git commit -m "Description des changements"
git push

# Voir l'état du repository
git status

# Voir l'historique des commits
git log --oneline

# Créer une nouvelle branche pour une fonctionnalité
git checkout -b feature/nouvelle-fonctionnalite
```

## 5. Cloner le projet ailleurs

Une fois sur GitHub, d'autres personnes (ou vous sur un autre ordinateur) pourront cloner le projet :

```bash
git clone https://github.com/YOUR_USERNAME/ehco-btp-immobilier.git
cd ehco-btp-immobilier
composer install
npm install
cp .env.example .env
php artisan key:generate
# Configurer la base de données dans .env
php artisan migrate --seed
npm run build
php artisan serve
```

---

**Note importante** : Assurez-vous de ne jamais committer le fichier `.env` qui contient vos mots de passe et clés secrètes. Ce fichier est déjà dans `.gitignore` pour éviter cela.
