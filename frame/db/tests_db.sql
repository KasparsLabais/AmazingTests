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
  `answer_text` varchar(50) CHARACTER SET utf8 NOT NULL,
  `answer_correct` tinyint(4) DEFAULT '0',
  `question_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`answer_id`),
  UNIQUE KEY `answer_id` (`answer_id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table anketas.answers: ~6 rows (approximately)
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
	(8, 'No', 0, 3),
	(9, 'Jā', 1, 4),
	(10, 'Nē', 0, 4),
	(11, '1', 0, 5),
	(12, '10', 0, 5),
	(13, '13', 0, 5),
	(14, '21', 1, 5),
	(15, '20', 0, 5),
	(16, 'Liela', 0, 6),
	(17, '1', 0, 6),
	(18, 'Zaļa', 0, 6),
	(19, '2', 1, 6),
	(20, '34', 1, 7),
	(21, '18', 0, 7);
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;

-- Dumping structure for table anketas.questions
CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_name` text CHARACTER SET utf32 NOT NULL,
  `test_id` int(10) unsigned NOT NULL,
  `question_datestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`question_id`),
  UNIQUE KEY `question_id` (`question_id`),
  KEY `test_id` (`test_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table anketas.questions: ~7 rows (approximately)
DELETE FROM `questions`;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` (`question_id`, `question_name`, `test_id`, `question_datestamp`) VALUES
	(1, 'What is chickens first name?', 1, '2018-04-05 21:12:59'),
	(2, 'Can chickens play piano?', 1, '2018-04-05 21:13:41'),
	(3, 'Would you eat chicken-nugget if it was chicken you know?', 1, '2018-04-05 21:14:33'),
	(4, 'Vai anatolijam ir sievas māte?', 2, '2018-04-06 19:56:26'),
	(5, 'Cik anatolija sievas mātei ir pirkstu?', 2, '2018-04-06 19:56:58'),
	(6, 'Cik anatolijam ir sievu?', 2, '2018-04-06 19:57:15'),
	(7, 'Cik tad anatolijam ir gadu?', 2, '2018-04-06 19:57:32');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;

-- Dumping structure for table anketas.tests
CREATE TABLE IF NOT EXISTS `tests` (
  `test_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test_name` varchar(50) CHARACTER SET utf32 NOT NULL DEFAULT '0',
  `test_description` mediumtext CHARACTER SET utf32,
  `test_datestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`test_id`),
  UNIQUE KEY `test_id` (`test_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table anketas.tests: ~1 rows (approximately)
DELETE FROM `tests`;
/*!40000 ALTER TABLE `tests` DISABLE KEYS */;
INSERT INTO `tests` (`test_id`, `test_name`, `test_description`, `test_datestamp`) VALUES
	(1, 'Chicken or Egg?', 'Find out, if you know who was first', '2018-04-05 19:08:49'),
	(2, 'Cik vecs ir anatolijs?', 'Vai anatolijs patiešām ir tik vecs?', '2018-04-06 19:54:38');
/*!40000 ALTER TABLE `tests` ENABLE KEYS */;

-- Dumping structure for table anketas.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(60) CHARACTER SET utf32 NOT NULL,
  `test_id` int(10) unsigned NOT NULL,
  `test_key` varchar(255) CHARACTER SET utf32 NOT NULL,
  `user_datestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `correct_answers` int(11) NOT NULL DEFAULT '0',
  `test_length` int(11) DEFAULT '0',
  `current_question` int(11) DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `test_id` (`test_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci CHECKSUM=1;

-- Dumping data for table anketas.users: ~29 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`, `user_name`, `test_id`, `test_key`, `user_datestamp`, `correct_answers`, `test_length`, `current_question`) VALUES
	(1, 'adasdas d', 1, '58ydxt6IOPYBM', '2018-04-05 21:17:22', 0, 3, 0),
	(2, 'adasdas d', 1, '58ydxt6IOPYBM', '2018-04-05 21:18:19', 0, 3, 0),
	(3, 'adasdas d', 1, '58ydxt6IOPYBM', '2018-04-05 21:18:53', 0, 3, 0),
	(4, 'asdasdsad ', 1, '15bqqir.J7jhQ', '2018-04-05 21:20:01', 0, 3, 0),
	(5, 'asdasdsad ', 1, '15bqqir.J7jhQ', '2018-04-05 21:21:25', 0, 3, 0),
	(6, 'asdasdsad ', 1, '15bqqir.J7jhQ', '2018-04-05 21:21:53', 0, 3, 0),
	(7, 'asdasdsad ', 1, '15bqqir.J7jhQ', '2018-04-05 21:22:04', 0, 3, 0),
	(8, 'asdasdsad ', 1, '15bqqir.J7jhQ', '2018-04-05 21:22:23', 0, 3, 0),
	(9, 'asdasdsad ', 1, '15bqqir.J7jhQ', '2018-04-05 21:22:53', 0, 3, 0),
	(10, 'asdasdsad ', 1, '15bqqir.J7jhQ', '2018-04-05 21:23:05', 0, 3, 0),
	(11, 'asdasdsad ', 1, '15bqqir.J7jhQ', '2018-04-05 21:23:20', 0, 3, 0),
	(12, 'asdasdsad ', 1, '15bqqir.J7jhQ', '2018-04-05 21:24:05', 0, 3, 0),
	(13, 'asddsadsasa', 1, '85Ydiy3V8aSrM', '2018-04-05 21:24:34', 0, 3, 0),
	(14, 'asddsadsasa', 1, '85Ydiy3V8aSrM', '2018-04-05 21:24:49', 0, 3, 0),
	(15, 'Mantija', 1, '729br8F24MY2.', '2018-04-05 21:25:12', 0, 3, 0),
	(16, 'asdsaddsa', 1, '16Y8eTmc3eosA', '2018-04-05 21:25:24', 0, 3, 0),
	(17, 'asdsaddsa', 1, '16Y8eTmc3eosA', '2018-04-05 21:25:57', 0, 3, 0),
	(18, 'Armani', 1, '94nLSphbDNDWU', '2018-04-05 21:26:03', 0, 3, 0),
	(19, 'adsa', 1, '84UXbXb0SlFbQ', '2018-04-05 21:26:16', 0, 3, 0),
	(20, 'adsa', 1, '84UXbXb0SlFbQ', '2018-04-05 21:26:24', 0, 3, 0),
	(21, 'asd', 1, '82LwLKwCHOYTo', '2018-04-05 21:26:27', 0, 3, 0),
	(22, 'aaaa', 1, '23XgSBeSLew.M', '2018-04-05 21:27:26', 0, 3, 0),
	(23, 'Amandoniko', 1, '956EjsvBtc80c', '2018-04-05 21:29:36', 0, 3, 0),
	(24, 'AÄ¼ona', 1, '38/RSBGGGWGYY', '2018-04-06 00:02:48', 0, 3, 0),
	(25, 'fff', 1, '86g3rGSbytlpg', '2018-04-06 18:55:09', 1, 3, 3),
	(26, 'Abromows', 1, '72phSifO4/F4g', '2018-04-06 19:02:09', 3, 3, 3),
	(27, 'Ozols', 1, '88hJjvEXCHgAU', '2018-04-06 19:17:20', 0, 3, 3),
	(28, 'Juris', 1, '55ZY722EasmII', '2018-04-06 19:53:38', 0, 3, 0),
	(29, 'ÄÄÄÅ—ns', 1, '10gDtATBA1oxg', '2018-04-06 19:55:52', 2, 3, 3),
	(30, 'Anatolijs', 2, '17MH9Sl3wV2IU', '2018-04-06 20:02:46', 0, 4, 4),
	(31, 'Anatolijs', 2, '83sBPk6094Tjg', '2018-04-06 20:03:09', 1, 4, 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
