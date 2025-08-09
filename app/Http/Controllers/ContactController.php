<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactMessage;

class ContactController extends Controller
{
    /**
     * Afficher la page de contact.
     */
    public function index()
    {
        return view('pages.contact');
    }

    /**
     * Traiter l'envoi du formulaire de contact.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'nullable|string|max:20',
            'sujet' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'bien_id' => 'nullable|exists:bien_immobiliers,id'
        ]);

        try {
            // Envoyer l'email de contact
            Mail::to('kavegeamelie@gmail.com') // Votre email de réception
                ->send(new ContactMessage($validated));
            
            return back()->with('success', 'Votre message a été envoyé avec succès ! Nous vous recontacterons dans les plus brefs délais.');
            
        } catch (\Exception $e) {
            Log::error('Erreur envoi email contact: ' . $e->getMessage());
            
            return back()->with('error', 'Une erreur est survenue lors de l\'envoi de votre message. Veuillez réessayer ou nous contacter directement.');
        }
    }

    /**
     * Afficher le formulaire de contact pour un bien spécifique.
     */
    public function contactBien($bienId)
    {
        $bien = \App\Models\BienImmobilier::findOrFail($bienId);
        
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'html' => view('biens.contact-modal', compact('bien'))->render()
            ]);
        }

        return view('pages.contact', compact('bien'));
    }
}
