# Claude Code Instructions

## Communication
- Завжди відповідай українською мовою
- Відповідай максимально коротко — економ ресурси і токени

## Project
- Laravel 12 + Livewire v3.7.6 + Volt + Tailwind CSS
- URL: http://vist-laravel.test
- Original PHP site for reference: "D:\My projects v1.1\Vist"

## Deployment (Hostinger)
- SSH key: `C:/laragon/www/vist-laravel/SSH key/vist-net-ua`
- Server: `u746005963@45.84.204.46` port `65002`
- Project path: `/home/u746005963/domains/vist.net.ua/laravel-projects/vist-laravel/`
- Deploy command (one connection for all steps):
  `ssh -i "C:/laragon/www/vist-laravel/SSH key/vist-net-ua" -o StrictHostKeyChecking=no -p 65002 u746005963@45.84.204.46 "cd /home/u746005963/domains/vist.net.ua/laravel-projects/vist-laravel && git pull origin main && php artisan migrate --force && php artisan optimize:clear 2>&1"`
