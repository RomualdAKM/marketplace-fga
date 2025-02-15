<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerte de Stock</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        h1 {
            font-size: 24px;
            margin: 0;
        }
        p {
            line-height: 1.6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #888;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            color: white;
            background-color: #4CAF50;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Alerte de Stock : {{ $product->name }}</h1>
        </div>
        <p>Bonjour {{ $admin->name }},</p>
        <p>Nous vous informons que le stock du produit suivant a atteint son niveau d'alerte :</p>
        <table>
            <tr>
                <th>Nom du produit</th>
                <td>{{ $product->name }}</td>
            </tr>
            <tr>
                <th>Stock actuel</th>
                <td>{{ $product->stock }}</td>
            </tr>
            <tr>
                <th>Niveau d'alerte de stock</th>
                <td>{{ $product->stock_alert }}</td>
            </tr>
        </table>
        <p>Veuillez prendre les mesures nécessaires pour réapprovisionner le stock.</p>
        <a href="#" class="btn">Gérer le stock</a>
        <p>Cordialement,<br>Votre équipe {{ config('app.name') }}</p>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>
