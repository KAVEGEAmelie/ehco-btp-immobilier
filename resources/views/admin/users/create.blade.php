@extends('admin.layouts.app')

@section('title', 'Créer un Utilisateur')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>➕ Créer un Nouvel Utilisateur</h1>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            ← Retour à la liste
        </a>
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
            <h3>Informations de l'Utilisateur</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="name">Nom complet *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name') }}" 
                           placeholder="Nom et prénom de l'utilisateur" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Adresse email *</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}" 
                           placeholder="email@exemple.com" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="role">Rôle *</label>
                    <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                        <option value="">-- Sélectionner un rôle --</option>
                        <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>Utilisateur</option>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrateur</option>
                        <option value="main_admin" {{ old('role') === 'main_admin' ? 'selected' : '' }}>Administrateur Principal</option>
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

                <div class="form-group">
                    <label for="password">Mot de passe *</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" placeholder="Minimum 8 caractères" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmer le mot de passe *</label>
                    <input type="password" class="form-control" 
                           id="password_confirmation" name="password_confirmation" 
                           placeholder="Répéter le mot de passe" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        💾 Créer l'Utilisateur
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* === Formulaire Création Utilisateur avec Thème Sombre === */
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

.card {
    background: var(--couleur-surface);
    border-radius: 12px;
    border: 1px solid var(--couleur-bordure);
    overflow: hidden;
}

.card-header {
    background: var(--couleur-surface-claire);
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--couleur-bordure);
}

.card-header h3 {
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

/* Responsive design */
@media (max-width: 768px) {
    .admin-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .card-body {
        padding: 1rem;
    }
}
</style>
@endsection
