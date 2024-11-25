<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Профиль клиента: {{ $client->name }}</title>
</head>
<body>
    <h1 style="background-color: green; color: white; padding: 10px; text-align: center">Профиль клиента</h1>

    <ul style="color: green;">
        <li><strong>Имя:</strong> {{ $client->name }}</li>
        <li><strong>Email:</strong> {{ $client->email }}</li>
        <li><strong>Телефон:</strong> {{ $client->phone }}</li>
        <li><strong>Статус:</strong> {{ $client->status }}</li>
        <li><strong>Дата регистрации:</strong> {{ $client->register_at }}</li>
        <li><strong>Город:</strong> {{ $client->city ?? 'Не указан' }}</li>
    </ul>

    @if($weather)
        <div style="background-color: white; border: 2px solid green; margin: 20px; padding: 15px; border-radius: 10px">
            <h2 style="color: green">Текущая погода в {{ $client->city }}</h2>
            <p><strong>Температура:</strong>{{ $weather['main']['temp'] }} °C</p>
            <p><strong>Описание:</strong>{{ ucfirst($weather['weather'][0]['description']) }}</p>
            <p><strong>Влажность:</strong>{{ $weather['main']['humidity'] }} %</p>
            <p><strong>Скорость ветра:</strong>{{ $weather['wind']['speed'] }} м/с</p>
        </div>
    @else
        <p>Город не указан или произошла ошибка!</p>
   @endif

    <a href="{{ route('clients.index') }}" style="display: inline-block; margin: 20px; padding: 10px; background-color: green; color: white; text-decoration: none;border-radius: 5px">
        Вернуться к списку</a>
</body>
</html>
