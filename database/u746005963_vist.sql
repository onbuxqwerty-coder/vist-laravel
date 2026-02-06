-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Січ 23 2026 р., 22:45
-- Версія сервера: 11.8.3-MariaDB-log
-- Версія PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `u746005963_vist`
--

-- --------------------------------------------------------

--
-- Структура таблиці `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_01_09_000001_create_products_table', 1),
(2, '2025_01_09_000002_create_product_images_table', 1),
(3, '2025_01_09_000003_create_product_specs_table', 1),
(4, '2025_01_09_000004_create_product_configurations_table', 1),
(5, '2025_01_09_000005_create_product_configuration_specs_table', 1),
(6, '2025_01_09_000006_create_product_documents_table', 1),
(7, '2025_01_09_000007_create_product_related_table', 1),
(8, '2025_01_09_000008_create_product_seo_table', 1),
(9, '2026_01_20_133701_create_users_table', 2);

-- --------------------------------------------------------

--
-- Структура таблиці `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `category` enum('workstation','server','ipc','ups') DEFAULT 'workstation',
  `price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `currency` char(3) NOT NULL DEFAULT 'UAH',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `status` varchar(50) DEFAULT 'in_stock'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `products`
--

INSERT INTO `products` (`id`, `title`, `subtitle`, `slug`, `image`, `description`, `category`, `price`, `currency`, `is_active`, `created_at`, `updated_at`, `status`) VALUES
(5, 'N100 / 8GB DDR4 / 240GB SSD / mITX / No OS', NULL, 'n100-8gb-ddr4-240gb-ssd-mitx-no-os', NULL, '', 'workstation', 12699.00, 'UAH', 1, '2025-12-16 12:13:00', '2025-12-18 12:13:49', 'in_stock'),
(6, 'i3-13100 / 16GB DDR5 / 500GB SSD / 400W / No OS', NULL, 'i3-13100-16gb-ddr5-500gb-ssd-400w-no-os', NULL, '', 'workstation', 24999.00, 'UAH', 1, '2025-12-16 12:13:00', '2025-12-18 12:21:20', 'in_stock'),
(7, 'i5-13400 / 32GB DDR5 / RTX 5050 8GB / 2TB SSD / 500W / No OS', NULL, 'i5-13400-32gb-ddr5-rtx5050-2tb-ssd-500w-no-os', NULL, '', 'workstation', 50999.00, 'UAH', 1, '2025-12-16 12:13:00', '2025-12-18 12:14:08', 'in_stock'),
(8, 'DELL T440 16SFF/2 x Intel XEON Silver 8 Core 4110 / DDR4-32GB ECC/ HBA330 MINICARD 12GBPowerEdge Gen13', NULL, 'dell-t440-16sff-2-x-intel-xeon-silver-8-core-4110-ddr4-32gb-ecc-hba330-minicard-12gbpoweredge-gen13', NULL, '', 'server', 45791.00, 'UAH', 1, '2025-12-17 09:09:26', '2025-12-18 10:35:39', 'in_stock'),
(9, 'Сервер Dell PowerEdge R720 2U Rack / 2x Intel Xeon E5-2660 v2 (10 (20) ядер по 2.2 - 3.0 GHz) / 128 GB DDR3 / 2x 450 GB HDD (SAS) / iRMC S3 Graphics / Два блоки живлення 750W', NULL, 'server-dell-poweredge-r720-2u-rack', NULL, '', 'server', 20158.00, 'UAH', 1, '2025-12-18 12:28:35', NULL, 'in_stock'),
(10, 'Сервер HP ProLiant DL380 Gen9 (4 LFF) 2U Rack / 2x Intel Xeon E5-2680 v4 (14 (28) ядра по 2.4 - 3.3 GHz) / 128 GB DDR4 / 2x 4000 GB HDD (SAS) / RAID HP Smart Array P440ar / 2x 500W', NULL, 'server-hp-proliant-dl380-gen9-4-lff-2u-rack-2x-intel-xeon-e5-2680-v4-14-28-yadra-po-24-33-ghz-128-gb-ddr4-2x-4000-gb-hdd-sas-raid-hp-smart-array-p440ar-2x-500w', NULL, '', 'server', 45000.00, 'UAH', 1, '2025-12-18 12:29:58', NULL, 'in_stock'),
(11, 'Modular Embedded Computer with Intel® Core 12/13/14th-Gen Processor 2.5GbE LAN', NULL, 'modular-embedded-computer-with-intel-core-12-13-14th-gen-processor-25gbe-lan', NULL, '', 'ipc', 60000.00, 'UAH', 1, '2025-12-18 12:42:42', '2026-01-20 14:31:03', 'in_stock');

-- --------------------------------------------------------

--
-- Структура таблиці `product_images`
--

CREATE TABLE `product_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `alt_text` varchar(255) DEFAULT NULL,
  `is_primary` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `sort_order`, `alt_text`, `is_primary`) VALUES
