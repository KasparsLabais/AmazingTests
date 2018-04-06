-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.19 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for anketas
CREATE DATABASE IF NOT EXISTS `anketas` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `anketas`;

-- Dumping structure for table anketas.answers
CREATE TABLE IF NOT EXISTS `answers` (
  `answer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `answer_text` varchar(50) NOT NULL,
  `answer_correct` tinyint(4) DEFAULT '0',
  `question_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`answer_id`),
  UNIQUE KEY `answer_id` (`answer_id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf32;

-- Dumping data for table anketas.answers: ~8 rows (approximately)
DELETE FROM `answers`;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` (`answer_id`, `answer_text`, `answer_correct`, `question_id`) VALUES
	(1, 'John', 0, 1),
	(2, 'Nugget', 1, 1),
	(3, 'Annabella', 0, 1),
	(4, 'Yes', 1, 2),
	(5, 'No', 0, 2),
	(6, 'Maybe', 1, 3),
	(7, 'Yes', 0, 3),
	(8, 'No', 0, 3);
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;

-- Dumping structure for table anketas.questions
CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_name` text NOT NULL,
  `test_id` int(10) unsigned NOT NULL,
  `question_datestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`question_id`),
  UNIQUE KEY `question_id` (`question_id`),
  KEY `test_id` (`test_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf32;

-- Dumping data for table anketas.questions: ~3 rows (approximately)
DELETE FROM `questions`;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` (`question_id`, `question_name`, `test_id`, `question_datestamp`) VALUES
	(1, 'What is chickens first name?', 1, '2018-04-05 21:12:59'),
	(2, 'Can chickens play piano?', 1, '2018-04-05 21:13:41'),
	(3, 'Would you eat chicken-nugget if it was chicken you know?', 1, '2018-04-05 21:14:33');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;

-- Dumping structure for table anketas.tests
CREATE TABLE IF NOT EXISTS `tests` (
  `test_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test_name` varchar(50) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `test_description` text CHARACTER SET latin1,
  `test_datestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`test_id`),
  UNIQUE KEY `test_id` (`test_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf32;

-- Dumping data for table anketas.tests: ~1 rows (approximately)
DELETE FROM `tests`;
/*!40000 ALTER TABLE `tests` DISABLE KEYS */;
INSERT INTO `tests` (`test_id`, `test_name`, `test_description`, `test_datestamp`) VALUES
	(1, 'Chicken or Egg?', 'Find out, if you know who was first', '2018-04-05 19:08:49');
/*!40000 ALTER TABLE `tests` ENABLE KEYS */;

-- Dumping structure for table anketas.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(60) NOT NULL,
  `test_id` int(10) unsigned NOT NULL,
  `test_key` varchar(255) NOT NULL,
  `user_datestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `correct_answers` int(11) NOT NULL DEFAULT '0',
  `test_length` int(11) DEFAULT '0',
  `current_question` int(11) DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `test_id` (`test_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf32 CHECKSUM=1;

-- Dumping data for table anketas.users: ~26 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`, `user_name`, `test_id`, `test_key`, `user_datestamp`, `correct_answers`, `test_length`, `current_question`) VALUES
	(1, 'Armani', 1, '94nLSphbDNDWU', '2018-04-05 21:26:03', 0, 3, 0),
	(2, 'Abromows', 1, '72phSifO4/F4g', '2018-04-06 19:02:09', 3, 3, 3);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
