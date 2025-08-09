@extends('layouts.app')

{{-- Le titre sera dynamique en fonction du bien affiché --}}
@section('title', $bien->titre)

@section('content')
    <h1>{{ $bien->titre }}</h1>
    <p>Ce bien est situé à : {{ $bien->ville }}</p>
    <p>Prix : {{ number_format($bien->prix, 2, ',', ' ') }} CFA</p>
    {{-- Ici on ajoutera la galerie photo, la description complète, etc. --}}
@endsection
