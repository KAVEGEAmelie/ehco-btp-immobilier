@extends('admin.layouts.app')

@section('title', 'Détails du Bien')
@section('breadcrumb', 'Administration / Gestion des Biens / Détails')

@section('content')
<div class="admin-bien-show">
    <div class="page-header">
        <div class="header-content">
            <h1>🏠 {{ $bien->titre }}</h1>
            <div class="bien-status status-{{ $bien->statut }}">
                {{ ucfirst($bien->statut) }}
            </div>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.biens.edit', $bien) }}" class="btn-warning">
                ✏️ Modifier
            </a>
            <a href="{{ route('admin.biens.index') }}" class="btn-secondary">
                ← Retour à la liste
            </a>
        </div>
    </div>

    <div class="bien-details-container">
        <div class="bien-images">
            @if($bien->photos->count() > 0)
                <div class="main-image">
                    <img src="{{ asset('storage/' . $bien->photos->first()->chemin) }}" alt="{{ $bien->titre }}">
                </div>
                @if($bien->photos->count() > 1)
                    <div class="gallery">
                        @foreach($bien->photos as $photo)
                            <div class="gallery-item">
                                <img src="{{ asset('storage/' . $photo->chemin) }}" alt="{{ $bien->titre }}">
                            </div>
                        @endforeach
                    </div>
                @endif
            @else
                <div class="no-image">
                    <span>📷</span>
                    <p>Aucune image disponible</p>
                </div>
            @endif
        </div>

        <div class="bien-info">
            <div class="info-section">
                <h3>Informations Générales</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Prix :</label>
                        <span class="price">{{ $bien->prix_format }}</span>
                    </div>
                    <div class="info-item">
                        <label>Surface :</label>
                        <span>{{ $bien->surface }} m²</span>
                    </div>
                    <div class="info-item">
                        <label>Ville :</label>
                        <span>{{ $bien->ville }}</span>
                    </div>
                    <div class="info-item">
                        <label>Adresse :</label>
                        <span>{{ $bien->adresse }}</span>
                    </div>
                    <div class="info-item">
                        <label>Nombre de pièces :</label>
                        <span>{{ $bien->nombre_pieces }}</span>
                    </div>
                    <div class="info-item">
                        <label>Chambres :</label>
                        <span>{{ $bien->nombre_chambres }}</span>
                    </div>
                    <div class="info-item">
                        <label>Salles de bain :</label>
                        <span>{{ $bien->nombre_sdb }}</span>
                    </div>
                    <div class="info-item">
                        <label>Disponible :</label>
                        <span class="badge badge-{{ $bien->disponible ? 'success' : 'danger' }}">
                            {{ $bien->disponible ? 'Oui' : 'Non' }}
                        </span>
                    </div>
                    <div class="info-item">
                        <label>Statut :</label>
                        <span class="badge badge-{{ $bien->statut }}">
                            {{ ucfirst($bien->statut) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="info-section">
                <h3>Description</h3>
                <div class="description">
                    {{ $bien->description }}
                </div>
            </div>

            <div class="info-section">
                <h3>Informations Système</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Créé le :</label>
                        <span>{{ $bien->created_at->format('d/m/Y à H:i') }}</span>
                    </div>
                    <div class="info-item">
                        <label>Modifié le :</label>
                        <span>{{ $bien->updated_at->format('d/m/Y à H:i') }}</span>
                    </div>
                    <div class="info-item">
                        <label>Nombre de photos :</label>
                        <span>{{ $bien->photos->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="action-section">
        <form action="{{ route('admin.biens.destroy', $bien) }}" method="POST" 
              class="delete-form"
              data-message="Êtes-vous sûr de vouloir supprimer ce bien ? Cette action est irréversible.">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger">
                🗑️ Supprimer ce bien
            </button>
        </form>
    </div>
</div>

<style>
/* === Vue Détails Bien avec Thème Sombre === */
.admin-bien-show {
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

.header-content {
    display: flex;
    align-items: center;
    gap: 20px;
}

.header-content h1 {
    color: #fff;
    margin: 0;
    font-size: 1.8rem;
    font-weight: 700;
}

.bien-status {
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    color: white;
    backdrop-filter: blur(10px);
}

.status-disponible {
    background: rgba(39, 174, 96, 0.9);
}

.status-vendu {
    background: rgba(231, 76, 60, 0.9);
}

.status-loue {
    background: rgba(243, 156, 18, 0.9);
}

.status-reserve {
    background: rgba(155, 89, 182, 0.9);
}

.header-actions {
    display: flex;
    gap: 10px;
}

.btn-warning, .btn-secondary {
    padding: 12px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.btn-warning {
    background: #f39c12;
    color: white;
    border-color: #f39c12;
}

.btn-secondary {
    background: var(--couleur-surface-claire);
    color: var(--couleur-texte);
    border-color: var(--couleur-bordure);
}

.btn-warning:hover, .btn-secondary:hover {
    transform: translateY(-2px);
    text-decoration: none;
}

.btn-warning:hover {
    background: #e67e22;
    color: white;
}

.btn-secondary:hover {
    background: var(--couleur-bordure);
    color: var(--couleur-texte);
}

.bien-details-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-bottom: 30px;
}

.bien-images {
    background: var(--couleur-surface);
    border-radius: 15px;
    padding: 20px;
    border: 1px solid var(--couleur-bordure);
}

.main-image img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: 10px;
    border: 1px solid var(--couleur-bordure);
}

.gallery {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
    gap: 10px;
    margin-top: 15px;
}

.gallery-item img {
    width: 100%;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 1px solid var(--couleur-bordure);
}

.gallery-item img:hover {
    transform: scale(1.05);
    border-color: var(--couleur-primaire);
}

.no-image {
    height: 300px;
    background: var(--couleur-surface-claire);
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: var(--couleur-texte-mute);
    border: 2px dashed var(--couleur-bordure);
}

.no-image span {
    font-size: 3rem;
    margin-bottom: 10px;
    background: linear-gradient(135deg, var(--couleur-primaire), #0077cc);
    color: white;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.bien-info {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.info-section {
    background: var(--couleur-surface);
    border-radius: 15px;
    padding: 20px;
    border: 1px solid var(--couleur-bordure);
}

.info-section h3 {
    color: #fff;
    margin: 0 0 15px 0;
    font-size: 1.2rem;
    font-weight: 600;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--couleur-primaire);
}

.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 5px;
    padding: 12px;
    background: var(--couleur-surface-claire);
    border-radius: 8px;
    border: 1px solid var(--couleur-bordure);
}

.info-item label {
    font-weight: 600;
    color: var(--couleur-texte-mute);
    font-size: 0.9rem;
}

.info-item span {
    color: var(--couleur-texte);
    font-size: 1rem;
    font-weight: 500;
}

.price {
    color: var(--couleur-primaire) !important;
    font-size: 1.3rem !important;
    font-weight: 700 !important;
}

.badge {
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
    display: inline-block;
}

.badge-success {
    background: rgba(39, 174, 96, 0.2);
    color: #2ecc71;
    border: 1px solid rgba(39, 174, 96, 0.3);
}

.badge-danger {
    background: rgba(231, 76, 60, 0.2);
    color: #e74c3c;
    border: 1px solid rgba(231, 76, 60, 0.3);
}

.badge-disponible {
    background: rgba(39, 174, 96, 0.2);
    color: #2ecc71;
    border: 1px solid rgba(39, 174, 96, 0.3);
}

.badge-vendu {
    background: rgba(231, 76, 60, 0.2);
    color: #e74c3c;
    border: 1px solid rgba(231, 76, 60, 0.3);
}

.badge-loue {
    background: rgba(243, 156, 18, 0.2);
    color: #f39c12;
    border: 1px solid rgba(243, 156, 18, 0.3);
}

.badge-reserve {
    background: rgba(155, 89, 182, 0.2);
    color: #9b59b6;
    border: 1px solid rgba(155, 89, 182, 0.3);
}

.description {
    color: var(--couleur-texte);
    line-height: 1.6;
    white-space: pre-wrap;
    padding: 15px;
    background: var(--couleur-surface-claire);
    border-radius: 8px;
    border: 1px solid var(--couleur-bordure);
}

.action-section {
    background: var(--couleur-surface);
    border-radius: 15px;
    padding: 20px;
    border: 1px solid var(--couleur-bordure);
    text-align: center;
}

.btn-danger {
    background: #e74c3c;
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-danger:hover {
    background: #c0392b;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
}

@media (max-width: 768px) {
    .admin-bien-show {
        padding: 20px;
    }
    
    .page-header {
        flex-direction: column;
        gap: 20px;
        text-align: center;
        padding: 20px;
    }
    
    .header-content {
        flex-direction: column;
        gap: 10px;
    }
    
    .bien-details-container {
        grid-template-columns: 1fr;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .info-section, .bien-images {
        padding: 15px;
    }
}
</style>
@endsection
