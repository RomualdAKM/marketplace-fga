<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle commande</title>
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
            margin-top: 0;
        }
        .order-details {
            background-color: #ecf0f1;
            border-radius: 5px;
            padding: 20px;
            margin-top: 20px;
        }
        .order-details h2 {
            margin-top: 0;
            color: #2c3e50;
        }
        .order-info {
            list-style-type: none;
            padding: 0;
        }
        .order-info li {
            margin-bottom: 10px;
        }
        .order-info strong {
            display: inline-block;
            width: 150px;
            color: #7f8c8d;
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
        <h1>Nouvelle commande passée</h1>
        <p>Une nouvelle commande a été passée sur votre boutique.</p>
        
        <div class="order-details">
            <h2>Détails de la commande</h2>
            <ul class="order-info">
                <li><strong>Numéro de commande :</strong> {{ $order->id }}</li>
                <li><strong>Client :</strong> {{ $order->user->name }}</li>
                <li><strong>Montant total :</strong> {{ $order->total_price }} €</li>
                <li><strong>Date :</strong> {{ $order->created_at->format('d/m/Y H:i') }}</li>
            </ul>
        </div>
        
        <a href="{{ url()->current() . '/admin' }}" class="cta">Accéder au panneau d'administration</a>
       
    </div>
</body>
</html>