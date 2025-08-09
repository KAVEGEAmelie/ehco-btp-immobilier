<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BienImmobilier;

class BienController extends Controller
{
    /**
     * Afficher la liste des biens immobiliers.
     */
    public function index(Request $request)
    {
        $query = BienImmobilier::with('photos')->where('disponible', true);

        // Filtres de recherche
        if ($request->filled('ville')) {
            $query->where('ville', 'like', '%' . $request->ville . '%');
        }

        if ($request->filled('prix_max')) {
            $query->where('prix', '<=', $request->prix_max);
        }

        if ($request->filled('pieces_min')) {
            $query->where('nombre_pieces', '>=', $request->pieces_min);
        }

        if ($request->filled('surface_min')) {
            $query->where('surface', '>=', $request->surface_min);
        }

        $biens = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('biens.index', compact('biens'));
    }

    /**
     * Afficher les détails d'un bien (via AJAX pour le modal).
     */
    public function show(BienImmobilier $bien)
    {
        $bien->load('photos');
        
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'html' => view('biens.modal', compact('bien'))->render()
            ]);
        }

        return view('biens.show', compact('bien'));
    }
}
