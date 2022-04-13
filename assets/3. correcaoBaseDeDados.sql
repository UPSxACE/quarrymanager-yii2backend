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

