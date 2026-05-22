# SQL для проекта Car Service

## Файлы

| Файл | Назначение |
|------|------------|
| `car_service.sql` | Таблицы `services`, `vehicles`, `appointments` + тестовые пользователи и данные |

## Как импортировать в phpMyAdmin

**Вариант A (проще):** слева один раз кликните базу **`laravel`**, потом **Импорт** → `car_service.sql`.

**Вариант B:** импорт с главной страницы phpMyAdmin — в файле уже есть `USE laravel;` (строка после комментариев). Если ваша БД называется иначе, откройте `.env` и замените `laravel` в `USE \`...\`;` в SQL-файле.

Ошибка **#1046 База данных не выбрана** = не выбрана БД слева и в SQL был закомментирован `USE` (исправлено в актуальной версии файла).

## Ошибка #1049 «Неизвестная база данных laravel»

В актуальном `car_service.sql` в начале есть `CREATE DATABASE IF NOT EXISTS laravel` — импортируйте файл снова с главной phpMyAdmin или после выбора любой базы.

Либо вручную: phpMyAdmin → **Создать БД** → имя `laravel` → utf8mb4_unicode_ci.

## Ошибка migrate: «Table users already exists»

Так бывает, если вы **сначала импортировали** `car_service.sql` (таблицы уже есть), а потом запустили `php artisan migrate` (Laravel снова хочет создать `users`).

**Исправление (сохранить данные из SQL):**

1. phpMyAdmin → база `laravel` → **Импорт** → файл `sync_migrations_after_import.sql`
2. В терминале:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```
   Добавятся только служебные таблицы Laravel (`password_resets`, `failed_jobs`, …).

**Или с нуля (удалит все данные в БД):**

```bash
php artisan migrate:fresh --seed
```

После этого SQL-импорт не нужен.

## Если Laravel уже работает (без SQL-импорта)

```bash
php artisan migrate
php artisan db:seed
```

SQL нужен, чтобы **передать структуру одногруппникам** или развернуть БД без Artisan.

## Тестовые логины (после импорта)

| Email | Пароль | Роль |
|-------|--------|------|
| admin@car-service.local | password | admin |
| mechanic@car-service.local | password | mechanic |
| client@car-service.local | password | client |

## Внимание

- Импорт с `DROP TABLE` для `services`, `vehicles`, `appointments` **удалит данные** в этих таблицах.
- Таблицы Laravel (`migrations`, `password_resets`, …) этот файл не трогает.
