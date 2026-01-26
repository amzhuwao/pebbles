# Pebbles Elementary Admin Dashboard - Setup Guide

## Overview

This admin dashboard allows you to manage:

- **Gallery Sections**: Create photo galleries for different categories (School Events, Sports Day, etc.)
- **Gallery Photos**: Upload and organize photos within each section
- **News Articles**: Create, edit, and publish news articles on your website

## Installation Steps

### Step 1: Database Setup

1. **Create a MySQL Database**

   ```sql
   CREATE DATABASE pebbles_elementary CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   CREATE USER 'pebbles_user'@'localhost' IDENTIFIED BY 'secure_password_here';
   GRANT ALL PRIVILEGES ON pebbles_elementary.* TO 'pebbles_user'@'localhost';
   FLUSH PRIVILEGES;
   ```

2. **Run the SQL Schema**
   - Open `/admin/database.sql` in your MySQL client
   - Execute the entire script to create tables and default gallery sections

3. **Update Database Credentials**
   - Edit `/admin/config.php`
   - Update these constants:
     ```php
     define('DB_HOST', 'localhost');      // Your database host
     define('DB_USER', 'pebbles_user');   // Your database user
     define('DB_PASSWORD', 'your_password'); // Your database password
     define('DB_NAME', 'pebbles_elementary'); // Your database name
     ```

### Step 2: Admin Credentials

**Initial Login Credentials:**

- Username: `admin`
- Password: `admin123`

**⚠️ SECURITY WARNING**: Change these credentials immediately!

Edit `/admin/config.php` and update:

```php
define('ADMIN_USER', 'your_new_username');
define('ADMIN_PASSWORD', 'your_new_password');
```

### Step 3: Set File Permissions

Make the upload directories writable:

```bash
chmod 755 /admin/uploads/gallery/
chmod 755 /admin/uploads/news/
```

### Step 4: Access the Admin Dashboard

1. Navigate to: `http://your-domain.com/admin/login.php`
2. Log in with your credentials
3. Start managing content!

## Features

### Dashboard

- Overview of all content
- Quick access to gallery and news sections
- System statistics

### Gallery Management

- **Manage Sections**: Create, view, and delete gallery sections
- **Upload Photos**: Add photos to existing sections with titles and descriptions
- **Organize Photos**: Each section displays all uploaded photos with delete options
- **Default Sections**: Pre-populated with:
  - School Events
  - Classroom Activities
  - Sports Day
  - Assemblies
  - Field Trips

### News Management

- **Create Articles**: Write news articles with rich content
- **Featured Images**: Add images to articles
- **Draft/Publish**: Save as draft or publish immediately
- **Edit Articles**: Update existing articles
- **Delete Articles**: Remove articles from your site

## File Structure

```
/admin/
├── login.php           # Admin login page
├── dashboard.php       # Main admin interface
├── logout.php          # Logout script
├── config.php          # Database configuration
├── database.sql        # Database schema
├── pages/
│   ├── dashboard.php   # Dashboard overview
│   ├── gallery.php     # Gallery management
│   └── news.php        # News management
├── uploads/
│   ├── gallery/        # Gallery photos storage
│   └── news/           # News featured images storage
└── README.md           # This file
```

## Image Upload Specifications

**Supported Formats:**

- JPEG (.jpg, .jpeg)
- PNG (.png)
- GIF (.gif)
- WebP (.webp)

**File Size Limit:** 5MB per image

**Recommended Dimensions:**

- Gallery Photos: 1200x800px (landscape)
- News Featured Images: 1200x600px

## Security Considerations

1. **Change Default Credentials**: Update username and password in `config.php`
2. **HTTPS**: Always use HTTPS in production
3. **Database Password**: Use a strong, secure password
4. **File Permissions**: Ensure upload directories have correct permissions
5. **Backups**: Regularly backup your database and uploaded files

## Troubleshooting

### Can't Connect to Database

- Verify database credentials in `config.php`
- Ensure MySQL server is running
- Check database user has proper privileges

### Can't Upload Images

- Check file permissions on `/admin/uploads/` directories
- Verify image file format is supported
- Check file size doesn't exceed 5MB
- Ensure PHP has upload_tmp_dir configured

### Page Not Found

- Verify all PHP files are in correct directories
- Check URL path to admin folder
- Ensure your web server is configured for PHP

## Displaying Content on Frontend

### For Gallery Photos

The gallery photos are stored in the database and can be accessed via:

```
/admin/uploads/gallery/[filename]
```

You can create a `gallery-dynamic.php` file to display photos from the database.

### For News Articles

Create a `news-dynamic.php` file to display published articles from the database.

## Future Enhancements

Consider adding:

- User roles and permissions
- Article categories/tags
- Photo captions and metadata
- Comment moderation
- SEO optimization tools
- Backup and restore functionality
- Advanced search functionality

## Support

For issues or questions, ensure you've:

1. Followed all setup steps correctly
2. Checked file permissions
3. Verified database connection
4. Updated configuration files
