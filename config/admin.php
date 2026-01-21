<?php
/**
 * Файл: config/admin.php
 * Конфігурація адмін-панелі
 */

return [
    // Налаштування логування
    'log_enabled' => env('ADMIN_LOG_ENABLED', true),
    'log_file' => storage_path('logs/admin_access.log'),
    
    // Налаштування сесії
    'session_timeout' => 7200, // 2 години в секундах
    
    // Налаштування безпеки
    'max_login_attempts' => 5,
    'login_attempt_timeout' => 300, // 5 хвилин
];