-- Пути к фото в БД (файлы лежат в public/images/)
-- Выполните после миграций: php artisan migrate

USE `laravel`;

-- Услуги
ALTER TABLE `services`
  ADD COLUMN IF NOT EXISTS `image_path` VARCHAR(255) NULL AFTER `description`;

UPDATE `services` SET `image_path` = 'Замена масла.jpg' WHERE `name` = 'Замена масла';
UPDATE `services` SET `image_path` = 'Диагностика.png' WHERE `name` = 'Диагностика';
UPDATE `services` SET `image_path` = 'Замена тормозных колодок.png' WHERE `name` = 'Замена тормозных колодок';

-- Картинки сайта (страница + галерея)
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
('page', 'hero', 'Бокс автосервиса АвтоМастер.jpg', NULL, 0, NOW(), NOW()),
('page', 'mechanic', 'Мастер в автосервисе.jpg', NULL, 0, NOW(), NOW()),
('page', 'engine', 'Ремонт двигателя.jpg', NULL, 0, NOW(), NOW()),
('page', 'brakes', 'Тормозная система.jpg', NULL, 0, NOW(), NOW()),
('page', 'workshop', 'Гараж.jpg', NULL, 0, NOW(), NOW()),
('page', 'car', 'Автомобиль после обслуживания.jpg', NULL, 0, NOW(), NOW()),
('page', 'tools', 'Инструменты мастера.jpg', NULL, 0, NOW(), NOW()),
('page', 'diagnostic', 'Диагностика.png', NULL, 0, NOW(), NOW()),
('page', 'oil', 'Замена масла.jpg', NULL, 0, NOW(), NOW()),
('gallery', 'item_0', 'Бокс автосервиса АвтоМастер_1.jpg', 'Автосервис, бокс', 0, NOW(), NOW()),
('gallery', 'item_1', 'Двигатель, ремонт.jpg', 'Двигатель, ремонт', 1, NOW(), NOW()),
('gallery', 'item_2', 'Тормозная система.jpg', 'Тормозная система', 2, NOW(), NOW()),
('gallery', 'item_3', 'Инструменты мастера.jpg', 'Инструменты мастера', 3, NOW(), NOW()),
('gallery', 'item_4', 'Мастер за работой.jpg', 'Мастер за работой', 4, NOW(), NOW()),
('gallery', 'item_5', 'Автомобиль после обслуживания.jpg', 'Автомобиль после обслуживания', 5, NOW(), NOW())
ON DUPLICATE KEY UPDATE
  `file_path` = VALUES(`file_path`),
  `alt` = VALUES(`alt`),
  `sort_order` = VALUES(`sort_order`),
  `updated_at` = NOW();
