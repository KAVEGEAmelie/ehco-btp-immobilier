@extends('admin.layouts.app')

@section('title', 'Modifier le Bien')
@section('breadcrumb', 'Administration / Gestion des Biens / Modifier')

@section('content')
<div class="admin-bien-edit">
    <div class="page-header">
        <div class="header-content">
            <h1>✏️ Modifier le Bien</h1>
            <p>{{ $bien->titre }}</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.biens.show', $bien) }}" class="btn-info">
                👁️ Voir les détails
            </a>
            <a href="{{ route('admin.biens.index') }}" class="btn-secondary">
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

    <form action="{{ route('admin.biens.update', $bien) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-container">
            <div class="form-section">
                <h3>Informations Générales</h3>
                
                <div class="form-group">
                    <label for="titre">Titre du bien *</label>
                    <input type="text" class="form-control @error('titre') is-invalid @enderror" 
                           id="titre" name="titre" value="{{ old('titre', $bien->titre) }}" 
                           placeholder="Ex: Magnifique appartement T3" required>
                    @error('titre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description *</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="5" 
                              placeholder="Décrivez le bien en détail..." required>{{ old('description', $bien->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="prix">Prix (CFA) *</label>
                        <input type="number" class="form-control @error('prix') is-invalid @enderror" 
                               id="prix" name="prix" value="{{ old('prix', $bien->prix) }}" 
                               step="0.01" min="0" placeholder="285000" required>
                        @error('prix')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="surface">Surface (m²) *</label>
                        <input type="number" class="form-control @error('surface') is-invalid @enderror" 
                               id="surface" name="surface" value="{{ old('surface', $bien->surface) }}" 
                               min="0" placeholder="120" required>
                        @error('surface')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3>Localisation</h3>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="ville">Ville *</label>
                        <input type="text" class="form-control @error('ville') is-invalid @enderror" 
                               id="ville" name="ville" value="{{ old('ville', $bien->ville) }}" 
                               placeholder="Lyon" required>
                        @error('ville')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="adresse">Adresse *</label>
                        <input type="text" class="form-control @error('adresse') is-invalid @enderror" 
                               id="adresse" name="adresse" value="{{ old('adresse', $bien->adresse) }}" 
                               placeholder="15 Rue des Roses" required>
                        @error('adresse')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3>Caractéristiques</h3>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="nombre_pieces">Nombre de pièces *</label>
                        <input type="number" class="form-control @error('nombre_pieces') is-invalid @enderror" 
                               id="nombre_pieces" name="nombre_pieces" value="{{ old('nombre_pieces', $bien->nombre_pieces) }}" 
                               min="1" placeholder="5" required>
                        @error('nombre_pieces')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nombre_chambres">Nombre de chambres *</label>
                        <input type="number" class="form-control @error('nombre_chambres') is-invalid @enderror" 
                               id="nombre_chambres" name="nombre_chambres" value="{{ old('nombre_chambres', $bien->nombre_chambres) }}" 
                               min="0" placeholder="3" required>
                        @error('nombre_chambres')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nombre_sdb">Salles de bain *</label>
                        <input type="number" class="form-control @error('nombre_sdb') is-invalid @enderror" 
                               id="nombre_sdb" name="nombre_sdb" value="{{ old('nombre_sdb', $bien->nombre_sdb) }}" 
                               min="0" placeholder="2" required>
                        @error('nombre_sdb')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3>Statut et Disponibilité</h3>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="statut">Statut *</label>
                        <select class="form-control @error('statut') is-invalid @enderror" id="statut" name="statut" required>
                            <option value="disponible" {{ old('statut', $bien->statut) === 'disponible' ? 'selected' : '' }}>Disponible</option>
                            <option value="vendu" {{ old('statut', $bien->statut) === 'vendu' ? 'selected' : '' }}>Vendu</option>
                            <option value="loue" {{ old('statut', $bien->statut) === 'loue' ? 'selected' : '' }}>Loué</option>
                            <option value="reserve" {{ old('statut', $bien->statut) === 'reserve' ? 'selected' : '' }}>Réservé</option>
                        </select>
                        @error('statut')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="hidden" name="disponible" value="0">
                            <input type="checkbox" 
                                   class="form-check-input" 
                                   id="disponible" 
                                   name="disponible" 
                                   value="1"
                                   {{ old('disponible', $bien->disponible) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="disponible">
                                Marquer comme disponible à la visite
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3>Photos Actuelles</h3>
                
                @if($bien->photos->count() > 0)
                    <div class="current-photos">
                        @foreach($bien->photos as $photo)
                            <div class="photo-item" data-photo-id="{{ $photo->id }}">
                                <img src="{{ asset('storage/' . $photo->chemin) }}" alt="{{ $bien->titre }}">
                                <button type="button" class="delete-photo" onclick="deletePhoto({{ $photo->id }})">
                                    🗑️
                                </button>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="no-photos">Aucune photo pour ce bien.</p>
                @endif

                <div class="form-group">
                    <label for="images">Ajouter de nouvelles photos</label>
                    <input type="file" class="form-control @error('images.*') is-invalid @enderror" 
                           id="images" name="images[]" multiple accept="image/*">
                    <small class="form-text text-muted">
                        Formats acceptés : JPEG, PNG, JPG, GIF. Taille maximale : 2MB par image.
                    </small>
                    @error('images.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                💾 Enregistrer les Modifications
            </button>
            <a href="{{ route('admin.biens.show', $bien) }}" class="btn-info">
                👁️ Voir les détails
            </a>
            <a href="{{ route('admin.biens.index') }}" class="btn-secondary">
                Annuler
            </a>
        </div>
    </form>
</div>

<script>
function deletePhoto(photoId) {
    // Utiliser le système de modal moderne
    if (window.notificationSystem) {
        window.notificationSystem.confirm(
            'Êtes-vous sûr de vouloir supprimer cette photo ?',
            () => {
                // Confirmation acceptée
                fetch('{{ route("admin.biens.photo.delete") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        photo_id: photoId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.querySelector(`[data-photo-id="${photoId}"]`).remove();
                        window.notificationSystem.show('Photo supprimée avec succès', 'success');
                    } else {
                        window.notificationSystem.show('Erreur lors de la suppression de la photo', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    window.notificationSystem.show('Erreur lors de la suppression de la photo', 'error');
                });
            }
        );
    } else {
        // Fallback si le système de notification n'est pas disponible
        if (confirm('Êtes-vous sûr de vouloir supprimer cette photo ?')) {
            fetch('{{ route("admin.biens.photo.delete") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    photo_id: photoId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.querySelector(`[data-photo-id="${photoId}"]`).remove();
                } else {
                    alert('Erreur lors de la suppression de la photo');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Erreur lors de la suppression de la photo');
            });
        }
    }
}
</script>

<style>
/* === Formulaire Édition Bien avec Thème Sombre === */
.admin-bien-edit {
    padding: 30px;
    background: var(--couleur-fond);
    min-height: calc(100vh - 80px);
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    background: var(--couleur-surface);
    padding: 25px;
    border-radius: 15px;
    border: 1px solid var(--couleur-bordure);
}

.header-content h1 {
    color: #fff;
    margin: 0 0 5px 0;
    font-size: 1.8rem;
    font-weight: 700;
}

.header-content p {
    color: var(--couleur-texte-mute);
    margin: 0;
    font-style: italic;
}

.header-actions {
    display: flex;
    gap: 10px;
}

.btn-info, .btn-secondary {
    padding: 12px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.btn-info {
    background: #17a2b8;
    color: white;
    border-color: #17a2b8;
}

.btn-secondary {
    background: var(--couleur-surface-claire);
    color: var(--couleur-texte);
    border-color: var(--couleur-bordure);
}

.btn-info:hover, .btn-secondary:hover {
    transform: translateY(-2px);
    text-decoration: none;
}

.btn-info:hover {
    color: white;
    background: #138496;
}

.btn-secondary:hover {
    color: var(--couleur-texte);
    background: var(--couleur-bordure);
}

.form-container {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.form-section {
    background: var(--couleur-surface);
    border-radius: 15px;
    padding: 25px;
    border: 1px solid var(--couleur-bordure);
}

.form-section h3 {
    color: #fff;
    margin: 0 0 20px 0;
    font-size: 1.3rem;
    font-weight: 600;
    border-bottom: 2px solid var(--couleur-primaire);
    padding-bottom: 10px;
}

.form-group {
    margin-bottom: 20px;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #fff;
}

.form-control {
    width: 100%;
    padding: 12px;
    font-size: 1rem;
    line-height: 1.5;
    color: var(--couleur-texte);
    background-color: var(--couleur-surface-claire);
    border: 2px solid var(--couleur-bordure);
    border-radius: 8px;
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
}

.form-check {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 10px;
    padding: 15px;
    background: var(--couleur-surface-claire);
    border-radius: 8px;
    border: 1px solid var(--couleur-bordure);
}

.form-check-input {
    margin: 0;
    width: 18px;
    height: 18px;
    accent-color: var(--couleur-primaire);
}

.form-check-label {
    margin: 0;
    cursor: pointer;
    color: var(--couleur-texte);
    font-weight: 500;
}

.current-photos {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 15px;
    margin-bottom: 20px;
}

.photo-item {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid var(--couleur-bordure);
    background: var(--couleur-surface-claire);
}

.photo-item img {
    width: 100%;
    height: 120px;
    object-fit: cover;
}

.delete-photo {
    position: absolute;
    top: 5px;
    right: 5px;
    background: rgba(231, 76, 60, 0.9);
    color: white;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    cursor: pointer;
    font-size: 0.8rem;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.delete-photo:hover {
    background: rgba(192, 57, 43, 0.9);
    transform: scale(1.1);
}

.no-photos {
    text-align: center;
    color: var(--couleur-texte-mute);
    font-style: italic;
    margin-bottom: 20px;
    padding: 40px;
    background: var(--couleur-surface-claire);
    border-radius: 8px;
    border: 2px dashed var(--couleur-bordure);
}

.form-actions {
    background: var(--couleur-surface);
    border-radius: 15px;
    padding: 25px;
    border: 1px solid var(--couleur-bordure);
    display: flex;
    gap: 15px;
    justify-content: center;
    margin-top: 30px;
}

.btn-primary {
    background: linear-gradient(135deg, var(--couleur-primaire), #0077cc);
    color: white;
    padding: 15px 30px;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 170, 255, 0.4);
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 8px;
}

.alert-danger {
    color: #ff6b6b;
    background-color: rgba(231, 76, 60, 0.1);
    border-color: rgba(231, 76, 60, 0.3);
}

.alert ul {
    margin-bottom: 0;
    padding-left: 20px;
    color: #ff6b6b;
}

.alert strong {
    color: #ff6b6b;
}

@media (max-width: 768px) {
    .admin-bien-edit {
        padding: 20px;
    }
    
    .page-header {
        flex-direction: column;
        gap: 20px;
        text-align: center;
        padding: 20px;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .form-actions {
        flex-direction: column;
        padding: 20px;
    }
    
    .current-photos {
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    }
    
    .form-section {
        padding: 20px;
    }
}
</style>
@endsection
