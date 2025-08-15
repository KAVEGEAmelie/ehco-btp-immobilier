<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Mail;

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';

// Démarrer l'application
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "🚀 Test de Laravel Mail...\n";

try {
    // Test direct avec Laravel Mail
    Mail::raw('Ceci est un test direct depuis Laravel', function($message) {
        $message->to('kavegeamelie@gmail.com')
                ->subject('Test Laravel Mail Direct - EHCO BTP');
    });
    
    echo "✅ Email envoyé avec succès via Laravel !\n";
    
} catch (\Exception $e) {
    echo "❌ Erreur Laravel Mail : " . $e->getMessage() . "\n";
    echo "📋 Stack trace : " . $e->getTraceAsString() . "\n";
}

// Test avec la classe ContactMessage
echo "\n📧 Test avec ContactMessage...\n";

try {
    $contactData = [
        'nom' => 'Test Utilisateur',
        'email' => 'test@example.com',
        'telephone' => '0123456789',
        'sujet' => 'Test du système email',
        'message' => 'Ceci est un test du formulaire de contact.',
        'bien_id' => null
    ];
    
    Mail::to('kavegeamelie@gmail.com')->send(new \App\Mail\ContactMessage($contactData));
    
    echo "✅ Email ContactMessage envoyé avec succès !\n";
    
} catch (\Exception $e) {
    echo "❌ Erreur ContactMessage : " . $e->getMessage() . "\n";
    echo "📋 Stack trace : " . $e->getTraceAsString() . "\n";
}
