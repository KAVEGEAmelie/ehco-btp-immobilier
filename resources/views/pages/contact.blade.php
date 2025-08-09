@extends('layouts.app')

@section('title', 'Contactez-nous - ' . ($settings['site_name'] ?? 'EHCO Immobilier'))

@section('content')
<div class="contact-page">
    <!-- Hero Section -->
    <section class="contact-hero">
        <div class="container">
            <h1 class="contact-title">Contactez-nous</h1>
            <p class="contact-subtitle">Notre équipe d'experts est à votre disposition pour vous accompagner dans votre projet immobilier</p>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="contact-content">
        <div class="container">
            <div class="contact-grid">
                <!-- Formulaire de contact -->
                <div class="contact-form-section">
                    <h2>Envoyez-nous un message</h2>

                    @if(session('success'))
                        <div class="alert alert-success">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
                        @csrf

                        @if(isset($bien))
                            <input type="hidden" name="bien_id" value="{{ $bien->id }}">
                            <div class="selected-bien">
                                <h4>Bien sélectionné :</h4>
                                <p><strong>{{ $bien->titre }}</strong> - {{ $bien->prix_format }}</p>
                                <p>{{ $bien->ville }}</p>
                            </div>
                        @endif

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
                                    <option value="Estimation" {{ old('sujet') == 'Estimation' ? 'selected' : '' }}>Estimation de bien</option>
                                    <option value="Partenariat" {{ old('sujet') == 'Partenariat' ? 'selected' : '' }}>Partenariat professionnel</option>
                                    <option value="Autre" {{ old('sujet') == 'Autre' ? 'selected' : '' }}>Autre</option>
                                </select>
                                @error('sujet')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message">Votre message *</label>
                            <textarea id="message" name="message" rows="6" required placeholder="Décrivez votre projet, vos besoins, ou posez vos questions...">{{ old('message') }}</textarea>
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
                        </div>
                    </form>
                </div>

                <!-- Informations de contact -->
                <div class="contact-info-section">
                    <h2>Nos coordonnées</h2>

                    <div class="contact-methods">
                        <div class="contact-method">
                            <div class="method-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M22 16.92V19C22 20.1046 21.1046 21 20 21C10.0589 21 2 12.9411 2 3C2 1.89543 2.89543 1 4 1H7.08C7.56 1 7.96 1.33 8.03 1.8L8.5 5.5C8.58 6.06 8.34 6.62 7.89 6.9L5.89 8.1C7.12 10.58 9.42 12.88 11.9 14.11L13.1 12.11C13.38 11.66 13.94 11.42 14.5 11.5L18.2 11.97C18.67 12.04 19 12.44 19 12.92V16.92Z" stroke="currentColor" stroke-width="2"/>
                                </svg>
                            </div>
                            <div class="method-content">
                                <h3>Téléphone</h3>
                                <p>{{ $settings['contact_phone'] ?? '+228 96 53 00 26 / +228 71 32 91 81' }}</p>
                                <span class="availability">Lun-Ven : 9h-18h, Sam : 9h-17h</span>
                            </div>
                        </div>

                        <div class="contact-method">
                            <div class="method-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2"/>
                                    <polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2"/>
                                </svg>
                            </div>
                            <div class="method-content">
                                <h3>Email</h3>
                                <p>{{ $settings['contact_email'] ?? 'ehcobtp@gmail.com' }}</p>
                                <span class="availability">Réponse sous 24h</span>
                            </div>
                        </div>

                        @if(isset($settings['address']) && $settings['address'])
                        <div class="contact-method">
                            <div class="method-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 5.02944 7.02944 1 12 1C16.9706 1 21 5.02944 21 10Z" stroke="currentColor" stroke-width="2"/>
                                    <circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="2"/>
                                </svg>
                            </div>
                            <div class="method-content">
                                <h3>Adresse</h3>
                                <p style="white-space: pre-line;">{{ $settings['address'] }}</p>
                            </div>
                        </div>
                        @endif

                    </div>

                    <!-- Services proposés -->
                    <div class="services-offered">
                        <h3>Nos services</h3>
                        <ul>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 12L11 14L15 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Guide immobilier personnalisé
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 12L11 14L15 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Accompagnement financement
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 12L11 14L15 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Négociation et suivi
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 12L11 14L15 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Estimation gratuite
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
