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
</body>
</html>
