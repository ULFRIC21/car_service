-- Одна команда для phpMyAdmin (база laravel). Создаёт таблицу site_images.
USE `laravel`;

CREATE TABLE IF NOT EXISTS `site_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `group` varchar(32) NOT NULL DEFAULT 'page',
  `slot` varchar(64) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `sort_order` smallint unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_images_group_slot_unique` (`group`, `slot`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `site_images` (`group`, `slot`, `file_path`, `alt`, `sort_order`, `created_at`, `updated_at`) VALUES
('page', 'car', 'glav/slide1.jpg', 'Автосервис', 0, NOW(), NOW()),
('page', 'workshop', 'glav/slide1.jpg', 'Автосервис', 0, NOW(), NOW())
ON DUPLICATE KEY UPDATE `file_path` = VALUES(`file_path`), `updated_at` = NOW();
