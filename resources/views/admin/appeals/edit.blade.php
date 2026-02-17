@extends('layouts.app')

@section('title', 'Редагувати звернення')

@section('body-class', 'dashboard-page')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-products.css') }}">
@endpush

@section('content')
<style>
.appeal-edit { max-width: 900px; margin: 150px auto; padding: 0 20px; }
.form-card { background: rgba(255,255,255,0.1); backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.2); padding: 40px; border-radius: 20px; box-shadow: 0 8px 32px 0 rgba(31,38,135,0.37); color: #fff; }
.form-card h1 { font-size: 22px; margin: 0 0 30px 0; color: #fff; text-align: center; }
.form-card label { display: block; margin-bottom: 8px; font-weight: 600; color: #fff; font-size: 14px; }
.form-card input, .form-card textarea { width: 100%; padding: 12px 15px; border: 1px solid rgba(255,255,255,0.2); border-radius: 10px; font-size: 15px; margin-bottom: 16px; box-sizing: border-box; background: rgba(255,255,255,0.05); color: #fff; font-family: inherit; transition: all 0.3s; }
.form-card input::placeholder, .form-card textarea::placeholder { color: rgba(255,255,255,0.5); }
.form-card textarea { resize: vertical; min-height: 120px; }
.form-card input:focus, .form-card textarea:focus { outline: none; border-color: rgba(255,255,255,0.5); background: rgba(255,255,255,0.15); }
.form-card .btn-save { width: 100%; padding: 15px; background: rgba(255,255,255,0.2); color: #fff; border: 1px solid rgba(255,255,255,0.4); border-radius: 10px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s; }
.form-card .btn-save:hover { background: rgba(255,255,255,0.3); transform: scale(1.02); }
.form-card .btn-cancel { display: block; width: 100%; padding: 15px; margin-top: 10px; background: rgba(231,76,60,0.2); color: #fff; border: 1px solid rgba(231,76,60,0.4); border-radius: 10px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s; text-align: center; text-decoration: none; }
.form-card .btn-cancel:hover { background: rgba(231,76,60,0.35); }
.error { color: #ff6b6b; font-size: 13px; margin-top: -12px; margin-bottom: 12px; }
</style>

<main class="appeal-edit">
    <nav class="admin-nav">
        <div class="admin-nav-title">
            Редагувати звернення
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

    <div class="form-card">
        <h1>Редагувати звернення</h1>
        <form method="POST" action="{{ route('admin.appeals.update', $appeal) }}">
            @csrf
            @method('PUT')

            <label for="name">Ім'я</label>
            <input type="text" id="name" name="name" value="{{ old('name', $appeal->name) }}" required>
            @error('name') <div class="error">{{ $message }}</div> @enderror

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $appeal->email) }}" required>
            @error('email') <div class="error">{{ $message }}</div> @enderror

            <label for="phone">Телефон</label>
            <input type="tel" id="phone" name="phone" value="{{ old('phone', $appeal->phone) }}" required>
            @error('phone') <div class="error">{{ $message }}</div> @enderror

            <label for="subject">Тема звернення</label>
            <input type="text" id="subject" name="subject" value="{{ old('subject', $appeal->subject) }}">
            @error('subject') <div class="error">{{ $message }}</div> @enderror

            <label for="message">Повідомлення</label>
            <textarea id="message" name="message" required>{{ old('message', $appeal->message) }}</textarea>
            @error('message') <div class="error">{{ $message }}</div> @enderror

            <button type="submit" class="btn-save">Зберегти</button>
            <a href="{{ route('admin.appeals.show', $appeal) }}" class="btn-cancel">Скасувати</a>
        </form>
    </div>
</main>
@endsection