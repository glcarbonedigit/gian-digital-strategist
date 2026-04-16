<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Nuova richiesta contatti</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #111;">
    <h2>Nuova richiesta dal sito</h2>

    <p><strong>Nome:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Telefono:</strong> {{ $data['phone'] ?: 'Non indicato' }}</p>
    <p><strong>Servizio:</strong> {{ $data['service'] ?: 'Non indicato' }}</p>

    <hr>

    <p><strong>Messaggio:</strong></p>
    <p>{!! nl2br(e($data['message'])) !!}</p>
</body>
</html>