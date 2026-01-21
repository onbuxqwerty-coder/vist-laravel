# Інструкція з встановлення VIST Laravel

## 📋 Системні вимоги

### Обов'язково:
- **PHP 8.4+** з extensions:
  - BCMath PHP Extension
  - Ctype PHP Extension
  - Fileinfo PHP Extension
  - JSON PHP Extension
  - Mbstring PHP Extension
  - OpenSSL PHP Extension
  - PDO PHP Extension
  - Tokenizer PHP Extension
  - XML PHP Extension
  
- **Composer 2.x**
- **MySQL 8.0+** або **MariaDB 10.3+**
- **Apache 2.4+** або **Nginx 1.18+**

### Опціонально:
- **Node.js 18+** і **NPM** (для компіляції frontend assets)
- **Redis** (для кешування та черг)

---

## 🚀 Швидкий старт (Локальна розробка)

### 1. Розпакування

```bash
# Для Linux/Mac
tar -xzf vist-laravel.tar.gz
cd vist-laravel

# Для Windows
# Розпакуйте vist-laravel.zip через провідник
# або використайте 7-Zip
```

### 2. Встановлення залежностей

```bash
# Встановити PHP залежності
composer install

# (Опціонально) Встановити NPM залежності для frontend
npm install
```

### 3. Конфігурація оточення

```bash
# Згенерувати ключ додатку
php artisan key:generate

# Відредагувати .env файл
nano .env  # або використайте будь-який текстовий редактор
```

Переконайтеся, що налаштування БД правильні:
```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u746005963_vist
DB_USERNAME=u746005963_admin_vist
DB_PASSWORD=98Vs12Ys&5RKsMys102$
```

### 4. База даних

```bash
# Запустити міграції (створить таблиці)
php artisan migrate

# Наповнити базу тестовими даними
php artisan db:seed
```

### 5. Запуск

```bash
# Запустити вбудований сервер розробки
php artisan serve

# Сайт буде доступний на http://localhost:8000
```

**Готово!** 🎉 Відкрийте браузер і перейдіть на http://localhost:8000

---

## 🌐 Production встановлення

### Apache 2.4+

#### 1. Копіювання файлів

```bash
# Копіюємо проєкт на сервер
sudo cp -r vist-laravel /var/www/
sudo chown -R www-data:www-data /var/www/vist-laravel
```

#### 2. Встановлення прав

```bash
# Права на storage та bootstrap/cache
sudo chmod -R 775 /var/www/vist-laravel/storage
sudo chmod -R 775 /var/www/vist-laravel/bootstrap/cache
```

#### 3. Конфігурація Apache

Створіть файл `/etc/apache2/sites-available/vist.conf`:

```apache
<VirtualHost *:80>
    ServerName vist.dp.ua
    ServerAlias www.vist.dp.ua
    ServerAdmin info@vist.dp.ua
    
    # ВАЖЛИВО: DocumentRoot вказує на public директорію!
    DocumentRoot /var/www/vist-laravel/public
    
    <Directory /var/www/vist-laravel/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    # Логи
    ErrorLog ${APACHE_LOG_DIR}/vist-error.log
    CustomLog ${APACHE_LOG_DIR}/vist-access.log combined
</VirtualHost>
```

Активуйте сайт:
```bash
sudo a2ensite vist.conf
sudo a2enmod rewrite
sudo systemctl restart apache2
```

#### 4. HTTPS (Let's Encrypt)

```bash
sudo apt install certbot python3-certbot-apache
sudo certbot --apache -d vist.dp.ua -d www.vist.dp.ua
```

---

### Nginx 1.18+

#### 1. Конфігурація Nginx

Створіть файл `/etc/nginx/sites-available/vist`:

```nginx
server {
    listen 80;
    server_name vist.dp.ua www.vist.dp.ua;
    
    # ВАЖЛИВО: root вказує на public директорію!
    root /var/www/vist-laravel/public;
    
    index index.php index.html;
    
    charset utf-8;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }
    
    error_page 404 /index.php;
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }
    
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Активуйте конфігурацію:
```bash
sudo ln -s /etc/nginx/sites-available/vist /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

