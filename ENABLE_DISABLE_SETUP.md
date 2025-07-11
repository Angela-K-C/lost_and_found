# Enable/Disable User Functionality Setup

## Database Setup Required

To use the enable/disable functionality, you need to add a status column to your users table.

### Option 1: Run the SQL script

Execute the SQL file: `sql/add_user_status.sql`

### Option 2: Run this SQL manually in phpMyAdmin

```sql
ALTER TABLE `users` ADD COLUMN `status` ENUM('active', 'disabled') DEFAULT 'active' AFTER `profile_pic`;
UPDATE `users` SET `status` = 'active' WHERE `status` IS NULL;
```

## Features Included

✅ **Toggle Functionality**: Button changes between "Disable" and "Enable"
✅ **Status Display**: Shows "Active" or "Disabled" status in table
✅ **Confirmation Dialog**: Asks for confirmation before changing status
✅ **Success Messages**: Shows confirmation when status is changed
✅ **Error Handling**: Handles various error scenarios
✅ **Visual Styling**: Color-coded status indicators and buttons

## How it Works

1. **Active users** see a red "Disable" button
2. **Disabled users** see a green "Enable" button
3. Status is displayed in a separate column with color coding
4. All changes are logged with success/error messages

## Files Modified

- `pages/disable_user.php` - New file for toggle functionality
- `pages/all_users.php` - Updated to show status and toggle button
- `assets/css/all_users.css` - Added styles for status and buttons
- `sql/add_user_status.sql` - SQL script to add status column
