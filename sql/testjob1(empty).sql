-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema testjob1
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema testjob1
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `testjob1` DEFAULT CHARACTER SET utf8 ;
USE `testjob1` ;

-- -----------------------------------------------------
-- Table `testjob1`.`notebook`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testjob1`.`notebook` (
  `idNotebook` INT NOT NULL AUTO_INCREMENT,
  `FIO` VARCHAR(100) NOT NULL,
  `Company` VARCHAR(45) NULL,
  `Phone` VARCHAR(20) NOT NULL,
  `Email` VARCHAR(50) NOT NULL,
  `Birth` VARCHAR(10) NULL,
  `Photo` MEDIUMBLOB NULL,
  PRIMARY KEY (`idNotebook`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
