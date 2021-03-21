CREATE TABLE IF NOT EXISTS `sipra_foods_schema`.`stock_out` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `amount` INT NOT NULL,
    `stock_id` INT NOT NULL,
    `detail` VARCHAR(455) NULL,
    `stock_after` INT NULL,
    `out_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `created_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `employee_id` INT NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_sale_operation_employee1_idx` (`employee_id` ASC) VISIBLE,
    INDEX `fk_stock_out_stock1_idx` (`stock_id` ASC) VISIBLE,
    CONSTRAINT `fk_sale_operation_employee1` FOREIGN KEY (`employee_id`) REFERENCES `sipra_foods_schema`.`employee` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `fk_stock_out_stock1` FOREIGN KEY (`stock_id`) REFERENCES `sipra_foods_schema`.`stock` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT stock_out_valid CHECK((FN_CHECK_STOCK_COUNT(stock_id, amount) = 1))
) ENGINE = InnoDB

CREATE TABLE IF NOT EXISTS `sipra_foods_schema`.`stock_out` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `amount` INT NOT NULL,
  `stock_id` INT NOT NULL,
  `detail` VARCHAR(455) NULL,
  `stock_after` INT NULL,
  `out_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `created_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `employee_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_sale_operation_employee1_idx` (`employee_id` ASC) VISIBLE,
  INDEX `fk_stock_out_stock1_idx` (`stock_id` ASC) VISIBLE,
  CONSTRAINT `fk_sale_operation_employee1`
    FOREIGN KEY (`employee_id`)
    REFERENCES `sipra_foods_schema`.`employee` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_stock_out_stock1`
    FOREIGN KEY (`stock_id`)
    REFERENCES `sipra_foods_schema`.`stock` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT stock_out_valid CHECK((FN_CHECK_STOCK_COUNT(stock_id, amount) = 1))
    )
ENGINE = InnoDB


-- 2
-- 2
-- 2
-- 2
-- 2
DELIMITER $$ 
CREATE FUNCTION FN_CHECK_STOCK_COUNT (stock_id INT, out_amount INT)
RETURNS INT(1) 
DETERMINISTIC 
BEGIN 
    DECLARE DB_AMOUNT,GOOD INT;
SELECT
    amount INTO DB_AMOUNT
FROM
    stock
WHERE
    id = stock_id;

IF out_amount <= DB_AMOUNT THEN
SET
    GOOD = 1;

ELSE
SET
    GOOD = 0;

END IF;

RETURN GOOD;

END $ $