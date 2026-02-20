@extends('layouts.app')

@section('title', 'Адмін-панель')

@section('body-class', 'dashboard-page')

@section('content')
<style>
/* Специфічний padding для dashboard */
.dashboard-page main {
    padding-top: 80px; /* або яке значення вам потрібно */
}

body { background-image: url('/img/dashboard-bg.png');}
/* решта ваших стилів... */

.dashboard-container { max-width: 1200px; margin: 40px auto; padding: 20px; }
.dashboard-header { background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.2); color: #fff; padding: 30px; border-radius: 20px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37); }
.dashboard-header h1 { font-size: 28px; margin: 0; }
.dashboard-header .user-info { color: #bdc3c7; font-size: 14px; margin-top: 6px; }
.logout-btn { background: rgba(231,76,60,0.2); color: #fff; padding: 10px 20px; border-radius: 6px; text-decoration: none; border: none; cursor: pointer; font-size: 14px; }
.logout-btn:hover { background: rgba(231,76,60,0.4); }
.admin-cards { display: flex; gap: 24px; margin-bottom: 30px; justify-content: center; flex-wrap: wrap; }
.admin-card { background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 20px; box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37); padding: 28px; text-decoration: none; color: white; transition: transform 0.2s, box-shadow 0.2s; display: flex; flex-direction: column; justify-content: center; align-items: center; gap: 20px; width: 500px; min-height: 300px; text-align: center; }
.admin-card:hover { transform: translateY(-4px); box-shadow: 0 8px 40px rgba(31, 38, 135, 0.5); }
.admin-card .card-info { display: flex; flex-direction: column; align-items: center; gap: 8px; }
.admin-card .card-icon { font-size: 40px; }
.admin-card h2 { font-size: 20px; color: #fff; margin: 0; }
.admin-card p { font-size: 14px; color: rgba(255, 255, 255, 0.7); margin: 0; line-height: 1.5; }
.admin-card .card-count { font-size: 36px; font-weight: bold; color: rgba(255, 255, 255, 0.9); flex-shrink: 0; }
.section-title { font-size: 18px; color: rgba(255, 255, 255, 0.7); margin-bottom: 16px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }
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

    <div class="admin-cards">
        <a href="{{ route('admin.products.index') }}" class="admin-card">
            <div class="card-info">
                <div class="card-icon">📦</div>
                <h2>Продукти</h2>
                <p>Управління каталогом продукції: робочі станції, сервери, промислові ПК, ДБЖ</p>
            </div>
            <div class="card-count">{{ \App\Models\Product::count() }}</div>
        </a>

        <a href="{{ route('admin.appeals.index') }}" class="admin-card">
            <div class="card-info">
                <div class="card-icon">📬</div>
                <h2>Звернення</h2>
                <p>Перегляд, коментування та відповідь на звернення клієнтів з сайту</p>
            </div>
            <div class="card-count">{{ \App\Models\Appeal::count() }}</div>
        </a>
    </div>

</div>
@endsection
