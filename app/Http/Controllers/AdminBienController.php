<?php

namespace App\Http\Controllers;

use App\Models\BienImmobilier;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBienController extends Controller
{
    public function index()
    {
        $biens = BienImmobilier::with('photos')->latest()->paginate(10);
        return view('admin.biens.index', compact('biens'));
    }

    public function create()
    {
        return view('admin.biens.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'surface' => 'required|numeric|min:0',
            'nombre_pieces' => 'required|integer|min:0',
            'nombre_chambres' => 'required|integer|min:0',
            'nombre_sdb' => 'required|integer|min:0',
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:100',
            'statut' => 'required|in:disponible,vendu,loue,reserve',
            'disponible' => 'required|in:0,1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Convertir disponible en boolean
        $validated['disponible'] = (bool) $validated['disponible'];

        $bien = BienImmobilier::create($validated);

        // Traitement des images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $fileName = time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('biens', $fileName, 'public');
                
                Photo::create([
                    'bien_immobilier_id' => $bien->id,
                    'chemin' => $imagePath,
                    'alt' => $bien->titre,
                    'ordre' => $index + 1
                ]);
            }
        }

        return redirect()->route('admin.biens.index')
            ->with('success', 'Bien immobilier créé avec succès !');
    }

    public function show(BienImmobilier $bien)
    {
        $bien->load('photos');
        return view('admin.biens.show', compact('bien'));
    }

    public function edit(BienImmobilier $bien)
    {
        $bien->load('photos');
        return view('admin.biens.edit', compact('bien'));
    }

    public function update(Request $request, BienImmobilier $bien)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'surface' => 'required|numeric|min:0',
            'nombre_pieces' => 'required|integer|min:0',
            'nombre_chambres' => 'required|integer|min:0',
            'nombre_sdb' => 'required|integer|min:0',
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:100',
            'statut' => 'required|in:disponible,vendu,loue,reserve',
            'disponible' => 'required|in:0,1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Convertir disponible en boolean
        $validated['disponible'] = (bool) $validated['disponible'];

        $bien->update($validated);

        // Traitement des nouvelles images
        if ($request->hasFile('images')) {
            $maxOrdre = $bien->photos()->max('ordre') ?? 0;
            
            foreach ($request->file('images') as $index => $image) {
                $fileName = time() . '_' . ($maxOrdre + $index + 1) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('biens', $fileName, 'public');
                
                Photo::create([
                    'bien_immobilier_id' => $bien->id,
                    'chemin' => $imagePath,
                    'alt' => $bien->titre,
                    'ordre' => $maxOrdre + $index + 1
                ]);
            }
        }

        return redirect()->route('admin.biens.index')
            ->with('success', 'Bien immobilier mis à jour avec succès !');
    }

    public function destroy(BienImmobilier $bien)
    {
        // Supprimer les images associées
        foreach ($bien->photos as $photo) {
            Storage::disk('public')->delete($photo->chemin);
            $photo->delete();
        }

        $bien->delete();

        return redirect()->route('admin.biens.index')
            ->with('success', 'Bien immobilier supprimé avec succès !');
    }

    public function deletePhoto(Request $request)
    {
        $photoId = $request->input('photo_id');
        $photo = Photo::findOrFail($photoId);
        
        // Supprimer le fichier
        Storage::disk('public')->delete($photo->chemin);
        
        // Supprimer de la base de données
        $photo->delete();
        
        return response()->json(['success' => true]);
    }
}
