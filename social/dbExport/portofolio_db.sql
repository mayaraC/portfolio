SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `portefolio_db` DEFAULT CHARACTER SET utf8 ;
USE `portefolio_db` ;

-- -----------------------------------------------------
-- Table `portefolio_db`.`post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portefolio_db`.`post` (
  `idPost` INT(11) NOT NULL AUTO_INCREMENT,
  `commentaire` VARCHAR(255) NOT NULL,
  `creationDate` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp,
  `modificationDate` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`idPost`))
ENGINE = InnoDB
AUTO_INCREMENT = 55
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `portefolio_db`.`media`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portefolio_db`.`media` (
  `idMedia` INT(11) NOT NULL AUTO_INCREMENT,
  `typeMedia` VARCHAR(45) NOT NULL,
  `nomMedia` VARCHAR(45) NOT NULL,
  `creationDate` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp,
  `modificationDate` TIMESTAMP NULL DEFAULT NULL,
  `post_idPost` INT(11) NOT NULL,
  PRIMARY KEY (`idMedia`),
  INDEX `fk_media_post` (`post_idPost` ASC),
  CONSTRAINT `fk_media_post`
    FOREIGN KEY (`post_idPost`)
    REFERENCES `portefolio_db`.`post` (`idPost`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 31
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
