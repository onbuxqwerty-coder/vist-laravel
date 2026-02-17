@extends('layouts.app')

@section('title', 'Звернення: ' . $appeal->subject)

@section('body-class', 'dashboard-page')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-products.css') }}">
@endpush

@section('content')
<style>
.appeal-show { max-width: 1200px; margin: 150px auto; padding: 0 20px; }
.appeal-show h1 { font-size: 22px; margin-bottom: 24px; color: #fff; text-align: center; }
.appeal-show h2 { font-size: 18px; margin-bottom: 16px; color: #fff; }
.back { text-align: center; margin-bottom: 24px; }
.back a { color: rgba(255,255,255,0.7); text-decoration: none; font-size: 14px; transition: color 0.3s; }
.back a:hover { color: #fff; }
.card { background: rgba(255,255,255,0.1); backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.2); padding: 24px; border-radius: 16px; box-shadow: 0 8px 32px 0 rgba(31,38,135,0.37); margin-bottom: 24px; color: #fff; }
.field { margin-bottom: 12px; font-size: 14px; color: rgba(255,255,255,0.85); }
.field strong { color: #fff; }
.subject-badge { display: inline-block; background: rgba(52,152,219,0.25); color: #7ec8f7; font-size: 13px; padding: 3px 10px; border-radius: 12px; border: 1px solid rgba(52,152,219,0.3); }
.product-badge { display: inline-block; background: rgba(241,196,15,0.2); color: #f7dc6f; font-size: 13px; padding: 3px 10px; border-radius: 12px; border: 1px solid rgba(241,196,15,0.3); }
.message-text { font-size: 14px; color: rgba(255,255,255,0.85); line-height: 1.6; margin-top: 12px; white-space: pre-wrap; }
.alert { padding: 12px 16px; border-radius: 10px; margin-bottom: 16px; text-align: center; font-size: 14px; }
.alert-success { background: rgba(0,200,100,0.15); border: 1px solid rgba(0,200,100,0.3); color: #a0ffb0; }
.comment { background: rgba(255,255,255,0.08); padding: 12px 16px; border-radius: 10px; margin-bottom: 10px; font-size: 14px; color: rgba(255,255,255,0.85); line-height: 1.5; border: 1px solid rgba(255,255,255,0.1); }
.comment-date { font-size: 12px; color: rgba(255,255,255,0.5); margin-top: 4px; }
.no-comments { color: rgba(255,255,255,0.5); font-size: 14px; }
.section { margin-top: 32px; }
.section label { display: block; margin-bottom: 8px; font-weight: 600; color: #fff; font-size: 14px; }
.section textarea { width: 100%; padding: 12px; border: 1px solid rgba(255,255,255,0.2); border-radius: 10px; font-size: 14px; resize: vertical; min-height: 80px; margin-bottom: 12px; box-sizing: border-box; background: rgba(255,255,255,0.05); color: #fff; font-family: inherit; }
.section textarea::placeholder { color: rgba(255,255,255,0.5); }
.section textarea:focus { outline: none; border-color: rgba(255,255,255,0.5); background: rgba(255,255,255,0.15); }
.btn { padding: 10px 20px; border: 1px solid rgba(255,255,255,0.3); border-radius: 10px; font-size: 14px; cursor: pointer; color: #fff; transition: all 0.3s; }
.btn-primary { background: rgba(52,152,219,0.25); }
.btn-primary:hover { background: rgba(52,152,219,0.4); }
.btn-success { background: rgba(39,174,96,0.25); }
.btn-success:hover { background: rgba(39,174,96,0.4); }
.error { color: #ff6b6b; font-size: 13px; margin-top: -8px; margin-bottom: 12px; }
</style>

<main class="appeal-show">
    <nav class="admin-nav">
        <div class="admin-nav-title">
            Деталі звернення
        </div>
        <div class="admin-nav-links">
            <a href="{{ route('admin.products.index') }}" class="nav-link">Продукти</a>
            <a href="{{ route('admin.products.create') }}" class="nav-link">Додати продукт</a>
            <a href="{{ route('admin.appeals.index') }}" class="nav-link">Звернення</a>
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

    <div class="card">
        <div class="field"><strong>Ім'я:</strong> {{ $appeal->name }}</div>
        <div class="field"><strong>Email:</strong> {{ $appeal->email }}</div>
        <div class="field"><strong>Телефон:</strong> {{ $appeal->phone }}</div>
        <div class="field"><strong>Дата:</strong> {{ $appeal->date }} {{ \Illuminate\Support\Str::substr($appeal->time, 0, 5) }}</div>
        @if($appeal->subject)
            <div class="field"><strong>Тема:</strong> <span class="subject-badge">{{ $appeal->subject }}</span></div>
        @endif
        @if($appeal->product_name)
            <div class="field"><strong>Продукт:</strong> <span class="product-badge">{{ $appeal->product_name }}</span></div>
        @endif
        <div class="message-text">{{ $appeal->message }}</div>
    </div>

    {{-- Comments --}}
    <div class="section">
        <h2>Коментарі</h2>
        @forelse($appeal->comments as $comment)
            <div class="comment">
                {{ $comment->body }}
                <div class="comment-date">{{ $comment->created_at->format('d.m.Y H:i') }}</div>
            </div>
        @empty
            <div class="no-comments">Коментарів поки немає.</div>
        @endforelse
    </div>

    {{-- Add comment form --}}
    <div class="section">
        <h2>Додати коментар</h2>
        <form method="POST" action="{{ route('admin.appeals.addComment', $appeal) }}">
            @csrf
            <textarea name="body" placeholder="Введіть коментар..." required>{{ old('body') }}</textarea>
            @error('body') <div class="error">{{ $message }}</div> @enderror
            <button type="submit" class="btn btn-primary">Додати коментар</button>
        </form>
    </div>

    {{-- Reply by email --}}
    <div class="section">
        <h2>Відповісти на email</h2>
        <form method="POST" action="{{ route('admin.appeals.reply', $appeal) }}">
            @csrf
            <label>Відповідь буде надіслана на: <strong>{{ $appeal->email }}</strong></label>
            <textarea name="reply_message" placeholder="Текст відповіді..." required>{{ old('reply_message') }}</textarea>
            @error('reply_message') <div class="error">{{ $message }}</div> @enderror
            <button type="submit" class="btn btn-success">Надіслати email</button>
        </form>
    </div>
</main>
@endsection