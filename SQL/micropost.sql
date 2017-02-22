CREATE TABLE IF NOT EXISTS `mydb`.`micropost` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `content` VARCHAR(255) NOT NULL COMMENT '',
  `created` DATETIME NOT NULL COMMENT '',
  `modified` DATETIME NOT NULL COMMENT '',
  `valid` TINYINT(4) NOT NULL DEFAULT 1 COMMENT '',
  `user_id` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_micropost_user_idx` (`user_id` ASC)  COMMENT '',
  CONSTRAINT `fk_micropost_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `mydb`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
