-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               11.5.2-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for cloudybossnet_cs
CREATE DATABASE IF NOT EXISTS `cloudybossnet_cs` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_lithuanian_ci */;
USE `cloudybossnet_cs`;

-- Dumping structure for table cloudybossnet_cs.users
CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(11) NOT NULL,
  `userlogin` varchar(20) DEFAULT NULL,
  `userpassword` varchar(72) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `userbankaccount` varchar(7) DEFAULT NULL,
  `userprofile` varchar(100) DEFAULT NULL,
  `userfilename` varchar(100) DEFAULT NULL,
  `userphotosize` int(11) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_lithuanian_ci;

-- Dumping data for table cloudybossnet_cs.users: ~1 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`userid`, `userlogin`, `userpassword`, `username`, `userbankaccount`, `userprofile`, `userfilename`, `userphotosize`) VALUES
	(1, 'gdn', '$2y$10$lOeUK8dPXJ4V.jxHlIHcg.8TDp4I9jyGQHdRpskwV61rt63uBN3qy', 'ADMIN', 'LT-0001', 'I am hacker', 'uploads/CAT.jpg', 40670);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