(25, 8, 'img/hardware/servers/dell-t440-16sff-2-x-intel-xeon-silver-8-core-4110-ddr4-32gb-ecc-hba330-minicard-12gbpoweredge-gen13_8_1766054139_1.webp', 1, 'DELL T440 16SFF/2 x Intel XEON Silver 8 Core 4110 / DDR4-32GB ECC/ HBA330 MINICARD 12GBPowerEdge Gen13', 1),
(26, 8, 'img/hardware/servers/dell-t440-16sff-2-x-intel-xeon-silver-8-core-4110-ddr4-32gb-ecc-hba330-minicard-12gbpoweredge-gen13_8_1766054139_2.webp', 2, 'DELL T440 16SFF/2 x Intel XEON Silver 8 Core 4110 / DDR4-32GB ECC/ HBA330 MINICARD 12GBPowerEdge Gen13', 0),
(27, 8, 'img/hardware/servers/dell-t440-16sff-2-x-intel-xeon-silver-8-core-4110-ddr4-32gb-ecc-hba330-minicard-12gbpoweredge-gen13_8_5.webp', 3, 'DELL T440 16SFF/2 x Intel XEON Silver 8 Core 4110 / DDR4-32GB ECC/ HBA330 MINICARD 12GBPowerEdge Gen13', 0),
(35, 5, 'img/hardware/workstations/n100-8gb-ddr4-240gb-ssd-mitx-no-os_5_1.webp', 1, 'N100 / 8GB DDR4 / 240GB SSD / mITX / No OS', 1),
(36, 5, 'img/hardware/workstations/n100-8gb-ddr4-240gb-ssd-mitx-no-os_5_3.webp', 2, 'N100 / 8GB DDR4 / 240GB SSD / mITX / No OS', 0),
(37, 5, 'img/hardware/workstations/n100-8gb-ddr4-240gb-ssd-mitx-no-os_5_5.webp', 3, 'N100 / 8GB DDR4 / 240GB SSD / mITX / No OS', 0),
(38, 7, 'img/hardware/workstations/i5-13400-32gb-ddr5-rtx5050-2tb-ssd-500w-no-os_7_1.webp', 1, 'i5-13400 / 32GB DDR5 / RTX 5050 8GB / 2TB SSD / 500W / No OS', 0),
(39, 7, 'img/hardware/workstations/i5-13400-32gb-ddr5-rtx5050-2tb-ssd-500w-no-os_7_3.webp', 2, 'i5-13400 / 32GB DDR5 / RTX 5050 8GB / 2TB SSD / 500W / No OS', 0),
(40, 7, 'img/hardware/workstations/i5-13400-32gb-ddr5-rtx5050-2tb-ssd-500w-no-os_7_5.webp', 3, 'i5-13400 / 32GB DDR5 / RTX 5050 8GB / 2TB SSD / 500W / No OS', 1),
(41, 6, 'img/hardware/workstations/i3-13100-16gb-ddr5-500gb-ssd-400w-no-os_6_1.webp', 1, 'i3-13100 / 16GB DDR5 / 500GB SSD / 400W / No OS', 1),
(42, 6, 'img/hardware/workstations/i3-13100-16gb-ddr5-500gb-ssd-400w-no-os_6_3.webp', 2, 'i3-13100 / 16GB DDR5 / 500GB SSD / 400W / No OS', 0),
(43, 6, 'img/hardware/workstations/i3-13100-16gb-ddr5-500gb-ssd-400w-no-os_6_5.webp', 3, 'i3-13100 / 16GB DDR5 / 500GB SSD / 400W / No OS', 0),
(44, 9, 'img/hardware/servers/server-dell-poweredge-r720-2u-rack_9_1.webp', 1, 'Сервер Dell PowerEdge R720 2U Rack / 2x Intel Xeon E5-2660 v2 (10 (20) ядер по 2.2 - 3.0 GHz) / 128 GB DDR3 / 2x 450 GB HDD (SAS) / iRMC S3 Graphics / Два блоки живлення 750W', 1),
(45, 9, 'img/hardware/servers/server-dell-poweredge-r720-2u-rack_9_2.webp', 2, 'Сервер Dell PowerEdge R720 2U Rack / 2x Intel Xeon E5-2660 v2 (10 (20) ядер по 2.2 - 3.0 GHz) / 128 GB DDR3 / 2x 450 GB HDD (SAS) / iRMC S3 Graphics / Два блоки живлення 750W', 0),
(46, 9, 'img/hardware/servers/server-dell-poweredge-r720-2u-rack_9_3.webp', 3, 'Сервер Dell PowerEdge R720 2U Rack / 2x Intel Xeon E5-2660 v2 (10 (20) ядер по 2.2 - 3.0 GHz) / 128 GB DDR3 / 2x 450 GB HDD (SAS) / iRMC S3 Graphics / Два блоки живлення 750W', 0),
(47, 10, 'img/hardware/servers/server-hp-proliant-dl380-gen9-4-lff-2u-rack-2x-intel-xeon-e5-2680-v4-14-28-yadra-po-24-33-ghz-128-gb-ddr4-2x-4000-gb-hdd-sas-raid-hp-smart-array-p440ar-2x-500w_10_1.webp', 1, 'Сервер HP ProLiant DL380 Gen9 (4 LFF) 2U Rack / 2x Intel Xeon E5-2680 v4 (14 (28) ядра по 2.4 - 3.3 GHz) / 128 GB DDR4 / 2x 4000 GB HDD (SAS) / RAID HP Smart Array P440ar / 2x 500W', 1),
(48, 10, 'img/hardware/servers/server-hp-proliant-dl380-gen9-4-lff-2u-rack-2x-intel-xeon-e5-2680-v4-14-28-yadra-po-24-33-ghz-128-gb-ddr4-2x-4000-gb-hdd-sas-raid-hp-smart-array-p440ar-2x-500w_10_2.webp', 2, 'Сервер HP ProLiant DL380 Gen9 (4 LFF) 2U Rack / 2x Intel Xeon E5-2680 v4 (14 (28) ядра по 2.4 - 3.3 GHz) / 128 GB DDR4 / 2x 4000 GB HDD (SAS) / RAID HP Smart Array P440ar / 2x 500W', 0),
(49, 10, 'img/hardware/servers/server-hp-proliant-dl380-gen9-4-lff-2u-rack-2x-intel-xeon-e5-2680-v4-14-28-yadra-po-24-33-ghz-128-gb-ddr4-2x-4000-gb-hdd-sas-raid-hp-smart-array-p440ar-2x-500w_10_3.webp', 3, 'Сервер HP ProLiant DL380 Gen9 (4 LFF) 2U Rack / 2x Intel Xeon E5-2680 v4 (14 (28) ядра по 2.4 - 3.3 GHz) / 128 GB DDR4 / 2x 4000 GB HDD (SAS) / RAID HP Smart Array P440ar / 2x 500W', 0),
(57, 11, 'img/hardware/industrial/modular-embedded-computer-with-intel-core-12-13-14th-gen-processor-25gbe-lan_11_1.webp', 1, 'Modular Embedded Computer with Intel® Core 12/13/14th-Gen Processor 2.5GbE LAN', 1),
(58, 11, 'img/hardware/industrial/modular-embedded-computer-with-intel-core-12-13-14th-gen-processor-25gbe-lan_11_3.webp', 2, 'Modular Embedded Computer with Intel® Core 12/13/14th-Gen Processor 2.5GbE LAN', 0),
(59, 11, 'img/hardware/industrial/modular-embedded-computer-with-intel-core-12-13-14th-gen-processor-25gbe-lan_11_5.webp', 3, 'Modular Embedded Computer with Intel® Core 12/13/14th-Gen Processor 2.5GbE LAN', 0);

