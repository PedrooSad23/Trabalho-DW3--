-- MySQL Script gerado pelo Workbench
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- Tabela de Usuários (Login)
CREATE TABLE IF NOT EXISTS `mydb`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `foto` VARCHAR(250) NOT NULL,
  `tipo` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`idusuario`))
ENGINE = InnoDB;

-- Tabela de Pacientes
CREATE TABLE IF NOT EXISTS `mydb`.`paciente` (
  `idpaciente` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `cpf` VARCHAR(14) NOT NULL,
  `data_nascimento` DATE NOT NULL,
  `telefone` VARCHAR(20) NOT NULL,
  `endereco` VARCHAR(150) NOT NULL,
  `estado` TEXT NULL,
  `idusuario` INT NOT NULL,
  PRIMARY KEY (`idpaciente`),
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC),
  INDEX `fk_paciente_usuario1_idx` (`idusuario` ASC),
  CONSTRAINT `fk_paciente_usuario1`
    FOREIGN KEY (`idusuario`)
    REFERENCES `mydb`.`usuario` (`idusuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- Tabela de Médicos
CREATE TABLE IF NOT EXISTS `mydb`.`medico` (
  `idmedico` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `crm` VARCHAR(50) NOT NULL,
  `especializacao` VARCHAR(100) NOT NULL,
  `telefone` VARCHAR(20) NOT NULL,
  `idusuario` INT NOT NULL,
  PRIMARY KEY (`idmedico`),
  INDEX `fk_medico_usuario1_idx` (`idusuario` ASC),
  CONSTRAINT `fk_medico_usuario1`
    FOREIGN KEY (`idusuario`)
    REFERENCES `mydb`.`usuario` (`idusuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
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
    REFERENCES `mydb`.`paciente` (`idpaciente`),
  CONSTRAINT `fk_consulta_medico1`
    FOREIGN KEY (`idmedico`)
    REFERENCES `mydb`.`medico` (`idmedico`),
  CONSTRAINT `fk_consulta_quarto1`
    FOREIGN KEY (`idquarto`)
    REFERENCES `mydb`.`quarto` (`idquarto`)
)
ENGINE = InnoDB;


-- =====================================================
-- DADOS INICIAIS (INSERTS PARA CADA TABELA)
-- =====================================================

-- 1. Inserir Usuários (Médico e Paciente)
-- Senha padrão para ambos: 123456 (gerada por password_hash)
INSERT INTO `mydb`.`usuario` (`idusuario`, `nome`, `email`, `senha`, `foto`, `tipo`) VALUES
(1, 'Dr. Carlos Silva', 'carlos@hospital.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png', 'medico'),
(2, 'Ana Souza', 'ana@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png', 'paciente');

-- 2. Inserir Médico (vinculado ao idusuario 1)
INSERT INTO `mydb`.`medico` (`idmedico`, `nome`, `crm`, `especializacao`, `telefone`, `idusuario`) VALUES
(1, 'Dr. Carlos Silva', 'CRM12345', 'Cardiologia', '(11) 98888-7777', 1);

-- 3. Inserir Paciente (vinculado ao idusuario 2)
INSERT INTO `mydb`.`paciente` (`idpaciente`, `nome`, `cpf`, `data_nascimento`, `telefone`, `endereco`, `estado`, `idusuario`) VALUES
(1, 'Ana Souza', '123.456.789-00', '1995-05-12', '(11) 99999-1111', 'Rua das Flores, 123', 'Estável', 2);

-- 4. Inserir Quarto
INSERT INTO `mydb`.`quarto` (`idquarto`, `numero`, `tipo`, `capacidade`, `status`) VALUES
(1, 101, 'Enfermaria', 2, 'Disponível');

-- 5. Inserir Consulta (vinculando paciente 1, médico 1 e quarto 1)
INSERT INTO `mydb`.`consulta` (`idconsulta`, `idpaciente`, `idmedico`, `idquarto`, `data_consulta`, `horario`, `diagnostico`) VALUES
(1, 1, 1, 1, '2026-12-01', '14:30:00', 'Primeira consulta de rotina cardiológica.');


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;