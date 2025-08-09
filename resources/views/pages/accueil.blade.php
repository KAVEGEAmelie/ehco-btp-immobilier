@extends('layouts.app')

@section('title', 'EHCO BTP - Votre Expert Immobilier')

@section('content')

{{-- Hero Section Moderne --}}
<section class="hero-modern">
    <div class="hero-background">
        <div class="hero-overlay"></div>
        <div class="floating-elements">
            <div class="float-element float-1"></div>
            <div class="float-element float-2"></div>
            <div class="float-element float-3"></div>
        </div>
    </div>

    <div class="hero-container">
        <div class="hero-content">
            <div class="hero-badge animate-fade-in">
                <span class="badge-icon">🏆</span>
                <span>Expert Immobilier Certifié</span>
            </div>

            <h1 class="hero-title animate-slide-up">
                <span class="title-main">ECHO BTP</span>
                <span class="title-sub">Votre Partenaire Immobilier de Confiance</span>
            </h1>

            <p class="hero-description animate-slide-up delay-1">
                Découvrez notre sélection exclusive de biens immobiliers d'exception.
                Nous vous accompagnons dans tous vos projets avec expertise et passion.
            </p>



            <div class="hero-actions animate-slide-up delay-3">
                <a href="{{ route('biens.index') }}" class="btn-primary-modern">
                    <span>Voir nos Biens</span>
                    <div class="btn-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('contact') }}" class="btn-secondary-modern">
                    <span>Contactez-nous</span>
                </a>
            </div>
        </div>

        <div class="hero-visual animate-fade-in delay-4">
            <div class="visual-card">
                <div class="card-image">
                    <img src="{{ asset('images/maison1.jpg') }}" alt="Maison moderne">
                </div>
                <div class="card-content">
                    <div class="card-price">VOUS RECHERCHER UN CONFORT</div>
                    <div class="card-title">Nous sommes là pour vous</div>
                    <div class="card-location">Visitez notre page et contactez-nous pour plus d'informations.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="scroll-indicator">
        <div class="scroll-mouse"></div>
        <span>Découvrir</span>
    </div>
</section>

{{-- Section Services Modernes --}}
<section class="services-modern">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">Nos Services</div>
            <h2 class="section-title">Pourquoi Choisir EHCO BTP ?</h2>
            <p class="section-description">
                Une expertise reconnue au service de vos ambitions immobilières
            </p>
        </div>

        <div class="services-grid">
            <div class="service-card-modern">
                <div class="service-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                        <path d="M3 7V17C3 18.1046 3.89543 19 5 19H19C20.1046 19 21 18.1046 21 17V7M3 7L12 14L21 7M3 7L5 5H19L21 7" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h3>Accompagnement Personnalisé</h3>
                <p>Un suivi sur-mesure à chaque étape de votre projet immobilier avec un conseiller dédié.</p>
                <div class="service-features">
                    <span>Conseil expert</span>
                    <span>Suivi personnalisé</span>
                    <span>Disponibilité 7j/7</span>
                </div>
            </div>

            <div class="service-card-modern featured">
                <div class="featured-badge">Populaire</div>
                <div class="service-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                        <path d="M12 2L3.09 8.26L12 14L20.91 8.26L12 2Z" stroke="currentColor" stroke-width="2"/>
                        <path d="M3.09 8.26V15.74L12 22L20.91 15.74V8.26" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h3>Portefeuille Exclusif</h3>
                <p>Accès privilégié à une sélection de biens haut de gamme et d'opportunités uniques.</p>
                <div class="service-features">
                    <span>Biens exclusifs</span>
                    <span>Visites prioritaires</span>
                    <span>Négociation optimisée</span>
                </div>
            </div>

            <div class="service-card-modern">
                <div class="service-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                        <path d="M9 11H15M9 15H15M17 21H7C5.89543 21 5 20.1046 5 19V5C5 3.89543 5.89543 3 7 3H12.5858C12.851 3 13.1054 3.10536 13.2929 3.29289L19.7071 9.70711C19.8946 9.89464 20 10.149 20 10.4142V19C20 20.1046 19.1046 21 18 21H17Z" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h3>Expertise Juridique</h3>
                <p>Sécurisation complète de vos transactions avec notre équipe d'experts juridiques.</p>
                <div class="service-features">
                    <span>Vérifications approfondies</span>
                    <span>Garanties légales</span>
                    <span>Accompagnement notarial</span>
                </div>
            </div>

            <div class="service-card-modern">
                <div class="service-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2"/>
                        <path d="M2 17L12 22L22 17M2 12L12 17L22 12" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h3>Service Client 24/7</h3>
                <p>Une équipe dédiée disponible à tout moment pour répondre à vos questions et vous accompagner.</p>
                <div class="service-features">
                    <span>Support continu</span>
                    <span>Réactivité garantie</span>
                    <span>Assistance personnalisée</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Section Processus Simplifié --}}
