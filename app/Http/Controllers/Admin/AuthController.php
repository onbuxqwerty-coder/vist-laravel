<?php

/**
 * Файл: app/Http/Controllers/Admin/AuthController.php
 * Контролер для аутентифікації адміністраторів через базу даних
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Відображення форми входу
     */
    public function showLoginForm()
    {
        // Якщо користувач вже авторизований - перенаправляємо до списку продуктів
        if (Auth::check()) {
            return redirect()->route('admin.products.index');
        }

        return view('admin.auth.login', [
            'success' => request()->get('logged_out') ? 'Ви успішно вийшли з системи.' : null,
            'error' => request()->get('timeout') ? 'Ваша сесія закінчилась. Будь ласка, увійдіть знову.' : null
        ]);
    }

    /**
     * Обробка запиту на вхід
     */
    public function login(Request $request)
    {
        // 1. Валідація введених даних
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // 2. Спроба авторизації через базу даних
        // Laravel автоматично порівняє пароль із хешем у таблиці users
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Регенеруємо сесію для захисту від фіксації сесії
            $request->session()->regenerate();

            // Логування успішного входу
            $this->logAction($request->email, 'SUCCESS');

            return redirect()->intended(route('admin.products.index'));
        }

        // 3. Якщо дані невірні
        // Логуємо невдалу спробу
        $this->logAction($request->email, 'FAILED');

        // Затримка для захисту від брутфорсу (імітація попередньої логіки)
        sleep(1);

        return back()
            ->withInput($request->only('email'))
            ->with('error', 'Невірний email або пароль!');
    }

    /**
     * Вихід із системи
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Ви успішно вийшли з системи.');
    }

    /**
     * Логування спроб входу (аналог попередньої функції logLoginAttempt)
     */
    protected function logAction($email, $status)
    {
        $logMessage = sprintf(
            "Admin Login %s | User: %s | IP: %s | UA: %s",
            $status,
            $email,
            request()->ip(),
            request()->userAgent()
        );

        // Записуємо у стандартний лог Laravel
        if ($status === 'SUCCESS') {
            Log::info($logMessage);
        } else {
            Log::warning($logMessage);
        }

        // Додатково записуємо в окремий файл, як було раніше
        file_put_contents(
            storage_path('logs/admin_access.log'),
            "[" . now()->format('Y-m-d H:i:s') . "] " . $logMessage . "\n",
            FILE_APPEND
        );
    }
}