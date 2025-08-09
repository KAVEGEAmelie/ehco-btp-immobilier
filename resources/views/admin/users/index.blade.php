@extends('admin.layouts.app')

@section('title', 'Gestion des Utilisateurs')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>👥 Gestion des Utilisateurs</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            ➕ Ajouter un Utilisateur
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3>Liste des Utilisateurs ({{ $users->total() }})</h3>
        </div>
        <div class="card-body">
            @if($users->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Rôle</th>
                                <th>Dernière Connexion</th>
                                <th>Date d'inscription</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge badge-{{ $user->role === 'main_admin' ? 'danger' : ($user->role === 'admin' ? 'warning' : 'secondary') }}">
                                            {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($user->last_login)
                                            {{ $user->last_login->format('d/m/Y H:i') }}
                                        @else
                                            <span class="text-muted">Jamais connecté</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-info">👁️</a>
                                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">✏️</a>
                                            @if($user->id !== auth()->id())
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline;" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger delete-btn"
                                                            data-title="Supprimer l'utilisateur"
                                                            data-message="Êtes-vous sûr de vouloir supprimer {{ $user->name }} ? Cette action est irréversible.">
                                                        🗑️
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pagination-wrapper">
                    {{ $users->links() }}
                </div>
            @else
                <div class="empty-state">
                    <p>Aucun utilisateur trouvé.</p>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                        Créer le premier utilisateur
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
/* === Thème Sombre pour l'Interface d'Administration === */

/* On assume que le layout parent définit déjà ces variables, mais on les déclare ici par sécurité */
:root {
    --couleur-fond: #1a1a1a;
    --couleur-surface: #2c2c2c;
    --couleur-surface-claire: #3a3a3a;
    --couleur-texte: #e1e1e1;
    --couleur-texte-mute: #a0aec0;
    --couleur-primaire: #00aaff;
    --couleur-bordure: #444;
}

.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding: 1rem;
    background-color: var(--couleur-surface);
    border-radius: 8px;
    border: 1px solid var(--couleur-bordure);
}

.admin-header h1 {
    color: #fff;
    font-size: 1.5rem;
    margin: 0;
}

.card {
    background: var(--couleur-surface); /* Fond de la carte */
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    border: 1px solid var(--couleur-bordure);
    overflow: hidden;
}

.card-header {
    background: var(--couleur-surface-claire); /* En-tête de carte légèrement plus claire */
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--couleur-bordure);
}

.card-header h3 {
    color: var(--couleur-texte);
    margin: 0;
    font-size: 1.1rem;
}

.card-body {
    padding: 0; /* On retire le padding pour que la table prenne toute la largeur */
}

.table-responsive {
    overflow-x: auto;
}

.table {
    width: 100%;
    margin-bottom: 0;
    border-collapse: collapse;
}

.table th,
.table td {
    padding: 1rem 1.5rem; /* Augmentation du padding pour un look aéré */
    vertical-align: middle;
    border-top: 1px solid var(--couleur-bordure);
    color: var(--couleur-texte);
    text-align: left;
}

.table .text-muted {
    color: var(--couleur-texte-mute);
}

.table tbody tr {
    transition: background-color 0.2s ease;
}

.table tbody tr:hover {
    background-color: rgba(0, 170, 255, 0.05); /* Effet de survol bleu subtil */
}

.table thead th {
    border-bottom: 2px solid var(--couleur-primaire);
    background: transparent;
    font-weight: 600;
    color: #fff;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge {
    display: inline-block;
    padding: 0.3em 0.7em;
    font-size: 0.75em;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 50px; /* Badges en forme de pilule */
}

.badge-danger {
    color: #fff;
    background-color: #e53e3e;
}

.badge-warning {
    color: #1a202c;
    background-color: #ecc94b;
}

.badge-secondary {
    color: #e2e8f0;
    background-color: #4a5568;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.btn {
    display: inline-flex; /* Pour mieux centrer les emojis/icônes */
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    text-align: center;
    cursor: pointer;
    border: 1px solid transparent;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.2s ease;
}

.btn-sm {
    padding: 0.35rem 0.6rem;
    font-size: 0.8rem;
    border-radius: 6px;
}

.btn-primary {
    color: #fff;
    background-color: var(--couleur-primaire);
    border-color: var(--couleur-primaire);
}

.btn-info {
    color: #fff;
    background-color: #319795;
    border-color: #319795;
}

.btn-warning {
    color: #1a202c;
    background-color: #ecc94b;
    border-color: #ecc94b;
}

.btn-danger {
    color: #fff;
    background-color: #e53e3e;
    border-color: #e53e3e;
}

.btn:hover {
    filter: brightness(115%);
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.alert {
    padding: 1rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: 8px;
}

.alert-success {
    color: #c6f6d5;
    background-color: rgba(72, 187, 120, 0.2);
    border-color: #48bb78;
}

.alert-danger {
    color: #fed7d7;
    background-color: rgba(229, 62, 62, 0.2);
    border-color: #e53e3e;
}

.empty-state {
    text-align: center;
    padding: 3rem 1rem;
    color: var(--couleur-texte-mute);
}

.pagination-wrapper {
    margin-top: 1.5rem;
    padding: 1.5rem;
    display: flex;
    justify-content: center;
}

/* Pagination pour le thème sombre */
.pagination { display: flex; padding-left: 0; list-style: none; border-radius: 0.25rem; }
.pagination .page-link { color: var(--couleur-primaire); background-color: transparent; border: 1px solid var(--couleur-bordure); padding: 0.5rem 0.75rem; margin-left: -1px; }
.pagination .page-item:first-child .page-link { border-top-left-radius: 0.25rem; border-bottom-left-radius: 0.25rem; }
.pagination .page-item:last-child .page-link { border-top-right-radius: 0.25rem; border-bottom-right-radius: 0.25rem; }
.pagination .page-link:hover { background-color: rgba(0, 170, 255, 0.1); }
.pagination .page-item.active .page-link { z-index: 1; color: #fff; background-color: var(--couleur-primaire); border-color: var(--couleur-primaire); }
.pagination .page-item.disabled .page-link { color: #6c757d; background-color: transparent; border-color: var(--couleur-bordure); }

</style>
@endsection
