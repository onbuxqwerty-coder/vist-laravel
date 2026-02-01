<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Відновлення паролю | VIST</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔑 Відновлення паролю</h1>
            <p>Введіть email для отримання посилання</p>
        </div>

        @if (session('status'))
            <div class="success-message">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email адреса</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus
                    placeholder="admin@vist.net.ua"
                >
            </div>

            <button type="submit" class="btn-submit">
                Надіслати посилання
            </button>
        </form>

        <div class="back-link">
            <a href="{{ route('login') }}">← Повернутися до входу</a>
        </div>
    </div>
</body>
</html>
