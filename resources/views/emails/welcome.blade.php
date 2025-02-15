<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue sur notre plateforme</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            border-radius: 5px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        .cta {
            background-color: #3498db;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenue, {{ $user->name }} !</h1>
        <p>Nous sommes ravis de vous accueillir sur notre plateforme.</p>
        <p>Votre compte a été créé avec succès. Vous pouvez maintenant faire vos achats en toute confiance.</p>
        <p>Si vous avez des questions ou besoin d'aide, n'hésitez pas à nous contacter.</p>
        <a href="{{ url()->current() }}" class="cta">Commencer à explorer</a>
    </div>
</body>
</html>