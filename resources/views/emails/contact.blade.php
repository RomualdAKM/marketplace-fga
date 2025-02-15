<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact {{$shop_name}}</title>
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
        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        .message {
            background-color: #ecf0f1;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
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
        <h2>Bonjour,</h2>

        <div class="message">
            <p><strong>{{ $name }}</strong> vous a contacté via le site {{$shop_name}} :</p>
        </div>
       
        <p><strong>Email :</strong> {{ $email }}</p>
        <p><strong>Numéro :</strong> {{ $number }}</p>
        <p><strong>Sujet :</strong> {{ $subject }}</p>
        <p><strong>Message :</strong> {{ $messages }}</p>
    </div>
</body>
</html>