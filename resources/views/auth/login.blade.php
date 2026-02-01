<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вхід в адмін-панель | VIST</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <h1>🔐 VIST Admin</h1>
            <p>Панель керування</p>
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

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
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

            <div class="form-group">
                <label for="password">Пароль</label>
                <div class="password-wrapper">
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required
                        placeholder="••••••••"
                    >
                    <button type="button" class="toggle-password" onclick="togglePassword()" id="toggleBtn">
                        <!-- Закрите око (показується коли пароль прихований) -->
                        <svg id="eyeSlash" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z"/>
                        </svg>
                        <!-- Відкрите око (показується коли пароль видимий) -->
                        <svg id="eyeOpen" style="display: none;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="remember-forgot">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Запам'ятати мене</label>
                </div>
                <div class="forgot-password">
                    <a href="{{ route('password.request') }}">Забули пароль?</a>
                </div>
            </div>

            <button type="submit" class="btn-login">
                Увійти
            </button>
        </form>

        <div class="back-link">
            <a href="{{ route('home') }}">← Повернутися на сайт</a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const field = document.getElementById('password');
            const eyeSlash = document.getElementById('eyeSlash');
            const eyeOpen = document.getElementById('eyeOpen');
            
            if (field.type === 'password') {
                // Показати пароль
                field.type = 'text';
                eyeSlash.style.display = 'none';
                eyeOpen.style.display = 'block';
            } else {
                // Приховати пароль
                field.type = 'password';
                eyeSlash.style.display = 'block';
                eyeOpen.style.display = 'none';
            }
        }
    </script>
</body>
</html>
