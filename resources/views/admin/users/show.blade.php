@extends('admin.layouts.app')

@section('title', 'Détails Utilisateur')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>👤 Détails de l'Utilisateur</h1>
        <div class="header-actions">
            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">
                ✏️ Modifier
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                ← Retour à la liste
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>{{ $user->name }}</h3>
            <span class="badge badge-{{ $user->role === 'main_admin' ? 'danger' : ($user->role === 'admin' ? 'warning' : 'secondary') }}">
                {{ ucfirst(str_replace('_', ' ', $user->role)) }}
            </span>
        </div>
        <div class="card-body">
            <div class="user-details">
                <div class="detail-row">
                    <label>ID :</label>
                    <span>{{ $user->id }}</span>
                </div>
                
                <div class="detail-row">
                    <label>Nom complet :</label>
                    <span>{{ $user->name }}</span>
                </div>
                
                <div class="detail-row">
                    <label>Email :</label>
                    <span>{{ $user->email }}</span>
                </div>
                
                <div class="detail-row">
                    <label>Rôle :</label>
                    <span class="badge badge-{{ $user->role === 'main_admin' ? 'danger' : ($user->role === 'admin' ? 'warning' : 'secondary') }}">
                        {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                    </span>
                </div>
                
                <div class="detail-row">
                    <label>Email vérifié :</label>
                    <span class="badge badge-{{ $user->email_verified_at ? 'success' : 'danger' }}">
                        {{ $user->email_verified_at ? 'Oui' : 'Non' }}
                    </span>
                </div>
                
                <div class="detail-row">
                    <label>Date d'inscription :</label>
                    <span>{{ $user->created_at->format('d/m/Y à H:i') }}</span>
                </div>
                
                <div class="detail-row">
                    <label>Dernière modification :</label>
                    <span>{{ $user->updated_at->format('d/m/Y à H:i') }}</span>
                </div>
                
                <div class="detail-row">
                    <label>Dernière connexion :</label>
                    <span>
                        @if($user->last_login)
                            {{ $user->last_login->format('d/m/Y à H:i') }}
                        @else
                            <span class="text-muted">Jamais connecté</span>
                        @endif
                    </span>
                </div>
            </div>
        </div>
        
        <div class="card-footer">
            <div class="action-buttons">
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">
                    ✏️ Modifier cet utilisateur
                </a>
                
                @if($user->id !== auth()->id())
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline;" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger delete-btn"
                                data-title="Supprimer l'utilisateur"
                                data-message="Êtes-vous sûr de vouloir supprimer {{ $user->name }} ? Cette action est irréversible et supprimera définitivement toutes ses données.">
                            🗑️ Supprimer
                        </button>
                    </form>
                @else
                    <span class="text-muted">Vous ne pouvez pas supprimer votre propre compte</span>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
/* === Vue Détails Utilisateur avec Thème Sombre === */
.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    background: var(--couleur-surface);
    padding: 1.5rem;
    border-radius: 12px;
    border: 1px solid var(--couleur-bordure);
}

.admin-header h1 {
    color: #fff;
    margin: 0;
    font-size: 1.5rem;
    font-weight: 600;
}

.header-actions {
    display: flex;
    gap: 0.5rem;
}

.card {
    background: var(--couleur-surface);
    border-radius: 12px;
    border: 1px solid var(--couleur-bordure);
    overflow: hidden;
    margin-bottom: 1.5rem;
}

.card-header {
    background: var(--couleur-surface-claire);
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--couleur-bordure);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-header h3 {
    color: #fff;
    margin: 0;
    font-weight: 600;
}

.card-body {
    padding: 1.5rem;
}

.card-footer {
    background: var(--couleur-surface-claire);
    padding: 1rem 1.5rem;
    border-top: 1px solid var(--couleur-bordure);
}

.user-details {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.detail-row {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: var(--couleur-surface-claire);
    border-radius: 8px;
    border: 1px solid var(--couleur-bordure);
}

.detail-row label {
    font-weight: 600;
    color: var(--couleur-texte-mute);
    min-width: 150px;
    font-size: 0.9rem;
}

.detail-row span {
    color: var(--couleur-texte);
    font-weight: 500;
}

.badge {
    display: inline-block;
    padding: 0.25em 0.6em;
    font-size: 0.75em;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.375rem;
}

.badge-danger {
    color: #fff;
    background-color: #dc3545;
    border: 1px solid rgba(220, 53, 69, 0.3);
}

.badge-warning {
    color: #212529;
    background-color: #ffc107;
    border: 1px solid rgba(255, 193, 7, 0.3);
}

.badge-secondary {
    color: #fff;
    background-color: #6c757d;
    border: 1px solid rgba(108, 117, 125, 0.3);
}

.badge-success {
    color: #fff;
    background-color: #28a745;
    border: 1px solid rgba(40, 167, 69, 0.3);
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.btn {
    display: inline-block;
    font-weight: 600;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid transparent;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    line-height: 1.5;
    border-radius: 0.5rem;
    text-decoration: none;
    transition: all 0.15s ease-in-out;
}

.btn-warning {
    color: #212529;
    background-color: #ffc107;
    border-color: #ffc107;
}

.btn-warning:hover {
    color: #212529;
    background-color: #e0a800;
    transform: translateY(-2px);
    text-decoration: none;
}

.btn-secondary {
    color: var(--couleur-texte);
    background-color: var(--couleur-surface-claire);
    border-color: var(--couleur-bordure);
}

.btn-secondary:hover {
    color: var(--couleur-texte);
    background-color: var(--couleur-bordure);
    transform: translateY(-2px);
    text-decoration: none;
}

.btn-danger {
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-danger:hover {
    color: #fff;
    background-color: #c82333;
    transform: translateY(-2px);
    text-decoration: none;
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
}

.text-muted {
    color: var(--couleur-texte-mute);
}

/* Responsive design */
@media (max-width: 768px) {
    .admin-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .header-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .detail-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .detail-row label {
        min-width: auto;
    }
    
    .card-body {
        padding: 1rem;
    }
}
</style>
@endsection
