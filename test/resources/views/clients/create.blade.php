<form action="{{route('clients.store') }}" method="POST">
    @csrf
    <div style="margin-bottom: 15px;">
        <label for="name">Имя</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="email">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="phone">Телефон</label>
        <input type="text" name="phone" value="{{ old('phone') }}" required>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="register_at">Дата регистрации</label>
        <input type="date" name="register_at" value="{{ old('register_at') }}" required>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="status">Статус</label>
        <select name="status">
            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Активен</option>
            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Неактивен</option>
        </select>
    </div>
    <button type="submit" style="width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">Создать</button>
</form>
