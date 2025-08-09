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
