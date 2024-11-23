<form action="{{route('clients.update', $client->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div style="margin-bottom: 15px;">
        <label for="name">Имя</label>
        <input type="text" name="name" value="{{ old('name', $client->name) }}" required>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="email">Email</label>
        <input type="email" name="email" value="{{ old('email', $client->email) }}" required>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="phone">Email</label>
        <input type="text" name="phone" value="{{ old('phone', $client->phone) }}" required>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="register_at">Email</label>
        <input type="date" name="register_at" value="{{ old('register_at', $client->register_at) }}" required>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="status">Статус</label>
        <select name="status">
            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Активен</option>
            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Неактивен</option>
        </select>
    </div>
    <button type="submit" style="width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">Обновить</button>
</form>
