use officepingpongELO;

CREATE TABLE `matchHistory` (
    `player1` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
    `player1Score` int(255) DEFAULT NULL,
    `player2` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
    `player2Score` int(255) DEFAULT NULL,
    `player1Win` tinyint(1) DEFAULT NULL,
    `matchId` INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`matchId`)
);