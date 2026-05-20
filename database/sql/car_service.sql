-- =============================================================================
-- Car Service — схема и тестовые данные для MySQL (phpMyAdmin / AMPPS)
-- База из .env: DB_DATABASE=laravel
-- =============================================================================
-- ВАЖНО: если Laravel уже накатил migrate — этот файл для справки/импорта
-- на другой компьютер. Не дублируйте таблицы на существующей БД.
-- =============================================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- Создать базу, если её ещё нет (ошибка #1049 = база не создана)
CREATE DATABASE IF NOT EXISTS `laravel`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

-- Имя как в .env → DB_DATABASE. Если другое — замените laravel везде в файле.
USE `laravel`;

-- -----------------------------------------------------------------------------
-- users (Laravel Auth + роли автосервиса)
-- -----------------------------------------------------------------------------
-- Если таблица users уже есть без phone/role, выполните только ALTER внизу файла.

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'client',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- services — каталог услуг
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `appointments`;
DROP TABLE IF EXISTS `vehicles`;
DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `duration_minutes` smallint unsigned NOT NULL DEFAULT 60,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- vehicles — автомобили клиентов
-- -----------------------------------------------------------------------------
CREATE TABLE `vehicles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `year` smallint unsigned DEFAULT NULL,
  `plate_number` varchar(20) NOT NULL,
  `vin` varchar(17) DEFAULT NULL,
  `mileage` int unsigned DEFAULT NULL,
  `notes` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicles_user_id_foreign` (`user_id`),
  CONSTRAINT `vehicles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- appointments — записи на сервис
-- status: pending | confirmed | in_progress | completed | cancelled
-- -----------------------------------------------------------------------------
CREATE TABLE `appointments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `vehicle_id` bigint unsigned NOT NULL,
  `service_id` bigint unsigned NOT NULL,
  `mechanic_id` bigint unsigned DEFAULT NULL,
  `scheduled_at` datetime NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `client_comment` text,
  `admin_comment` text,
  `price_at_booking` decimal(10,2) DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `appointments_user_id_foreign` (`user_id`),
  KEY `appointments_vehicle_id_foreign` (`vehicle_id`),
  KEY `appointments_service_id_foreign` (`service_id`),
  KEY `appointments_mechanic_id_foreign` (`mechanic_id`),
  CONSTRAINT `appointments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `appointments_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `appointments_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `appointments_mechanic_id_foreign` FOREIGN KEY (`mechanic_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;

-- =============================================================================
-- Тестовые данные (пароль у всех: password)
-- Хэш Laravel: bcrypt('password')
-- =============================================================================

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Администратор', 'admin@car-service.local', '+79000000001', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NOW(), NOW()),
(2, 'Дядя Петя', 'mechanic@car-service.local', '+79000000002', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'mechanic', NOW(), NOW()),
(3, 'Иван Клиент', 'client@car-service.local', '+79000000003', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'client', NOW(), NOW())
ON DUPLICATE KEY UPDATE
  `name` = VALUES(`name`),
  `phone` = VALUES(`phone`),
  `password` = VALUES(`password`),
  `role` = VALUES(`role`),
  `updated_at` = NOW();

INSERT INTO `services` (`id`, `name`, `description`, `price`, `duration_minutes`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Замена масла', 'Масло и фильтр', 3500.00, 60, 1, NOW(), NOW()),
(2, 'Диагностика', 'Компьютерная диагностика', 2000.00, 30, 1, NOW(), NOW()),
(3, 'Замена тормозных колодок', 'Передняя или задняя ось', 4500.00, 90, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE
  `description` = VALUES(`description`),
  `price` = VALUES(`price`),
  `duration_minutes` = VALUES(`duration_minutes`),
  `is_active` = VALUES(`is_active`),
  `updated_at` = NOW();

INSERT INTO `vehicles` (`id`, `user_id`, `brand`, `model`, `year`, `plate_number`, `mileage`, `created_at`, `updated_at`) VALUES
(1, 3, 'Toyota', 'Camry', 2018, 'А123БВ77', 85000, NOW(), NOW())
ON DUPLICATE KEY UPDATE
  `brand` = VALUES(`brand`),
  `model` = VALUES(`model`),
  `updated_at` = NOW();

INSERT INTO `appointments` (`id`, `user_id`, `vehicle_id`, `service_id`, `mechanic_id`, `scheduled_at`, `status`, `client_comment`, `price_at_booking`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 1, NULL, DATE_ADD(NOW(), INTERVAL 2 DAY), 'pending', 'Стук при торможении', 3500.00, NOW(), NOW())
ON DUPLICATE KEY UPDATE
  `status` = VALUES(`status`),
  `scheduled_at` = VALUES(`scheduled_at`),
  `updated_at` = NOW();

-- =============================================================================
-- Если users уже есть БЕЗ phone и role (старый Laravel):
-- =============================================================================
-- ALTER TABLE `users` ADD COLUMN `phone` varchar(20) NULL AFTER `email`;
-- ALTER TABLE `users` ADD COLUMN `role` varchar(20) NOT NULL DEFAULT 'client' AFTER `password`;

-- =============================================================================
-- После импорта этого файла НЕ запускайте сразу php artisan migrate!
-- Сначала импортируйте sync_migrations_after_import.sql (см. database/sql/README.md)
-- =============================================================================
