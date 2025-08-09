<div class="modal-header">
    <h2 class="modal-title">{{ $bien->titre }}</h2>
    <button class="modal-close" onclick="closeModal('bienModal')">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>
</div>

<div class="modal-content-body">
    <!-- Galerie photos -->
    <div class="photos-gallery">
        @if($bien->photos->count() > 0)
            <div class="main-photo">
                <img src="{{ $bien->photos->first()->url }}" alt="{{ $bien->titre }}" id="mainPhoto" onclick="openLightbox(0)">
                <div class="photo-counter">
                    <span id="currentPhoto">1</span> / <span id="totalPhotos">{{ $bien->photos->count() }}</span>
                </div>
                <div class="zoom-hint">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <circle cx="11" cy="11" r="8" stroke="white" stroke-width="2"/>
                        <path d="M21 21L16.65 16.65" stroke="white" stroke-width="2"/>
                        <line x1="11" y1="8" x2="11" y2="14" stroke="white" stroke-width="2"/>
                        <line x1="8" y1="11" x2="14" y2="11" stroke="white" stroke-width="2"/>
                    </svg>
                    <span>Cliquer pour agrandir</span>
                </div>
            </div>
            @if($bien->photos->count() > 1)
                <div class="thumbnails">
                    @foreach($bien->photos as $index => $photo)
                        <div class="thumbnail {{ $index === 0 ? 'active' : '' }}" onclick="changePhoto('{{ $photo->url }}', {{ $index + 1 }})">
                            <img src="{{ $photo->url }}" alt="Photo {{ $index + 1 }}" onclick="event.stopPropagation(); openLightbox({{ $index }})">
                        </div>
                    @endforeach
                </div>
            @endif
        @else
            <div class="no-photos">
                <img src="{{ asset('images/maison-default.jpg') }}" alt="{{ $bien->titre }}">
                <p>Aucune photo disponible</p>
            </div>
        @endif
    </div>

    <!-- Informations principales -->
    <div class="bien-info">
        <div class="prix-section">
            <div class="prix-principal">{{ $bien->prix_format }}</div>
            <div class="prix-metre">{{ number_format($bien->prix / $bien->surface, 0, ',', ' ') }} CFA/m²</div>
        </div>

        <div class="localisation">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                <path d="M21 10C21 17 12 23 12 23S3 17 3 10C3 5.58172 6.58172 2 12 2C17.4183 2 21 5.58172 21 10Z" stroke="currentColor" stroke-width="2"/>
                <circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="2"/>
            </svg>
            <div>
                <div class="ville">{{ $bien->ville }}</div>
                <div class="adresse">{{ $bien->adresse }}</div>
            </div>
        </div>

        <!-- Caractéristiques principales -->
        <div class="caracteristiques-grid">
            <div class="caracteristique">
                <div class="caracteristique-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M8 21H16M12 3V21M3 7L12 3L21 7" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <div class="caracteristique-info">
                    <span class="value">{{ $bien->surface }} m²</span>
                    <span class="label">Surface</span>
                </div>
            </div>

            <div class="caracteristique">
                <div class="caracteristique-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M3 7H21L19 21H5L3 7Z" stroke="currentColor" stroke-width="2"/>
                        <path d="M9 11V16M15 11V16" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <div class="caracteristique-info">
                    <span class="value">{{ $bien->nombre_pieces }}</span>
                    <span class="label">{{ $bien->nombre_pieces > 1 ? 'Pièces' : 'Pièce' }}</span>
                </div>
            </div>

            <div class="caracteristique">
                <div class="caracteristique-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M3 21H21M5 21V7L12 3L19 7V21M9 12H15M9 16H15" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <div class="caracteristique-info">
                    <span class="value">{{ $bien->nombre_chambres }}</span>
                    <span class="label">{{ $bien->nombre_chambres > 1 ? 'Chambres' : 'Chambre' }}</span>
                </div>
            </div>

            <div class="caracteristique">
                <div class="caracteristique-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <div class="caracteristique-info">
                    <span class="value">{{ $bien->nombre_sdb }}</span>
                    <span class="label">{{ $bien->nombre_sdb > 1 ? 'Salles de bain' : 'Salle de bain' }}</span>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="description-section">
            <h3>Description complète</h3>
            <div class="description-content">
                {{ $bien->description }}
            </div>
        </div>

        <!-- Guide immobilier -->
        <div class="guide-section">
            <h3>Guide immobilier</h3>
            <div class="guide-content">
                <div class="guide-item">
                    <h4>📍 Emplacement et quartier</h4>
                    <p>Ce bien est situé à {{ $bien->ville }}, dans un quartier recherché offrant tous les commodités nécessaires à proximité.</p>
                </div>
                
                <div class="guide-item">
                    <h4>💡 Points forts</h4>
                    <ul>
                        <li>Surface optimisée de {{ $bien->surface }} m²</li>
                        <li>{{ $bien->nombre_pieces }} pièces bien distribuées</li>
                        <li>{{ $bien->nombre_chambres }} chambre(s) confortable(s)</li>
                        <li>Excellent rapport qualité/prix</li>
                    </ul>
                </div>

                <div class="guide-item">
                    <h4>🔍 Analyse du marché</h4>
                    <p>Prix au m² : <strong>{{ number_format($bien->prix / $bien->surface, 0, ',', ' ') }} CFA/m²</strong></p>
                    <p>Le prix de ce bien est compétitif par rapport au marché local de {{ $bien->ville }}.</p>
                </div>

                <div class="guide-item">
                    <h4>📋 Démarches recommandées</h4>
                    <ol>
                        <li>Visite du bien avec notre agent</li>
                        <li>Étude de financement personnalisée</li>
                        <li>Négociation du prix si nécessaire</li>
                        <li>Accompagnement jusqu'à la signature</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="modal-actions">
            <button class="btn btn-primaire btn-contact-modal" data-bien-id="{{ $bien->id }}">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2"/>
                    <polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2"/>
                </svg>
                Contacter notre équipe
            </button>
            <button class="btn btn-secondaire" onclick="closeModal('bienModal')">
                Fermer
            </button>
        </div>
    </div>
