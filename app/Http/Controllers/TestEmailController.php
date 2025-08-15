<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactMessage;

class TestEmailController extends Controller
{
    /**
     * Afficher la page de test d'email.
     */
    public function index()
    {
        return view('test-email');
    }

    /**
     * Envoyer un email de test.
     */
    public function send(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:simple,contact',
            'destinataire' => 'required|email',
            'sujet' => 'required|string|max:255'
        ]);

        Log::info('Test email demandé', [
            'type' => $validated['type'],
            'destinataire' => $validated['destinataire'],
            'sujet' => $validated['sujet'],
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        try {
            if ($validated['type'] === 'simple') {
                // Email simple
                Mail::raw("Ceci est un email de test simple.\n\nEnvoyé le: " . now()->format('Y-m-d H:i:s'), function($message) use ($validated) {
                    $message->to($validated['destinataire'])
                            ->subject($validated['sujet']);
                });
                
                $message = 'Email simple envoyé avec succès !';
                
            } else {
                // Email avec ContactMessage
                $contactData = [
                    'nom' => 'Test System',
                    'email' => 'test@ehco-btp.com',
                    'telephone' => '0123456789',
                    'sujet' => $validated['sujet'],
                    'message' => 'Ceci est un test du système d\'email avec la classe ContactMessage. Envoyé le: ' . now()->format('Y-m-d H:i:s'),
                    'bien_id' => null
                ];
                
                Mail::to($validated['destinataire'])->send(new ContactMessage($contactData));
                
                $message = 'Email ContactMessage envoyé avec succès !';
            }
            
            Log::info('Test email envoyé avec succès', [
                'type' => $validated['type'],
                'destinataire' => $validated['destinataire']
            ]);
            
            return back()->with('success', $message);
            
        } catch (\Exception $e) {
            Log::error('Erreur test email', [
                'type' => $validated['type'],
                'destinataire' => $validated['destinataire'],
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Erreur lors de l\'envoi : ' . $e->getMessage());
        }
    }
}
