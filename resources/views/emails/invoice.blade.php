<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture pour votre commande</title>
</head>
<body>
    <h1>Votre facture est prête</h1>
    <p>Cher(e) client(e),</p>
    <p>Nous vous remercions pour votre commande #{{ $order->id }}. Veuillez trouver ci-joint votre facture au format PDF.</p>
    <p>Cordialement,<br>L'équipe {{$shop->name}}</p>
</body>
</html>