</div>

<script>
let currentLightboxIndex = 0;
let photos = [];

function changePhoto(photoUrl, photoNumber) {
    document.getElementById('mainPhoto').src = photoUrl;
    document.getElementById('currentPhoto').textContent = photoNumber;
    
    // Mettre à jour les thumbnails actifs
    document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
    document.querySelectorAll('.thumbnail')[photoNumber - 1].classList.add('active');
}

function openLightbox(index) {
    // Récupérer les photos depuis le modal
    photos = @json($bien->photos->pluck('url'));
    currentLightboxIndex = index;
    
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightboxImage');
    
    if (photos.length > 0) {
        lightboxImage.src = photos[index];
        updateLightboxCounter();
        updateLightboxThumbnails();
        updateLightboxNavigation();
        
        lightbox.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    lightbox.style.display = 'none';
    document.body.style.overflow = 'auto';
}

function previousImage() {
    if (currentLightboxIndex > 0) {
        currentLightboxIndex--;
    } else {
        currentLightboxIndex = photos.length - 1;
    }
    updateLightboxImage();
}

function nextImage() {
    if (currentLightboxIndex < photos.length - 1) {
        currentLightboxIndex++;
    } else {
        currentLightboxIndex = 0;
    }
    updateLightboxImage();
}

function goToImage(index) {
    currentLightboxIndex = index;
    updateLightboxImage();
}

function updateLightboxImage() {
    const lightboxImage = document.getElementById('lightboxImage');
    lightboxImage.src = photos[currentLightboxIndex];
    updateLightboxCounter();
    updateLightboxThumbnails();
}

function updateLightboxCounter() {
    document.getElementById('lightboxCurrentPhoto').textContent = currentLightboxIndex + 1;
    document.getElementById('lightboxTotalPhotos').textContent = photos.length;
}

function updateLightboxThumbnails() {
    const container = document.getElementById('lightboxThumbnails');
    
    if (photos.length > 1) {
        container.style.display = 'flex';
        container.innerHTML = '';
        
        photos.forEach((photoUrl, index) => {
            const thumbnail = document.createElement('div');
            thumbnail.className = `lightbox-thumbnail ${index === currentLightboxIndex ? 'active' : ''}`;
            thumbnail.onclick = () => goToImage(index);
            
            const img = document.createElement('img');
            img.src = photoUrl;
            img.alt = `Photo ${index + 1}`;
            
            thumbnail.appendChild(img);
            container.appendChild(thumbnail);
        });
    } else {
        container.style.display = 'none';
    }
}

function updateLightboxNavigation() {
    const prevBtn = document.querySelector('.lightbox-prev');
    const nextBtn = document.querySelector('.lightbox-next');
    
    if (photos.length > 1) {
        prevBtn.style.display = 'block';
        nextBtn.style.display = 'block';
    } else {
        prevBtn.style.display = 'none';
        nextBtn.style.display = 'none';
    }
}

// Fermer avec la touche Echap
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeLightbox();
    }
    if (e.key === 'ArrowLeft') {
        previousImage();
    }
    if (e.key === 'ArrowRight') {
        nextImage();
    }
});
</script>
