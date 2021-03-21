CREATE TABLE Accounts (`AccountID` int, `AccountBalance` decimal(11, 2));
INSERT INTO Accounts (`AccountID`, `AccountBalance`)
VALUES (1, NULL),
    (2, NULL);
CREATE TABLE Transactions (
    `TransactionID` int,
    `AccountID` int,
    `TransactionAmount` decimal(11, 2)
);
CREATE TRIGGER NewTrigger
AFTER
INSERT ON Transactions FOR EACH ROW
UPDATE Accounts a
SET a.AccountBalance = (
        SELECT SUM(TransactionAmount)
        FROM Transactions
        WHERE AccountID = a.AccountID
    )
WHERE a.AccountID = NEW.AccountID;


INSERT INTO Transactions (
        `TransactionID`,
        `AccountID`,
        `TransactionAmount`
    )
VALUES (1, 1, 10.50);
;
INSERT INTO Transactions (
        `TransactionID`,
        `AccountID`,
        `TransactionAmount`
    )
VALUES (1, 1, 19.50);
;
INSERT INTO Transactions (
        `TransactionID`,
        `AccountID`,
        `TransactionAmount`
    )
VALUES (1, 2, 25.45);
;
INSERT INTO Transactions (
        `TransactionID`,
        `AccountID`,
        `TransactionAmount`
    )
VALUES (1, 2, 10.55);
;