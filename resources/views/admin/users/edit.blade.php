@extends('admin.layouts.app')

@section('title', 'Modifier Utilisateur')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>✏️ Modifier l'Utilisateur</h1>
        <div class="header-actions">
            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info">
                👁️ Voir les détails
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                ← Retour à la liste
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Erreurs :</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3>Modification de {{ $user->name }}</h3>
            <span class="badge badge-{{ $user->role === 'main_admin' ? 'danger' : ($user->role === 'admin' ? 'warning' : 'secondary') }}">
                {{ ucfirst(str_replace('_', ' ', $user->role)) }}
            </span>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">Nom complet *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name', $user->name) }}" 
                           placeholder="Nom et prénom de l'utilisateur" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Adresse email *</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email', $user->email) }}" 
                           placeholder="email@exemple.com" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="role">Rôle *</label>
                    <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                        <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>Utilisateur</option>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrateur</option>
                        <option value="main_admin" {{ old('role', $user->role) === 'main_admin' ? 'selected' : '' }}>Administrateur Principal</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">
                        <strong>Utilisateur :</strong> Accès limité au site<br>
                        <strong>Administrateur :</strong> Gestion des biens immobiliers<br>
                        <strong>Administrateur Principal :</strong> Accès complet (gestion utilisateurs + paramètres)
                    </small>
                </div>

                <div class="password-section">
                    <h4>Modification du mot de passe (optionnel)</h4>
                    <p class="text-muted">Laissez ces champs vides si vous ne souhaitez pas changer le mot de passe.</p>
                    
                    <div class="form-group">
                        <label for="password">Nouveau mot de passe</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" placeholder="Minimum 8 caractères">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirmer le nouveau mot de passe</label>
                        <input type="password" class="form-control" 
                               id="password_confirmation" name="password_confirmation" 
                               placeholder="Répéter le nouveau mot de passe">
                    </div>
                </div>

                <div class="user-info">
                    <h4>Informations du compte</h4>
                    <div class="info-grid">
                        <div class="info-item">
                            <label>Créé le :</label>
                            <span>{{ $user->created_at->format('d/m/Y à H:i') }}</span>
                        </div>
                        <div class="info-item">
                            <label>Dernière modification :</label>
                            <span>{{ $user->updated_at->format('d/m/Y à H:i') }}</span>
                        </div>
                        <div class="info-item">
                            <label>Dernière connexion :</label>
                            <span>
                                @if($user->last_login)
                                    {{ $user->last_login->format('d/m/Y à H:i') }}
                                @else
                                    <span class="text-muted">Jamais connecté</span>
                                @endif
                            </span>
                        </div>
                        <div class="info-item">
                            <label>Email vérifié :</label>
                            <span class="badge badge-{{ $user->email_verified_at ? 'success' : 'danger' }}">
                                {{ $user->email_verified_at ? 'Oui' : 'Non' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        💾 Enregistrer les Modifications
                    </button>
                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info">
                        👁️ Voir les détails
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* === Formulaire Édition Utilisateur avec Thème Sombre === */
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

.card-header h3, .card-header h4 {
    color: #fff;
    margin: 0;
    font-weight: 600;
}

.card-body {
    padding: 1.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: #fff;
}

.form-control {
    display: block;
    width: 100%;
    padding: 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: var(--couleur-texte);
    background-color: var(--couleur-surface-claire);
    border: 2px solid var(--couleur-bordure);
    border-radius: 0.5rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus {
    color: var(--couleur-texte);
    background-color: var(--couleur-surface);
    border-color: var(--couleur-primaire);
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 170, 255, 0.25);
}

.form-control.is-invalid {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

.form-control::placeholder {
    color: var(--couleur-texte-mute);
    opacity: 0.8;
}

.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #ff6b6b;
    font-weight: 500;
}

.form-text {
    display: block;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: var(--couleur-texte-mute);
    background: var(--couleur-surface-claire);
    padding: 8px 12px;
    border-radius: 6px;
    border-left: 3px solid var(--couleur-primaire);
}

.password-section {
    margin: 2rem 0;
    padding: 1.5rem;
    background: var(--couleur-surface-claire);
    border-radius: 0.5rem;
    border: 1px solid var(--couleur-bordure);
}

.password-section h4 {
    margin-top: 0;
    color: #fff;
    font-weight: 600;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--couleur-primaire);
}

.user-info {
    margin: 2rem 0;
    padding: 1.5rem;
    background: var(--couleur-surface-claire);
    border-radius: 0.5rem;
    border: 1px solid var(--couleur-bordure);
}

.user-info h4 {
    margin-top: 0;
    margin-bottom: 1rem;
    color: #fff;
    font-weight: 600;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--couleur-primaire);
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
    padding: 1rem;
    background: var(--couleur-surface);
    border-radius: 8px;
    border: 1px solid var(--couleur-bordure);
}

.info-item label {
    font-weight: 600;
    color: var(--couleur-texte-mute);
    font-size: 0.875rem;
}

.info-item span {
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

.form-actions {
    display: flex;
    gap: 0.5rem;
    margin-top: 2rem;
    padding-top: 1rem;
    border-top: 1px solid var(--couleur-bordure);
}

.btn {
    display: inline-block;
    font-weight: 600;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid transparent;
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.5rem;
    text-decoration: none;
    transition: all 0.15s ease-in-out;
}

.btn-primary {
    color: #fff;
    background: linear-gradient(135deg, var(--couleur-primaire), #0077cc);
    border-color: var(--couleur-primaire);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0077cc, var(--couleur-primaire));
    border-color: #0077cc;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 170, 255, 0.3);
    text-decoration: none;
    color: #fff;
}

.btn-info {
    color: #fff;
    background-color: #17a2b8;
    border-color: #17a2b8;
}

.btn-info:hover {
    background-color: #117a8b;
    border-color: #117a8b;
    transform: translateY(-2px);
    text-decoration: none;
    color: #fff;
}

.btn-secondary {
    color: var(--couleur-texte);
    background-color: var(--couleur-surface-claire);
    border-color: var(--couleur-bordure);
}

.btn-secondary:hover {
    background-color: var(--couleur-bordure);
    border-color: var(--couleur-bordure);
    transform: translateY(-2px);
    text-decoration: none;
    color: var(--couleur-texte);
}

.alert {
    padding: 0.75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: 0.5rem;
}

.alert-danger {
    color: #ff6b6b;
    background-color: rgba(231, 76, 60, 0.1);
    border-color: rgba(231, 76, 60, 0.3);
}

.alert ul {
    margin-bottom: 0;
    padding-left: 1.5rem;
    color: #ff6b6b;
}

.alert strong {
    color: #ff6b6b;
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
    
    .form-actions {
        flex-direction: column;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .card-body {
        padding: 1rem;
    }
}
</style>
@endsection
