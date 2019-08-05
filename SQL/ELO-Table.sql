use officepingpongELO;

CREATE TABLE `ELO` (
	`FirstName` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
	`LastName` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
	`ELO` INT(255),
	`Wins` INT(255),
	`Losses` INT(255),
	`UUID` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin,
	`isAdmin` BOOLEAN,
	PRIMARY KEY (`FirstName`)
);