@extends('layouts.app')

@section('title', 'Адмін-панель')

@section('content')
<style>
body { background: #f5f7fa; }
.dashboard-container { max-width: 1200px; margin: 40px auto; padding: 20px; }
.dashboard-header { background: #2c3e50; color: #fff; padding: 30px; border-radius: 12px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; }
.dashboard-header h1 { font-size: 28px; margin: 0; }
.dashboard-header .user-info { color: #bdc3c7; font-size: 14px; margin-top: 6px; }
.logout-btn { background: rgba(231,76,60,0.2); color: #fff; padding: 10px 20px; border-radius: 6px; text-decoration: none; border: none; cursor: pointer; font-size: 14px; }
.logout-btn:hover { background: rgba(231,76,60,0.4); }
.admin-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; margin-bottom: 30px; }
.admin-card { background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 28px; text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s; display: flex; flex-direction: column; gap: 12px; }
.admin-card:hover { transform: translateY(-4px); box-shadow: 0 6px 20px rgba(0,0,0,0.12); }
.admin-card .card-icon { font-size: 40px; }
.admin-card h2 { font-size: 20px; color: #2c3e50; margin: 0; }
.admin-card p { font-size: 14px; color: #7f8c8d; margin: 0; line-height: 1.5; }
.admin-card .card-count { font-size: 28px; font-weight: bold; color: #3498db; }
.section-title { font-size: 18px; color: #7f8c8d; margin-bottom: 16px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }
.quick-links { background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 28px; }
.quick-links ul { list-style: none; padding: 0; margin: 0; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px; }
.quick-links a { color: #3498db; text-decoration: none; font-size: 15px; padding: 8px 0; display: block; }
.quick-links a:hover { color: #2980b9; }
</style>

<div class="dashboard-container">
    <div class="dashboard-header">
        <div>
            <h1>Back Office VIST</h1>
            <p class="user-info">{{ Auth::user()->name }} ({{ Auth::user()->email }})</p>
        </div>
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">Вийти</button>
        </form>
    </div>

    <div class="section-title">Управління</div>
    <div class="admin-cards">
        <a href="{{ route('admin.products.index') }}" class="admin-card">
            <div class="card-icon">📦</div>
            <h2>Продукти</h2>
            <p>Управління каталогом продукції: робочі станції, сервери, промислові ПК, ДБЖ</p>
            <div class="card-count">{{ \App\Models\Product::count() }}</div>
        </a>

        <a href="{{ route('admin.appeals.index') }}" class="admin-card">
            <div class="card-icon">📬</div>
            <h2>Звернення</h2>
            <p>Перегляд, коментування та відповідь на звернення клієнтів з сайту</p>
            <div class="card-count">{{ \App\Models\Appeal::count() }}</div>
        </a>
    </div>

    <div class="section-title">Каталог на сайті</div>
    <div class="quick-links">
        <ul>
            <li><a href="{{ route('workstations.index') }}">Робочі станції</a></li>
            <li><a href="{{ route('servers.index') }}">Сервери</a></li>
            <li><a href="{{ route('industrial.index') }}">Промислові ПК</a></li>
            <li><a href="{{ route('ups.index') }}">ДБЖ</a></li>
            <li><a href="{{ route('home') }}">Головна сайту</a></li>
            <li><a href="{{ route('support.index') }}">Підтримка</a></li>
        </ul>
    </div>
</div>
@endsection
