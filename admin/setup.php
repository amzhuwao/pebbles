<?php

/**
 * ADMIN SETUP CHECKLIST
 * Complete these steps to get your admin dashboard running
 */

echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
echo "<title>Admin Setup - Pebbles Elementary</title>";
echo "<style>";
echo "body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }";
echo ".container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; }";
echo "h1 { color: #667eea; }";
echo ".step { background: #f9f9f9; padding: 15px; margin: 15px 0; border-left: 4px solid #667eea; }";
echo ".step h3 { margin: 0 0 10px 0; }";
echo ".step code { background: #f0f0f0; padding: 2px 5px; border-radius: 3px; }";
echo ".success { color: #28a745; }";
echo ".warning { color: #dc3545; }";
echo ".info { background: #e7f3ff; padding: 15px; border-radius: 5px; margin: 15px 0; border-left: 4px solid #2196F3; }";
echo "</style>";
echo "</head>";
echo "<body>";
echo "<div class='container'>";
echo "<h1>🔧 Admin Dashboard Setup Checklist</h1>";

echo "<div class='info'>";
echo "<strong>⚠️ Important:</strong> Follow these steps in order to set up your admin dashboard.";
echo "</div>";

echo "<div class='step'>";
echo "<h3>✅ Step 1: Database Setup</h3>";
echo "<p>Run this SQL command in your MySQL client:</p>";
echo "<code>CREATE DATABASE pebbles_elementary CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;</code><br>";
echo "<code>CREATE USER 'pebbles_user'@'localhost' IDENTIFIED BY 'secure_password_here';</code><br>";
echo "<code>GRANT ALL PRIVILEGES ON pebbles_elementary.* TO 'pebbles_user'@'localhost';</code><br>";
echo "<code>FLUSH PRIVILEGES;</code>";
echo "</div>";

echo "<div class='step'>";
echo "<h3>✅ Step 2: Execute Database Schema</h3>";
echo "<ol>";
echo "<li>Open <code>/admin/database.sql</code> file</li>";
echo "<li>Copy all the SQL code</li>";
echo "<li>Paste it into your MySQL client</li>";
echo "<li>Execute the script</li>";
echo "</ol>";
echo "<p><strong>This will create:</strong> gallery_sections, gallery_photos, news_articles, admin_logs tables</p>";
echo "</div>";

echo "<div class='step'>";
echo "<h3>✅ Step 3: Configure Database Credentials</h3>";
echo "<ol>";
echo "<li>Edit <code>/admin/config.php</code></li>";
echo "<li>Update these lines with your database info:</li>";
echo "</ol>";
echo "<code>define('DB_HOST', 'localhost');</code><br>";
echo "<code>define('DB_USER', 'pebbles_user');</code><br>";
echo "<code>define('DB_PASSWORD', 'your_password');</code><br>";
echo "<code>define('DB_NAME', 'pebbles_elementary');</code>";
echo "</div>";

echo "<div class='step'>";
echo "<h3>✅ Step 4: Change Admin Credentials (IMPORTANT!)</h3>";
echo "<p class='warning'><strong>Default login is admin/admin123 - CHANGE THIS NOW!</strong></p>";
echo "<ol>";
echo "<li>Edit <code>/admin/config.php</code></li>";
echo "<li>Change these lines:</li>";
echo "</ol>";
echo "<code>define('ADMIN_USER', 'your_new_username');</code><br>";
echo "<code>define('ADMIN_PASSWORD', 'your_new_password');</code>";
echo "</div>";

echo "<div class='step'>";
echo "<h3>✅ Step 5: Set File Permissions</h3>";
echo "<p>Make upload directories writable:</p>";
echo "<code>chmod 755 /admin/uploads/gallery/</code><br>";
echo "<code>chmod 755 /admin/uploads/news/</code>";
echo "</div>";

echo "<div class='step'>";
echo "<h3>✅ Step 6: Test Login</h3>";
echo "<p>Visit: <code>http://your-domain.com/admin/login.php</code></p>";
echo "<p>Log in with your new credentials</p>";
echo "</div>";

echo "<div class='info' style='background: #d4edda;'>";
echo "<h3>🎉 You're all set!</h3>";
echo "<p>Your admin dashboard is ready to use. You can now:</p>";
echo "<ul>";
echo "<li>Create gallery sections</li>";
echo "<li>Upload photos</li>";
echo "<li>Create news articles</li>";
echo "<li>Manage all content from one place</li>";
echo "</ul>";
echo "</div>";

echo "</div>";
echo "</body>";
echo "</html>";
