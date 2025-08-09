<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Administration') - Immobilier Pro</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* === Variables CSS pour le Thème Sombre === */
        :root {
            --couleur-fond: #1a1a1a;
            --couleur-surface: #2c2c2c;
            --couleur-surface-claire: #3a3a3a;
            --couleur-texte: #e1e1e1;
            --couleur-texte-mute: #a0aec0;
            --couleur-primaire: #00aaff;
            --couleur-bordure: #444;
            --couleur-sidebar: #1e1e1e;
            --couleur-sidebar-hover: rgba(0, 170, 255, 0.1);
        }

        /* === Style Global === */
        body {
            background-color: var(--couleur-fond);
            color: var(--couleur-texte);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .admin-layout {
            display: flex;
            min-height: 100vh;
            background: var(--couleur-fond);
        }
        
        .admin-sidebar {
            width: 280px;
            background: linear-gradient(180deg, var(--couleur-sidebar), #252525);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            transition: transform 0.3s ease;
            border-right: 1px solid var(--couleur-bordure);
        }
        
        .admin-sidebar.hidden {
            transform: translateX(-100%);
        }
        
        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid var(--couleur-bordure);
            text-align: center;
            background: var(--couleur-surface);
        }
        
        .sidebar-header h2 {
            color: white;
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
        }
        
        .sidebar-header p {
            margin: 5px 0 0 0;
            opacity: 0.8;
            font-size: 0.9rem;
            color: var(--couleur-texte-mute);
        }
        
        .sidebar-nav {
            padding: 20px 0;
        }
        
        .nav-item {
            margin-bottom: 5px;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            color: var(--couleur-texte-mute);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .nav-link:hover, .nav-link.active {
            background: var(--couleur-sidebar-hover);
            color: white;
            border-left-color: var(--couleur-primaire);
        }
        
        .nav-link .icon {
            margin-right: 12px;
            font-size: 1.2rem;
            width: 20px;
            text-align: center;
        }
        
        .admin-main {
            flex: 1;
            margin-left: 280px;
            transition: margin-left 0.3s ease;
            background: var(--couleur-fond);
        }
        
        .admin-main.expanded {
            margin-left: 0;
        }
        
        .admin-header {
            background: var(--couleur-surface);
            padding: 20px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
            border-bottom: 1px solid var(--couleur-bordure);
        }
        
        .header-left {
            display: flex;
            align-items: center;
        }
        
        .menu-toggle {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            margin-right: 20px;
            color: var(--couleur-texte);
            padding: 8px;
            border-radius: 6px;
            transition: background 0.3s ease;
        }

        .menu-toggle:hover {
            background: var(--couleur-surface-claire);
        }
        
        .breadcrumb {
            color: var(--couleur-texte-mute);
            font-size: 1.1rem;
        }
        
        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-left: auto;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--couleur-primaire), #0077cc);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        .user-details span {
            display: block;
            color: var(--couleur-texte);
        }
        
        .user-details .role {
            font-size: 0.85rem;
            color: var(--couleur-texte-mute);
        }
        
        .logout-btn {
            background: #e53e3e;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            font-weight: 600;
        }
        
        .logout-btn:hover {
            background: #c53030;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        
        .admin-content {
            padding: 0;
            min-height: calc(100vh - 80px);
            background: var(--couleur-fond);
        }
        
        .mobile-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        /* === Messages d'alerte avec thème sombre === */
        .alert-success {
            background: rgba(72, 187, 120, 0.2);
            color: #c6f6d5;
            padding: 15px;
            margin: 20px 30px;
            border-radius: 8px;
            border: 1px solid #48bb78;
        }

        .alert-error {
            background: rgba(229, 62, 62, 0.2);
            color: #fed7d7;
            padding: 15px;
            margin: 20px 30px;
            border-radius: 8px;
            border: 1px solid #e53e3e;
        }
        
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            
            .admin-sidebar.show {
                transform: translateX(0);
            }
            
            .admin-main {
                margin-left: 0;
            }
            
            .mobile-overlay.show {
                display: block;
            }
        }

        /* === Styles pour Modal de Confirmation === */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 10000;
        }

        .modal-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .confirmation-modal {
            background: var(--couleur-surface);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            max-width: 400px;
            width: 90%;
            border: 2px solid var(--couleur-bordure);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            transform: scale(0.7);
            transition: transform 0.3s ease;
        }

        .modal-overlay.show .confirmation-modal {
            transform: scale(1);
        }

        .modal-icon {
            font-size: 4rem;
            margin-bottom: 15px;
            display: block;
        }

        .modal-icon.warning { color: #ffa726; }
        .modal-icon.danger { color: #ef5350; }
        .modal-icon.info { color: var(--couleur-primaire); }

        .modal-title {
            color: #fff;
            font-size: 1.5rem;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .modal-message {
            color: var(--couleur-texte-mute);
            font-size: 1rem;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .modal-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .modal-btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 100px;
        }

        .modal-btn.primary {
            background: var(--couleur-primaire);
            color: white;
        }

        .modal-btn.primary:hover {
            background: #0077cc;
            transform: translateY(-2px);
        }

        .modal-btn.danger {
            background: linear-gradient(135deg, #ef5350, #d32f2f);
            color: white;
        }

        .modal-btn.danger:hover {
            background: linear-gradient(135deg, #d32f2f, #c62828);
            transform: translateY(-2px);
        }

        .modal-btn.secondary {
            background: var(--couleur-surface-claire);
            color: var(--couleur-texte);
            border: 1px solid var(--couleur-bordure);
        }

        .modal-btn.secondary:hover {
            background: var(--couleur-bordure);
            transform: translateY(-2px);
        }

        /* === Styles pour Notifications === */
        .notification-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: 400px;
        }

        .notification {
            background: var(--couleur-surface);
            border: 1px solid var(--couleur-bordure);
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transform: translateX(400px);
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            position: relative;
            overflow: hidden;
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.success {
            border-left: 4px solid #4caf50;
        }

        .notification.error {
            border-left: 4px solid #f44336;
        }

        .notification.warning {
            border-left: 4px solid #ff9800;
        }

        .notification.info {
            border-left: 4px solid var(--couleur-primaire);
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar -->
        <nav class="admin-sidebar" id="adminSidebar">
            <div class="sidebar-header">
                <h2>🏢 Admin Panel</h2>
                <p>Immobilier Pro</p>
            </div>
            
            <div class="sidebar-nav">
                <div class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span class="icon">📊</span>
                        Dashboard
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="{{ route('admin.biens.index') }}" class="nav-link {{ request()->routeIs('admin.biens.*') ? 'active' : '' }}">
                        <span class="icon">🏠</span>
                        Gestion des Biens
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="{{ route('admin.profile.edit') }}" class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                        <span class="icon">👤</span>
                        Mon Profil
                    </a>
                </div>
                
                @if(auth()->user()->isMainAdmin())
                <div class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <span class="icon">👥</span>
                        Utilisateurs
                    </a>
                </div>
                @endif
                
                <div class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <span class="icon">🌐</span>
                        Voir le Site
                    </a>
                </div>
            </div>
        </nav>
        
        <!-- Mobile Overlay -->
        <div class="mobile-overlay" id="mobileOverlay"></div>
        
        <!-- Main Content -->
        <main class="admin-main" id="adminMain">
            <!-- Header -->
            <header class="admin-header">
                <div class="header-left">
                    <button class="menu-toggle" id="menuToggle">☰</button>
                    <div class="breadcrumb">@yield('breadcrumb', 'Administration')</div>
                </div>
                
                <div class="header-right">
                    <div class="user-info">
                        <div class="user-avatar">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="user-details">
                            <span>{{ auth()->user()->name }}</span>
                            <span class="role">{{ auth()->user()->role_name }}</span>
                        </div>
                    </div>
                    
                    <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">
                            🚪 Déconnexion
                        </button>
                    </form>
                </div>
            </header>
            
            <!-- Page Content -->
            <div class="admin-content">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Conteneur pour les notifications modernes -->
    <div id="notification-container" class="notification-container"></div>

    <!-- Modal de confirmation moderne -->
    <div id="modal-overlay" class="modal-overlay">
        <div class="confirmation-modal">
            <div id="modal-icon" class="modal-icon"></div>
            <h3 id="modal-title" class="modal-title"></h3>
            <p id="modal-message" class="modal-message"></p>
            <div class="modal-actions">
                <button id="modal-confirm" class="modal-btn primary">Confirmer</button>
                <button id="modal-cancel" class="modal-btn secondary">Annuler</button>
            </div>
        </div>
    </div>

    <script>
        // === Système de Notifications Modernes ===
        class NotificationSystem {
            constructor() {
                this.container = document.getElementById('notification-container');
                this.modalOverlay = document.getElementById('modal-overlay');
                this.setupModal();
            }

            // Afficher une notification
            show(message, type = 'info', duration = 5000) {
                const notification = this.createNotification(message, type);
                this.container.appendChild(notification);

                // Animation d'entrée
                setTimeout(() => notification.classList.add('show'), 10);

                // Barre de progression
                if (duration > 0) {
                    this.startProgressBar(notification, duration);
                    setTimeout(() => this.remove(notification), duration);
                }

                return notification;
            }

            // Créer l'élément notification
            createNotification(message, type) {
                const notification = document.createElement('div');
                notification.className = `notification ${type}`;

                const icons = {
                    success: '✅',
                    error: '❌',
                    warning: '⚠️',
                    info: 'ℹ️'
                };

                const titles = {
                    success: 'Succès',
                    error: 'Erreur',
                    warning: 'Attention',
                    info: 'Information'
                };

                notification.innerHTML = `
                    <div class="notification-header">
                        <div class="notification-title">
                            <span class="notification-icon">${icons[type] || icons.info}</span>
                            ${titles[type] || titles.info}
                        </div>
                        <button class="notification-close" onclick="notifications.remove(this.closest('.notification'))">×</button>
                    </div>
                    <div class="notification-message">${message}</div>
                    <div class="notification-progress">
                        <div class="notification-progress-bar"></div>
                    </div>
                `;

                return notification;
            }

            // Barre de progression
            startProgressBar(notification, duration) {
                const progressBar = notification.querySelector('.notification-progress-bar');
                let width = 100;
                const interval = 50;
                const decrement = (100 / duration) * interval;

                const timer = setInterval(() => {
                    width -= decrement;
                    if (width <= 0) {
                        clearInterval(timer);
                        return;
                    }
                    progressBar.style.width = width + '%';
                }, interval);
            }

            // Supprimer une notification
            remove(notification) {
                notification.classList.add('removing');
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }

            // Configuration du modal de confirmation
            setupModal() {
                const modalCancel = document.getElementById('modal-cancel');
                const modalOverlay = this.modalOverlay;

                modalCancel.addEventListener('click', () => this.hideModal());
                modalOverlay.addEventListener('click', (e) => {
                    if (e.target === modalOverlay) this.hideModal();
                });
            }

            // Afficher modal de confirmation
            confirm(options = {}) {
                return new Promise((resolve) => {
                    const {
                        title = 'Confirmer l\'action',
                        message = 'Êtes-vous sûr de vouloir continuer ?',
                        type = 'warning',
                        confirmText = 'Confirmer',
                        cancelText = 'Annuler'
                    } = options;

                    const modalIcon = document.getElementById('modal-icon');
                    const modalTitle = document.getElementById('modal-title');
                    const modalMessage = document.getElementById('modal-message');
                    const modalConfirm = document.getElementById('modal-confirm');
                    const modalCancel = document.getElementById('modal-cancel');

                    // Configuration de l'icône
                    const icons = {
                        warning: '⚠️',
                        danger: '🗑️',
                        info: 'ℹ️'
                    };

                    modalIcon.className = `modal-icon ${type}`;
                    modalIcon.textContent = icons[type] || icons.warning;
                    modalTitle.textContent = title;
                    modalMessage.textContent = message;
                    modalConfirm.textContent = confirmText;
                    modalCancel.textContent = cancelText;

                    // Configuration des boutons
                    modalConfirm.className = `modal-btn ${type === 'danger' ? 'danger' : 'primary'}`;

                    // Event listeners
                    const confirmHandler = () => {
                        this.hideModal();
                        resolve(true);
                        modalConfirm.removeEventListener('click', confirmHandler);
                    };

                    const cancelHandler = () => {
                        this.hideModal();
                        resolve(false);
                        modalCancel.removeEventListener('click', cancelHandler);
                    };

                    modalConfirm.addEventListener('click', confirmHandler);
                    modalCancel.addEventListener('click', cancelHandler);

                    this.showModal();
                });
            }

            showModal() {
                this.modalOverlay.classList.add('show');
                document.body.style.overflow = 'hidden';
            }

            hideModal() {
                this.modalOverlay.classList.remove('show');
                document.body.style.overflow = '';
            }
        }

        // Initialiser le système de notifications
        const notifications = new NotificationSystem();
        window.notificationSystem = notifications;

        // Fonction globale pour afficher les notifications
        window.showNotification = (message, type = 'info', duration = 5000) => {
            return notifications.show(message, type, duration);
        };

        // Fonction globale pour les confirmations
        window.showConfirm = (options) => {
            return notifications.confirm(options);
        };

        // Fonction alternative pour debug
        window.confirmDelete = async (message) => {
            return await notifications.confirm({
                title: 'Confirmer la suppression',
                message: message,
                type: 'danger',
                confirmText: 'Supprimer',
                cancelText: 'Annuler'
            });
        };

        // Remplacer les alertes par défaut
        window.alert = (message) => {
            showNotification(message, 'info');
        };

        // Afficher les messages de session au chargement
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🔍 Debug: Recherche des formulaires de suppression...');
            const forms = document.querySelectorAll('.delete-form');
            console.log('🔍 Debug: Trouvé', forms.length, 'formulaires de suppression');
            
            forms.forEach((form, index) => {
                console.log(`🔍 Debug: Formulaire ${index + 1}:`, form);
                console.log(`🔍 Debug: Message:`, form.dataset.message);
            });

            console.log('🔍 Debug: Recherche des boutons de suppression...');
            const buttons = document.querySelectorAll('.delete-btn');
            console.log('🔍 Debug: Trouvé', buttons.length, 'boutons de suppression');
            
            buttons.forEach((button, index) => {
                console.log(`🔍 Debug: Bouton ${index + 1}:`, button);
                console.log(`🔍 Debug: Message bouton:`, button.dataset.message);
                console.log(`🔍 Debug: Titre bouton:`, button.dataset.title);
            });

            @if(session('success'))
                showNotification('{{ session('success') }}', 'success');
            @endif

            @if(session('error'))
                showNotification('{{ session('error') }}', 'error');
            @endif

            @if(session('warning'))
                showNotification('{{ session('warning') }}', 'warning');
            @endif

            @if($errors->any())
                @foreach($errors->all() as $error)
                    showNotification('{{ $error }}', 'error');
                @endforeach
            @endif

            // Gérer les formulaires de suppression avec confirmation moderne
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    
                    const message = this.dataset.message || 'Êtes-vous sûr de vouloir supprimer cet élément ?';
                    
                    try {
                        const confirmed = await showConfirm({
                            title: 'Confirmer la suppression',
                            message: message,
                            type: 'danger',
                            confirmText: 'Supprimer',
                            cancelText: 'Annuler'
                        });
                        
                        if (confirmed) {
                            // Soumettre le formulaire
                            this.submit();
                        }
                    } catch (error) {
                        console.error('Erreur avec le système de modal:', error);
                        // Fallback vers confirm() classique
                        if (confirm(message)) {
                            this.submit();
                        }
                    }
                });
            });

            // Gérer les boutons de suppression (type="button" avec classe delete-btn)
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', async function(e) {
                    e.preventDefault();
                    
                    const form = this.closest('.delete-form');
                    if (!form) {
                        console.error('Formulaire de suppression non trouvé');
                        return;
                    }
                    
                    const message = this.dataset.message || form.dataset.message || 'Êtes-vous sûr de vouloir supprimer cet élément ?';
                    const title = this.dataset.title || 'Confirmer la suppression';
                    
                    try {
                        const confirmed = await showConfirm({
                            title: title,
                            message: message,
                            type: 'danger',
                            confirmText: 'Supprimer',
                            cancelText: 'Annuler'
                        });
                        
                        if (confirmed) {
                            // Soumettre le formulaire
                            form.submit();
                        }
                    } catch (error) {
                        console.error('Erreur avec le système de modal:', error);
                        // Fallback vers confirm() classique
                        if (confirm(message)) {
                            form.submit();
                        }
                    }
                });
            });
        });

        // === Scripts existants ===
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('adminSidebar');
            const main = document.getElementById('adminMain');
            const overlay = document.getElementById('mobileOverlay');
            
            menuToggle.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.toggle('show');
                    overlay.classList.toggle('show');
                } else {
                    sidebar.classList.toggle('hidden');
                    main.classList.toggle('expanded');
                }
            });
            
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            });
            
            // Fermer le sidebar mobile en cliquant sur un lien
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        sidebar.classList.remove('show');
                        overlay.classList.remove('show');
                    }
                });
            });
        });
    </script>
</body>
</html>
