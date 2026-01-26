-- Pebbles Elementary Admin System Database Schema
-- Execute this SQL to set up the database
CREATE TABLE IF NOT EXISTS gallery_sections (
    id INT PRIMARY KEY AUTO_INCREMENT,
    section_name VARCHAR(100) NOT NULL,
    description TEXT,
    display_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS gallery_photos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    section_id INT NOT NULL,
    photo_title VARCHAR(255) NOT NULL,
    photo_description TEXT,
    photo_path VARCHAR(255) NOT NULL,
    display_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (section_id) REFERENCES gallery_sections(id) ON DELETE CASCADE
);
CREATE TABLE IF NOT EXISTS news_articles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content LONGTEXT NOT NULL,
    featured_image VARCHAR(255),
    author VARCHAR(100),
    is_published BOOLEAN DEFAULT FALSE,
    publish_date DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS admin_logs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    action VARCHAR(255),
    details TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Insert default gallery section
INSERT INTO gallery_sections (section_name, description, display_order)
VALUES (
        'School Events',
        'Photos from school events and activities',
        1
    ),
    (
        'Classroom Activities',
        'Classroom learning moments',
        2
    ),
    (
        'Sports Day',
        'Sports day events and competitions',
        3
    ),
    (
        'Assemblies',
        'School assemblies and ceremonies',
        4
    ),
    (
        'Field Trips',
        'Student field trip experiences',
        5
    );