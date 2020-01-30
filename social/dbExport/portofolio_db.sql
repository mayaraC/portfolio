SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `portefolio_db` ;
CREATE SCHEMA IF NOT EXISTS `portefolio_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `portefolio_db` ;

-- -----------------------------------------------------
-- Table `portefolio_db`.`post`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `portefolio_db`.`post` ;

CREATE TABLE IF NOT EXISTS `portefolio_db`.`post` (
  `idPost` INT NOT NULL AUTO_INCREMENT,
  `commentaire` VARCHAR(255) NOT NULL,
  `creationDate` TIMESTAMP NOT NULL,
  `modificationDate` TIMESTAMP NULL,
  PRIMARY KEY (`idPost`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portefolio_db`.`media`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `portefolio_db`.`media` ;

CREATE TABLE IF NOT EXISTS `portefolio_db`.`media` (
  `idMedia` INT NOT NULL AUTO_INCREMENT,
  `typeMedia` VARCHAR(45) NOT NULL,
  `nomMedia` VARCHAR(45) NOT NULL,
  `creationDate` TIMESTAMP NOT NULL,
  `modificationDate` TIMESTAMP NULL,
  PRIMARY KEY (`idMedia`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portefolio_db`.`contenir`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `portefolio_db`.`contenir` ;

CREATE TABLE IF NOT EXISTS `portefolio_db`.`contenir` (
  `post_idPost` INT NOT NULL,
  `media_idMedia` INT NOT NULL,
  INDEX `fk_contenir_post1_idx` (`post_idPost` ASC),
  INDEX `fk_contenir_media1_idx` (`media_idMedia` ASC),
  CONSTRAINT `fk_contenir_post1`
    FOREIGN KEY (`post_idPost`)
    REFERENCES `portefolio_db`.`post` (`idPost`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contenir_media1`
    FOREIGN KEY (`media_idMedia`)
    REFERENCES `portefolio_db`.`media` (`idMedia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
