-- Запустите ПОСЛЕ импорта car_service.sql, если получаете ошибку
-- "Table 'users' already exists" при php artisan migrate
--
-- Помечает в таблице migrations уже существующие таблицы,
-- чтобы Laravel не создавал их повторно.

USE `laravel`;

INSERT IGNORE INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2026_05_18_000001_add_phone_and_role_to_users_table', 1),
('2026_05_18_000002_create_services_table', 1),
('2026_05_18_000003_create_vehicles_table', 1),
('2026_05_18_000004_create_appointments_table', 1),
('2026_05_20_000001_add_name_parts_to_users_table', 1),
('2026_05_23_000001_add_contacted_at_to_users_table', 1);
