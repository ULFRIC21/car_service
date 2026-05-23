-- =============================================================================
-- Тех Эксперт — ОДИН файл для phpMyAdmin (вкладка SQL → Выполнить)
-- =============================================================================
-- Перед импортом: в .env должно быть DB_DATABASE=laravel (или замените имя ниже).
-- ВНИМАНИЕ: полностью пересоздаёт базу `laravel` и удаляет все старые данные!
-- После импорта: php artisan migrate НЕ нужен.
--
-- Админ:  admin@car-service.local  /  password
-- URL:    http://127.0.0.1:8000/admin
-- =============================================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

DROP DATABASE IF EXISTS `laravel`;

CREATE DATABASE `laravel`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `laravel`;

-- -----------------------------------------------------------------------------
-- Laravel: служебные таблицы
-- -----------------------------------------------------------------------------

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- users — регистрация + админка (заявки, contacted_at)
-- -----------------------------------------------------------------------------

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `patronymic` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'client',
  `contacted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- services, vehicles, appointments (на будущее / тестовые данные)
-- -----------------------------------------------------------------------------

CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `image_path` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration_minutes` smallint unsigned NOT NULL DEFAULT 60,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `appointments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `vehicle_id` bigint unsigned DEFAULT NULL,
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

CREATE TABLE `site_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `group` varchar(32) NOT NULL DEFAULT 'page',
  `slot` varchar(64) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `sort_order` smallint unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_images_group_slot_unique` (`group`,`slot`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;

-- -----------------------------------------------------------------------------
-- Данные (пароль у всех тестовых: password)
-- -----------------------------------------------------------------------------

INSERT INTO `users` (`id`, `name`, `first_name`, `last_name`, `email`, `phone`, `password`, `role`, `contacted_at`, `created_at`, `updated_at`) VALUES
(1, 'Администратор', 'Админ', 'Системный', 'admin@car-service.local', '8800535353', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NULL, NOW(), NOW()),
(2, 'Механик Петров', 'Петр', 'Петров', 'mechanic@car-service.local', '8800535354', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'mechanic', NULL, NOW(), NOW()),
(3, 'Иван Клиентов', 'Иван', 'Клиентов', 'client@car-service.local', '89001234567', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'client', NULL, NOW(), NOW());

INSERT INTO `services` (`id`, `name`, `description`, `price`, `duration_minutes`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Замена масла', 'Масло и фильтр', 3500.00, 60, 1, NOW(), NOW()),
(2, 'Диагностика', 'Компьютерная диагностика', 2000.00, 30, 1, NOW(), NOW()),
(3, 'Замена тормозных колодок', 'Передняя или задняя ось', 4500.00, 90, 1, NOW(), NOW());

INSERT INTO `vehicles` (`id`, `user_id`, `brand`, `model`, `year`, `plate_number`, `mileage`, `created_at`, `updated_at`) VALUES
(1, 3, 'Toyota', 'Camry', 2018, 'А123БВ18', 85000, NOW(), NOW());

INSERT INTO `appointments` (`id`, `user_id`, `vehicle_id`, `service_id`, `scheduled_at`, `status`, `client_comment`, `price_at_booking`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 1, DATE_ADD(NOW(), INTERVAL 2 DAY), 'pending', 'Тестовая заявка', 3500.00, NOW(), NOW());

-- -----------------------------------------------------------------------------
-- Пометить миграции как выполненные (чтобы migrate не ломал БД)
-- -----------------------------------------------------------------------------

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2019_08_19_000000_create_failed_jobs_table', 1),
('2019_12_14_000001_create_personal_access_tokens_table', 1),
('2026_05_18_000001_add_phone_and_role_to_users_table', 1),
('2026_05_18_000002_create_services_table', 1),
('2026_05_18_000003_create_vehicles_table', 1),
('2026_05_18_000004_create_appointments_table', 1),
('2026_05_20_000001_add_name_parts_to_users_table', 1),
('2026_05_20_000002_make_vehicle_id_nullable_on_appointments', 1),
('2026_05_22_120000_add_image_path_to_services_table', 1),
('2026_05_22_120001_create_site_images_table', 1),
('2026_05_23_000001_add_contacted_at_to_users_table', 1);

-- =============================================================================
-- Готово. Проверка: откройте сайт, /register, /admin
-- =============================================================================
