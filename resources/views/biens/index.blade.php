@extends('layouts.app')

@section('title', 'Nos Biens Immobiliers - Guide Complet')

@section('content')
<div class="biens-page">
    <!-- Hero Section -->
    <section class="biens-hero">
        <div class="container">
            <h1 class="biens-title">Votre Guide Immobilier Professionnel</h1>
            <p class="biens-subtitle">Découvrez notre sélection de biens immobiliers avec des guides complets pour vous accompagner dans votre projet</p>
        </div>
    </section>

    <!-- Filtres de recherche -->
    <section class="biens-filters">
        <div class="container">
            <form method="GET" action="{{ route('biens.index') }}" class="filter-form">
                <div class="filter-grid">
                    <div class="filter-group">
                        <label for="ville">Ville</label>
                        <input type="text" id="ville" name="ville" value="{{ request('ville') }}" placeholder="Rechercher une ville">
                    </div>
                    <div class="filter-group">
                        <label for="prix_max">Prix maximum</label>
                        <select id="prix_max" name="prix_max">
                            <option value="">Tous les prix</option>
                            <option value="200000" {{ request('prix_max') == '200000' ? 'selected' : '' }}>200 000 CFA</option>
                            <option value="300000" {{ request('prix_max') == '300000' ? 'selected' : '' }}>300 000 CFA</option>
                            <option value="500000" {{ request('prix_max') == '500000' ? 'selected' : '' }}>500 000 CFA</option>
                            <option value="750000" {{ request('prix_max') == '750000' ? 'selected' : '' }}>750 000 CFA</option>
                            <option value="1000000" {{ request('prix_max') == '1000000' ? 'selected' : '' }}>1 000 000 CFA</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="pieces_min">Pièces min.</label>
                        <select id="pieces_min" name="pieces_min">
                            <option value="">Toutes</option>
                            <option value="2" {{ request('pieces_min') == '2' ? 'selected' : '' }}>2+</option>
                            <option value="3" {{ request('pieces_min') == '3' ? 'selected' : '' }}>3+</option>
                            <option value="4" {{ request('pieces_min') == '4' ? 'selected' : '' }}>4+</option>
                            <option value="5" {{ request('pieces_min') == '5' ? 'selected' : '' }}>5+</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="surface_min">Surface min.</label>
                        <select id="surface_min" name="surface_min">
                            <option value="">Toutes</option>
                            <option value="50" {{ request('surface_min') == '50' ? 'selected' : '' }}>50 m²+</option>
                            <option value="80" {{ request('surface_min') == '80' ? 'selected' : '' }}>80 m²+</option>
                            <option value="100" {{ request('surface_min') == '100' ? 'selected' : '' }}>100 m²+</option>
                            <option value="150" {{ request('surface_min') == '150' ? 'selected' : '' }}>150 m²+</option>
                        </select>
                    </div>
                    <div class="filter-actions">
                        <button type="submit" class="btn btn-primaire">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <path d="M21 21L16.514 16.506L21 21ZM19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Rechercher
                        </button>
                        <a href="{{ route('biens.index') }}" class="btn btn-secondaire">Réinitialiser</a>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Liste des biens -->
    <section class="biens-listing">
        <div class="container">
            @if($biens->count() > 0)
                <div class="biens-grid">
                    @foreach($biens as $bien)
                        <div class="bien-card" data-bien-id="{{ $bien->id }}">
                            <div class="bien-image">
                                <img src="{{ $bien->image_principale }}" alt="{{ $bien->titre }}" loading="lazy">
                                <div class="bien-prix">{{ $bien->prix_format }}</div>
                                <div class="bien-status">
                                    @if($bien->disponible)
                                        <span class="status-disponible">Disponible</span>
                                    @else
                                        <span class="status-vendu">Vendu</span>
                                    @endif
                                </div>
                            </div>

                            <div class="bien-content">
                                <h3 class="bien-titre">{{ $bien->titre }}</h3>
                                <p class="bien-localisation">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                        <path d="M21 10C21 17 12 23 12 23S3 17 3 10C3 5.58172 6.58172 2 12 2C17.4183 2 21 5.58172 21 10Z" stroke="currentColor" stroke-width="2"/>
                                        <circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                    {{ $bien->ville }}
                                </p>

                                <div class="bien-details">
                                    <div class="detail-item">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                            <path d="M3 7H21L19 21H5L3 7Z" stroke="currentColor" stroke-width="2"/>
                                            <path d="M9 11V16M15 11V16" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                        <span>{{ $bien->nombre_pieces }} pièces</span>
                                    </div>
                                    <div class="detail-item">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                            <path d="M3 21H21M5 21V7L12 3L19 7V21M9 12H15M9 16H15" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                        <span>{{ $bien->nombre_chambres }} chambres</span>
                                    </div>
                                    <div class="detail-item">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                            <path d="M8 21H16M12 3V21M3 7L12 3L21 7" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                        <span>{{ $bien->surface }} m²</span>
                                    </div>
                                </div>

                                <div class="bien-actions">
                                    <button class="btn btn-primaire btn-voir-details" data-bien-id="{{ $bien->id }}">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                            <path d="M1 12S5 4 12 4S23 12 23 12S19 20 12 20S1 12 1 12Z" stroke="currentColor" stroke-width="2"/>
                                            <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                        Guide Complet
                                    </button>
                                    <button class="btn btn-secondaire btn-contact" data-bien-id="{{ $bien->id }}">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                            <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2"/>
                                            <polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                        Contacter
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    {{ $biens->appends(request()->query())->links() }}
                </div>
            @else
                <div class="no-results">
                    <div class="no-results-icon">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none">
                            <path d="M3 7H21L19 21H5L3 7Z" stroke="currentColor" stroke-width="2"/>
                            <path d="M9 11V16M15 11V16" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <h3>Aucun bien trouvé</h3>
                    <p>Essayez de modifier vos critères de recherche pour voir plus de résultats.</p>
                    <a href="{{ route('biens.index') }}" class="btn btn-primaire">Voir tous les biens</a>
                </div>
            @endif
        </div>
    </section>
