-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema gestorpedreira
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `gestorpedreira` ;

-- -----------------------------------------------------
-- Schema gestorpedreira
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gestorpedreira` DEFAULT CHARACTER SET utf8 ;
USE `gestorpedreira` ;

-- -----------------------------------------------------
-- Table `gestorpedreira`.`Material`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorpedreira`.`Material` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorpedreira`.`Cor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorpedreira`.`Cor` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorpedreira`.`Produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorpedreira`.`Produto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idMaterial` INT NOT NULL,
  `idCor` INT NULL,
  `Res_Compressao` FLOAT NULL,
  `Res_Flexao` FLOAT NULL,
  `Massa_Vol_Aparente` FLOAT NULL,
  `Absorcao_Agua` FLOAT NULL,
  `tituloArtigo` VARCHAR(255) NULL,
  `descricaoProduto` VARCHAR(2550) NULL,
  `preco` FLOAT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Produto_Material1_idx` (`idMaterial` ASC) ,
  INDEX `fk_Produto_Cor1_idx` (`idCor` ASC) ,
  CONSTRAINT `fk_Produto_Material1`
    FOREIGN KEY (`idMaterial`)
    REFERENCES `gestorpedreira`.`Material` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Produto_Cor1`
    FOREIGN KEY (`idCor`)
    REFERENCES `gestorpedreira`.`Cor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorpedreira`.`LocalExtracao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorpedreira`.`LocalExtracao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `coordenadasGPS_X` FLOAT NULL,
  `coordenadasGPS_Y` FLOAT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorpedreira`.`LocalArmazem`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorpedreira`.`LocalArmazem` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorpedreira`.`Lote`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorpedreira`.`Lote` (
  `codigo_lote` VARCHAR(50) NOT NULL,
  `idProduto` INT NOT NULL,
  `quantidade` FLOAT NOT NULL,
  `idLocalExtracao` INT NOT NULL,
  `idLocalArmazem` INT NULL,
  `dataHora` DATETIME NULL,
  PRIMARY KEY (`codigo_lote`),
  INDEX `fk_Lote_Produto1_idx` (`idProduto` ASC) ,
  INDEX `fk_Lote_Local1_idx` (`idLocalExtracao` ASC) ,
  INDEX `fk_Lote_LocalArmazem1_idx` (`idLocalArmazem` ASC) ,
  CONSTRAINT `fk_Lote_Produto1`
    FOREIGN KEY (`idProduto`)
    REFERENCES `gestorpedreira`.`Produto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Lote_Local1`
    FOREIGN KEY (`idLocalExtracao`)
    REFERENCES `gestorpedreira`.`LocalExtracao` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Lote_LocalArmazem1`
    FOREIGN KEY (`idLocalArmazem`)
    REFERENCES `gestorpedreira`.`LocalArmazem` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorpedreira`.`Fotografia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorpedreira`.`Fotografia` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `link` VARCHAR(500) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorpedreira`.`role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorpedreira`.`role` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `can_admin` SMALLINT(6) NOT NULL DEFAULT 0,
  `can_gestor` SMALLINT(6) NOT NULL DEFAULT 0,
  `can_operario` SMALLINT(6) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `gestorpedreira`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorpedreira`.`user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `role_id` INT(11) NOT NULL,
  `status` SMALLINT(6) NOT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  `username` VARCHAR(255) NULL DEFAULT NULL,
  `password` VARCHAR(255) NULL DEFAULT NULL,
  `auth_key` VARCHAR(255) NULL DEFAULT NULL,
  `access_token` VARCHAR(255) NULL DEFAULT NULL,
  `logged_in_ip` VARCHAR(255) NULL DEFAULT NULL,
  `logged_in_at` TIMESTAMP NULL DEFAULT NULL,
  `created_ip` VARCHAR(255) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `banned_at` TIMESTAMP NULL DEFAULT NULL,
  `banned_reason` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `user_email` (`email` ASC) ,
  UNIQUE INDEX `user_username` (`username` ASC) ,
  INDEX `user_role_id` (`role_id` ASC) ,
  CONSTRAINT `user_role_id`
    FOREIGN KEY (`role_id`)
    REFERENCES `gestorpedreira`.`role` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `gestorpedreira`.`Pedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorpedreira`.`Pedido` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idUser` INT NOT NULL,
  `idProduto` INT NULL,
  `desconto` FLOAT NULL,
  `quantidade` FLOAT NULL,
  `nome` VARCHAR(150) NOT NULL,
  `morada` VARCHAR(150) NULL,
  `telefone` VARCHAR(15) NULL,
  `email` VARCHAR(70) NULL,
  `mensagem` VARCHAR(150) NULL,
  `nif` INT NULL,
  `dataHoraPedido` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Pedido_Produto1_idx` (`idProduto` ASC) ,
  INDEX `fk_Pedido_user1_idx` (`idUser` ASC) ,
  CONSTRAINT `fk_Pedido_Produto1`
    FOREIGN KEY (`idProduto`)
    REFERENCES `gestorpedreira`.`Produto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pedido_user1`
    FOREIGN KEY (`idUser`)
    REFERENCES `gestorpedreira`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorpedreira`.`CodigoDesconto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorpedreira`.`CodigoDesconto` (
  `codigo` VARCHAR(40) NOT NULL,
  `descricao` VARCHAR(255) NULL,
  `descontoGeral` FLOAT NULL,
  `idProduto` INT NULL,
  `descontoProduto` FLOAT NULL,
  `dataExpiracao` DATE NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_CodigoDesconto_Produto1_idx` (`idProduto` ASC) ,
  CONSTRAINT `fk_CodigoDesconto_Produto1`
    FOREIGN KEY (`idProduto`)
    REFERENCES `gestorpedreira`.`Produto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorpedreira`.`Transportadora`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorpedreira`.`Transportadora` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorpedreira`.`Pedido_Lote`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorpedreira`.`Pedido_Lote` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idPedido` INT NOT NULL,
  `codigoLote` VARCHAR(50) NOT NULL,
  `trackingID` VARCHAR(60) NULL,
  `quantidade` FLOAT NOT NULL,
  `idTransportadora` INT NULL,
  `matricula_Veiculo_recolha` VARCHAR(30) NULL,
  `dataHoraRecolha` DATETIME NULL,
  INDEX `fk_QuantidadeStockReservado_Lote1_idx` (`codigoLote` ASC) ,
  PRIMARY KEY (`id`),
  INDEX `fk_Pedido_Lote_Transportadora1_idx` (`idTransportadora` ASC) ,
  CONSTRAINT `fk_QuantidadeStockReservado_Pedido`
    FOREIGN KEY (`idPedido`)
    REFERENCES `gestorpedreira`.`Pedido` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_QuantidadeStockReservado_Lote1`
    FOREIGN KEY (`codigoLote`)
    REFERENCES `gestorpedreira`.`Lote` (`codigo_lote`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pedido_Lote_Transportadora1`
    FOREIGN KEY (`idTransportadora`)
    REFERENCES `gestorpedreira`.`Transportadora` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorpedreira`.`Estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorpedreira`.`Estado` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorpedreira`.`TipoAcao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorpedreira`.`TipoAcao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorpedreira`.`Logs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorpedreira`.`Logs` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idUser` INT NULL,
  `idTipoAcao` INT NULL,
  `descricao` VARCHAR(255) NULL,
  `dataHora` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Logs_TipoAcao1_idx` (`idTipoAcao` ASC) ,
  CONSTRAINT `fk_Logs_TipoAcao1`
    FOREIGN KEY (`idTipoAcao`)
    REFERENCES `gestorpedreira`.`TipoAcao` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Logs_user1`
    FOREIGN KEY (`id`)
    REFERENCES `gestorpedreira`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorpedreira`.`perfil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorpedreira`.`perfil` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idUser` INT NULL,
  `idFotografia` INT NOT NULL,
  `email` VARCHAR(70) NOT NULL,
  `nome` VARCHAR(150) NULL,
  `telefone` VARCHAR(15) NULL,
  `morada` VARCHAR(150) NULL,
  `localidade` VARCHAR(50) NULL,
  `codPostal` VARCHAR(15) NULL,
  `nif` INT NULL,
  `nib` VARCHAR(50) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `timezone` VARCHAR(255) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Utilizador_Fotografia1_idx` (`idFotografia` ASC) ,
  INDEX `fk_dadosPessoais_user1_idx` (`idUser` ASC) ,
  CONSTRAINT `fk_Utilizador_Fotografia1`
    FOREIGN KEY (`idFotografia`)
    REFERENCES `gestorpedreira`.`Fotografia` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dadosPessoais_user1`
    FOREIGN KEY (`idUser`)
    REFERENCES `gestorpedreira`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorpedreira`.`Estado_Pedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorpedreira`.`Estado_Pedido` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idEstado` INT NOT NULL,
  `idPedido` INT NOT NULL,
  `dataEstado` DATETIME NULL,
  INDEX `fk_Estado_Pedido_Pedido1_idx` (`idPedido` ASC) ,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Estado_Pedido_Estado1`
    FOREIGN KEY (`idEstado`)
    REFERENCES `gestorpedreira`.`Estado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Estado_Pedido_Pedido1`
    FOREIGN KEY (`idPedido`)
    REFERENCES `gestorpedreira`.`Pedido` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorpedreira`.`Fotografia_Lote`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorpedreira`.`Fotografia_Lote` (
  `id` INT NOT NULL,
  `codigoLote` VARCHAR(50) NOT NULL,
  `idFotografia` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Fotografia_Lote_Lote1_idx` (`codigoLote` ASC) ,
  INDEX `fk_Fotografia_Lote_Fotografia1_idx` (`idFotografia` ASC) ,
  CONSTRAINT `fk_Fotografia_Lote_Lote1`
    FOREIGN KEY (`codigoLote`)
    REFERENCES `gestorpedreira`.`Lote` (`codigo_lote`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Fotografia_Lote_Fotografia1`
    FOREIGN KEY (`idFotografia`)
    REFERENCES `gestorpedreira`.`Fotografia` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorpedreira`.`Fotografia_Produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorpedreira`.`Fotografia_Produto` (
  `id` INT NOT NULL,
  `idProduto` INT NOT NULL,
  `idFotografia` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Fotografia_Produto_Produto1_idx` (`idProduto` ASC) ,
  INDEX `fk_Fotografia_Produto_Fotografia1_idx` (`idFotografia` ASC) ,
  CONSTRAINT `fk_Fotografia_Produto_Produto1`
    FOREIGN KEY (`idProduto`)
    REFERENCES `gestorpedreira`.`Produto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Fotografia_Produto_Fotografia1`
    FOREIGN KEY (`idFotografia`)
    REFERENCES `gestorpedreira`.`Fotografia` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorpedreira`.`migration`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorpedreira`.`migration` (
  `version` VARCHAR(180) NOT NULL,
  `apply_time` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`version`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gestorpedreira`.`user_auth`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorpedreira`.`user_auth` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `provider` VARCHAR(255) NOT NULL,
  `provider_id` VARCHAR(255) NOT NULL,
  `provider_attributes` TEXT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `user_auth_provider_id` (`provider_id` ASC) ,
  INDEX `user_auth_user_id` (`user_id` ASC) ,
  CONSTRAINT `user_auth_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `gestorpedreira`.`user` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `gestorpedreira`.`user_token`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorpedreira`.`user_token` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NULL DEFAULT NULL,
  `type` SMALLINT(6) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `data` VARCHAR(255) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `expired_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `user_token_token` (`token` ASC) ,
  INDEX `user_token_user_id` (`user_id` ASC) ,
  CONSTRAINT `user_token_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `gestorpedreira`.`user` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `gestorpedreira`.`notificacoes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorpedreira`.`notificacoes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idUser` INT NOT NULL,
  `mensagem` VARCHAR(255) NOT NULL,
  `notificacoescol` TINYINT NOT NULL DEFAULT 0,
  `origem` VARCHAR(100) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_notificacoes_user1_idx` (`idUser` ASC) ,
  CONSTRAINT `fk_notificacoes_user1`
    FOREIGN KEY (`idUser`)
    REFERENCES `gestorpedreira`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;