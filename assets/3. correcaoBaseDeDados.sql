use gestorpedreira;

ALTER TABLE profile
ADD COLUMN dataNascimento date
AFTER full_name;

ALTER TABLE profile
ADD COLUMN genero tinyint
AFTER full_name; 

ALTER TABLE `gestorpedreira`.`produto` 
ADD COLUMN `idFotografia` INT NULL AFTER `idCor`,
ADD INDEX `fk_Produto_Fotografia_idx` (`idFotografia` ASC);
;
ALTER TABLE `gestorpedreira`.`produto` 
ADD CONSTRAINT `fk_Produto_Fotografia1`
  FOREIGN KEY (`idFotografia`)
  REFERENCES `gestorpedreira`.`fotografia` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `gestorpedreira`.`produto` 
ADD COLUMN `na_loja` TINYINT(1) NULL DEFAULT 0 AFTER `preco`;

ALTER TABLE `gestorpedreira`.`material` 
ADD COLUMN `prefixo` VARCHAR(3) NULL AFTER `nome`,
ADD UNIQUE INDEX `prefixo_UNIQUE` (`prefixo` ASC);

ALTER TABLE `gestorpedreira`.`cor` 
ADD COLUMN `prefixo` VARCHAR(3) NULL AFTER `nome`,
ADD UNIQUE INDEX `prefixo_UNIQUE` (`prefixo` ASC);

ALTER TABLE `gestorpedreira`.`pedido` 
ADD COLUMN `localidade` VARCHAR(50) NULL AFTER `morada`,
ADD COLUMN `codPostal` VARCHAR(15) NULL AFTER `localidade`,
ADD COLUMN `nib` INT(11) NULL AFTER `nif`;

ALTER TABLE `gestorpedreira`.`pedido` 
ADD COLUMN `codigo_desconto` VARCHAR(50) NULL AFTER `desconto`;

ALTER TABLE `gestorpedreira`.`estado_pedido` 
ADD COLUMN `last` TINYINT(1) NOT NULL DEFAULT 1 AFTER `dataEstado`;


