@extends('layouts.app')

@section('title', 'Редагувати звернення')

@section('content')
<style>
body { background: #f5f7fa; }
.appeal-edit { max-width: 560px; margin: 0 auto; padding: 40px 20px; }
.appeal-edit h1 { font-size: 22px; margin-bottom: 24px; color: #2c3e50; text-align: center; }
.back { text-align: center; margin-bottom: 16px; }
.back a { color: #4a90d9; text-decoration: none; font-size: 14px; }
.back a:hover { text-decoration: underline; }
.form-card { background: #fff; padding: 32px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
.form-card label { display: block; margin-bottom: 4px; font-weight: bold; color: #444; font-size: 14px; }
.form-card input, .form-card textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; margin-bottom: 16px; box-sizing: border-box; }
.form-card textarea { resize: vertical; min-height: 100px; }
.form-card input:focus, .form-card textarea:focus { outline: none; border-color: #4a90d9; }
.form-card .btn-save { width: 100%; padding: 12px; background: #4a90d9; color: #fff; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; }
.form-card .btn-save:hover { background: #3a7bc8; }
.error { color: #c00; font-size: 13px; margin-top: -12px; margin-bottom: 12px; }
</style>

<main class="appeal-edit">
    <h1>Редагувати звернення</h1>
    <div class="back">
        <a href="{{ route('admin.appeals.show', $appeal) }}">&larr; Назад до звернення</a>
    </div>

    <div class="form-card">
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
        </form>
    </div>
</main>
@endsection