<section class="process-modern">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Comment Ça Marche ?</h2>
            <p class="section-description">Un processus simple et transparent en 4 étapes</p>
        </div>

        <div class="process-steps">
            <div class="process-step">
                <div class="step-number">1</div>
                <div class="step-content">
                    <h3>Consultation Gratuite</h3>
                    <p>Analysons ensemble vos besoins et définissons votre projet immobilier idéal.</p>
                </div>
                <div class="step-connector"></div>
            </div>

            <div class="process-step">
                <div class="step-number">2</div>
                <div class="step-content">
                    <h3>Recherche Ciblée</h3>
                    <p>Nous sélectionnons les biens correspondant parfaitement à vos critères.</p>
                </div>
                <div class="step-connector"></div>
            </div>

            <div class="process-step">
                <div class="step-number">3</div>
                <div class="step-content">
                    <h3>Visites & Négociation</h3>
                    <p>Accompagnement lors des visites et négociation du meilleur prix pour vous.</p>
                </div>
                <div class="step-connector"></div>
            </div>

            <div class="process-step">
                <div class="step-number">4</div>
                <div class="step-content">
                    <h3>Finalisation</h3>
                    <p>Gestion complète des formalités jusqu'à la remise des clés.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Section CTA Moderne --}}
<section class="cta-modern">
    <div class="container">
        <div class="cta-content">
            <div class="cta-text">
                <h2>Prêt à Concrétiser Votre Projet ?</h2>
                <p>Contactez-nous dès aujourd'hui pour une consultation gratuite et découvrez comment nous pouvons vous aider à réaliser vos rêves immobiliers.</p>

                <div class="cta-benefits">
                    <div class="benefit-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        <span>Consultation gratuite</span>
                    </div>
                    <div class="benefit-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        <span>Réponse sous 24h</span>
                    </div>
                    <div class="benefit-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        <span>Sans engagement</span>
                    </div>
                </div>
            </div>

            <div class="cta-actions">
                <a href="{{ route('contact') }}" class="btn-primary-large">
                    <span>Contactez-nous</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </a>
                <a href="tel:+22896530026/71329181" class="btn-secondary-large">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <path d="M22 16.92V19.92C22 20.52 21.52 21 20.92 21C10.93 21 3 13.07 3 3.08C3 2.48 3.48 2 4.08 2H7.09C7.69 2 8.17 2.48 8.17 3.08C8.17 4.43 8.43 5.72 8.91 6.91C9.1 7.37 8.95 7.91 8.55 8.23L6.84 9.46C8.21 12.43 10.57 14.78 13.54 16.16L14.77 14.45C15.09 14.05 15.63 13.9 16.09 14.09C17.28 14.57 18.57 14.83 19.92 14.83C20.52 14.83 21 15.31 21 15.91V16.92H22Z" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    <span>Appeler maintenant</span>
                </a>
            </div>
        </div>
    </div>
</section>

<style>
/* ===== STYLES MODERNES POUR LA PAGE D'ACCUEIL ===== */

/* Hero Section Moderne */
.hero-modern {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    overflow: hidden;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.8) 100%);
}

.floating-elements {
    position: absolute;
    width: 100%;
    height: 100%;
}

.float-element {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    animation: float 6s ease-in-out infinite;
}

