-- STOCK_in AFTER VALUE UPDATING
DELIMITER $$

CREATE TRIGGER BEFORE__STOCK_EFFECT_VALUE_INSERT BEFORE
INSERT
    ON stock_in FOR EACH ROW 
 BEGIN
	SET NEW.stock_after = (
        SELECT
            amount
        FROM
            stock s
        WHERE
            s.id = NEW.stock_id
    ) + NEW.amount;
END $$

DELIMITER


 -- STOCK AMOUNT UPDATING ON NEW STOCK IN
CREATE TRIGGER AFTER__CHECK_IN__INSERT
AFTER
INSERT
    ON stock_in FOR EACH ROW
UPDATE
    stock s
SET
    s.amount = s.amount + NEW.amount
WHERE
    s.id = NEW.stock_id 
    
    
    
    -- STOCK AMOUNT UPDATING ON DELETE STOCK IN
CREATE TRIGGER AFTER__CHECK_OUT__DELETE 
AFTER 
DELETE 
    ON stock_in FOR EACH ROW
UPDATE
    stock s
SET
    s.amount = s.amount - OLD.amount
WHERE
    s.id = OLD.stock_id
    
