@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="admin-dashboard">
    <div class="dashboard-header">
        <h1>📊 Dashboard Administrateur</h1>
        <p>Bienvenue {{ $user->name }} - {{ $user->role_name }}</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">🏠</div>
            <div class="stat-content">
                <h3>{{ $stats['total_biens'] }}</h3>
                <p>Biens Immobiliers</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">✅</div>
            <div class="stat-content">
                <h3>{{ $stats['biens_actifs'] }}</h3>
                <p>Biens Actifs</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">📸</div>
            <div class="stat-content">
                <h3>{{ $stats['total_photos'] }}</h3>
                <p>Photos</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-content">
                <h3>{{ $stats['total_admins'] }}</h3>
                <p>Administrateurs</p>
            </div>
        </div>
    </div>

    <div class="dashboard-actions">
        <h2>Actions Rapides</h2>
        <div class="action-grid">
            <a href="{{ route('admin.biens.index') }}" class="action-card">
                <div class="action-icon">🏠</div>
                <h3>Gérer les Biens</h3>
                <p>Ajouter, modifier ou supprimer des propriétés</p>
            </a>

            <a href="{{ route('admin.biens.create') }}" class="action-card">
                <div class="action-icon">➕</div>
                <h3>Ajouter un Bien</h3>
                <p>Créer une nouvelle propriété</p>
            </a>

            @if($user->isMainAdmin())
            <a href="{{ route('admin.users.index') }}" class="action-card">
                <div class="action-icon">👥</div>
                <h3>Gérer les Utilisateurs</h3>
                <p>Administrer les comptes utilisateurs</p>
            </a>

            
            @endif
        </div>
    </div>

    <div class="recent-activity">
        <h2>Activité Récente</h2>
        <div class="activity-list">
            <div class="activity-item">
                <div class="activity-icon">📝</div>
                <div class="activity-content">
                    <p><strong>Dernière connexion :</strong> {{ $user->last_login ? $user->last_login->format('d/m/Y à H:i') : 'Première connexion' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* === Dashboard avec Thème Sombre === */
.admin-dashboard {
    padding: 30px;
    background: var(--couleur-fond);
    min-height: calc(100vh - 80px);
}

.dashboard-header {
    margin-bottom: 40px;
    text-align: center;
    background: var(--couleur-surface);
    padding: 30px;
    border-radius: 15px;
    border: 1px solid var(--couleur-bordure);
}

.dashboard-header h1 {
    color: #fff;
    font-size: 2.5rem;
    margin-bottom: 10px;
    font-weight: 700;
}

.dashboard-header p {
    color: var(--couleur-texte-mute);
    font-size: 1.2rem;
    margin: 0;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
    margin-bottom: 50px;
}

.stat-card {
    background: var(--couleur-surface);
    color: white;
    padding: 30px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    border: 1px solid var(--couleur-bordure);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, var(--couleur-primaire), #0077cc);
    opacity: 0.1;
    transition: opacity 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    border-color: var(--couleur-primaire);
}

.stat-card:hover::before {
    opacity: 0.2;
}

.stat-icon {
    font-size: 3rem;
    margin-right: 20px;
    background: linear-gradient(135deg, var(--couleur-primaire), #0077cc);
    padding: 15px;
    border-radius: 12px;
    position: relative;
    z-index: 1;
}

.stat-content {
    position: relative;
    z-index: 1;
}

.stat-content h3 {
    font-size: 2.5rem;
    margin: 0;
    font-weight: 700;
    color: #fff;
}

.stat-content p {
    margin: 5px 0 0 0;
    color: var(--couleur-texte-mute);
    font-size: 1.1rem;
    font-weight: 500;
}

.dashboard-actions {
    margin-bottom: 50px;
    background: var(--couleur-surface);
    padding: 30px;
    border-radius: 15px;
    border: 1px solid var(--couleur-bordure);
}

.dashboard-actions h2 {
    color: #fff;
    margin-bottom: 25px;
    font-size: 1.8rem;
    font-weight: 600;
    padding-bottom: 15px;
    border-bottom: 2px solid var(--couleur-primaire);
}

.action-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
}

.action-card {
    background: var(--couleur-surface-claire);
    padding: 30px;
    border-radius: 15px;
    text-decoration: none;
    color: inherit;
    border: 1px solid var(--couleur-bordure);
    transition: all 0.3s ease;
    text-align: center;
}

.action-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 170, 255, 0.2);
    border-color: var(--couleur-primaire);
    text-decoration: none;
}

.action-icon {
    font-size: 3rem;
    margin-bottom: 15px;
    background: linear-gradient(135deg, var(--couleur-primaire), #0077cc);
    color: white;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px auto;
}

.action-card h3 {
    color: #fff;
    margin: 0 0 10px 0;
    font-size: 1.3rem;
    font-weight: 600;
}

.action-card p {
    color: var(--couleur-texte-mute);
    margin: 0;
    line-height: 1.5;
}

.recent-activity {
    background: var(--couleur-surface);
    padding: 30px;
    border-radius: 15px;
    border: 1px solid var(--couleur-bordure);
}

.recent-activity h2 {
    color: #fff;
    margin-bottom: 25px;
    font-size: 1.8rem;
    font-weight: 600;
    padding-bottom: 15px;
    border-bottom: 2px solid var(--couleur-primaire);
}

.activity-list {
    background: var(--couleur-surface-claire);
    border-radius: 15px;
    padding: 25px;
    border: 1px solid var(--couleur-bordure);
}

.activity-item {
    display: flex;
    align-items: center;
    padding: 15px 0;
}

.activity-icon {
    font-size: 1.5rem;
    margin-right: 15px;
    background: var(--couleur-primaire);
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.activity-content {
    flex: 1;
}

.activity-content p {
    color: var(--couleur-texte);
    margin: 0;
    font-size: 1rem;
}

.activity-content strong {
    color: #fff;
}

@media (max-width: 768px) {
    .admin-dashboard {
        padding: 20px;
    }

    .dashboard-header {
        padding: 20px;
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }

    .action-grid {
        grid-template-columns: 1fr;
    }

    .stat-card {
        flex-direction: column;
        text-align: center;
    }

    .stat-icon {
        margin-right: 0;
        margin-bottom: 15px;
    }

    .dashboard-actions, .recent-activity {
        padding: 20px;
    }
}
</style>
@endsection
