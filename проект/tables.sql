CREATE TABLE `tasks` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255),
  `topic` tinyint(3) unsigned,
  `place` VARCHAR(255),
  `date` TIMESTAMP NOT NULL,
  `duration` tinyint(3) unsigned,
  `comment` VARCHAR(255) DEFAULT NULL,
  `if_done` tinyint(3) unsigned,
  `created_at` TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY(`id`),
  INDEX `deleted_at` (`deleted_at`),
  INDEX `durations` (`durations`),
  INDEX `topic` (`topic`)
);

CREATE TABLE `users` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(255),
  `password` VARCHAR(255),
  `created_at` TIMESTAMP,
  PRIMARY KEY(`id`)
);

CREATE TABLE `topics` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255),
  PRIMARY KEY(`id`)
);

INSERT INTO `topics` (`name`) VALUES
('встреча'),
('звонок'),
('совещание'),
('дело');

CREATE TABLE `durations` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255),
  PRIMARY KEY(`id`)
);

INSERT INTO `durations` (`name`) VALUES
('Меньше часа'),
('1 час'),
('1,5 часа'),
('2 часа'),
('2,5 часа'),
('3 часа'),
('3,5 часа'),
('4 часа'),
('Больше 4 часов');

CREATE TABLE `if_doned` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255),
  PRIMARY KEY(`id`)
);

INSERT INTO `if_doned` (`name`) VALUES
('Текущая'),
('Выполненная');