<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accusé de Réception d'Ouverture de Compte</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px; background-color: #f4f4f4; font-size: 18px;">
    <div style="background-color: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); max-width: 600px; margin: auto;">
        <h2 style="color: #333;">Accusé de Réception d'Ouverture de Compte</h2>
        <p>Bonjour {{ $infos['prenom'] }} {{ $infos['nom'] }},</p>
        <p>Nous confirmons l'ouverture de votre compte. Vous pouvez vous connecter en utilisant les informations suivantes :</p>
        <ul>
            <li><strong>Nom d'utilisateur :</strong> {{ $infos['username'] }}</li>
            <li><strong>Email :</strong> {{ $infos['email'] }}</li>
            <li><strong>Mot de passe :</strong> {{ $infos['password'] }}</li>
        </ul>
        <p>Vous pouvez vous connecter soit avec votre nom d'utilisateur et mot de passe, soit avec votre email et mot de passe.</p>
        <p>Nous vous remercions pour votre inscription. Si vous avez des questions ou des préoccupations, n'hésitez pas à nous contacter.</p>
        <p>Cordialement,<br>Isidore Dev</p>
    </div>
</body>
</html>
