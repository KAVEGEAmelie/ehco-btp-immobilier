<?php

namespace App\Http\Controllers;

use App\Models\BienImmobilier; // <-- N'oubliez pas d'importer le modèle !
use Illuminate\Http\Request;

class BienImmobilierController extends Controller
{
    public function index()
    {
        // Pour l'instant, on retourne une vue vide.
        // Bientôt, on récupérera ici tous les biens de la base de données.
        return view('biens.index');
    }

    public function show(BienImmobilier $bien)
    {
        // Grâce au "Route Model Binding" de Laravel,
        // Laravel récupère automatiquement le bien immobilier correspondant à l'ID
        // passé dans l'URL et l'injecte dans la variable $bien.
        return view('biens.show', [
            'bien' => $bien
        ]);
    }
}
