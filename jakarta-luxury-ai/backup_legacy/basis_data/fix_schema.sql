-- Fix Jakarta Luxury AI Database Schema Issues
-- This script fixes the missing columns and ENUM issues
USE jakarta_luxury_ai;
-- Add 'address' column to users table if it doesn't exist
-- MySQL doesn't support IF NOT EXISTS for ALTER TABLE, so we use a procedure
DELIMITER $$ DROP PROCEDURE IF EXISTS AddAddressColumn $$ CREATE PROCEDURE AddAddressColumn() BEGIN
DECLARE column_exists INT DEFAULT 0;
SELECT COUNT(*) INTO column_exists
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_SCHEMA = 'jakarta_luxury_ai'
    AND TABLE_NAME = 'users'
    AND COLUMN_NAME = 'address';
IF column_exists = 0 THEN
ALTER TABLE users
ADD COLUMN address VARCHAR(255) DEFAULT NULL
AFTER phone;
SELECT 'Column address added successfully!' as status;
ELSE
SELECT 'Column address already exists!' as status;
END IF;
END $$ DELIMITER;
CALL AddAddressColumn();
DROP PROCEDURE IF EXISTS AddAddressColumn;
-- Display current users table structure
DESCRIBE users;
-- Display current reservations table structure  
DESCRIBE reservations;
SELECT 'Schema fix completed successfully!' as final_status;