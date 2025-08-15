<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactMessage;

class DebugEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'debug:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Debug complet du système d\'email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Diagnostic complet du système d\'email');
        
        // 1. Vérification de la configuration
        $this->info("\n📧 Configuration actuelle :");
        $this->line("MAIL_MAILER: " . config('mail.default'));
        $this->line("MAIL_HOST: " . config('mail.mailers.smtp.host'));
        $this->line("MAIL_PORT: " . config('mail.mailers.smtp.port'));
        $this->line("MAIL_USERNAME: " . config('mail.mailers.smtp.username'));
        $this->line("MAIL_ENCRYPTION: " . config('mail.mailers.smtp.encryption'));
        $this->line("MAIL_FROM_ADDRESS: " . config('mail.from.address'));
        $this->line("MAIL_FROM_NAME: " . config('mail.from.name'));
        
        // 2. Test d'envoi simple
        $this->info("\n🚀 Test d'envoi simple...");
        try {
            Mail::raw('Test debug simple depuis Laravel', function($message) {
                $message->to('kavegeamelie@gmail.com')
                        ->subject('Debug Email - Test Simple');
            });
            $this->info("✅ Test simple réussi");
        } catch (\Exception $e) {
            $this->error("❌ Test simple échoué : " . $e->getMessage());
            Log::error('Debug Email - Test simple échoué', ['error' => $e->getMessage()]);
        }
        
        // 3. Test avec ContactMessage
        $this->info("\n📬 Test avec ContactMessage...");
        try {
            $contactData = [
                'nom' => 'Debug Test',
                'email' => 'debug@test.com',
                'telephone' => '0123456789',
                'sujet' => 'Test debug email system',
                'message' => 'Ce message teste le système d\'email avec la classe ContactMessage.',
                'bien_id' => null
            ];
            
            Mail::to('kavegeamelie@gmail.com')->send(new ContactMessage($contactData));
            $this->info("✅ Test ContactMessage réussi");
        } catch (\Exception $e) {
            $this->error("❌ Test ContactMessage échoué : " . $e->getMessage());
            Log::error('Debug Email - ContactMessage échoué', ['error' => $e->getMessage()]);
        }
        
        // 4. Vérifier les logs récents
        $this->info("\n📋 Dernières entrées de log...");
        $logFile = storage_path('logs/laravel.log');
        if (file_exists($logFile)) {
            $lines = file($logFile);
            $lastLines = array_slice($lines, -10);
            foreach ($lastLines as $line) {
                if (stripos($line, 'mail') !== false || stripos($line, 'email') !== false) {
                    $this->line($line);
                }
            }
        }
        
        $this->info("\n✨ Diagnostic terminé !");
    }
}
