@extends('admin.layouts.app')

@section('title', 'Mon Profil')

@section('content')
<div class="admin-content">
    <div class="content-header">
        <h1>Mon Profil</h1>
        <p>Gérez vos informations personnelles et votre mot de passe</p>
    </div>

    <div class="admin-grid">
        <div class="admin-card">
            <div class="card-header">
                <h2>👤 Informations personnelles</h2>
            </div>
            <div class="card-content">
                @if(session('success'))
                    <div class="success-message">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.profile.update') }}" method="POST" class="admin-form">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Nom complet</label>
                        <input type="text" id="name" name="name" 
                               value="{{ old('name', $user->name) }}" 
                               class="form-control @error('name') error @enderror" required>
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Adresse email</label>
                        <input type="email" id="email" name="email" 
                               value="{{ old('email', $user->email) }}" 
                               class="form-control @error('email') error @enderror" required>
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Rôle</label>
                        <input type="text" value="{{ ucfirst($user->role) }}" 
                               class="form-control" readonly>
                        <small class="form-text">Votre niveau d'accès dans l'administration</small>
                    </div>

                    <div class="form-group">
                        <label>Membre depuis</label>
                        <input type="text" value="{{ $user->created_at->format('d/m/Y à H:i') }}" 
                               class="form-control" readonly>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            💾 Mettre à jour le profil
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header">
                <h2>🔒 Changer le mot de passe</h2>
            </div>
            <div class="card-content">
                <form action="{{ route('admin.profile.password.update') }}" method="POST" class="admin-form">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="current_password">Mot de passe actuel</label>
                        <input type="password" id="current_password" name="current_password" 
                               class="form-control @error('current_password') error @enderror" required>
                        @error('current_password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Nouveau mot de passe</label>
                        <input type="password" id="password" name="password" 
                               class="form-control @error('password') error @enderror" required>
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                        <small class="form-text">Minimum 8 caractères</small>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirmer le nouveau mot de passe</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" 
                               class="form-control" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning">
                            🔑 Changer le mot de passe
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.admin-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-top: 30px;
}

@media (max-width: 768px) {
    .admin-grid {
        grid-template-columns: 1fr;
    }
}

.success-message {
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    color: #155724;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    border-left: 4px solid #28a745;
}

.form-text {
    font-size: 0.875rem;
    color: var(--couleur-texte-mute);
    margin-top: 5px;
    display: block;
}

.btn-warning {
    background: linear-gradient(135deg, #ff6b35, #f57c00);
    color: white;
}

.btn-warning:hover {
    background: linear-gradient(135deg, #e55a2b, #ef6c00);
    transform: translateY(-2px);
}
</style>
@endsection
