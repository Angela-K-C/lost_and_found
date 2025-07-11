-- Add status column to users table for enable/disable functionality
ALTER TABLE `users` ADD COLUMN `status` ENUM('active', 'disabled') DEFAULT 'active' AFTER `profile_pic`;

-- Update existing users to have active status
UPDATE `users` SET `status` = 'active' WHERE `status` IS NULL;
