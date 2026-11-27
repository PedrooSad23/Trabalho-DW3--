-- MySQL Script simplificado (Usuário comum sem coluna tipo)
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- Tabela de Usuários
CREATE TABLE IF NOT EXISTS `mydb`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `foto` VARCHAR(250) NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;

-- Tabela de Quartos
CREATE TABLE IF NOT EXISTS `mydb`.`quarto` (
  `idquarto` INT NOT NULL AUTO_INCREMENT,
  `numero` INT NOT NULL,
  `tipo` VARCHAR(80) NOT NULL,
  `capacidade` INT NOT NULL,
  `status` TEXT NOT NULL,
  PRIMARY KEY (`idquarto`))
ENGINE = InnoDB;

-- Tabela de Consultas
CREATE TABLE IF NOT EXISTS `mydb`.`consulta` (
  `idconsulta` INT NOT NULL AUTO_INCREMENT,
  `idpaciente` INT NOT NULL,
  `idmedico` INT NOT NULL,
  `idquarto` INT NOT NULL,
  `data_consulta` DATE NOT NULL,
  `horario` TIME NOT NULL,
  `diagnostico` TEXT NOT NULL,
  PRIMARY KEY (`idconsulta`),
  INDEX `fk_consulta_paciente_idx` (`idpaciente` ASC),
  INDEX `fk_consulta_medico1_idx` (`idmedico` ASC),
  INDEX `fk_consulta_quarto1_idx` (`idquarto` ASC),
  CONSTRAINT `fk_consulta_paciente`
    FOREIGN KEY (`idpaciente`)
    REFERENCES `mydb`.`usuario` (`idusuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_consulta_medico1`
    FOREIGN KEY (`idmedico`)
    REFERENCES `mydb`.`usuario` (`idusuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_consulta_quarto1`
    FOREIGN KEY (`idquarto`)
    REFERENCES `mydb`.`quarto` (`idquarto`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- =====================================================
-- DADOS INICIAIS
-- =====================================================

-- 1. Inserir Usuários
-- Senha padrão para ambos: 123456 (gerada por password_hash)
INSERT INTO `mydb`.`usuario` (`idusuario`, `nome`, `email`, `senha`, `foto`) VALUES
(1, 'Dr. Carlos Silva', 'carlos@hospital.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png'),
(2, 'Ana Souza', 'ana@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png');

-- 2. Inserir Quarto
INSERT INTO `mydb`.`quarto` (`idquarto`, `numero`, `tipo`, `capacidade`, `status`) VALUES
(1, 101, 'Enfermaria', 2, 'Disponível');

-- 3. Inserir Consulta
INSERT INTO `mydb`.`consulta` (`idconsulta`, `idpaciente`, `idmedico`, `idquarto`, `data_consulta`, `horario`, `diagnostico`) VALUES
(1, 2, 1, 1, '2026-12-01', '14:30:00', 'Primeira consulta de rotina cardiológica.');


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;