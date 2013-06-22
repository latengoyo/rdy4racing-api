
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- game
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `game`;

CREATE TABLE `game`
(
    `game_id` INTEGER NOT NULL AUTO_INCREMENT,
    `game_code` VARCHAR(8) NOT NULL,
    `game_name` VARCHAR(32) NOT NULL,
    PRIMARY KEY (`game_id`),
    UNIQUE INDEX `game_U_1` (`game_code`),
    INDEX `game_I_1` (`game_code`),
    INDEX `game_I_2` (`game_name`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- gamemod
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `gamemod`;

CREATE TABLE `gamemod`
(
    `gmod_id` INTEGER NOT NULL AUTO_INCREMENT,
    `gmod_game_id` INTEGER NOT NULL,
    `gmod_code` VARCHAR(16) NOT NULL,
    `gmod_name` VARCHAR(32) NOT NULL,
    `gmod_description` VARCHAR(2048) NOT NULL,
    `gmod_image_low` VARCHAR(255) NOT NULL,
    `gmod_image_high` VARCHAR(255) NOT NULL,
    `gmod_image_gl` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`gmod_id`),
    UNIQUE INDEX `gamemod_U_1` (`gmod_code`),
    INDEX `gamemod_I_1` (`gmod_code`),
    INDEX `gamemod_I_2` (`gmod_name`),
    INDEX `gamemod_FI_1` (`gmod_game_id`),
    CONSTRAINT `gamemod_FK_1`
        FOREIGN KEY (`gmod_game_id`)
        REFERENCES `game` (`game_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `user_id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_email` VARCHAR(255) NOT NULL,
    `user_password` VARCHAR(124) NOT NULL,
    `user_firstname` VARCHAR(255),
    `user_lastname` VARCHAR(255),
    `user_dateofbirth` DATE,
    `user_rank` VARCHAR(1) DEFAULT 'R' NOT NULL,
    `user_mmr` INTEGER DEFAULT 1000 NOT NULL,
    `user_rating` INTEGER DEFAULT 0 NOT NULL,
    `user_about` TEXT,
    `user_avatar` VARCHAR(255),
    `user_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `user_active` SMALLINT DEFAULT 1 NOT NULL,
    `user_godfather` INTEGER,
    PRIMARY KEY (`user_id`),
    UNIQUE INDEX `user_U_1` (`user_email`),
    INDEX `user_I_1` (`user_email`),
    INDEX `user_I_2` (`user_firstname`),
    INDEX `user_I_3` (`user_lastname`),
    INDEX `user_FI_1` (`user_godfather`),
    CONSTRAINT `user_FK_1`
        FOREIGN KEY (`user_godfather`)
        REFERENCES `user` (`user_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user_game
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user_game`;

CREATE TABLE `user_game`
(
    `usgm_id` INTEGER NOT NULL AUTO_INCREMENT,
    `usgm_user_id` INTEGER NOT NULL,
    `usgm_game_id` INTEGER NOT NULL,
    `usgm_driver` VARCHAR(32) NOT NULL,
    PRIMARY KEY (`usgm_id`),
    UNIQUE INDEX `user_game_U_1` (`usgm_user_id`, `usgm_game_id`),
    UNIQUE INDEX `user_game_U_2` (`usgm_game_id`, `usgm_driver`),
    INDEX `user_game_I_1` (`usgm_driver`),
    CONSTRAINT `user_game_FK_1`
        FOREIGN KEY (`usgm_user_id`)
        REFERENCES `user` (`user_id`),
    CONSTRAINT `user_game_FK_2`
        FOREIGN KEY (`usgm_game_id`)
        REFERENCES `game` (`game_id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;