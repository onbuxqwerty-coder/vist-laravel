<?php
/**
 * Файл: app/Http/Middleware/CheckIPAccess.php
 * Middleware для перевірки доступу по IP
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIPAccess
{
    // Дозволені IP адреси (залиште порожнім для доступу з будь-яких IP)
    protected $allowedIps = [
        // '123.456.789.0',
        // '98.765.43.21',
    ];

    public function handle(Request $request, Closure $next)
    {
        if (!empty($this->allowedIps)) {
            $userIp = $request->ip();
            
            if (!in_array($userIp, $this->allowedIps)) {
                abort(403, 'Access denied from your IP address.');
            }
        }

        return $next($request);
    }
}