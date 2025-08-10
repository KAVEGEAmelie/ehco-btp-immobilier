import './bootstrap';

// ===== HEADER STICKY BEHAVIOR =====
document.addEventListener('DOMContentLoaded', function() {
    const header = document.getElementById('header');
    const menuToggle = document.getElementById('menuToggle');
    const nav = document.getElementById('nav');
    let lastScrollY = window.scrollY;
    let scrollTimeout;
    
    // Fonction pour gérer le scroll du header
    function handleScroll() {
        const currentScrollY = window.scrollY;
        
        // Ajouter/retirer la classe 'scrolled' pour l'effet de transparence
        if (currentScrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
        
        // Gérer l'affichage/masquage du header
        if (currentScrollY > lastScrollY && currentScrollY > 100) {
            // Scrolling down - cacher le header
            header.classList.add('hidden');
        } else {
            // Scrolling up - montrer le header
            header.classList.remove('hidden');
        }
        
        lastScrollY = currentScrollY;
    }
    
    // Optimiser les performances avec throttling
    function throttledScrollHandler() {
        if (scrollTimeout) return;
        
        scrollTimeout = setTimeout(() => {
            handleScroll();
            scrollTimeout = null;
        }, 10);
    }
    
    // Écouter l'événement de scroll
    window.addEventListener('scroll', throttledScrollHandler);
    
    // ===== MENU MOBILE =====
    if (menuToggle && nav) {
        menuToggle.addEventListener('click', function() {
            // Toggle des classes actives
            menuToggle.classList.toggle('active');
            nav.classList.toggle('active');
            
            // Empêcher le scroll du body quand le menu est ouvert
            if (nav.classList.contains('active')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        });
        
        // Fermer le menu si on clique sur un lien
        const navLinks = nav.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                menuToggle.classList.remove('active');
                nav.classList.remove('active');
                document.body.style.overflow = '';
            });
        });
        
        // Fermer le menu si on redimensionne vers desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth > 480) {
                menuToggle.classList.remove('active');
                nav.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }

    // ===== EFFET LUMINEUX SUR LE LOGO =====
    const logo = document.querySelector('.logo');
    if (logo) {
        logo.addEventListener('click', function(e) {
            // Ajouter la classe pour l'animation
            this.classList.add('clicked');
            
            // Créer un effet de particules lumineuses
            createGlowParticles(e);
            
            // Retirer la classe après l'animation
            setTimeout(() => {
                this.classList.remove('clicked');
            }, 800);
        });
        
        // Fonction pour créer des particules lumineuses
        function createGlowParticles(e) {
            const rect = logo.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;
            
            // Créer 12 particules pour un effet plus dense
            for (let i = 0; i < 12; i++) {
                const particle = document.createElement('div');
                particle.className = 'glow-particle';
                
                // Position initiale au centre du logo
                const angle = (i * 30) * (Math.PI / 180); // 30 degrés entre chaque particule
                const distance = 80 + Math.random() * 40; // Distance variable
                const size = 3 + Math.random() * 3; // Taille variable
                
                particle.style.cssText = `
                    position: fixed;
                    width: ${size}px;
                    height: ${size}px;
                    background: radial-gradient(circle, #00aaff, rgba(0, 170, 255, 0.3));
                    border-radius: 50%;
                    pointer-events: none;
                    z-index: 9999;
                    left: ${centerX}px;
                    top: ${centerY}px;
                    opacity: 1;
                    transform: translate(-50%, -50%);
                    transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                    box-shadow: 0 0 10px #00aaff, 0 0 20px rgba(0, 170, 255, 0.5);
                `;
                
                document.body.appendChild(particle);
                
                // Animer la particule avec un délai aléatoire
                setTimeout(() => {
                    const endX = centerX + Math.cos(angle) * distance;
                    const endY = centerY + Math.sin(angle) * distance;
                    const randomOffset = (Math.random() - 0.5) * 40;
                    
                    particle.style.left = `${endX + randomOffset}px`;
                    particle.style.top = `${endY + randomOffset}px`;
                    particle.style.opacity = '0';
                    particle.style.transform = 'translate(-50%, -50%) scale(0)';
                    particle.style.filter = 'blur(2px)';
                }, 10 + i * 20); // Délai progressif pour chaque particule
                
                // Supprimer la particule après l'animation
                setTimeout(() => {
                    if (document.body.contains(particle)) {
                        document.body.removeChild(particle);
                    }
                }, 1000);
            }
            
            // Créer un effet d'onde circulaire
            const wave = document.createElement('div');
            wave.style.cssText = `
                position: fixed;
                left: ${centerX}px;
                top: ${centerY}px;
                width: 0;
                height: 0;
                border: 2px solid rgba(0, 170, 255, 0.6);
                border-radius: 50%;
                transform: translate(-50%, -50%);
                pointer-events: none;
                z-index: 9998;
                transition: all 0.6s ease-out;
            `;
            
            document.body.appendChild(wave);
            
            setTimeout(() => {
                wave.style.width = '150px';
                wave.style.height = '150px';
                wave.style.opacity = '0';
                wave.style.borderWidth = '1px';
            }, 10);
            
            setTimeout(() => {
                if (document.body.contains(wave)) {
                    document.body.removeChild(wave);
                }
            }, 600);
        }
    }
    
    // ===== SMOOTH SCROLLING POUR LES LIENS D'ANCRAGE =====
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const headerHeight = header.offsetHeight;
                const targetPosition = target.offsetTop - headerHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // ===== GESTION DES MODALS =====
    
    // Fonction pour ouvrir un modal
    window.openModal = function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    };
    
    // Fonction pour fermer un modal
    window.closeModal = function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    };
    
    // Fermer modal en cliquant sur l'overlay
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal(this.id);
            }
        });
    });
    
    // Fermer modal avec la touche Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const activeModal = document.querySelector('.modal.active');
            if (activeModal) {
                closeModal(activeModal.id);
            }
        }
    });

    // ===== GESTION DES BIENS IMMOBILIERS =====
    
    // Boutons "Voir détails" pour ouvrir le modal du bien
    document.addEventListener('click', function(e) {
        if (e.target.closest('.btn-voir-details')) {
            e.preventDefault();
            const button = e.target.closest('.btn-voir-details');
            const bienId = button.getAttribute('data-bien-id');
            
            if (bienId) {
                loadBienDetails(bienId);
            }
        }
    });
    
    // Boutons "Contact" pour ouvrir le modal de contact
    document.addEventListener('click', function(e) {
        if (e.target.closest('.btn-contact') || e.target.closest('.btn-contact-modal')) {
            e.preventDefault();
            const button = e.target.closest('.btn-contact, .btn-contact-modal');
            const bienId = button.getAttribute('data-bien-id');
            
            if (bienId) {
                loadContactForm(bienId);
            }
        }
    });
    
    // Fonction pour charger les détails d'un bien via AJAX
    function loadBienDetails(bienId) {
        const modal = document.getElementById('bienModal');
        const modalBody = modal.querySelector('.modal-body');
        
        // Afficher un loader
        modalBody.innerHTML = '<div class="loading">Chargement...</div>';
        openModal('bienModal');
        
        // Faire la requête AJAX
        fetch(`/biens/${bienId}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                modalBody.innerHTML = data.html;
            } else {
                modalBody.innerHTML = '<div class="error">Erreur lors du chargement des détails.</div>';
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            modalBody.innerHTML = '<div class="error">Erreur lors du chargement des détails.</div>';
        });
    }
    
    // Fonction pour charger le formulaire de contact via AJAX
    function loadContactForm(bienId) {
        const modal = document.getElementById('contactModal');
        const modalBody = modal.querySelector('.modal-body');
        
        // Afficher un loader
        modalBody.innerHTML = '<div class="loading">Chargement...</div>';
        openModal('contactModal');
        
        // Faire la requête AJAX
        fetch(`/contact/bien/${bienId}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                modalBody.innerHTML = data.html;
            } else {
                modalBody.innerHTML = '<div class="error">Erreur lors du chargement du formulaire.</div>';
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            modalBody.innerHTML = '<div class="error">Erreur lors du chargement du formulaire.</div>';
        });
    }

    // ===== ANIMATIONS ET EFFETS =====
    
    // Animation des cartes au scroll
    const observeCards = () => {
        const cards = document.querySelectorAll('.bien-card, .service-card, .property-card');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });
        
        cards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });
    };
    
    // Lancer les animations si on est sur la page des biens
    if (document.querySelector('.biens-page')) {
        setTimeout(observeCards, 100);
    }
});
