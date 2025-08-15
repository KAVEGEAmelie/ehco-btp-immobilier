# 🏠 EHCO Immobilier - Plateforme Immobilière

## 📋 Description du Projet

EHCO Immobilier est une plateforme immobilière moderne développée avec Laravel 11, offrant une expérience utilisateur complète pour la recherche, la consultation et la gestion de biens immobiliers.

## ✨ Fonctionnalités Principales

### 🎯 **Interface Publique**
- **Page d'accueil moderne** avec animations CSS et design responsive
- **Catalogue de biens** avec système de filtres avancés (ville, prix, surface, pièces)
- **Guide complet des biens** avec modal détaillé et galerie photos
- **Lightbox interactif** pour visualiser les images en grand format
- **Système de contact** avec envoi d'emails automatisé (Gmail SMTP)
- **Design responsive** optimisé mobile et desktop

### ⚙️ **Panel d'Administration**
- **Gestion des biens immobiliers** (CRUD complet)
- **Upload multiple d'images** avec gestion des photos
- **Validation avancée des formulaires** 
- **Interface d'administration sécurisée**
- **Système d'authentification** pour les administrateurs

### 🎨 **Technologies & Design**
- **Frontend** : HTML5, CSS3, JavaScript, Blade Templates
- **Animations** : Transitions fluides, effets de survol, lightbox
- **Responsive** : Grid CSS, Flexbox, Mobile-first
- **UI/UX** : Design moderne avec gradients et micro-interactions

## 🛠️ Technologies Utilisées

- **Framework** : Laravel 11.45.1
- **Base de données** : PostgreSQL
- **Frontend** : Vite, CSS3, JavaScript vanilla
- **Email** : Gmail SMTP
- **Upload** : Gestion locale des fichiers
- **Authentification** : Laravel Auth

## 📦 Installation

### Prérequis
- PHP 8.2+
- Composer
- Node.js 18+
- PostgreSQL
- Git

### Étapes d'installation

1. **Cloner le repository**
```bash
git clone https://github.com/votre-username/ehco-immobilier.git
cd ehco-immobilier
```

2. **Installer les dépendances PHP**
```bash
composer install
```

3. **Installer les dépendances Node.js**
```bash
npm install
```

4. **Configuration de l'environnement**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configuration de la base de données**
Modifier le fichier `.env` avec vos paramètres PostgreSQL :
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=ehco_immobilier
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. **Configuration Email (Gmail SMTP)**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
```

7. **Migrations et données de test**
```bash
php artisan migrate
php artisan db:seed
```

8. **Compilation des assets**
```bash
npm run build
```

9. **Lancement du serveur**
```bash
php artisan serve
```

## 🎭 Utilisation

### Interface Publique
- Accédez à `http://localhost:8000` pour voir la page d'accueil
- Naviguez vers `/biens` pour consulter le catalogue
- Utilisez les filtres pour rechercher des biens spécifiques
- Cliquez sur "Guide complet" pour voir les détails d'un bien
- Cliquez sur les images pour les voir en grand format

### Administration
- Accédez à `http://localhost:8000/admin` pour l'interface d'administration
- Utilisez les identifiants créés lors du seeding
- Gérez les biens : création, modification, suppression
- Uploadez des photos pour chaque bien

## 🎨 Fonctionnalités Avancées

### Lightbox Gallery
- Clic sur n'importe quelle image pour l'agrandir
- Navigation avec flèches clavier ou boutons
- Miniatures pour navigation directe
- Fermeture avec Échap ou clic sur l'overlay

### Système de Contact
- Formulaire de contact intégré
- Envoi automatique d'emails
- Templates HTML personnalisés
- Configuration Gmail SMTP

### Design Responsive
- Adaptation automatique aux différentes tailles d'écran
- Navigation mobile optimisée
- Images responsive avec lazy loading
- Grilles CSS flexibles

## 🔧 Commandes Utiles

```bash
# Tests
php artisan test

# Clear cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Recompiler les assets
npm run dev          # Mode développement
npm run build        # Mode production

# Migrations
php artisan migrate:fresh --seed

# Test email
php artisan test:email
```

## 📁 Structure du Projet

```
app/
├── Http/Controllers/
│   ├── AdminBienController.php    # Gestion admin des biens
│   └── BienController.php         # Interface publique
├── Models/
│   ├── BienImmobilier.php        # Modèle principal
│   ├── Photo.php                 # Gestion des images
│   └── User.php                  # Utilisateurs/admins
└── Mail/
    └── ContactMessage.php        # Emails de contact

resources/
├── views/
│   ├── pages/accueil.blade.php   # Page d'accueil
│   ├── biens/                    # Vues des biens
│   └── layouts/app.blade.php     # Template principal
└── css/app.css                   # Styles principaux

database/
├── migrations/                   # Structure BDD
└── seeders/                     # Données de test
```

## 🎯 Fonctionnalités à Venir

- [ ] Système de favoris
- [ ] Comparaison de biens
- [ ] Notifications en temps réel
- [ ] API REST
- [ ] Géolocalisation des biens
- [ ] Chat en ligne

## 👥 Contribution

Les contributions sont les bienvenues ! Pour contribuer :

1. Fork le projet
2. Créez une branche pour votre fonctionnalité (`git checkout -b feature/AmazingFeature`)
3. Committez vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrez une Pull Request

## 📄 Licence

Ce projet est sous licence MIT. Voir le fichier [LICENSE](LICENSE) pour plus de détails.

## 📞 Contact

**EHCO Immobilier** - Expert Immobilier Certifié

- 📧 Email : ehcobtp@gmail.com
- 📱 Téléphone : +225 01 23 45 67 89
- 🌐 Site web : [En cours de déploiement]

---

**Développé avec ❤️ par l'équipe EHCO Immobilier**
