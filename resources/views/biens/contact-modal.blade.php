<div class="modal-header">
    <h2 class="modal-title">Contacter notre équipe</h2>
    <button class="modal-close" onclick="closeModal('contactModal')">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>
</div>

<div class="modal-content-body">
    <div class="contact-info">
        <h3>{{ $bien->titre }}</h3>
        <p class="prix">{{ $bien->prix_format }}</p>
        <p class="localisation">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                <path d="M21 10C21 17 12 23 12 23S3 17 3 10C3 5.58172 6.58172 2 12 2C17.4183 2 21 5.58172 21 10Z" stroke="currentColor" stroke-width="2"/>
                <circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="2"/>
            </svg>
            {{ $bien->ville }}
        </p>
    </div>

    <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
        @csrf
        <input type="hidden" name="bien_id" value="{{ $bien->id }}">

        <div class="form-grid">
            <div class="form-group">
                <label for="nom">Nom complet *</label>
                <input type="text" id="nom" name="nom" required value="{{ old('nom') }}">
                @error('nom')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" required value="{{ old('email') }}">
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="tel" id="telephone" name="telephone" value="{{ old('telephone') }}">
                @error('telephone')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="sujet">Sujet de votre demande *</label>
                <select id="sujet" name="sujet" required>
                    <option value="">Choisissez un sujet</option>
                    <option value="Visite" {{ old('sujet') == 'Visite' ? 'selected' : '' }}>Demande de visite</option>
                    <option value="Information" {{ old('sujet') == 'Information' ? 'selected' : '' }}>Demande d'informations</option>
                    <option value="Financement" {{ old('sujet') == 'Financement' ? 'selected' : '' }}>Aide au financement</option>
                    <option value="Négociation" {{ old('sujet') == 'Négociation' ? 'selected' : '' }}>Négociation de prix</option>
                    <option value="Autre" {{ old('sujet') == 'Autre' ? 'selected' : '' }}>Autre</option>
                </select>
                @error('sujet')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="message">Votre message *</label>
            <textarea id="message" name="message" rows="5" required placeholder="Décrivez votre projet, vos besoins, ou posez vos questions...">{{ old('message') }}</textarea>
            @error('message')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primaire">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <path d="M4 12L8 16L20 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Envoyer ma demande
            </button>
            <button type="button" class="btn btn-secondaire" onclick="closeModal('contactModal')">
                Annuler
            </button>
        </div>
    </form>

    <div class="contact-alternatives">
        <h4>Autres moyens de nous contacter</h4>
        <div class="contact-methods">
            <div class="contact-method">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <path d="M22 16.92V19C22 20.1046 21.1046 21 20 21C10.0589 21 2 12.9411 2 3C2 1.89543 2.89543 1 4 1H7.08C7.56 1 7.96 1.33 8.03 1.8L8.5 5.5C8.58 6.06 8.34 6.62 7.89 6.9L5.89 8.1C7.12 10.58 9.42 12.88 11.9 14.11L13.1 12.11C13.38 11.66 13.94 11.42 14.5 11.5L18.2 11.97C18.67 12.04 19 12.44 19 12.92V16.92Z" stroke="currentColor" stroke-width="2"/>
                </svg>
                <div>
                    <span class="method-label">Téléphone</span>
                    <span class="method-value">+228 96 53 00 26 / +228 71 32 91 81</span>
                </div>
            </div>

            <div class="contact-method">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2"/>
                    <polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2"/>
                </svg>
                <div>
                    <span class="method-label">Email direct</span>
                    <span class="method-value">ehcobtp@gmail.com</span>
                </div>
            </div>
        </div>
    </div>
</div>
