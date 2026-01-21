<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; 

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Головний адміністратор',
                'email' => 'admin@vist.net.ua', 
                'password' => '$2y$10$I3IKmWYA9k/SJR6fN7OIneIxDE/KbNiIyoCr/fhD0Mn15hQHSXn06', // пароль: password
            ],
            [
                'name' => 'Менеджер',
                'email' => 'info@vist.net.ua',
                'password' => '$2y$10$SL6L2M5mE6GzM7A7/xJd8e26cQSKKOMzWmYlMgYr.6itheTt3KOd6', // пароль: password
            ],
            [
                'name' => 'Директор',
                'email' => 'valery.litvinov@vist.net.ua',
                'password' => '$2y$10$0vvYiHWd.cLP7hlMMD1.mOyc9fNkMGM5P..JEWeFIfB45/OPSNBgS', // пароль: password
            ]
        ];

        foreach ($admins as $admin) {
            // Метод updateOrCreate оновить email, якщо name збігається, або створить новий запис
            User::updateOrCreate(['name' => $admin['name']], $admin);
        }
    }
}