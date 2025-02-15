<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mot de passe oublier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }

        p {
            margin: 10px 0;
        }

        strong {
            color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bonjour {{ $user->name }},</h1>
        <p>Nous vous avons envoy  un nouveau mot de passe suite  votre demande de rinitialisation.</p>
        <p>Voici votre nouveau mot de passe : <strong>{{ $newPassword }}</strong>. N'oubliez pas de le modifier une fois connect  votre compte.</p>
        <p>Cordialement,<br>L'quipe de {{ $shop->name ?? 'Shop' }}</p>
    </div>
</body>
</html>
