-- Выполните в phpMyAdmin (база laravel), если регистрация пишет "Unknown column first_name"
-- Если колонка уже есть — пропустите соответствующую строку (ошибка Duplicate column).

USE `laravel`;

ALTER TABLE `users` ADD COLUMN `first_name` varchar(100) NULL AFTER `name`;
ALTER TABLE `users` ADD COLUMN `last_name` varchar(100) NULL AFTER `first_name`;
ALTER TABLE `users` ADD COLUMN `patronymic` varchar(100) NULL AFTER `last_name`;

-- Если нет phone и role (старый дамп Laravel):
-- ALTER TABLE `users` ADD COLUMN `phone` varchar(20) NULL AFTER `email`;
-- ALTER TABLE `users` ADD COLUMN `role` varchar(20) NOT NULL DEFAULT 'client' AFTER `password`;

INSERT IGNORE INTO `migrations` (`migration`, `batch`) VALUES
('2026_05_20_000001_add_name_parts_to_users_table', 1);
