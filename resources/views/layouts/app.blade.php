<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body>
    @include('partials.header')

    {{-- La classe "container" est importante ici ! --}}
    <main class="container">
        @yield('content')
    </main>

    @include('partials.footer')

    {{-- Inclusion du JavaScript --}}
    @vite(['resources/js/app.js'])

    {{-- AJOUTER CE CODE AVANT LA FIN DU BODY DANS VOTRE LAYOUT --}}

<div class="lightbox" id="lightbox" style="display: none;">
    <button class="lightbox-close">&times;</button>
    <button class="lightbox-prev">&#10094;</button>
    <button class="lightbox-next">&#10095;</button>
    <div class="lightbox-content">
        <img src="" class="lightbox-image" alt="Image agrandie">
    </div>
</div>
</body>
</html>
