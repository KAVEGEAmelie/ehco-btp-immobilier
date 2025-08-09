<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function accueil()
    {
        // Pour l'instant, on retourne juste une vue.
        // Plus tard, on pourra y ajouter les derniers biens mis en ligne.
        return view('pages.accueil');
    }

    public function contact()
    {
        // Récupérer les paramètres de contact depuis la base de données
        $settingsRaw = DB::table('settings')->whereIn('group', ['general', 'contact'])->get();
        
        // Valeurs par défaut
        $settings = [
            'site_name' => 'ECHO Immobilier',
            'contact_email' => 'contact@echo-immobilier.com',
            'contact_phone' => '01 23 45 67 89',
            'address' => "123 Rue de l'Immobilier\n75001 Paris, France",
            'description' => 'Votre partenaire de confiance pour tous vos projets immobiliers.',
        ];
        
        // Remplacer par les vraies valeurs de la base de données
        foreach ($settingsRaw as $setting) {
            $settings[$setting->key] = $setting->value;
        }
        
        return view('pages.contact', compact('settings'));
    }
}
