-- [12/06 Saturday] : SQL Changes to TblBankAccount

ALTER TABLE itsraghz.TblBankAcct DROP KEY ShortName;
ALTER TABLE itsraghz.TblBankAcct ADD COLUMN (IsActive char(1) DEFAULT 'N');
ALTER TABLE itsraghz.TblBankAcct ADD CONSTRAINT UNIQUE KEY TblBankAcct_UK_1 (ShortName, ValidThru, IsActive);
UPDATE itsraghz.TblBankAcct set IsActive='Y' where ShortName like '%2%';
--
UPDATE itsraghz.TblBankAcct set ShortName='CitiPlatinum' where ShortName='CitiPlatinum2';
UPDATE itsraghz.TblBankAcct set ShortName='HSBCPlatinum' where ShortName='HSBCPlatinumNew2';
UPDATE itsraghz.TblBankAcct set ShortName='SBIPlatinum-Addon' where ShortName='SBIPlatinum-Addon-2'

-- [12/07 Sunday] : To avoid mishaps, add NOT NULL constraint
--    Hint: If there are already rows existing with NULL values, you got to update them before adding this NOT NULL constraint!

ALTER TABLE itsraghz.TblBankAcct MODIFY COLUMN AcctNo VARCHAR(20) NOT NULL;
ALTER TABLE itsraghz.TblBankAcct MODIFY COLUMN NameRegistered VARCHAR(30) NOT NULL COMMENT 'Name Registered for the subscription/account';
ALTER TABLE itsraghz.TblBankAcct MODIFY COLUMN EmailRegistered VARCHAR(100) DEFAULT 'raghavan.30may1981@gmail.com' COMMENT 'Email Registered for the subscription/account';
ALTER TABLE itsraghz.TblBankAcct MODIFY COLUMN ValidThru VARCHAR(5) DEFAULT '12/99' COMMENT 'The validity period of the card (mentioned as mm/yy)';
ALTER TABLE itsraghz.TblBankAcct MODIFY COLUMN AcctType VARCHAR(10) DEFAULT 'Debit' COMMENT 'Type of account - Debit/Creidt/Subscription etc.,';
--
SELECT COUNT(*) from itsraghz.TblBankAcct where NameRegistered IS NULL;
UPDATE itsraghz.TblBankAcct set NameRegistered='NULLRenamed' where NameRegistered IS NULL;
--

