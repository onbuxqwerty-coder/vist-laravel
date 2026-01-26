@extends('layouts.app')

@section('title', 'Адмін-панель')

@section('content')
<style>
body {
    background: #f5f7fa;
}

.dashboard-container {
    max-width: 1200px;
    margin: 50px auto;
    padding: 20px;
}

.dashboard-header {
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.dashboard-header h1 {
    font-size: 32px;
    color: #2c3e50;
    margin-bottom: 10px;
}

.user-info {
    color: #7f8c8d;
    font-size: 16px;
}

.logout-btn {
    background: #e74c3c;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    display: inline-block;
    margin-top: 20px;
}

.logout-btn:hover {
    background: #c0392b;
}
</style>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>🎛️ Адмін-панель VIST</h1>
        <p class="user-info">Вітаємо, {{ Auth::user()->name }}! ({{ Auth::user()->email }})</p>
        
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">Вийти</button>
        </form>
    </div>

    <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <h2>Швидкі посилання</h2>
        <ul style="list-style: none; padding: 0; margin-top: 20px;">
            <li style="margin-bottom: 10px;">
                <a href="{{ route('workstations.index') }}" style="color: #3498db; text-decoration: none;">📦 Робочі станції</a>
            </li>
            <li style="margin-bottom: 10px;">
                <a href="{{ route('servers.index') }}" style="color: #3498db; text-decoration: none;">🖥️ Сервери</a>
            </li>
            <li style="margin-bottom: 10px;">
                <a href="{{ route('industrial.index') }}" style="color: #3498db; text-decoration: none;">🏭 Промислові ПК</a>
            </li>
            <li style="margin-bottom: 10px;">
                <a href="{{ route('ups.index') }}" style="color: #3498db; text-decoration: none;">🔋 ДБЖ</a>
            </li>
        </ul>
    </div>
</div>
@endsection
