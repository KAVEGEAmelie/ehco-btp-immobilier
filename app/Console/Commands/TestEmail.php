<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test d\'envoi d\'email de contact';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Test d\'envoi d\'email en cours...');
        
        $testData = [
            'nom' => 'Test EHCO BTP',
            'email' => 'test@example.com',
            'telephone' => '0123456789',
            'sujet' => 'Test du système email',
            'message' => 'Ceci est un test du système d\'envoi d\'email depuis le site EHCO BTP Immobilier.',
            'bien_id' => null
        ];

        try {
            Mail::to('kavegeamelie@gmail.com')
                ->send(new ContactMessage($testData));
            
            $this->info('✅ Email envoyé avec succès !');
            $this->info('📧 Destinataire: kavegeamelie@gmail.com');
            $this->info('📬 Vérifiez votre boîte email (et les spams)');
            
        } catch (\Exception $e) {
            $this->error('❌ Erreur lors de l\'envoi: ' . $e->getMessage());
            $this->info('💡 Vérifiez votre configuration SMTP dans le .env');
        }
    }
}