</div>

<!-- Modal pour les détails du bien -->
<div id="bienModal" class="modal">
    <div class="modal-content">
        <div class="modal-body">
            <!-- Le contenu sera chargé dynamiquement -->
        </div>
    </div>
</div>

<!-- Modal pour le contact -->
<div id="contactModal" class="modal">
    <div class="modal-content">
        <div class="modal-body">
            <!-- Le contenu sera chargé dynamiquement -->
        </div>
    </div>
</div>

<!-- Lightbox pour affichage des images en grand (doit être en dehors des modals) -->
<div id="lightbox" class="lightbox">
    <div class="lightbox-overlay" onclick="closeLightbox()"></div>
    <div class="lightbox-content">
        <button class="lightbox-close" onclick="closeLightbox()">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                <path d="M18 6L6 18M6 6L18 18" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        
        <div class="lightbox-image-container">
            <img id="lightboxImage" src="" alt="">
            
            <!-- Navigation -->
            <button class="lightbox-nav lightbox-prev" onclick="previousImage()" style="display: none;">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none">
                    <path d="M15 18L9 12L15 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <button class="lightbox-nav lightbox-next" onclick="nextImage()" style="display: none;">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none">
                    <path d="M9 18L15 12L9 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        
        <div class="lightbox-counter">
            <span id="lightboxCurrentPhoto">1</span> / <span id="lightboxTotalPhotos">1</span>
        </div>
        
        <!-- Miniatures en bas -->
        <div id="lightboxThumbnails" class="lightbox-thumbnails" style="display: none;">
            <!-- Les miniatures seront ajoutées dynamiquement -->
        </div>
    </div>
</div>
@endsection
