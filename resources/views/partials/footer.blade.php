<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-left">
                <p class="copyright">&copy; {{ date('Y') }} EHCO Immobilier. Tous droits réservés.</p>
            </div>
            
            <div class="footer-center">
                <div class="admin-link-wrapper">
                    <a href="{{ route('admin.login') }}" class="admin-link">
                        🔐 Espace Admin
                    </a>
                </div>
            </div>
            
            <div class="footer-right">
                <div class="developer-signature">
                    <span class="signature-text">Développé par</span>
                    <span class="signature-name">KA.A</span>
                    <span class="signature-separator">•</span>
                    <a href="mailto:camillekvg99@gmail.com" class="signature-email">
                        <svg class="email-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        camillekvg99@gmail.com
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>