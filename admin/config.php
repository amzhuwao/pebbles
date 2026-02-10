<?php
// Start session first, before any output
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '@Fl011326');
define('DB_NAME', 'pebbles_elementary');

// Admin credentials (change these!)
define('ADMIN_USER', 'admin');
define('ADMIN_PASSWORD', 'admin123'); // CHANGE THIS!

// Upload paths
define('GALLERY_UPLOAD_DIR', __DIR__ . '/uploads/gallery/');
define('NEWS_UPLOAD_DIR', __DIR__ . '/uploads/news/');

// Allowed image types
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/gif', 'image/webp']);
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB

// Connect to database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset
$conn->set_charset("utf8");
