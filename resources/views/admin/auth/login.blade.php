{{--
    Файл: resources/views/admin/auth/login.blade.php
    Blade-шаблон для сторінки входу в адмін-панель
--}}

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вхід до адмін-панелі | VIST</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-login.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>
                🔐 Адмін-панель
            </h1>
            <p>Система управління продуктами VIST</p>
        </div>
        
        <div class="login-body">
            @if($success)
                <div class="alert-success">
                    ✅ {{ $success }}
                </div>
            @endif
            
            @if($error)
                <div class="alert-error">
                    ⚠️ {{ $error }}
                </div>
            @endif
            
            <form method="POST" autocomplete="off">
                @csrf
				<div class="form-group">
					<label for="email">Email</label> {{-- Змінено з Логін на Email --}}
					<div class="input-wrapper">
						<input 
							type="email" {{-- Змінено з text на email для валідації браузером --}}
							id="email" 
							name="email" {{-- КРИТИЧНО: змінено з username на email --}}
							required 
							autofocus
							placeholder="Введіть ваш email" {{-- Оновлено placeholder --}}
							value="{{ old('email') }}" {{-- Змінено old('username') на old('email') --}}
						>
						<span class="input-icon">👤</span>
					</div>
				</div>
                
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <div class="input-wrapper">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            placeholder="Введіть пароль"
                        >
                        <span class="toggle-password" onclick="togglePassword()">👁️</span>
                    </div>
                </div>
                
                <button type="submit" class="btn-login">
                    🔓 Увійти
                </button>
                
                <div class="security-note">
                    <strong>🛡️ Безпека:</strong> Ця сторінка захищена. Всі спроби входу логуються.
                </div>
            </form>
        </div>
        
        <div class="login-footer">
            <a href="{{ route('home') }}">
                ← Повернутися на головну
            </a>
        </div>
    </div>
    
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.textContent = '🙈';
            } else {
                passwordInput.type = 'password';
                toggleIcon.textContent = '👁️';
            }
        }
        
        // Фокус на поле логіна при завантаженні
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('email').focus(); 
        });
        
        // Enter на будь-якому полі - submit форми
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    document.querySelector('form').submit();
                }
            });
        });
    </script>
</body>
</html>