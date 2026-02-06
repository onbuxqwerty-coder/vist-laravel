# Звіт про виконану роботу — проект "form"

**Дата:** 30 січня 2026 р.
**Виконавець:** Volodymyr Sukhovoi
**Проект:** form (Laravel Feedback Form Application)
**Репозиторій:** локальний (C:\Users\liqwood\Laragon-Projects\form\)

---

## Використані інструменти та технології

| Категорія | Інструменти |
|---|---|
| Мова програмування | PHP 8.2+ |
| Фреймворк | Laravel 12.0 |
| База даних | MySQL |
| Поштовий сервер | Gmail SMTP (smtp.gmail.com:587, TLS) |
| Збірка фронтенду | Vite 7.0, Tailwind CSS 4.0 |
| Локальний сервер | Laragon |
| Система контролю версій | Git |
| AI-асистент | Claude Code (Claude Opus 4.5) |

---

## Опис проекту

Розроблено з нуля окремий Laravel-додаток для управління зверненнями клієнтів. Додаток дозволяє:

- Створювати звернення через форму (ім'я, email, телефон, тема, повідомлення)
- Переглядати список звернень з пагінацією
- Переглядати деталі окремого звернення
- Редагувати та видаляти звернення
- Додавати коментарі до звернень
- Надсилати email-відповіді через Gmail SMTP

Інтерфейс українською мовою.

---

## Створені файли

### Міграції бази даних (2)

| Файл | Призначення |
|---|---|
| `database/migrations/..._create_appeals_table.php` | Таблиця звернень: date, time, name, email, phone, subject, message |
| `database/migrations/..._create_comments_table.php` | Таблиця коментарів: appeal_id (FK), body |

### Моделі (2)

| Файл | Призначення |
|---|---|
| `app/Models/Appeal.php` | Модель звернення, зв'язок hasMany → Comment |
| `app/Models/Comment.php` | Модель коментаря, зв'язок belongsTo → Appeal |

### Контролери (1)

| Файл | Методи |
|---|---|
| `app/Http/Controllers/AppealController.php` | index, create, store, show, edit, update, destroy, addComment, reply (9 методів) |

### Пошта (1)

| Файл | Призначення |
|---|---|
| `app/Mail/AppealReply.php` | Mailable для email-відповідей клієнтам |

### Views (5)

| Файл | Призначення |
|---|---|
| `resources/views/appeals/create.blade.php` | Форма створення звернення |
| `resources/views/appeals/index.blade.php` | Список звернень з пагінацією (10 на сторінку) |
| `resources/views/appeals/show.blade.php` | Деталі звернення + коментарі + форма відповіді email |
| `resources/views/appeals/edit.blade.php` | Форма редагування звернення |
| `resources/views/emails/appeal-reply.blade.php` | HTML-шаблон email-відповіді |

### Маршрути

| Метод | URL | Дія |
|---|---|---|
| GET | `/` | Форма створення звернення |
| POST | `/appeals` | Збереження звернення |
| GET | `/appeals` | Список звернень |
| GET | `/appeals/{id}` | Деталі звернення |
| GET | `/appeals/{id}/edit` | Форма редагування |
| PUT | `/appeals/{id}` | Оновлення звернення |
| DELETE | `/appeals/{id}` | Видалення звернення |
| POST | `/appeals/{id}/comments` | Додавання коментаря |
| POST | `/appeals/{id}/reply` | Відправка email-відповіді |

### Конфігурація

- Налаштовано `.env` для MySQL та Gmail SMTP
- Налаштовано Vite + Tailwind CSS
- Налаштовано composer scripts: `setup`, `dev`, `test`

---

## Комміти на GitHub

| Хеш | Опис |
|---|---|
| `5a41b15` | Initial commit: Laravel feedback form application |

---

## Підсумок

- Створено повноцінний Laravel-додаток з нуля
- 68 файлів, 11 362 рядки коду
- Реалізовано CRUD для звернень, систему коментарів, email-відповіді
- Налаштовано Gmail SMTP для відправки листів
- Проект став основою для подальшої інтеграції у vist-laravel (Back Office)
