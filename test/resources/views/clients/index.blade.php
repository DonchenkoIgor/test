<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


<form method="GET" action="{{route('clients.index')}}" style="display: flex; gap: 10px; margin-bottom: 20px;">
    <input type="text" name="name" placeholder="Поиск по имени" value="{{ request('name') }}">
    <select name="status" style="padding: 8px; flex: 1;">
        <option value="">Все</option>
        <option value="active" {{ request('status') == 'active' ? 'selected' : ''}}>Активен</option>
        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : ''}}>Неактивен</option>
    </select>
    <button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">Фильтровать</button>
</form>

<table style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th style="padding: 8px; text-align: left; border: 1px solid #ddd;">Имя</th>
            <th style="padding: 8px; text-align: left; border: 1px solid #ddd;">Email</th>
            <th style="padding: 8px; text-align: left; border: 1px solid #ddd;">Телефон</th>
            <th style="padding: 8px; text-align: left; border: 1px solid #ddd;">Статус</th>
            <th style="padding: 8px; text-align: left; border: 1px solid #ddd;">Дата регистрации</th>
        </tr>
    </thead>

    <tbody>
        @foreach($clients as $client)
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;">{{$client->name}}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{$client->email}}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{$client->phone}}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{$client->status}}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{$client->register_at}}</td>
                <td>
                    <a href="{{route('clients.edit', $client->id)}}" style="color: #4CAF50; text-decoration: none;">Редактировать</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div style="margin-top: 20px;">
    {{ $clients->onEachSide(1)->links('pagination::bootstrap-4') }}
</div>
