<header class="header" id="header">
    <div class="container">
        <a href="{{ route('home') }}" class="logo">EHCO</a>

        <!-- Menu burger pour mobile -->
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>

        <nav class="nav" id="nav">
            <ul class="nav-list">
                <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Accueil</a></li>
                <li class="nav-item"><a href="{{ route('biens.index') }}" class="nav-link">Nos Biens</a></li>
                <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
            </ul>
        </nav>
    </div>
</header>