.float-1 {
    width: 80px;
    height: 80px;
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.float-2 {
    width: 120px;
    height: 120px;
    top: 60%;
    right: 15%;
    animation-delay: 2s;
}

.float-3 {
    width: 60px;
    height: 60px;
    bottom: 20%;
    left: 20%;
    animation-delay: 4s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.hero-container {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 4rem;
    align-items: center;
}

.hero-content {
    color: white;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.8rem 1.5rem;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 2rem;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.badge-icon {
    font-size: 1.2rem;
}

.hero-title {
    margin-bottom: 1.5rem;
}

.title-main {
    display: block;
    font-size: 4rem;
    font-weight: 800;
    line-height: 0.9;
    margin-bottom: 0.5rem;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.title-sub {
    display: block;
    font-size: 1.8rem;
    font-weight: 400;
    opacity: 0.9;
    line-height: 1.2;
}

.hero-description {
    font-size: 1.2rem;
    line-height: 1.6;
    margin-bottom: 3rem;
    opacity: 0.9;
}

.hero-stats {
    display: flex;
    gap: 2rem;
    margin-bottom: 3rem;
}

.stat-card {
    text-align: center;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.stat-number {
    display: block;
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
    margin-top: 0.5rem;
}

.hero-actions {
    display: flex;
    gap: 1.5rem;
}

.btn-primary-modern {
    display: inline-flex;
    align-items: center;
    gap: 0.8rem;
    padding: 1rem 2rem;
    background: white;
    color: #667eea;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1.1rem;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.btn-primary-modern:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    color: #667eea;
}

.btn-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 24px;
    height: 24px;
    background: rgba(102, 126, 234, 0.1);
    border-radius: 50%;
    transition: transform 0.3s ease;
}

.btn-primary-modern:hover .btn-icon {
    transform: translateX(3px);
}

.btn-secondary-modern {
    display: inline-flex;
    align-items: center;
    padding: 1rem 2rem;
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: white;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1.1rem;
    text-decoration: none;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.btn-secondary-modern:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-2px);
    color: white;
}

.hero-visual {
    position: relative;
}

.visual-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    transform: rotate(3deg);
    transition: transform 0.3s ease;
}

.visual-card:hover {
    transform: rotate(0deg) scale(1.05);
}

.card-image {
    height: 250px;
    overflow: hidden;
}

.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.card-content {
    padding: 1.5rem;
}

.card-price {
    font-size: 1.8rem;
    font-weight: 700;
    color: #667eea;
    margin-bottom: 0.5rem;
}

.card-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.3rem;
}

.card-location {
    color: #666;
    font-size: 0.9rem;
}

.scroll-indicator {
    position: absolute;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    color: white;
    font-size: 0.9rem;
    animation: bounce 2s infinite;
}

.scroll-mouse {
    width: 24px;
    height: 40px;
    border: 2px solid white;
    border-radius: 12px;
    position: relative;
}

.scroll-mouse::before {
    content: '';
    position: absolute;
    top: 8px;
    left: 50%;
    transform: translateX(-50%);
    width: 2px;
    height: 8px;
    background: white;
    border-radius: 1px;
    animation: scroll 1.5s infinite;
}

@keyframes scroll {
    0% { top: 8px; opacity: 1; }
    100% { top: 24px; opacity: 0; }
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateX(-50%) translateY(0); }
    40% { transform: translateX(-50%) translateY(-10px); }
    60% { transform: translateX(-50%) translateY(-5px); }
}

/* Animations */
.animate-fade-in {
    animation: fadeIn 1s ease-out;
}

.animate-slide-up {
    animation: slideUp 1s ease-out;
}

.delay-1 { animation-delay: 0.2s; animation-fill-mode: both; }
.delay-2 { animation-delay: 0.4s; animation-fill-mode: both; }
.delay-3 { animation-delay: 0.6s; animation-fill-mode: both; }
.delay-4 { animation-delay: 0.8s; animation-fill-mode: both; }

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Services Modernes */
.services-modern {
    padding: 8rem 0;
    background: #f8fafc;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.section-header {
    text-align: center;
    margin-bottom: 5rem;
}

