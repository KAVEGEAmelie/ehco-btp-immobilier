<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="EHCO Immobilier - Expert en solutions immobilières. Découvrez nos biens immobiliers de qualité.">
<meta name="keywords" content="immobilier, vente, achat, location, maison, appartement, EHCO">
<meta name="author" content="EHCO Immobilier">

<title>@yield('title', 'EHCO Immobilier')</title>

<!-- Favicon -->
<link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon.svg') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.svg') }}">
<link rel="apple-touch-icon" href="{{ asset('images/favicon.svg') }}">

<!-- Meta tags Open Graph pour partage réseaux sociaux -->
<meta property="og:title" content="@yield('title', 'EHCO Immobilier')">
<meta property="og:description" content="Expert en solutions immobilières. Découvrez nos biens immobiliers de qualité.">
<meta property="og:image" content="{{ asset('images/logo-ehco.svg') }}">
<meta property="og:type" content="website">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

{{-- Utilisation de Vite pour le CSS --}}
@vite(['resources/css/app.css'])
