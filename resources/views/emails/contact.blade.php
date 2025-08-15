<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau message de contact</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f8f9fa;
            padding: 30px;
            border: 1px solid #dee2e6;
        }
        .footer {
            background: #343a40;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 0 0 10px 10px;
        }
        .info-row {
            margin: 15px 0;
            padding: 10px;
            background: white;
            border-left: 4px solid #667eea;
            border-radius: 5px;
        }
        .label {
            font-weight: bold;
            color: #667eea;
            margin-bottom: 5px;
        }
        .message-content {
            background: white;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            border: 1px solid #dee2e6;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🏢 EHCO Immobilier - Nouveau Message</h1>
        <p>Vous avez reçu un nouveau message depuis votre site immobilier</p>
    </div>
    
    <div class="content">
        <div class="info-row">
            <div class="label">👤 Nom complet :</div>
            <div>{{ $contactData['nom'] }}</div>
        </div>
        
        <div class="info-row">
            <div class="label">📧 Email :</div>
            <div>{{ $contactData['email'] }}</div>
        </div>
        
        <div class="info-row">
            <div class="label">📱 Téléphone :</div>
            <div>{{ $contactData['telephone'] ?? 'Non renseigné' }}</div>
        </div>
        
        @if(isset($contactData['bien_id']) && $contactData['bien_id'])
        <div class="info-row">
            <div class="label">🏠 Bien concerné :</div>
            <div>ID #{{ $contactData['bien_id'] }}</div>
        </div>
        @endif
        
        <div class="info-row">
            <div class="label">📅 Date d'envoi :</div>
            <div>{{ now()->format('d/m/Y à H:i') }}</div>
        </div>
        
        <div class="message-content">
            <div class="label">💬 Message :</div>
            <p>{!! nl2br(e($contactData['message'])) !!}</p>
        </div>
    </div>
    
    <div class="footer">
        <p><strong>EHCO Immobilier - Solutions Immobilières</strong></p>
        <p>Ce message a été envoyé automatiquement depuis votre site web</p>
        <p>Pour répondre, utilisez directement l'adresse email : {{ $contactData['email'] }}</p>
    </div>
</body>
</html>
