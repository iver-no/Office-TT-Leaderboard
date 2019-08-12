use officepingpongELO;

CREATE TABLE `elo` (
  `FirstName` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `LastName` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `Nickname` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `ELO` int(255) DEFAULT NULL,
  `Wins` int(255) DEFAULT NULL,
  `Losses` int(255) DEFAULT NULL,
  `UUID` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',
  `isAdmin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`UUID`)
);