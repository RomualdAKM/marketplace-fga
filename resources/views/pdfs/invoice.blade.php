<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        .section {
            margin-bottom: 30px;
        }
        .section h2 {
            color: #2c3e50;
            border-bottom: 1px solid #bdc3c7;
            padding-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #2c3e50;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .total {
            font-size: 1.2em;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
            color: #2c3e50;
        }
        .client-info, .delivery-info {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Facture pour la commande #{{ $order->id }}</h1>
    </div>
    
    <div class="section">
        <h2>Détails du client</h2>
        <div class="client-info">
            <p><strong>Nom :</strong> {{ $user->name }}</p>
            <p><strong>Email :</strong> {{ $user->email }}</p>
        </div>
    </div>
    
    <div class="section">
        <h2>Adresse de livraison</h2>
        <div class="delivery-info">
            <p>{{ $deliveryDetail->full_name }}</p>
            <p>{{ $deliveryDetail->address }}</p>
            <p>{{ $deliveryDetail->deliveryCity->city_name }}, {{ $deliveryDetail->deliveryCountry->country_name }}</p>
        </div>
    </div>
    
    <div class="section">
        <h2>Articles commandés</h2>
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Options</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Prix de livraison</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>
                            @foreach($item->options as $option)
                                {{ $option->variationOption->name }} (+ {{ $option->additional_price }} {{ $shop->devise }})<br>
                            @endforeach
                        </td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price }} {{ $shop->devise }}</td>
                        <td>{{ $deliveryDetail->deliveryCity->city_price }} {{ $shop->devise }}</td>
                        <td>{{ ($item->price * $item->quantity) + $deliveryDetail->deliveryCity->city_price }} {{ $shop->devise }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="total">
        Total : {{ $order->total_price }} {{ $shop->devise }}
    </div>
</body>
</html>