#### 2. HTTPS (Let's Encrypt)

```bash
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d vist.dp.ua -d www.vist.dp.ua
```

---

## ⚙️ Production оптимізації

### 1. Оптимізація Laravel

```bash
# Змінити .env на production
APP_ENV=production
APP_DEBUG=false

# Оптимізувати автозавантаження
composer install --optimize-autoloader --no-dev

# Кешувати конфігурацію
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Оптимізувати всі кеші
php artisan optimize
```

### 2. Налаштування .env для production

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://vist.dp.ua

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u746005963_vist
DB_USERNAME=u746005963_admin_vist
DB_PASSWORD=YOUR_STRONG_PASSWORD

# Використати Redis для кешування (опціонально)
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

# Email налаштування
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=info@vist.dp.ua
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@vist.dp.ua
MAIL_FROM_NAME="VIST"
```

### 3. Компіляція Frontend Assets (опціонально)

```bash
# Встановити залежності
npm install

# Скомпілювати для production
npm run build
```

### 4. Налаштування Cron (для scheduled tasks)

Додайте в crontab:
```bash
* * * * * cd /var/www/vist-laravel && php artisan schedule:run >> /dev/null 2>&1
```

---

## 🔧 Налаштування PHP

Рекомендовані налаштування в `php.ini`:

```ini
upload_max_filesize = 64M
post_max_size = 64M
memory_limit = 512M
max_execution_time = 300

; OPcache для production
opcache.enable=1
opcache.memory_consumption=256
opcache.max_accelerated_files=20000
opcache.validate_timestamps=0
```

Перезапустіть PHP-FPM:
```bash
sudo systemctl restart php8.4-fpm
```

---

## 🐛 Усунення проблем

### Проблема: "500 Internal Server Error"

**Рішення 1:** Перевірте права на storage
```bash
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R www-data:www-data storage bootstrap/cache
```

**Рішення 2:** Перевірте логи
```bash
tail -f storage/logs/laravel.log
```

### Проблема: "Application key not set"

**Рішення:**
```bash
php artisan key:generate
```

### Проблема: Білий екран (blank page)

**Рішення:** Ввімкніть debug режим тимчасово
```env
APP_DEBUG=true
```

Перегляньте помилки, потім вимкніть назад.

### Проблема: 404 на всіх сторінках крім головної

**Apache:**
```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

Переконайтеся, що `AllowOverride All` встановлено в конфігурації.

**Nginx:**
Перевірте, що `try_files` директива присутня в конфігурації.

### Проблема: CSS/JS не завантажуються

**Рішення:** Перевірте, що DocumentRoot/root вказує на `public` директорію, не на корінь проєкту.

---

## 📊 Моніторинг

### Логи Laravel

```bash
# В реальному часі
tail -f storage/logs/laravel.log

# Останні помилки
tail -100 storage/logs/laravel.log | grep ERROR
```

### Логи веб-сервера

**Apache:**
```bash
tail -f /var/log/apache2/vist-error.log
```

**Nginx:**
```bash
tail -f /var/log/nginx/error.log
```

---

## 🔄 Оновлення проєкту

```bash
# 1. Backup бази даних
mysqldump -u root -p u746005963_vist > backup.sql

# 2. Backup файлів
tar -czf vist-backup-$(date +%Y%m%d).tar.gz /var/www/vist-laravel

# 3. Оновлення коду
cd /var/www/vist-laravel
git pull  # якщо використовуєте Git

# 4. Оновлення залежностей
composer install --no-dev --optimize-autoloader

# 5. Міграції (якщо є нові)
php artisan migrate --force

# 6. Очистка кешів
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# 7. Повторна оптимізація
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 📞 Підтримка

При виникненні проблем:

1. Перевірте `storage/logs/laravel.log`
2. Перевірте логи веб-сервера
3. Перевірте права на файли та директорії
4. Читайте офіційну документацію Laravel: https://laravel.com/docs/11.x

## 🎉 Готово!

Ваш сайт VIST тепер працює на Laravel! 

- Головна сторінка: https://vist.dp.ua
- Робочі станції: https://vist.dp.ua/products/workstations
- Сервери: https://vist.dp.ua/products/servers
