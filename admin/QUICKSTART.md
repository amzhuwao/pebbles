# Admin Dashboard System - Complete Setup Guide

## What Has Been Created

Your admin backend system is now ready! Here's what's included:

### 📁 File Structure

```
/admin/
├── login.php              # Admin login page
├── dashboard.php          # Main admin interface
├── logout.php             # Logout functionality
├── config.php             # Database & credentials config
├── database.sql           # Database schema (run this in MySQL)
├── setup.php              # Setup checklist page
├── README.md              # Full documentation
└── pages/
    ├── dashboard.php      # Dashboard overview
    ├── gallery.php        # Gallery management
    └── news.php           # News management
└── uploads/
    ├── gallery/           # Gallery photos storage
    └── news/              # News featured images storage
```

### 🎯 Features Included

#### 1. **Admin Authentication**

- Secure login system
- Session management
- Logout functionality
- Default credentials (CHANGE THESE!)

#### 2. **Gallery Management**

- Create gallery sections
- Upload photos to sections
- Organize photos with titles and descriptions
- Delete sections and photos
- Pre-populated with 5 default sections

#### 3. **News Management**

- Create news articles
- Add featured images
- Draft/Publish toggle
- Edit existing articles
- Full content editor
- Author attribution

#### 4. **Database System**

- MySQL database schema ready
- Relational tables
- Automatic timestamps
- Cascading deletes

## 🚀 Quick Start (5 Steps)

### Step 1: Create Database

Run in MySQL:

```sql
CREATE DATABASE pebbles_elementary CHARACTER SET utf8mb4;
CREATE USER 'pebbles_user'@'localhost' IDENTIFIED BY 'secure_password';
GRANT ALL PRIVILEGES ON pebbles_elementary.* TO 'pebbles_user'@'localhost';
FLUSH PRIVILEGES;
```

### Step 2: Run Database Schema

- Open `/admin/database.sql`
- Copy and paste into MySQL client
- Execute all SQL statements

### Step 3: Configure Connection

Edit `/admin/config.php` and update:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'pebbles_user');
define('DB_PASSWORD', 'your_password');
define('DB_NAME', 'pebbles_elementary');
```

### Step 4: Change Admin Password

Still in `/admin/config.php`, update:

```php
define('ADMIN_USER', 'your_new_username');
define('ADMIN_PASSWORD', 'your_new_password');
```

### Step 5: Set Permissions

```bash
chmod 755 /admin/uploads/gallery/
chmod 755 /admin/uploads/news/
```

## 📝 Login Details

**Default Credentials (CHANGE IMMEDIATELY):**

- URL: `http://your-domain.com/admin/login.php`
- Username: `admin`
- Password: `admin123`

⚠️ **IMPORTANT**: Change these in `/admin/config.php` before going live!

## 🎨 Dashboard Features

### Dashboard Tab

- Overview of system
- Quick stats
- Links to gallery and news sections

### Gallery Tab

**Manage Sections:**

- Create new gallery sections
- View all sections with photo counts
- Delete sections

**Upload Photos:**

- Select section to upload to
- Add photo title and description
- Upload image (max 5MB)
- Supported formats: JPG, PNG, GIF, WebP

### News Tab

**Create Articles:**

- Write article title
- Add author name
- Upload featured image (optional)
- Write article content
- Publish or save as draft
- See all articles with status

**Manage Articles:**

- View all articles in list format
- See publication status
- Edit articles
- Delete articles

## 💾 Database Tables

### gallery_sections

- id (Primary Key)
- section_name
- description
- display_order
- created_at, updated_at

### gallery_photos

- id (Primary Key)
- section_id (Foreign Key)
- photo_title
- photo_description
- photo_path
- display_order
- created_at, updated_at

### news_articles

- id (Primary Key)
- title
- content
- featured_image
- author
- is_published
- publish_date
- created_at, updated_at

### admin_logs

- id (Primary Key)
- action
- details
- created_at

## 🔒 Security Notes

1. **Change Default Credentials** - Do this immediately!
2. **Use HTTPS** - Always use HTTPS in production
3. **Strong Passwords** - Use strong database and admin passwords
4. **Backups** - Regular database backups are essential
5. **File Permissions** - Keep upload directories properly secured
6. **Database Access** - Limit database user to localhost only

## 📱 Image Specifications

**Gallery Photos:**

- Max size: 5MB
- Formats: JPG, PNG, GIF, WebP
- Recommended: 1200x800px

**News Featured Images:**

- Max size: 5MB
- Formats: JPG, PNG, GIF, WebP
- Recommended: 1200x600px

## 🐛 Troubleshooting

### Can't Connect to Database

- Check credentials in config.php
- Verify MySQL server is running
- Confirm user has proper privileges

### Images Won't Upload

- Check folder permissions (755)
- Verify file format is supported
- Check file size < 5MB
- Ensure php.ini allows uploads

### Can't Access Admin Panel

- Verify login.php file exists
- Check PHP is enabled on server
- Confirm correct URL

## 🔗 Accessing Content

Gallery photos are stored at:

```
/admin/uploads/gallery/[filename]
```

News images are stored at:

```
/admin/uploads/news/[filename]
```

You can display this content on your website by:

1. Querying the database directly, OR
2. Creating dynamic pages that fetch from the database

## 📚 Next Steps

1. Complete the setup using `/admin/setup.php`
2. Log in with new credentials
3. Create gallery sections
4. Upload some photos
5. Write a test article
6. Test the functionality

## 📖 Full Documentation

See `/admin/README.md` for comprehensive documentation including:

- Detailed installation steps
- Feature descriptions
- File structure
- Security guidelines
- Troubleshooting guide
- Future enhancement ideas

---

**Your admin dashboard is ready to use!**

Visit: `http://your-domain.com/admin/login.php` to get started.
