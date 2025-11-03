-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8mb3 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`armazenamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`armazenamento` (
  `ramal_do_setor` INT NOT NULL,
  `nome_do_setor` VARCHAR(500) NOT NULL,
  `funcionarios_do_setor` VARCHAR(500) NOT NULL,
  PRIMARY KEY (`ramal_do_setor`, `nome_do_setor`, `funcionarios_do_setor`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `mydb`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`cliente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NULL DEFAULT NULL,
  `saldo` DECIMAL(10,2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `mydb`.`log_produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`log_produto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NULL DEFAULT NULL,
  `acao` VARCHAR(100) NULL DEFAULT NULL,
  `data_insercao` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `mydb`.`produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`produto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NULL DEFAULT NULL,
  `preco` DOUBLE NULL DEFAULT NULL,
  `estoque` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;