@extends('admin.layouts.app')

@section('title', 'Ajouter un Bien')
@section('breadcrumb', 'Administration / Gestion des Biens / Ajouter')

@section('content')
<div class="admin-bien-create">
    <div class="page-header">
        <div class="header-content">
            <h1>➕ Ajouter un Bien Immobilier</h1>
            <p>Créez une nouvelle propriété pour votre catalogue</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.biens.index') }}" class="btn-secondary">
                ← Retour à la liste
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.biens.store') }}" enctype="multipart/form-data" class="bien-form">
        @csrf
        
        <div class="form-sections">
            <!-- Informations Générales -->
            <div class="form-section">
                <h3>📋 Informations Générales</h3>
                
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="titre" class="form-label">Titre du bien *</label>
                        <input type="text" 
                               id="titre" 
                               name="titre" 
                               class="form-input @error('titre') error @enderror" 
                               value="{{ old('titre') }}" 
                               required
                               placeholder="Ex: Belle maison avec jardin">
                        @error('titre')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="description" class="form-label">Description *</label>
                        <textarea id="description" 
                                  name="description" 
                                  class="form-textarea @error('description') error @enderror" 
                                  rows="4" 
                                  required
                                  placeholder="Décrivez les caractéristiques et avantages de ce bien...">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Détails du Bien -->
            <div class="form-section">
                <h3>🏠 Détails du Bien</h3>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="prix" class="form-label">Prix (CFA) *</label>
                        <input type="number" 
                               id="prix" 
                               name="prix" 
                               class="form-input @error('prix') error @enderror" 
                               value="{{ old('prix') }}" 
                               min="0" 
                               step="1000"
                               required
                               placeholder="250000">
                        @error('prix')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="surface" class="form-label">Surface (m²) *</label>
                        <input type="number" 
                               id="surface" 
                               name="surface" 
                               class="form-input @error('surface') error @enderror" 
                               value="{{ old('surface') }}" 
                               min="1" 
                               required
                               placeholder="120">
                        @error('surface')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="nombre_pieces" class="form-label">Nombre de pièces *</label>
                        <input type="number" 
                               id="nombre_pieces" 
                               name="nombre_pieces" 
                               class="form-input @error('nombre_pieces') error @enderror" 
                               value="{{ old('nombre_pieces') }}" 
                               min="1" 
                               required
                               placeholder="5">
                        @error('nombre_pieces')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="nombre_chambres" class="form-label">Nombre de chambres *</label>
                        <input type="number" 
                               id="nombre_chambres" 
                               name="nombre_chambres" 
                               class="form-input @error('nombre_chambres') error @enderror" 
                               value="{{ old('nombre_chambres') }}" 
                               min="0" 
                               required
                               placeholder="3">
                        @error('nombre_chambres')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="nombre_sdb" class="form-label">Salles de bain *</label>
                        <input type="number" 
                               id="nombre_sdb" 
                               name="nombre_sdb" 
                               class="form-input @error('nombre_sdb') error @enderror" 
                               value="{{ old('nombre_sdb') }}" 
                               min="0" 
                               required
                               placeholder="2">
                        @error('nombre_sdb')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="statut" class="form-label">Statut *</label>
                        <select id="statut" 
                                name="statut" 
                                class="form-select @error('statut') error @enderror" 
                                required>
                            <option value="">Sélectionnez un statut</option>
                            <option value="disponible" {{ old('statut') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                            <option value="vendu" {{ old('statut') == 'vendu' ? 'selected' : '' }}>Vendu</option>
                            <option value="loue" {{ old('statut') == 'loue' ? 'selected' : '' }}>Loué</option>
                            <option value="reserve" {{ old('statut') == 'reserve' ? 'selected' : '' }}>Réservé</option>
                        </select>
                        @error('statut')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="hidden" name="disponible" value="0">
                            <input type="checkbox" 
                                   id="disponible" 
                                   name="disponible" 
                                   value="1"
                                   class="form-check-input" 
                                   {{ old('disponible', 1) == 1 ? 'checked' : '' }}>
                            <label for="disponible" class="form-check-label">
                                Marquer comme disponible à la visite
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Localisation -->
            <div class="form-section">
                <h3>📍 Localisation</h3>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="ville" class="form-label">Ville *</label>
                        <input type="text" 
                               id="ville" 
                               name="ville" 
                               class="form-input @error('ville') error @enderror" 
                               value="{{ old('ville') }}" 
                               required
                               placeholder="Paris">
                        @error('ville')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="adresse" class="form-label">Adresse complète *</label>
                        <input type="text" 
                               id="adresse" 
                               name="adresse" 
                               class="form-input @error('adresse') error @enderror" 
                               value="{{ old('adresse') }}" 
                               required
                               placeholder="123 Rue de la République, 75001 Paris">
                        @error('adresse')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Photos -->
            <div class="form-section">
                <h3>📸 Photos du Bien</h3>
                
                <div class="form-group">
                    <label for="images" class="form-label">Images (JPEG, PNG, JPG, GIF - Max 2MB chacune)</label>
                    <input type="file" 
                           id="images" 
                           name="images[]" 
                           class="form-file @error('images.*') error @enderror" 
                           multiple 
                           accept="image/*">
                    <div class="file-help">
                        Vous pouvez sélectionner plusieurs images à la fois. La première image sera utilisée comme image principale.
                    </div>
                    @error('images.*')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div id="image-preview" class="image-preview-grid"></div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                💾 Créer le Bien
            </button>
            <a href="{{ route('admin.biens.index') }}" class="btn-secondary">
                Annuler
            </a>
        </div>
    </form>
</div>

<style>
/* === Formulaire Création Bien avec Thème Sombre === */
.admin-bien-create {
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
}

.btn-primary, .btn-secondary {
    padding: 12px 25px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: linear-gradient(135deg, var(--couleur-primaire), #0077cc);
    color: white;
    border: 1px solid var(--couleur-primaire);
}

.btn-secondary {
    background: var(--couleur-surface-claire);
    color: var(--couleur-texte);
    border: 1px solid var(--couleur-bordure);
}

.btn-primary:hover, .btn-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    text-decoration: none;
}

.btn-primary:hover {
    color: white;
}

.btn-secondary:hover {
    background: var(--couleur-bordure);
    color: var(--couleur-texte);
}

.bien-form {
    background: var(--couleur-surface);
    border-radius: 15px;
    padding: 30px;
    border: 1px solid var(--couleur-bordure);
}

.form-sections {
    margin-bottom: 30px;
}

.form-section {
    margin-bottom: 40px;
    padding-bottom: 30px;
    border-bottom: 2px solid var(--couleur-bordure);
}

.form-section:last-child {
    border-bottom: none;
}

.form-section h3 {
    color: #fff;
    margin: 0 0 25px 0;
    font-size: 1.3rem;
    font-weight: 600;
    padding-bottom: 10px;
    border-bottom: 3px solid var(--couleur-primaire);
    display: inline-block;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.form-label {
    font-weight: 600;
    color: #fff;
    margin-bottom: 8px;
    font-size: 1rem;
}

.form-input, .form-textarea, .form-select, .form-file {
    padding: 12px 15px;
    border: 2px solid var(--couleur-bordure);
    border-radius: 10px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: var(--couleur-surface-claire);
    color: var(--couleur-texte);
}

.form-input:focus, .form-textarea:focus, .form-select:focus {
    outline: none;
    border-color: var(--couleur-primaire);
    box-shadow: 0 0 0 3px rgba(0, 170, 255, 0.2);
    background: var(--couleur-surface);
}

.form-input.error, .form-textarea.error, .form-select.error, .form-file.error {
    border-color: #e74c3c;
    box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.2);
}

.form-textarea {
    resize: vertical;
    min-height: 120px;
}

.form-select {
    cursor: pointer;
}

.form-select option {
    background: var(--couleur-surface);
    color: var(--couleur-texte);
}

.error-message {
    color: #ff6b6b;
    font-size: 0.9rem;
    margin-top: 5px;
    font-weight: 500;
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
    font-weight: 500;
    color: var(--couleur-texte);
}

.file-help {
    color: var(--couleur-texte-mute);
    font-size: 0.9rem;
    margin-top: 5px;
    font-style: italic;
    padding: 10px;
    background: var(--couleur-surface-claire);
    border-radius: 6px;
    border-left: 3px solid var(--couleur-primaire);
}

.image-preview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 15px;
    margin-top: 15px;
}

.form-actions {
    display: flex;
    gap: 15px;
    justify-content: flex-end;
    padding-top: 30px;
    border-top: 2px solid var(--couleur-bordure);
}

/* Styles pour les placeholders */
.form-input::placeholder,
.form-textarea::placeholder {
    color: var(--couleur-texte-mute);
    opacity: 0.8;
}

/* Styles pour les input de type file */
.form-file {
    background: var(--couleur-surface-claire);
    color: var(--couleur-texte);
    cursor: pointer;
}

.form-file::-webkit-file-upload-button {
    background: var(--couleur-primaire);
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 6px;
    margin-right: 10px;
    cursor: pointer;
    font-weight: 500;
}

.form-file::-webkit-file-upload-button:hover {
    background: #0077cc;
}

@media (max-width: 768px) {
    .admin-bien-create {
        padding: 20px;
    }
    
    .page-header {
        flex-direction: column;
        gap: 20px;
        text-align: center;
        padding: 20px;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .bien-form {
        padding: 20px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('images');
    const previewGrid = document.getElementById('image-preview');
    
    imageInput.addEventListener('change', function(e) {
        previewGrid.innerHTML = '';
        
        if (e.target.files) {
            Array.from(e.target.files).forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewDiv = document.createElement('div');
                        previewDiv.style.cssText = `
                            position: relative;
                            border-radius: 10px;
                            overflow: hidden;
                            aspect-ratio: 1;
                            background: var(--couleur-surface-claire);
                            border: 1px solid var(--couleur-bordure);
                        `;
                        
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.cssText = `
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                        `;
                        
                        const badge = document.createElement('div');
                        badge.textContent = index === 0 ? 'Principale' : `Photo ${index + 1}`;
                        badge.style.cssText = `
                            position: absolute;
                            top: 5px;
                            left: 5px;
                            background: ${index === 0 ? '#27ae60' : 'var(--couleur-primaire)'};
                            color: white;
                            padding: 2px 8px;
                            border-radius: 12px;
                            font-size: 0.8rem;
                            font-weight: 600;
                            backdrop-filter: blur(10px);
                        `;
                        
                        previewDiv.appendChild(img);
                        previewDiv.appendChild(badge);
                        previewGrid.appendChild(previewDiv);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
});
</script>
@endsection
