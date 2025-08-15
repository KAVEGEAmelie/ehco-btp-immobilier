<?php

require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Charger les variables d'environnement
$envFile = __DIR__ . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && !str_starts_with(trim($line), '#')) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value, " \t\n\r\0\x0B\"");
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
}

// Fonction helper pour env()
function env($key, $default = null) {
    $value = getenv($key);
    return $value !== false ? $value : $default;
}

echo "🔧 Configuration Mail :\n";
echo "MAIL_MAILER: " . env('MAIL_MAILER') . "\n";
echo "MAIL_HOST: " . env('MAIL_HOST') . "\n";
echo "MAIL_PORT: " . env('MAIL_PORT') . "\n";
echo "MAIL_USERNAME: " . env('MAIL_USERNAME') . "\n";
echo "MAIL_ENCRYPTION: " . env('MAIL_ENCRYPTION') . "\n";
echo "MAIL_FROM_ADDRESS: " . env('MAIL_FROM_ADDRESS') . "\n";

echo "\n📧 Test de connexion SMTP...\n";

try {
    // Test de connexion SMTP directe avec PHPMailer
    $mail = new PHPMailer(true);
    
    // Configuration SMTP
    $mail->isSMTP();
    $mail->Host = env('MAIL_HOST');
    $mail->SMTPAuth = true;
    $mail->Username = env('MAIL_USERNAME');
    $mail->Password = env('MAIL_PASSWORD');
    $mail->SMTPSecure = env('MAIL_ENCRYPTION');
    $mail->Port = env('MAIL_PORT');
    
    // Debug SMTP
    $mail->SMTPDebug = 2;
    
    // Configuration du message
    $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
    $mail->addAddress('kavegeamelie@gmail.com', 'Test Destinataire');
    
    $mail->isHTML(true);
    $mail->Subject = 'Test SMTP Direct - EHCO BTP';
    $mail->Body = '<h1>Test de connexion SMTP</h1><p>Ce message confirme que votre configuration SMTP fonctionne correctement.</p>';
    
    // Tentative d'envoi
    $mail->send();
    echo "✅ Email envoyé avec succès via PHPMailer !\n";
    
} catch (\Exception $e) {
    echo "❌ Erreur PHPMailer : " . $e->getMessage() . "\n";
}

echo "\n🔍 Informations système :\n";
echo "PHP Version: " . phpversion() . "\n";
echo "Extensions installées:\n";
$extensions = ['openssl', 'curl', 'mbstring', 'tokenizer'];
foreach ($extensions as $ext) {
    echo "- $ext: " . (extension_loaded($ext) ? '✅' : '❌') . "\n";
}
