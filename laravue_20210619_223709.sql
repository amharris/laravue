-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------


-- CREATE TABLE "rewards" --------------------------------------
CREATE TABLE `rewards`( 
	`id` BigInt( 20 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`name` VarChar( 191 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	`point_min` Int( 11 ) NOT NULL,
	`created_at` Timestamp NULL DEFAULT NULL,
	`updated_at` Timestamp NULL DEFAULT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 6;
-- -------------------------------------------------------------


-- CREATE TABLE "transaction_bag_items" ------------------------
CREATE TABLE `transaction_bag_items`( 
	`id` BigInt( 20 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`item_id` BigInt( 20 ) UNSIGNED NOT NULL,
	`bag_id` BigInt( 20 ) UNSIGNED NOT NULL,
	`created_at` DateTime NOT NULL DEFAULT current_timestamp(),
	`updated_at` DateTime NULL DEFAULT NULL,
	`qty` Int( 11 ) NOT NULL DEFAULT 1,
	`total_price` Decimal( 8, 2 ) NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = latin1
COLLATE = latin1_swedish_ci
ENGINE = InnoDB
AUTO_INCREMENT = 19;
-- -------------------------------------------------------------


-- CREATE TABLE "transaction_details" --------------------------
CREATE TABLE `transaction_details`( 
	`id` BigInt( 20 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`trx_id` BigInt( 20 ) UNSIGNED NOT NULL,
	`item_id` BigInt( 20 ) UNSIGNED NOT NULL,
	`qty` Int( 11 ) NOT NULL,
	`price` Decimal( 8, 2 ) NOT NULL,
	`total_price` Decimal( 8, 2 ) NOT NULL,
	`created_at` Timestamp NULL DEFAULT NULL,
	`updated_at` Timestamp NULL DEFAULT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 17;
-- -------------------------------------------------------------


-- CREATE TABLE "personal_access_tokens" -----------------------
CREATE TABLE `personal_access_tokens`( 
	`id` BigInt( 20 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`tokenable_type` VarChar( 191 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	`tokenable_id` BigInt( 20 ) UNSIGNED NOT NULL,
	`name` VarChar( 191 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	`token` VarChar( 64 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	`abilities` Text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
	`last_used_at` Timestamp NULL DEFAULT NULL,
	`created_at` Timestamp NULL DEFAULT NULL,
	`updated_at` Timestamp NULL DEFAULT NULL,
	PRIMARY KEY ( `id` ),
	CONSTRAINT `personal_access_tokens_token_unique` UNIQUE( `token` ) )
CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------


-- CREATE TABLE "failed_jobs" ----------------------------------
CREATE TABLE `failed_jobs`( 
	`id` BigInt( 20 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`uuid` VarChar( 191 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	`connection` Text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	`queue` Text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	`payload` LongText CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	`exception` LongText CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	`failed_at` Timestamp NOT NULL DEFAULT current_timestamp(),
	PRIMARY KEY ( `id` ),
	CONSTRAINT `failed_jobs_uuid_unique` UNIQUE( `uuid` ) )
CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------


-- CREATE TABLE "transaction_items" ----------------------------
CREATE TABLE `transaction_items`( 
	`id` BigInt( 20 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`name` VarChar( 191 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	`price` Decimal( 8, 2 ) NOT NULL,
	`description` VarChar( 191 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
	`created_at` Timestamp NULL DEFAULT NULL,
	`updated_at` Timestamp NULL DEFAULT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 6;
-- -------------------------------------------------------------


-- CREATE TABLE "reward_redeems" -------------------------------
CREATE TABLE `reward_redeems`( 
	`id` BigInt( 20 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`reward_id` BigInt( 20 ) UNSIGNED NOT NULL,
	`user_id` BigInt( 20 ) UNSIGNED NOT NULL,
	`created_at` Timestamp NULL DEFAULT NULL,
	`updated_at` Timestamp NULL DEFAULT NULL,
	`by_admin` TinyInt( 1 ) NOT NULL DEFAULT 0,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 8;
-- -------------------------------------------------------------


-- CREATE TABLE "transactions" ---------------------------------
CREATE TABLE `transactions`( 
	`id` BigInt( 20 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`user_id` BigInt( 20 ) UNSIGNED NOT NULL,
	`status` VarChar( 191 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	`total_payment` Decimal( 8, 2 ) NOT NULL,
	`created_at` Timestamp NULL DEFAULT NULL,
	`updated_at` Timestamp NULL DEFAULT NULL,
	`reference_id` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	`point_id` BigInt( 20 ) UNSIGNED NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 14;
-- -------------------------------------------------------------


-- CREATE TABLE "password_resets" ------------------------------
CREATE TABLE `password_resets`( 
	`email` VarChar( 191 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	`token` VarChar( 191 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	`created_at` Timestamp NULL DEFAULT NULL )
CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci
ENGINE = InnoDB;
-- -------------------------------------------------------------


-- CREATE TABLE "transaction_bags" -----------------------------
CREATE TABLE `transaction_bags`( 
	`id` BigInt( 20 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`user_id` BigInt( 20 ) UNSIGNED NOT NULL,
	`created_at` DateTime NOT NULL DEFAULT current_timestamp(),
	`updated_at` DateTime NULL DEFAULT NULL,
	`total_payment` Decimal( 8, 2 ) NOT NULL,
	`submitted` TinyInt( 1 ) NOT NULL DEFAULT 0,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = latin1
COLLATE = latin1_swedish_ci
ENGINE = InnoDB
AUTO_INCREMENT = 14;
-- -------------------------------------------------------------


-- CREATE TABLE "reward_points" --------------------------------
CREATE TABLE `reward_points`( 
	`id` BigInt( 20 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`rule_name` VarChar( 191 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	`rate` Int( 11 ) NOT NULL DEFAULT 1,
	`point` Int( 11 ) NOT NULL,
	`created_at` Timestamp NULL DEFAULT NULL,
	`updated_at` Timestamp NULL DEFAULT NULL,
	`type` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'rate',
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 4;
-- -------------------------------------------------------------


-- CREATE TABLE "migrations" -----------------------------------
CREATE TABLE `migrations`( 
	`id` Int( 10 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`migration` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	`batch` Int( 11 ) NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 24;
-- -------------------------------------------------------------


-- CREATE TABLE "users" ----------------------------------------
CREATE TABLE `users`( 
	`id` BigInt( 20 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`name` VarChar( 191 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	`email` VarChar( 191 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	`email_verified_at` Timestamp NULL DEFAULT NULL,
	`is_admin` TinyInt( 1 ) NULL DEFAULT NULL,
	`password` VarChar( 191 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	`remember_token` VarChar( 100 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
	`created_at` Timestamp NULL DEFAULT NULL,
	`updated_at` Timestamp NULL DEFAULT NULL,
	`points` Int( 11 ) NULL DEFAULT NULL,
	PRIMARY KEY ( `id` ),
	CONSTRAINT `users_email_unique` UNIQUE( `email` ) )
CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 9;
-- -------------------------------------------------------------


-- Dump data of "rewards" ----------------------------------
BEGIN;

INSERT INTO `rewards`(`id`,`name`,`point_min`,`created_at`,`updated_at`) VALUES 
( '1', 'Hadiah Utama', '100', '2021-06-13 10:58:13', NULL ),
( '2', 'Hadiah Kedua', '50', '2021-06-13 10:58:13', NULL ),
( '3', 'Hadiah Ketiga', '25', '2021-06-13 10:58:13', NULL ),
( '4', 'Hadiah Keempat', '10', '2021-06-13 10:58:13', NULL ),
( '5', 'Hadiah Kelima', '5', '2021-06-13 10:58:13', NULL );
COMMIT;
-- ---------------------------------------------------------


-- Dump data of "transaction_bag_items" --------------------
BEGIN;

INSERT INTO `transaction_bag_items`(`id`,`item_id`,`bag_id`,`created_at`,`updated_at`,`qty`,`total_price`) VALUES 
( '1', '2', '1', '2021-06-16 19:41:59', '2021-06-16 19:41:59', '1', '50000.00' ),
( '2', '5', '4', '2021-06-17 09:22:27', NULL, '1', '150000.00' ),
( '3', '4', '4', '2021-06-17 09:29:50', NULL, '1', '250000.00' ),
( '7', '4', '2', '2021-06-17 09:40:50', NULL, '1', '250000.00' ),
( '9', '2', '2', '2021-06-17 09:42:17', NULL, '2', '100000.00' ),
( '10', '4', '8', '2021-06-18 04:49:44', NULL, '1', '250000.00' ),
( '11', '3', '3', '2021-06-18 04:51:25', NULL, '1', '75000.00' ),
( '12', '3', '6', '2021-06-18 04:58:25', NULL, '2', '150000.00' ),
( '13', '4', '13', '2021-06-18 04:58:46', NULL, '1', '250000.00' ),
( '14', '2', '7', '2021-06-18 06:43:11', NULL, '1', '50000.00' ),
( '15', '1', '7', '2021-06-18 06:43:23', NULL, '1', '125000.00' ),
( '16', '1', '9', '2021-06-18 08:19:14', NULL, '1', '125000.00' ),
( '17', '2', '10', '2021-06-18 08:21:39', NULL, '3', '150000.00' ),
( '18', '5', '11', '2021-06-18 11:36:11', NULL, '1', '150000.00' ),
( '19', '1', '14', '2021-06-19 15:18:30', NULL, '1', '125000.00' );
COMMIT;
-- ---------------------------------------------------------


-- Dump data of "transaction_details" ----------------------
BEGIN;

INSERT INTO `transaction_details`(`id`,`trx_id`,`item_id`,`qty`,`price`,`total_price`,`created_at`,`updated_at`) VALUES 
( '1', '1', '2', '1', '50000.00', '50000.00', '2021-06-17 04:55:28', '2021-06-17 04:55:28' ),
( '2', '2', '5', '1', '150000.00', '150000.00', '2021-06-17 09:30:09', '2021-06-17 09:30:09' ),
( '3', '2', '4', '1', '250000.00', '250000.00', '2021-06-17 09:30:09', '2021-06-17 09:30:09' ),
( '4', '3', '4', '1', '250000.00', '250000.00', '2021-06-17 09:42:33', '2021-06-17 09:42:33' ),
( '5', '3', '2', '2', '50000.00', '100000.00', '2021-06-17 09:42:33', '2021-06-17 09:42:33' ),
( '6', '4', '5', '1', '150000.00', '150000.00', '2021-06-17 10:19:25', '2021-06-17 10:19:25' ),
( '7', '4', '1', '2', '125000.00', '250000.00', '2021-06-17 10:19:25', '2021-06-17 10:19:25' ),
( '8', '5', '4', '1', '250000.00', '250000.00', '2021-06-18 04:49:45', '2021-06-18 04:49:45' ),
( '9', '6', '3', '1', '75000.00', '75000.00', '2021-06-18 04:51:27', '2021-06-18 04:51:27' ),
( '10', '7', '3', '2', '75000.00', '150000.00', '2021-06-18 04:58:26', '2021-06-18 04:58:26' ),
( '11', '8', '4', '1', '250000.00', '250000.00', '2021-06-18 04:58:47', '2021-06-18 04:58:47' ),
( '12', '9', '2', '1', '50000.00', '50000.00', '2021-06-18 06:43:24', '2021-06-18 06:43:24' ),
( '13', '9', '1', '1', '125000.00', '125000.00', '2021-06-18 06:43:24', '2021-06-18 06:43:24' ),
( '14', '11', '1', '1', '125000.00', '125000.00', '2021-06-18 08:20:42', '2021-06-18 08:20:42' ),
( '15', '12', '2', '3', '50000.00', '150000.00', '2021-06-18 08:21:42', '2021-06-18 08:21:42' ),
( '16', '13', '5', '1', '150000.00', '150000.00', '2021-06-18 11:36:13', '2021-06-18 11:36:13' ),
( '17', '14', '1', '1', '125000.00', '125000.00', '2021-06-19 15:18:31', '2021-06-19 15:18:31' );
COMMIT;
-- ---------------------------------------------------------


-- Dump data of "personal_access_tokens" -------------------
-- ---------------------------------------------------------


-- Dump data of "failed_jobs" ------------------------------
-- ---------------------------------------------------------


-- Dump data of "transaction_items" ------------------------
BEGIN;

INSERT INTO `transaction_items`(`id`,`name`,`price`,`description`,`created_at`,`updated_at`) VALUES 
( '1', 'Barang Satu', '125000.00', '0', '2021-06-13 10:58:13', NULL ),
( '2', 'Barang Dua', '50000.00', '0', '2021-06-13 10:58:13', NULL ),
( '3', 'Barang Tiga', '75000.00', '0', '2021-06-13 10:58:13', NULL ),
( '4', 'Barang Empat', '250000.00', '0', '2021-06-13 10:58:13', NULL ),
( '5', 'Barang Lima', '150000.00', '0', '2021-06-13 10:58:13', NULL );
COMMIT;
-- ---------------------------------------------------------


-- Dump data of "reward_redeems" ---------------------------
BEGIN;

INSERT INTO `reward_redeems`(`id`,`reward_id`,`user_id`,`created_at`,`updated_at`,`by_admin`) VALUES 
( '1', '5', '2', '2021-06-19 04:44:01', '2021-06-19 04:44:01', '1' ),
( '2', '5', '3', '2021-06-19 05:40:27', '2021-06-19 05:40:27', '0' ),
( '3', '5', '4', '2021-06-19 05:45:33', '2021-06-19 05:45:33', '1' ),
( '4', '5', '5', '2021-06-19 05:51:57', '2021-06-19 05:51:57', '1' ),
( '5', '4', '2', '2021-06-19 12:23:40', '2021-06-19 12:23:40', '1' ),
( '6', '5', '5', '2021-06-19 14:13:34', '2021-06-19 14:13:34', '0' ),
( '7', '5', '7', '2021-06-19 14:32:43', '2021-06-19 14:32:43', '0' ),
( '8', '5', '7', '2021-06-19 15:10:36', '2021-06-19 15:10:36', '0' ),
( '9', '5', '2', '2021-06-19 15:19:04', '2021-06-19 15:19:04', '0' );
COMMIT;
-- ---------------------------------------------------------


-- Dump data of "transactions" -----------------------------
BEGIN;

INSERT INTO `transactions`(`id`,`user_id`,`status`,`total_payment`,`created_at`,`updated_at`,`reference_id`,`point_id`) VALUES 
( '1', '2', 'complete', '50000.00', '2021-06-17 04:55:28', '2021-06-18 06:41:47', '189fe9b1-1c43-4153-b66d-a6ed1a71220f', '3' ),
( '2', '2', 'pending', '400000.00', '2021-06-17 09:30:09', '2021-06-17 09:30:09', '5273d006-22e3-4e0d-a582-05397cd889c6', '3' ),
( '3', '3', 'pending', '350000.00', '2021-06-17 09:42:33', '2021-06-17 09:42:33', 'ec861455-3e15-4546-8b32-137959631c6a', '3' ),
( '4', '8', 'pending', '400000.00', '2021-06-17 10:19:25', '2021-06-17 10:19:25', 'f192a3b4-8b17-47d6-8beb-35bcdfcf9044', '3' ),
( '5', '5', 'pending', '250000.00', '2021-06-18 04:49:45', '2021-06-18 04:49:45', '7243342a-b212-4550-9bf8-8e402537a0f4', '3' ),
( '6', '4', 'pending', '75000.00', '2021-06-18 04:51:27', '2021-06-18 04:51:27', 'af463da6-fa18-4cbf-9b09-2a21c061eea4', '3' ),
( '7', '7', 'pending', '150000.00', '2021-06-18 04:58:26', '2021-06-18 04:58:26', '3c9e3927-d89b-4907-9818-2aca2d44cd33', '3' ),
( '8', '7', 'pending', '250000.00', '2021-06-18 04:58:47', '2021-06-18 04:58:47', '34b8445e-669e-4bbd-84a9-8a81a51641e7', '3' ),
( '9', '6', 'pending', '175000.00', '2021-06-18 06:43:24', '2021-06-18 06:43:24', 'e110b20d-b4e7-4ad2-b9a6-bc2bd42fec15', '3' ),
( '10', '5', 'pending', '125000.00', '2021-06-18 08:19:16', '2021-06-18 08:19:16', '3100d139-237c-410e-bae0-277ba5c1ccf8', '3' ),
( '11', '5', 'pending', '125000.00', '2021-06-18 08:20:42', '2021-06-18 08:20:42', 'c6a04829-71c8-4baa-890f-900c44eeb179', '3' ),
( '12', '3', 'pending', '150000.00', '2021-06-18 08:21:42', '2021-06-18 08:21:42', 'a97d7fc6-a838-4ee3-8fef-4b62d61e420b', '3' ),
( '13', '2', 'pending', '150000.00', '2021-06-18 11:36:13', '2021-06-18 11:36:13', '2165b31e-1d64-4af1-8001-1ed63b620a06', '3' ),
( '14', '2', 'pending', '125000.00', '2021-06-19 15:18:31', '2021-06-19 15:18:31', 'ef3eedf2-2439-4124-8af6-609ac8512265', '3' );
COMMIT;
-- ---------------------------------------------------------


-- Dump data of "password_resets" --------------------------
-- ---------------------------------------------------------


-- Dump data of "transaction_bags" -------------------------
BEGIN;

INSERT INTO `transaction_bags`(`id`,`user_id`,`created_at`,`updated_at`,`total_payment`,`submitted`) VALUES 
( '1', '2', '2021-06-16 19:31:29', '2021-06-17 04:55:28', '50000.00', '1' ),
( '2', '3', '2021-06-16 21:11:00', '2021-06-17 09:42:33', '0.00', '1' ),
( '3', '4', '2021-06-16 21:18:15', '2021-06-18 04:51:27', '0.00', '1' ),
( '4', '2', '2021-06-17 05:13:41', '2021-06-17 09:30:09', '0.00', '1' ),
( '5', '8', '2021-06-17 10:18:48', '2021-06-17 10:19:25', '0.00', '1' ),
( '6', '7', '2021-06-18 04:39:46', '2021-06-18 04:58:26', '0.00', '1' ),
( '7', '6', '2021-06-18 04:45:52', '2021-06-18 06:43:24', '0.00', '1' ),
( '8', '5', '2021-06-18 04:48:41', '2021-06-18 04:49:45', '0.00', '1' ),
( '9', '5', '2021-06-18 04:49:57', '2021-06-18 08:20:42', '0.00', '1' ),
( '10', '3', '2021-06-18 04:50:43', '2021-06-18 08:21:42', '0.00', '1' ),
( '11', '2', '2021-06-18 04:51:44', '2021-06-18 11:36:13', '0.00', '1' ),
( '12', '4', '2021-06-18 04:56:17', '2021-06-18 04:56:17', '0.00', '0' ),
( '13', '7', '2021-06-18 04:58:32', '2021-06-18 04:58:47', '0.00', '1' ),
( '14', '2', '2021-06-19 15:18:17', '2021-06-19 15:18:31', '0.00', '1' );
COMMIT;
-- ---------------------------------------------------------


-- Dump data of "reward_points" ----------------------------
BEGIN;

INSERT INTO `reward_points`(`id`,`rule_name`,`rate`,`point`,`created_at`,`updated_at`,`type`) VALUES 
( '1', 'Diskon Khusus', '100', '15', '2021-06-13 10:58:13', '2021-06-15 03:47:46', 'rate' ),
( '2', 'Diskon biasa', '1', '10', '2021-06-15 03:52:23', '2021-06-15 17:04:28', 'fixed' ),
( '3', 'Diskon fix', '1', '5', '2021-06-15 04:41:34', '2021-06-15 04:41:34', 'fixed' );
COMMIT;
-- ---------------------------------------------------------


-- Dump data of "migrations" -------------------------------
BEGIN;

INSERT INTO `migrations`(`id`,`migration`,`batch`) VALUES 
( '17', '2014_10_12_000000_create_users_table', '1' ),
( '18', '2014_10_12_100000_create_password_resets_table', '1' ),
( '19', '2019_08_19_000000_create_failed_jobs_table', '1' ),
( '20', '2019_12_14_000001_create_personal_access_tokens_table', '1' ),
( '21', '2021_06_13_035106_create_reward_points_table', '1' ),
( '22', '2021_06_13_035152_create_transactions_table', '1' ),
( '23', '2021_06_18_075613_update_users_reward_points_table', '2' );
COMMIT;
-- ---------------------------------------------------------


-- Dump data of "users" ------------------------------------
BEGIN;

INSERT INTO `users`(`id`,`name`,`email`,`email_verified_at`,`is_admin`,`password`,`remember_token`,`created_at`,`updated_at`,`points`) VALUES 
( '1', 'Admin Satu', 'admin1@example.com', '2021-06-13 10:58:13', '1', '$2y$10$uzFWye/YVnbBV2EuuTrzAuMLORZbHGqWvzJIfy.7Ng/k729V21ZsG', NULL, '2021-06-13 10:58:13', NULL, NULL ),
( '2', 'User Biasa Satu', 'user1@example.com', '2021-06-13 10:58:13', '0', '$2y$10$1FToJWYMqUWis7CjhWVNO.hnIsh06r0yEXbAm3SlrjnkUnPnrJA0.', NULL, '2021-06-13 10:58:13', '2021-06-19 15:19:04', '0' ),
( '3', 'User Biasa Dua', 'user2@example.com', '2021-06-13 10:58:13', '0', '$2y$10$W9IEARuFtVVb9jG8acBX6O5Fje9hnbopW2GuO7MZWG9N5xFtvdR4K', NULL, '2021-06-13 10:58:13', '2021-06-18 08:21:42', '0' ),
( '4', 'User Biasa Tiga Puluh', 'user30@example.com', NULL, '0', '$2y$10$4PvB.QHGv3vwz8w7pk4mS.2DB40g5hiuSZ9ERVQBhtsNNd2ZjYzSe', NULL, '2021-06-13 17:14:12', '2021-06-13 17:14:12', '0' ),
( '5', 'User Biasa Tiga Puluh Satu', 'user31@example.com', NULL, '0', '$2y$10$nqOPksZTugExvMykzXx6au/FDHsyGLuWgVM/SOSHvvo2QWgYQVvGe', NULL, '2021-06-13 17:19:28', '2021-06-19 14:13:34', '0' ),
( '6', 'User Biasa Tiga Puluh Dua', 'user32@example.com', NULL, '0', '$2y$10$6LpCB9JEbToemu49KibaN.C8pG8RgRyn7FIdG6W2HctTlVSxQbYH2', NULL, '2021-06-13 17:20:15', '2021-06-13 17:20:15', '5' ),
( '7', 'User Biasa Tiga Puluh Tiga', 'user33@example.com', NULL, '0', '$2y$10$nXtNLcGODo/dFDRFo9zEVuvxWSUJ/S9SEPpwk14CCuspgTZUN3wF2', NULL, '2021-06-15 03:48:34', '2021-06-19 15:10:36', '0' ),
( '8', 'User Biasa Tiga Puluh Empat', 'user34@example.com', NULL, '0', '$2y$10$lIoIUMd5WaorVrqW3m8RZ.rAqxqeC6bgxwGFXocSgjIScxpTZywyO', NULL, '2021-06-15 03:49:44', '2021-06-15 03:49:44', '5' );
COMMIT;
-- ---------------------------------------------------------


-- CREATE INDEX "index_bag_id" ---------------------------------
CREATE INDEX `index_bag_id` USING BTREE ON `transaction_bag_items`( `bag_id` );
-- -------------------------------------------------------------


-- CREATE INDEX "index_item_id" --------------------------------
CREATE INDEX `index_item_id` USING BTREE ON `transaction_bag_items`( `item_id` );
-- -------------------------------------------------------------


-- CREATE INDEX "transaction_details_item_id_foreign" ----------
CREATE INDEX `transaction_details_item_id_foreign` USING BTREE ON `transaction_details`( `item_id` );
-- -------------------------------------------------------------


-- CREATE INDEX "transaction_details_trx_id_foreign" -----------
CREATE INDEX `transaction_details_trx_id_foreign` USING BTREE ON `transaction_details`( `trx_id` );
-- -------------------------------------------------------------


-- CREATE INDEX "personal_access_tokens_tokenable_type_tokenable_id_index" 
CREATE INDEX `personal_access_tokens_tokenable_type_tokenable_id_index` USING BTREE ON `personal_access_tokens`( `tokenable_type`, `tokenable_id` );
-- -------------------------------------------------------------


-- CREATE INDEX "reward_redeems_reward_id_foreign" -------------
CREATE INDEX `reward_redeems_reward_id_foreign` USING BTREE ON `reward_redeems`( `reward_id` );
-- -------------------------------------------------------------


-- CREATE INDEX "reward_redeems_user_id_foreign" ---------------
CREATE INDEX `reward_redeems_user_id_foreign` USING BTREE ON `reward_redeems`( `user_id` );
-- -------------------------------------------------------------


-- CREATE INDEX "transactions_point_id_foreign" ----------------
CREATE INDEX `transactions_point_id_foreign` USING BTREE ON `transactions`( `point_id` );
-- -------------------------------------------------------------


-- CREATE INDEX "transactions_user_id_foreign" -----------------
CREATE INDEX `transactions_user_id_foreign` USING BTREE ON `transactions`( `user_id` );
-- -------------------------------------------------------------


-- CREATE INDEX "password_resets_email_index" ------------------
CREATE INDEX `password_resets_email_index` USING BTREE ON `password_resets`( `email` );
-- -------------------------------------------------------------


-- CREATE INDEX "Index_2" --------------------------------------
CREATE INDEX `Index_2` USING BTREE ON `transaction_bags`( `user_id` );
-- -------------------------------------------------------------


-- CREATE LINK "transaction_bag_items_bag_id_foreign" ----------
ALTER TABLE `transaction_bag_items`
	ADD CONSTRAINT `transaction_bag_items_bag_id_foreign` FOREIGN KEY ( `bag_id` )
	REFERENCES `transaction_bags`( `id` )
	ON DELETE Restrict
	ON UPDATE Restrict;
-- -------------------------------------------------------------


-- CREATE LINK "transaction_bag_items_item_id_foreign" ---------
ALTER TABLE `transaction_bag_items`
	ADD CONSTRAINT `transaction_bag_items_item_id_foreign` FOREIGN KEY ( `item_id` )
	REFERENCES `transaction_items`( `id` )
	ON DELETE Restrict
	ON UPDATE Restrict;
-- -------------------------------------------------------------


-- CREATE LINK "transaction_details_item_id_foreign" -----------
ALTER TABLE `transaction_details`
	ADD CONSTRAINT `transaction_details_item_id_foreign` FOREIGN KEY ( `item_id` )
	REFERENCES `transaction_items`( `id` )
	ON DELETE Restrict
	ON UPDATE Restrict;
-- -------------------------------------------------------------


-- CREATE LINK "transaction_details_trx_id_foreign" ------------
ALTER TABLE `transaction_details`
	ADD CONSTRAINT `transaction_details_trx_id_foreign` FOREIGN KEY ( `trx_id` )
	REFERENCES `transactions`( `id` )
	ON DELETE Restrict
	ON UPDATE Restrict;
-- -------------------------------------------------------------


-- CREATE LINK "reward_redeems_reward_id_foreign" --------------
ALTER TABLE `reward_redeems`
	ADD CONSTRAINT `reward_redeems_reward_id_foreign` FOREIGN KEY ( `reward_id` )
	REFERENCES `rewards`( `id` )
	ON DELETE Restrict
	ON UPDATE Restrict;
-- -------------------------------------------------------------


-- CREATE LINK "reward_redeems_user_id_foreign" ----------------
ALTER TABLE `reward_redeems`
	ADD CONSTRAINT `reward_redeems_user_id_foreign` FOREIGN KEY ( `user_id` )
	REFERENCES `users`( `id` )
	ON DELETE Restrict
	ON UPDATE Restrict;
-- -------------------------------------------------------------


-- CREATE LINK "transactions_point_id_foreign" -----------------
ALTER TABLE `transactions`
	ADD CONSTRAINT `transactions_point_id_foreign` FOREIGN KEY ( `point_id` )
	REFERENCES `reward_points`( `id` )
	ON DELETE Restrict
	ON UPDATE Restrict;
-- -------------------------------------------------------------


-- CREATE LINK "transactions_user_id_foreign" ------------------
ALTER TABLE `transactions`
	ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY ( `user_id` )
	REFERENCES `users`( `id` )
	ON DELETE Restrict
	ON UPDATE Restrict;
-- -------------------------------------------------------------


-- CREATE LINK "transaction_bags_user_id_foreign" --------------
ALTER TABLE `transaction_bags`
	ADD CONSTRAINT `transaction_bags_user_id_foreign` FOREIGN KEY ( `user_id` )
	REFERENCES `users`( `id` )
	ON DELETE Restrict
	ON UPDATE Restrict;
-- -------------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