-- --------------------------------------------------------

--
-- Структура таблиці `product_prices`
--

CREATE TABLE `product_prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `currency` char(3) NOT NULL DEFAULT 'UAH',
  `price_type` enum('from','base','promo','old') NOT NULL DEFAULT 'base',
  `valid_from` datetime DEFAULT NULL,
  `valid_to` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `product_prices`
--

INSERT INTO `product_prices` (`id`, `product_id`, `price`, `currency`, `price_type`, `valid_from`, `valid_to`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 5, 12699.00, 'UAH', 'base', NULL, NULL, 1, '2026-01-21 17:06:38', '2026-01-21 17:06:38'),
(2, 6, 24999.00, 'UAH', 'base', NULL, NULL, 1, '2026-01-21 17:06:38', '2026-01-21 17:06:38'),
(3, 7, 50999.00, 'UAH', 'base', NULL, NULL, 1, '2026-01-21 17:06:38', '2026-01-21 17:06:38'),
(4, 8, 45791.00, 'UAH', 'base', NULL, NULL, 1, '2026-01-21 17:06:38', '2026-01-21 17:06:38'),
(5, 9, 20158.00, 'UAH', 'base', NULL, NULL, 1, '2026-01-21 17:06:38', '2026-01-21 17:06:38'),
(6, 10, 45000.00, 'UAH', 'base', NULL, NULL, 1, '2026-01-21 17:06:38', '2026-01-21 17:06:38'),
(7, 11, 60000.00, 'UAH', 'base', NULL, NULL, 1, '2026-01-21 17:06:38', '2026-01-21 17:06:38'),
(8, 5, 10999.00, 'UAH', 'from', NULL, NULL, 1, '2026-01-21 17:06:53', '2026-01-21 17:06:53'),
(9, 6, 22999.00, 'UAH', 'from', NULL, NULL, 1, '2026-01-21 17:06:53', '2026-01-21 17:06:53'),
(10, 7, 48999.00, 'UAH', 'from', NULL, NULL, 1, '2026-01-21 17:06:53', '2026-01-21 17:06:53'),
(11, 8, 52000.00, 'UAH', 'old', '2025-12-01 00:00:00', '2026-02-28 23:59:59', 1, '2026-01-21 17:07:11', '2026-01-21 17:07:11'),
(12, 8, 45791.00, 'UAH', 'promo', '2025-12-01 00:00:00', '2026-02-28 23:59:59', 1, '2026-01-21 17:07:11', '2026-01-21 17:07:11'),
(13, 9, 24500.00, 'UAH', 'old', '2026-01-10 00:00:00', '2026-03-31 23:59:59', 1, '2026-01-21 17:07:38', '2026-01-21 17:07:38'),
(14, 9, 20158.00, 'UAH', 'promo', '2026-01-10 00:00:00', '2026-03-31 23:59:59', 1, '2026-01-21 17:07:38', '2026-01-21 17:07:38'),
(15, 11, 68000.00, 'UAH', 'old', '2026-01-15 00:00:00', '2026-02-28 23:59:59', 1, '2026-01-21 17:07:55', '2026-01-21 17:07:55'),
(16, 11, 60000.00, 'UAH', 'promo', '2026-01-15 00:00:00', '2026-02-28 23:59:59', 1, '2026-01-21 17:07:55', '2026-01-21 17:07:55');

-- --------------------------------------------------------

--
-- Структура таблиці `product_specs`
--

CREATE TABLE `product_specs` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `spec_key` varchar(100) NOT NULL,
  `spec_value` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `product_specs`
--

INSERT INTO `product_specs` (`id`, `product_id`, `spec_key`, `spec_value`, `sort_order`) VALUES
(182, 8, 'CPU', '2 × Intel Xeon Silver 4110', 10),
(183, 8, 'CPU_Type', '8-Core, 2.10–3.00 GHz, DDR4-2400, 85 W', 20),
(184, 8, 'RAM', '32 GB', 30),
(185, 8, 'RAM_Type', 'DDR4 ECC Registered 2400 MHz', 40),
(186, 8, 'Controller', 'DELL HBA330', 50),
(187, 8, 'Controller_Type', 'HBA SAS 12Gb/s PCIe 3.0 MiniCard', 60),
(188, 8, 'PSU', '2 шт. Блок живлення DELL PowerEdge Gen13, Gen14 750W', 70),
(189, 8, 'OS', 'No OS', 80),
(190, 8, 'Management', 'iDRAC 9 Enterprise', 90),
(191, 8, 'Management_Type', 'Remote Management, PowerEdge x40 series', 100),
(248, 5, 'Device_Class', 'Industrial PC', 10),
(249, 5, 'CPU', 'Intel N100', 20),
(250, 5, 'RAM', '8 GB', 30),
(251, 5, 'RAM_Type', 'DDR4', 40),
(252, 5, 'Storage', '240 GB', 50),
(253, 5, 'Storage_Type', 'SSD', 60),
(254, 5, 'Form_Factor', 'mITX', 70),
(255, 5, 'OS', 'No OS', 80),
(256, 7, 'Device_Class', 'Workstation', 10),
(257, 7, 'CPU', 'Intel Core i5-13400', 20),
(258, 7, 'RAM', '32 GB', 30),
(259, 7, 'RAM_Type', 'DDR5', 40),
(260, 7, 'GPU', 'RTX 5050', 50),
(261, 7, 'GPU_VRAM', '8 Gb', 60),
(262, 7, 'Storage', '2 TB', 70),
(263, 7, 'Storage_Type', 'SSD', 80),
(264, 7, 'PSU', '500 W', 90),
(265, 7, 'OS', 'No OS', 100),
(266, 6, 'Device_Class', 'Workstation', 10),
(267, 6, 'CPU', 'Intel Core i3-13100', 20),
(268, 6, 'RAM', '16 GB', 30),
(269, 6, 'RAM_Type', 'DDR5', 40),
(270, 6, 'Storage', '500 GB', 50),
(271, 6, 'Storage_Type', 'SSD', 60),
(272, 6, 'PSU', '400 W', 70),
(273, 6, 'OS', 'No OS', 80);

-- --------------------------------------------------------

--
-- Структура таблиці `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Головний адміністратор', 'admin@vist.net.ua', NULL, '$2y$12$0k8ywuSOFoXVi4qSAbKstOff9731471YTYe54GupoDvFBuAokmfLS', NULL, '2026-01-20 13:46:05', '2026-01-20 15:05:24'),
(2, 'Менеджер', 'info@vist.net.ua', NULL, '$2y$10$SL6L2M5mE6GzM7A7/xJd8e26cQSKKOMzWmYlMgYr.6itheTt3KOd6', NULL, '2026-01-20 13:46:06', '2026-01-20 14:09:37'),
(3, 'Директор', 'valery.litvinov@vist.net.ua', NULL, '$2y$10$0vvYiHWd.cLP7hlMMD1.mOyc9fNkMGM5P..JEWeFIfB45/OPSNBgS', NULL, '2026-01-20 13:46:06', '2026-01-20 14:09:37');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Індекси таблиці `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_active` (`is_active`);

--
-- Індекси таблиці `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_product` (`product_id`);

--
-- Індекси таблиці `product_prices`
--
ALTER TABLE `product_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_product_price` (`product_id`),
  ADD KEY `idx_price_type` (`price_type`),
  ADD KEY `idx_active` (`is_active`);

--
-- Індекси таблиці `product_specs`
--
ALTER TABLE `product_specs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_product_spec` (`product_id`,`spec_key`),
  ADD KEY `idx_product` (`product_id`),
  ADD KEY `idx_specs_key_value` (`spec_key`,`spec_value`);

--
-- Індекси таблиці `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблиці `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблиці `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT для таблиці `product_prices`
--
ALTER TABLE `product_prices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблиці `product_specs`
--
ALTER TABLE `product_specs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=274;

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `fk_images_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `product_prices`
--
ALTER TABLE `product_prices`
  ADD CONSTRAINT `fk_price_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `product_specs`
--
ALTER TABLE `product_specs`
  ADD CONSTRAINT `fk_specs_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
