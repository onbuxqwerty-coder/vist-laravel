@extends('layouts.app')

@section('title', 'Звернення — Адмін')

@section('content')
<style>
body { background: url('/img/dashboard-bg.png') no-repeat center center fixed; background-size: cover; }
.appeals-page { max-width: 1200px; margin: 0 auto; padding: 20px; padding-top: 140px; }
.appeals-page h1 { font-size: 24px; color: #fff; margin-bottom: 24px; text-align: center; }
.admin-nav { background: #2c3e50; padding: 12px 24px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 10px; border: 1px solid rgba(255, 255, 255, 0.2); }
.admin-nav-title { color: #fff; font-size: 18px; font-weight: bold; }
.admin-nav-links { display: flex; gap: 8px; align-items: center; flex-wrap: wrap; }
.admin-nav-links .nav-link { color: #ecf0f1; text-decoration: none; padding: 6px 14px; border-radius: 4px; font-size: 14px; transition: background 0.2s; }
.admin-nav-links .nav-link:hover, .admin-nav-links .nav-link.active { background: rgba(255,255,255,0.15); }
.alert { padding: 12px 16px; border-radius: 6px; margin-bottom: 16px; text-align: center; font-size: 14px; }
.alert-success { background: #d4edda; color: #155724; }
.alert-error { background: #f8d7da; color: #721c24; }
.card { background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.2); padding: 20px 24px; border-radius: 16px; box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37); margin-bottom: 16px; color: white; }
.card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
.card-header .name { font-weight: bold; font-size: 16px; color: #fff; }
.card-header .date { font-size: 13px; color: rgba(255, 255, 255, 0.6); }
.card-meta { font-size: 13px; color: rgba(255, 255, 255, 0.7); margin-bottom: 10px; }
.card-meta span { margin-right: 16px; }
.card-subject { display: inline-block; background: rgba(52, 152, 219, 0.25); color: #7ec8f7; font-size: 13px; padding: 3px 10px; border-radius: 12px; margin-bottom: 10px; border: 1px solid rgba(52, 152, 219, 0.3); }
.card-product { display: inline-block; background: rgba(241, 196, 15, 0.2); color: #f7dc6f; font-size: 13px; padding: 3px 10px; border-radius: 12px; margin-bottom: 10px; margin-left: 6px; border: 1px solid rgba(241, 196, 15, 0.3); }
.card-message { font-size: 20px; color: rgba(255, 255, 255, 0.85); line-height: 2.0; }
.card-actions { margin-top: 12px; display: flex; gap: 8px; }
.card-actions a, .card-actions button { font-size: 13px; padding: 5px 14px; border-radius: 8px; text-decoration: none; cursor: pointer; border: 1px solid rgba(255, 255, 255, 0.2); transition: all 0.3s ease; }
.btn-view { background: rgba(52, 152, 219, 0.2); color: #7ec8f7; }
.btn-view:hover { background: rgba(52, 152, 219, 0.35); }
.btn-edit { background: rgba(241, 196, 15, 0.2); color: #f7dc6f; }
.btn-edit:hover { background: rgba(241, 196, 15, 0.35); }
.btn-delete { background: rgba(231, 76, 60, 0.2); color: #f1948a; }
.btn-delete:hover { background: rgba(231, 76, 60, 0.35); }
.empty-state { text-align: center; color: rgba(255, 255, 255, 0.6); padding: 60px 0; }
.empty-state h2 { color: rgba(255, 255, 255, 0.5); margin-bottom: 10px; }
.pagination { text-align: center; margin-top: 24px; }
.pagination nav { display: flex; justify-content: center; }
</style>

<main class="appeals-page">
    <nav class="admin-nav">
        <div class="admin-nav-title">
            Панель управління звернень
        </div>
        <span style="font-size: 20px; color: #ecf0f1; opacity: 0.9;">
            Звернення ({{ $appeals->total() }})
        </span>
        <div class="admin-nav-links">
            <a href="{{ route('admin.appeals.index') }}" class="nav-link active">Звернення</a>
            <a href="{{ route('admin.products.index') }}" class="nav-link">Продукти</a>
            <a href="{{ route('admin.dashboard') }}" class="nav-link">Дашборд</a>
            <a href="{{ route('home') }}" class="nav-link">На головну</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="nav-link" style="background: rgba(231, 76, 60, 0.2); border: none; cursor: pointer;">Вихід</button>
            </form>
        </div>
    </nav>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif


    @forelse($appeals as $appeal)
        <div class="card">
            <div class="card-header">
                <span class="name">{{ $appeal->name }}</span>
                <span class="date">{{ $appeal->date }} {{ \Illuminate\Support\Str::substr($appeal->time, 0, 5) }}</span>
            </div>
            <div class="card-meta">
                <span>{{ $appeal->email }}</span>
                <span>{{ $appeal->phone }}</span>
            </div>
            @if($appeal->subject)
                <div class="card-subject">{{ $appeal->subject }}</div>
            @endif
            @if($appeal->product_name)
                <div class="card-product">{{ $appeal->product_name }}</div>
            @endif
            <div class="card-message">{{ Str::limit($appeal->message, 200) }}</div>
            <div class="card-actions">
                <a href="{{ route('admin.appeals.show', $appeal) }}" class="btn-view">Переглянути</a>
                <a href="{{ route('admin.appeals.edit', $appeal) }}" class="btn-edit">Редагувати</a>
                <form method="POST" action="{{ route('admin.appeals.destroy', $appeal) }}" onsubmit="return confirm('Видалити це звернення?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">Видалити</button>
                </form>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <h2>Звернень поки немає</h2>
            <p>Нові звернення з'являться тут після заповнення форм на сайті.</p>
        </div>
    @endforelse

    @if($appeals->hasPages())
        <div class="pagination">
            {{ $appeals->links() }}
        </div>
    @endif
</main>
@endsection
