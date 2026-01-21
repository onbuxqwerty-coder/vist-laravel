<?php
/**
 * Файл: app/Http/Middleware/AdminAuthenticated.php
 * Middleware для перевірки аутентифікації адміністратора
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('admin_logged_in')) {
            // Зберігаємо URL для редіректу після входу
            session(['redirect_after_login' => $request->fullUrl()]);
            
            return redirect()->route('admin.login');
        }

        // Перевірка таймаута сесії (2 години)
        $loginTime = session('login_time');
        if ($loginTime && now()->diffInSeconds($loginTime) > 7200) {
            session()->flush();
            return redirect()->route('admin.login')->with('timeout', 1);
        }

        // Оновлюємо час останньої активності
        session(['login_time' => now()]);

        return $next($request);
    }
}