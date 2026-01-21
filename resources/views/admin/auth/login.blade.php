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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
            animation: slideUp 0.5s ease;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }
        
        .login-header h1 {
            font-size: 28px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .login-header p {
            opacity: 0.9;
            font-size: 15px;
        }
        
        .login-body {
            padding: 40px 30px;
        }
        
        .alert-error {
            background: #fee;
            border: 2px solid #fcc;
            color: #c33;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
            animation: shake 0.5s;
        }
        
        .alert-success {
            background: #d4edda;
            border: 2px solid #c3e6cb;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
            animation: slideDown 0.5s;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .input-wrapper {
            position: relative;
        }
        
        .input-wrapper input {
            width: 100%;
            padding: 14px 45px 14px 15px;
            border: 2px solid #dfe6e9;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            font-family: inherit;
        }
        
        .input-wrapper input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            opacity: 0.5;
        }
        
        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 20px;
            user-select: none;
            opacity: 0.6;
            transition: opacity 0.3s;
        }
        
        .toggle-password:hover {
            opacity: 1;
        }
        
        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 16px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .login-footer {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            border-top: 1px solid #ecf0f1;
        }
        
        .login-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s;
        }
        
        .login-footer a:hover {
            gap: 10px;
        }
        
        .security-note {
            margin-top: 20px;
            padding: 15px;
            background: #e8f4f8;
            border-left: 4px solid #3498db;
            border-radius: 4px;
            font-size: 13px;
            color: #2c3e50;
        }
        
        @media (max-width: 480px) {
            .login-header {
                padding: 30px 20px;
            }
            
            .login-body {
                padding: 30px 20px;
            }
        }
    </style>
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