.section-badge {
    display: inline-block;
    padding: 0.5rem 1rem;
    background: #667eea;
    color: white;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.section-title {
    font-size: 3rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.section-description {
    font-size: 1.2rem;
    color: #64748b;
    max-width: 600px;
    margin: 0 auto;
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
}

.service-card-modern {
    background: white;
    padding: 3rem 2rem;
    border-radius: 20px;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
    position: relative;
    text-align: center;
}

.service-card-modern:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 50px rgba(102, 126, 234, 0.15);
    border-color: #667eea;
}

.service-card-modern.featured {
    border-color: #667eea;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    transform: scale(1.05);
}

.featured-badge {
    position: absolute;
    top: -12px;
    left: 50%;
    transform: translateX(-50%);
    background: #f59e0b;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 600;
}

.service-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    color: white;
}

.service-card-modern.featured .service-icon {
    background: rgba(255, 255, 255, 0.2);
}

.service-card-modern h3 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 1rem;
}

.service-card-modern.featured h3 {
    color: white;
}

.service-card-modern p {
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 2rem;
}

.service-card-modern.featured p {
    color: rgba(255, 255, 255, 0.9);
}

.service-features {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    justify-content: center;
}

.service-features span {
    background: #f1f5f9;
    color: #667eea;
    padding: 0.4rem 0.8rem;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 500;
}

.service-card-modern.featured .service-features span {
    background: rgba(255, 255, 255, 0.2);
    color: white;
}

/* Processus Moderne */
.process-modern {
    padding: 8rem 0;
    background: #1e293b;
    color: white;
}

.process-steps {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: repeat(2, 1fr);
    gap: 3rem 2rem;
    max-width: 900px;
    margin: 0 auto;
}

.process-step {
    text-align: center;
    position: relative;
}

.step-number {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: 700;
    margin: 0 auto 2rem;
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
}

.step-content h3 {
    font-size: 1.3rem;
    margin-bottom: 1rem;
    color: white;
}

.step-content p {
    color: rgba(255, 255, 255, 0.8);
    line-height: 1.6;
}

.step-connector {
    display: none;
}

/* CTA Moderne */
.cta-modern {
    padding: 8rem 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.cta-content {
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.cta-content h2 {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
}

.cta-content p {
    font-size: 1.2rem;
    line-height: 1.6;
    margin-bottom: 3rem;
    opacity: 0.9;
}

.cta-benefits {
    display: flex;
    justify-content: center;
    gap: 2rem;
    margin-bottom: 3rem;
}

.benefit-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
}

.cta-actions {
    display: flex;
    gap: 1.5rem;
    justify-content: center;
}

.btn-primary-large {
    display: inline-flex;
    align-items: center;
    gap: 0.8rem;
    padding: 1.2rem 2.5rem;
    background: white;
    color: #667eea;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1.2rem;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.btn-primary-large:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    color: #667eea;
}

.btn-secondary-large {
    display: inline-flex;
    align-items: center;
    gap: 0.8rem;
    padding: 1.2rem 2.5rem;
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: white;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1.2rem;
    text-decoration: none;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.btn-secondary-large:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-2px);
    color: white;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-container {
        grid-template-columns: 1fr;
        gap: 3rem;
        text-align: center;
    }

    .hero-visual {
        order: -1;
    }

    .title-main {
        font-size: 3rem;
    }

    .title-sub {
        font-size: 1.4rem;
    }

    .hero-stats {
        justify-content: center;
    }

    .hero-actions {
        justify-content: center;
        flex-wrap: wrap;
    }

    .section-title {
        font-size: 2.5rem;
    }

    .cta-content h2 {
        font-size: 2.5rem;
    }

    .cta-benefits {
        flex-direction: column;
        align-items: center;
    }

    .cta-actions {
        flex-direction: column;
        align-items: center;
    }

    .process-steps {
        grid-template-columns: 1fr;
        grid-template-rows: auto;
    }

    .services-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .title-main {
        font-size: 2.5rem;
    }

    .title-sub {
        font-size: 1.2rem;
    }

    .section-title {
        font-size: 2rem;
    }

    .cta-content h2 {
        font-size: 2rem;
    }

    .hero-stats {
        flex-direction: column;
        gap: 1rem;
    }

    .container {
        padding: 0 1rem;
    }
}
</style>

@endsection
