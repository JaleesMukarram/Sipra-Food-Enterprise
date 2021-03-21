
-- THIS TRIGGER WILL INCREASE THE STOCK AMOUNT WHEN
-- A NEW CHECK IN IS ADDED

DELIMITER $$
CREATE TRIGGER AFTER__CHECK_IN__INSERT
AFTER INSERT
ON stock_in FOR EACH ROW
BEGIN
        
    UPDATE stock s SET s.amount = s.amount + NEW.amount WHERE s.id = NEW.stock_id;
    
END $$


-- THIS TRIGGER WILL INCREASE THE STOCK AMOUNT WHEN
-- A NEW CHECK IN IS ADDED

DELIMITER $$
CREATE TRIGGER AFTER__CHECK_IN__DELETE 
AFTER DELETE 
ON stock_in FOR EACH ROW
BEGIN

    UPDATE stock s SET s.amount = s.amount - OLD.amount WHERE s.id = OLD.stock_id;
    
END $$



-- STOCK_EFFECT VALUE UPDATING
DELIMITER $$
CREATE TRIGGER BEFORE__CHECK_IN_STOCK_EFFECT__INSERT 
BEFORE INSERT
    ON stock_in FOR EACH ROW 
 BEGIN

	SET NEW.stock_after = (SELECT amount FROM stock s WHERE s.id = NEW.stock_id) + NEW.amount;

END $$



-- THIS TRIGGER WILL CHECK AT WHILE CHECK_OUT STOCK, THE AMOUNT 
-- IS LESS THAN THE AMOUNT IN THE STOCK

DELIMITER $$
CREATE TRIGGER BEFORE__CHECK_OUT__INSERT
BEFORE INSERT
ON stock_out FOR EACH ROW
BEGIN

    DECLARE total_stock int;

    SELECT amount INTO total_stock FROM stock
    WHERE id = NEW.stock_id;

    IF  NEW.amount > total_stock  THEN
        	signal sqlstate '45000' set message_text = 'Amount Greater than available amount';
    END IF;

END $$


-- THIS TRIGGER WILL DECREASE THE STOCK AMOUNT WHEN
-- A  CHECK OUT IS ADDED

DELIMITER $$
CREATE TRIGGER AFTER__CHECK_OUT__INSERT
AFTER INSERT
ON stock_out FOR EACH ROW
BEGIN
        
    UPDATE stock s SET s.amount = s.amount - NEW.amount WHERE s.id = NEW.stock_id;
    
END $$


-- STOCK_EFFECT VALUE UPDATING
DELIMITER $$
CREATE TRIGGER BEFORE__CHECK_OUT_STOCK_EFFECT__INSERT 
BEFORE INSERT
    ON stock_out FOR EACH ROW 
 BEGIN

	SET NEW.stock_after = (SELECT amount FROM stock s WHERE s.id = NEW.stock_id) - NEW.amount;

END $$


-- STOCK_RETURN VALUE CHECK
DELIMITER $$
CREATE TRIGGER BEFORE__STOCK_OUT_RETURN_AMOUNT__INSERT 
BEFORE INSERT
    ON stock_out_return FOR EACH ROW 
 BEGIN

    DECLARE total_out_amount INT;
    DECLARE stock_out_date DATE;

    SELECT SO.amount,  SO.out_date 
        INTO total_out_amount, stock_out_date 
    FROM stock_out SO
    WHERE SO.id = NEW.stock_out_id;

    IF NEW.amount  > total_out_amount THEN
        signal sqlstate '45000' set message_text = 'Amount Greater than taken amount';

    ELSEIF NEW.return_date < stock_out_date THEN
        signal sqlstate '45000' set message_text = 'Stock Return should after stock out date';
    END IF;

    IF  NEW.amount = total_out_amount THEN
        SET NEW.status = "SUCCESS";

    ELSEIF  NEW.amount = 0  THEN
        SET NEW.status = "FAILED"; 


    ELSEIF  NEW.amount / total_out_amount >= 0.8  THEN
        SET NEW.status = "EXCELLENT"; 

    ELSEIF  NEW.amount / total_out_amount >= 0.6  THEN
        SET NEW.status = "GOOD"; 

    ELSEIF  NEW.amount / total_out_amount >= 0.4  THEN
        SET NEW.status = "AVERAGE"; 

    ELSE
        SET NEW.status = "POOR"; 
    
    END IF;

END $$

