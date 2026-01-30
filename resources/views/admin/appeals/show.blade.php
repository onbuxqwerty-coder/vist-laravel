@extends('layouts.app')

@section('title', 'Звернення: ' . $appeal->subject)

@section('content')
<style>
body { background: #f5f7fa; }
.appeal-show { max-width: 800px; margin: 0 auto; padding: 20px; }
.appeal-show h1 { font-size: 22px; margin-bottom: 24px; color: #2c3e50; text-align: center; }
.appeal-show h2 { font-size: 18px; margin-bottom: 16px; color: #2c3e50; }
.back { text-align: center; margin-bottom: 24px; }
.back a { color: #4a90d9; text-decoration: none; font-size: 14px; }
.back a:hover { text-decoration: underline; }
.card { background: #fff; padding: 24px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); margin-bottom: 24px; }
.field { margin-bottom: 12px; font-size: 14px; color: #444; }
.field strong { color: #2c3e50; }
.subject-badge { display: inline-block; background: #e8f0fe; color: #1a5fb4; font-size: 13px; padding: 3px 10px; border-radius: 12px; }
.product-badge { display: inline-block; background: #fff3cd; color: #856404; font-size: 13px; padding: 3px 10px; border-radius: 12px; }
.message-text { font-size: 14px; color: #444; line-height: 1.6; margin-top: 12px; white-space: pre-wrap; }
.alert { padding: 12px 16px; border-radius: 6px; margin-bottom: 16px; text-align: center; font-size: 14px; }
.alert-success { background: #d4edda; color: #155724; }
.comment { background: #f9f9f9; padding: 12px 16px; border-radius: 6px; margin-bottom: 10px; font-size: 14px; color: #444; line-height: 1.5; }
.comment-date { font-size: 12px; color: #999; margin-top: 4px; }
.no-comments { color: #888; font-size: 14px; }
label { display: block; margin-bottom: 4px; font-weight: bold; color: #444; font-size: 14px; }
textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; resize: vertical; min-height: 80px; margin-bottom: 12px; box-sizing: border-box; }
textarea:focus { outline: none; border-color: #4a90d9; }
.btn { padding: 10px 20px; border: none; border-radius: 4px; font-size: 14px; cursor: pointer; color: #fff; }
.btn-primary { background: #4a90d9; }
.btn-primary:hover { background: #3a7bc8; }
.btn-success { background: #28a745; }
.btn-success:hover { background: #218838; }
.error { color: #c00; font-size: 13px; margin-top: -8px; margin-bottom: 12px; }
.section { margin-top: 32px; }
</style>

<main class="appeal-show">
    <h1>Деталі звернення</h1>
    <div class="back">
        <a href="{{ route('admin.appeals.index') }}">&larr; Назад до списку</a>
    </div>

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
