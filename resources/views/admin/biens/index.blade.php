@extends('admin.layouts.app')

@section('title', 'Gestion des Biens')
@section('breadcrumb', 'Administration / Gestion des Biens')

@section('content')
<div class="admin-biens-index">
    <div class="page-header">
        <div class="header-content">
            <h1>🏠 Gestion des Biens Immobiliers</h1>
            <p>Gérez vos propriétés, ajoutez de nouveaux biens et modifiez les informations</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.biens.create') }}" class="btn-primary">
                ➕ Ajouter un Bien
            </a>
        </div>
    </div>
    
    <div class="biens-stats">
        <div class="stat-card">
            <div class="stat-number">{{ $biens->total() }}</div>
            <div class="stat-label">Total des Biens</div>
        </div>
        <div class="stat-card active">
            <div class="stat-number">{{ $biens->where('statut', 'disponible')->count() }}</div>
            <div class="stat-label">Biens Disponibles</div>
        </div>
        <div class="stat-card sold">
            <div class="stat-number">{{ $biens->where('statut', 'vendu')->count() }}</div>
            <div class="stat-label">Biens Vendus</div>
        </div>
    </div>
    
    @if($biens->count() > 0)
        <div class="biens-grid">
            @foreach($biens as $bien)
                <div class="bien-card">
                    <div class="bien-image">
                        @if($bien->photos->count() > 0)
                            <img src="{{ asset('storage/' . $bien->photos->first()->chemin) }}" alt="{{ $bien->titre }}">
                        @else
                            <div class="placeholder-image">
                                <span>📷</span>
                                <p>Aucune image</p>
                            </div>
                        @endif
                        <div class="bien-status status-{{ $bien->statut }}">
                            {{ ucfirst($bien->statut) }}
                        </div>
                    </div>
                    
                    <div class="bien-content">
                        <h3>{{ $bien->titre }}</h3>
                        <div class="bien-price">{{ $bien->prix_format }}</div>
                        <div class="bien-location">📍 {{ $bien->ville }}</div>
                        
                        <div class="bien-details">
                            <span>📐 {{ $bien->surface }}m²</span>
                            <span>🏠 {{ $bien->nombre_pieces }} pièces</span>
                            <span>🛏️ {{ $bien->nombre_chambres }} ch.</span>
                        </div>
                        
                        <div class="bien-actions">
                            <a href="{{ route('admin.biens.show', $bien) }}" class="btn-action view">
                                👁️ Voir
                            </a>
                            <a href="{{ route('admin.biens.edit', $bien) }}" class="btn-action edit">
                                ✏️ Modifier
                            </a>
                            <form method="POST" action="{{ route('admin.biens.destroy', $bien) }}" 
                                  style="display: inline;" 
                                  class="delete-form"
                                  data-message="Êtes-vous sûr de vouloir supprimer ce bien ?">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action delete">
                                    🗑️ Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="pagination-wrapper">
            {{ $biens->links() }}
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">🏠</div>
            <h3>Aucun bien immobilier</h3>
            <p>Commencez par ajouter votre premier bien immobilier</p>
            <a href="{{ route('admin.biens.create') }}" class="btn-primary">
                ➕ Ajouter un Bien
            </a>
        </div>
    @endif
</div>

<style>
/* === Gestion des Biens avec Thème Sombre === */
.admin-biens-index {
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

.btn-primary {
    background: linear-gradient(135deg, var(--couleur-primaire), #0077cc);
    color: white;
    padding: 12px 25px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border: 1px solid var(--couleur-primaire);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 170, 255, 0.4);
    text-decoration: none;
    color: white;
}

.biens-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: var(--couleur-surface);
    padding: 25px;
    border-radius: 15px;
    text-align: center;
    border: 1px solid var(--couleur-bordure);
    border-left: 4px solid var(--couleur-primaire);
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

.stat-card.active {
    border-left-color: #27ae60;
}

.stat-card.sold {
    border-left-color: #e74c3c;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 5px;
}

.stat-label {
    color: var(--couleur-texte-mute);
    font-weight: 600;
}

.biens-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 25px;
    margin-bottom: 30px;
}

.bien-card {
    background: var(--couleur-surface);
    border-radius: 15px;
    overflow: hidden;
    border: 1px solid var(--couleur-bordure);
    transition: all 0.3s ease;
}

.bien-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    border-color: var(--couleur-primaire);
}

.bien-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.bien-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.placeholder-image {
    width: 100%;
    height: 100%;
    background: var(--couleur-surface-claire);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: var(--couleur-texte-mute);
    border-bottom: 1px solid var(--couleur-bordure);
}

.placeholder-image span {
    font-size: 3rem;
    margin-bottom: 10px;
}

.bien-status {
    position: absolute;
    top: 15px;
    right: 15px;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
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

.bien-content {
    padding: 20px;
}

.bien-content h3 {
    color: #fff;
    margin: 0 0 10px 0;
    font-size: 1.2rem;
    font-weight: 600;
}

.bien-price {
    color: var(--couleur-primaire);
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 8px;
}

.bien-location {
    color: var(--couleur-texte-mute);
    margin-bottom: 15px;
}

.bien-details {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
    font-size: 0.9rem;
    color: var(--couleur-texte-mute);
}

.bien-actions {
    display: flex;
    gap: 10px;
}

.btn-action {
    padding: 8px 15px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    flex: 1;
    text-align: center;
}

.btn-action.view {
    background: #3498db;
    color: white;
}

.btn-action.edit {
    background: #f39c12;
    color: white;
}

.btn-action.delete {
    background: #e74c3c;
    color: white;
}

.btn-action:hover {
    transform: translateY(-2px);
    opacity: 0.9;
    text-decoration: none;
    color: white;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: var(--couleur-surface);
    border-radius: 15px;
    border: 1px solid var(--couleur-bordure);
}

.empty-icon {
    font-size: 4rem;
    margin-bottom: 20px;
    background: linear-gradient(135deg, var(--couleur-primaire), #0077cc);
    color: white;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px auto;
}

.empty-state h3 {
    color: #fff;
    margin-bottom: 10px;
    font-weight: 600;
}

.empty-state p {
    color: var(--couleur-texte-mute);
    margin-bottom: 30px;
}

.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 30px;
}

/* Pagination avec thème sombre */
.pagination-wrapper .pagination {
    background: var(--couleur-surface);
    border-radius: 10px;
    padding: 10px;
    border: 1px solid var(--couleur-bordure);
}

.pagination-wrapper .pagination .page-link {
    background: var(--couleur-surface-claire);
    border: 1px solid var(--couleur-bordure);
    color: var(--couleur-texte);
    margin: 0 2px;
    border-radius: 6px;
}

.pagination-wrapper .pagination .page-link:hover {
    background: var(--couleur-primaire);
    border-color: var(--couleur-primaire);
    color: white;
}

.pagination-wrapper .pagination .page-item.active .page-link {
    background: var(--couleur-primaire);
    border-color: var(--couleur-primaire);
    color: white;
}

@media (max-width: 768px) {
    .admin-biens-index {
        padding: 20px;
    }
    
    .page-header {
        flex-direction: column;
        gap: 20px;
        text-align: center;
        padding: 20px;
    }
    
    .biens-grid {
        grid-template-columns: 1fr;
    }
    
    .bien-details {
        flex-direction: column;
        gap: 5px;
    }
    
    .bien-actions {
        flex-direction: column;
    }
    
    .biens-stats {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection
