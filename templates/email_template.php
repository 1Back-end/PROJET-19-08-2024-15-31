<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation de mot de passe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f6f6;
            margin: 0;
            padding: 0;
            color: #333333;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 10px 0;
            background-color: #4CAF50;
            color: white;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
            line-height: 1.6;
        }
        .content h2 {
            color: #4CAF50;
        }
        .content p {
            margin: 10px 0;
        }
        .token {
            display: inline-block;
            background-color: #f2f2f2;
            padding: 10px 15px;
            margin: 20px 0;
            font-size: 18px;
            font-weight: bold;
            color: #4CAF50;
            border-radius: 4px;
        }
        .footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #777777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Réinitialisation de mot de passe</h1>
        </div>
        <div class="content">
            <h2>Bonjour <?= htmlspecialchars($prenom) ?> <?= htmlspecialchars($nom) ?>,</h2>
            <p>Nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.</p>
            <p>Votre code de réinitialisation est :</p>
            <div class="token"><?= htmlspecialchars($token) ?></div>
            <p>Ce code est valide pendant 24 heures.</p>
            <p>Si vous n'avez pas demandé de réinitialisation de mot de passe, veuillez ignorer cet email.</p>
        </div>
        <div class="footer">
            <p>Merci,</p>
            <p>L'équipe de support</p>
        </div>
    </div>
</body>
</html>
