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
CREATE TABLE IF NOT EXISTS newsletters (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content LONGTEXT NOT NULL,
    recipient_count INT DEFAULT 0,
    sent_date DATETIME,
    is_sent BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS events (
    id INT PRIMARY KEY AUTO_INCREMENT,
    event_name VARCHAR(255) NOT NULL,
    event_description TEXT,
    event_date DATETIME NOT NULL,
    event_location VARCHAR(255),
    event_image VARCHAR(255),
    featured BOOLEAN DEFAULT FALSE,
    is_published BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
-- Insert default gallery sections
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
-- Insert placeholder gallery photos
INSERT INTO gallery_photos (
        section_id,
        photo_title,
        photo_description,
        photo_path,
        display_order
    )
VALUES -- School Events photos
    (
        1,
        'Annual Fundraiser 2026',
        'Our successful charity fundraiser event with students and parents',
        'uploads/gallery/school_event_fundraiser.jpg',
        1
    ),
    (
        1,
        'Graduation Ceremony',
        'Year 6 students celebrating their graduation',
        'uploads/gallery/school_event_graduation.jpg',
        2
    ),
    (
        1,
        'Winter Concert',
        'Students performing at the annual winter concert',
        'uploads/gallery/school_event_concert.jpg',
        3
    ),
    (
        1,
        'Book Week Celebration',
        'Students dressed as their favorite characters',
        'uploads/gallery/school_event_bookweek.jpg',
        4
    ),
    -- Classroom Activities photos
    (
        2,
        'Science Experiment',
        'Year 4 exploring chemical reactions',
        'uploads/gallery/classroom_science.jpg',
        1
    ),
    (
        2,
        'Art Class Creations',
        'Beautiful artwork created by our talented students',
        'uploads/gallery/classroom_art.jpg',
        2
    ),
    (
        2,
        'Reading Corner',
        'Students enjoying quiet reading time',
        'uploads/gallery/classroom_reading.jpg',
        3
    ),
    (
        2,
        'Math Workshop',
        'Hands-on learning with manipulatives',
        'uploads/gallery/classroom_math.jpg',
        4
    ),
    (
        2,
        'Group Project',
        'Collaborative learning in action',
        'uploads/gallery/classroom_group.jpg',
        5
    ),
    -- Sports Day photos
    (
        3,
        'Running Race',
        'Year 5 students competing in the 100m dash',
        'uploads/gallery/sports_running.jpg',
        1
    ),
    (
        3,
        'Team Relay',
        'Exciting relay race finish',
        'uploads/gallery/sports_relay.jpg',
        2
    ),
    (
        3,
        'Obstacle Course',
        'Students navigating the challenging obstacle course',
        'uploads/gallery/sports_obstacle.jpg',
        3
    ),
    (
        3,
        'Award Ceremony',
        'Winners receiving their medals',
        'uploads/gallery/sports_awards.jpg',
        4
    ),
    (
        3,
        'Tug of War',
        'Red team vs Blue team competition',
        'uploads/gallery/sports_tugofwar.jpg',
        5
    ),
    -- Assemblies photos
    (
        4,
        'Monday Morning Assembly',
        'Whole school gathering to start the week',
        'uploads/gallery/assembly_monday.jpg',
        1
    ),
    (
        4,
        'Achievement Awards',
        'Students receiving certificates for outstanding work',
        'uploads/gallery/assembly_awards.jpg',
        2
    ),
    (
        4,
        'Guest Speaker Visit',
        'Local author speaking to students',
        'uploads/gallery/assembly_speaker.jpg',
        3
    ),
    (
        4,
        'Harvest Festival',
        'Celebrating our harvest festival together',
        'uploads/gallery/assembly_harvest.jpg',
        4
    ),
    -- Field Trips photos
    (
        5,
        'Museum Visit',
        'Year 3 exploring the natural history museum',
        'uploads/gallery/trip_museum.jpg',
        1
    ),
    (
        5,
        'Farm Adventure',
        'Learning about farm animals and crops',
        'uploads/gallery/trip_farm.jpg',
        2
    ),
    (
        5,
        'Beach Clean-up',
        'Environmental awareness field trip',
        'uploads/gallery/trip_beach.jpg',
        3
    ),
    (
        5,
        'Castle Tour',
        'Historical learning at the local castle',
        'uploads/gallery/trip_castle.jpg',
        4
    ),
    (
        5,
        'Science Centre',
        'Interactive exhibits and demonstrations',
        'uploads/gallery/trip_science.jpg',
        5
    );
-- Insert placeholder news articles
INSERT INTO news_articles (
        title,
        content,
        featured_image,
        author,
        is_published,
        publish_date
    )
VALUES (
        'Pebbles Elementary Wins Regional Science Fair',
        '<p>We are thrilled to announce that our Year 5 students have won first place at the Regional Science Fair this weekend! The team, consisting of Emily Thompson, James Chen, and Aisha Patel, presented their innovative project on renewable energy solutions.</p>

<p>Their project, titled "Solar Power for Schools," demonstrated how schools could reduce their carbon footprint by implementing solar panels and energy-efficient systems. The judges were particularly impressed by the students'' thorough research and practical approach to solving real-world problems.</p>

<p>"We wanted to show that even kids can make a difference when it comes to protecting our planet," said Emily Thompson, one of the team members. "Our school has been really supportive, and we hope this project inspires other schools to think about renewable energy."</p>

<p>The students worked on this project for three months under the guidance of Mr. Davies, our Science Coordinator. They will now represent our region at the National Science Fair in March.</p>

<p>Congratulations to our brilliant scientists and thank you to all the parents and staff who supported them!</p>',
        'uploads/news/science_fair_winners.jpg',
        'Mrs. Robertson',
        1,
        '2026-01-20 09:00:00'
    ),
    (
        'New Library Extension Opening Next Month',
        '<p>After months of construction, we are excited to announce that our new library extension will officially open on February 15th, 2026. The expansion includes a dedicated reading corner, computer lab, and a special maker space for creative projects.</p>

<p>The new 200-square-meter extension doubles our current library space and will provide students with access to over 5,000 new books, including a diverse range of fiction, non-fiction, and digital resources.</p>

<p>Head Teacher Ms. Johnson commented: "Reading is fundamental to learning, and this new space will inspire our students to develop a lifelong love of books. The maker space will also allow children to explore STEM activities in an engaging, hands-on environment."</p>

<p>The library extension was made possible through generous funding from the Parent-Teacher Association and a grant from the Local Education Authority. Special thanks to everyone who contributed to our fundraising efforts last year.</p>

<p>We will be hosting an open house event on February 14th from 2-4 PM for parents and families to tour the new facilities. Please RSVP through the school office.</p>',
        'uploads/news/library_extension.jpg',
        'Mr. Patterson',
        1,
        '2026-01-18 10:30:00'
    ),
    (
        'Spring Term Drama Production: The Lion King Jr.',
        '<p>Our drama department is thrilled to announce this term''s production: Disney''s The Lion King Jr. The show will run for three nights from March 21-23, 2026 in the school hall.</p>

<p>This beloved musical tells the story of Simba, a young lion who must embrace his destiny as king. Over 60 students from Years 4-6 will participate in the production, both on stage and behind the scenes.</p>

<p>Auditions will be held on February 5th and 6th after school. Students interested in performing should sign up at the school office. We are also looking for volunteers to help with costumes, props, and set design.</p>

<p>Drama Coordinator Mrs. Foster said: "The Lion King Jr. is a perfect production for our students. It teaches important lessons about courage, friendship, and finding your place in the world. We can''t wait to see our talented students bring this story to life!"</p>

<p>Tickets will go on sale in early March. All proceeds will support the drama department and future productions.</p>

<p><strong>Important Dates:</strong></p>
<ul>
<li>Auditions: February 5-6</li>
<li>First Rehearsal: February 12</li>
<li>Performance Dates: March 21-23, 7:00 PM</li>
</ul>',
        'uploads/news/lion_king_production.jpg',
        'Mrs. Foster',
        1,
        '2026-01-15 14:00:00'
    ),
    (
        'Healthy Eating Week - February 10-14',
        '<p>Next month, Pebbles Elementary will be celebrating Healthy Eating Week! This initiative aims to educate our students about the importance of nutrition and making healthy food choices.</p>

<p>Throughout the week, students will participate in various activities including:</p>
<ul>
<li><strong>Monday:</strong> "Rainbow Day" - Students bring colorful fruits and vegetables for snack time</li>
<li><strong>Tuesday:</strong> Cooking demonstrations with local chef Sarah Williams</li>
<li><strong>Wednesday:</strong> Nutrition workshops for each year group</li>
<li><strong>Thursday:</strong> "Design a Healthy Lunchbox" competition</li>
<li><strong>Friday:</strong> Smoothie-making sessions and celebration assembly</li>
</ul>

<p>Our school kitchen will also be serving special healthy menus throughout the week, featuring dishes made with locally-sourced ingredients.</p>

<p>"We believe that teaching children about healthy eating early on helps them develop lifelong positive habits," said School Nurse Mrs. Kelly. "This week will be fun, interactive, and educational for all our students."</p>

<p>Parents are invited to join us for the Friday celebration assembly at 9:30 AM, where we will announce the winners of our competitions and share what we''ve learned.</p>

<p>More information and recipe cards will be sent home next week.</p>',
        'uploads/news/healthy_eating_week.jpg',
        'Mrs. Kelly',
        1,
        '2026-01-22 11:00:00'
    ),
    (
        'Parent-Teacher Conferences - February 3-5',
        '<p>Our Spring Term Parent-Teacher Conferences will take place from February 3rd to 5th. This is an excellent opportunity for parents and guardians to discuss their child''s progress and development with their class teacher.</p>

<p><strong>Conference Schedule:</strong></p>
<ul>
<li>Tuesday, February 3rd: 3:30 PM - 7:00 PM</li>
<li>Wednesday, February 4th: 3:30 PM - 7:00 PM</li>
<li>Thursday, February 5th: 3:30 PM - 6:00 PM</li>
</ul>

<p>Each appointment will last approximately 15 minutes. Booking forms were sent home this week - please return them by January 31st to secure your preferred time slot.</p>

<p>Teachers will discuss your child''s academic progress, social development, and any areas where additional support might be beneficial. Please feel free to prepare any questions you may have in advance.</p>

<p>If you are unable to attend during these times, please contact your child''s teacher to arrange an alternative appointment.</p>

<p>Childcare will be available in the school hall during conference hours for families who need it. Please indicate on your booking form if you require this service.</p>

<p>We look forward to meeting with all our families!</p>',
        'uploads/news/parent_teacher_conferences.jpg',
        'Ms. Johnson',
        1,
        '2026-01-24 08:00:00'
    ),
    (
        'Year 6 Residential Trip to Wales - Booking Now Open',
        '<p>We are excited to announce that booking is now open for our Year 6 residential trip to the Brecon Beacons National Park in Wales, scheduled for May 12-16, 2026.</p>

<p>This five-day outdoor education experience will include hiking, orienteering, rock climbing, canoeing, and team-building activities. Students will stay at the Clearwater Activity Centre, which offers excellent facilities and experienced instructors.</p>

<p><strong>Trip Details:</strong></p>
<ul>
<li><strong>Dates:</strong> May 12-16, 2026</li>
<li><strong>Cost:</strong> £285 per student (includes accommodation, meals, activities, and transport)</li>
<li><strong>Deposit:</strong> £100 due by February 14th</li>
<li><strong>Final payment:</strong> Due by April 1st</li>
</ul>

<p>This trip provides an amazing opportunity for students to develop independence, confidence, and resilience while enjoying the beautiful Welsh countryside. It''s also a wonderful way for our Year 6 students to create lasting memories before they move on to secondary school.</p>

<p>An information meeting for parents will be held on February 10th at 6:00 PM in the school hall. We will provide detailed information about the trip, answer questions, and discuss what students need to bring.</p>

<p>Booking forms and medical information sheets are available from the school office. Payment plans are available for families who need them - please speak to Mrs. Davies in the office confidentially.</p>

<p>Places are limited to 45 students, so please book early to avoid disappointment!</p>',
        'uploads/news/wales_residential_trip.jpg',
        'Mr. Harris',
        1,
        '2026-01-12 09:30:00'
    ),
    (
        'New After-School Clubs Starting This Term',
        '<p>We are delighted to introduce several new after-school clubs starting in February! These clubs provide excellent opportunities for students to explore new interests and develop their skills.</p>

<p><strong>New Clubs Include:</strong></p>

<p><strong>Coding Club (Years 3-6)</strong><br/>
Mondays, 3:30-4:30 PM<br/>
Learn programming basics using Scratch and Python. No experience necessary!</p>

<p><strong>Art & Crafts Club (Years 1-3)</strong><br/>
Tuesdays, 3:30-4:30 PM<br/>
Explore different art techniques including painting, clay modeling, and collage.</p>

<p><strong>Chess Club (Years 2-6)</strong><br/>
Wednesdays, 3:30-4:30 PM<br/>
Develop strategic thinking and problem-solving skills. All levels welcome.</p>

<p><strong>Gardening Club (Years 1-4)</strong><br/>
Thursdays, 3:30-4:30 PM<br/>
Learn about plants, sustainability, and grow vegetables for our school kitchen!</p>

<p><strong>Dance Club (Years 4-6)</strong><br/>
Fridays, 3:30-4:45 PM<br/>
Contemporary and street dance styles with Miss Taylor.</p>

<p>Each club costs £4 per session or £40 for a 12-week term (paid in advance). Most clubs are limited to 15-20 students.</p>

<p>Registration forms are available on our website and at the school office. Clubs begin the week of February 10th. Sign up by February 3rd to secure your child''s place!</p>',
        'uploads/news/after_school_clubs.jpg',
        'Mrs. Thompson',
        1,
        '2026-01-19 13:00:00'
    ),
    (
        'School Grounds Improvement Project Update',
        '<p>Work on our School Grounds Improvement Project is progressing well! We wanted to update our community on what''s been accomplished and what''s coming next.</p>

<p><strong>Completed So Far:</strong></p>
<ul>
<li>New outdoor classroom with seating area</li>
<li>Sensory garden with aromatic plants and textured pathways</li>
<li>Wildlife pond and bug hotel installations</li>
<li>Repainted playground markings</li>
</ul>

<p><strong>Coming in Spring 2026:</strong></p>
<ul>
<li>Adventure playground with climbing structures (March)</li>
<li>Basketball and netball courts resurfacing (April)</li>
<li>Additional trees and shrubs planting (April)</li>
<li>Outdoor fitness trail (May)</li>
</ul>

<p>This £150,000 project has been funded through various sources including the Local Authority, grants, and our amazing PTA fundraising efforts. The improvements will benefit our students for years to come, providing spaces for learning, play, and connecting with nature.</p>

<p>We will be hosting a "Community Planting Day" on April 19th where families can help plant trees and flowers. This will be a fun day with refreshments, activities for children, and a chance to see the new facilities.</p>

<p>Thank you to everyone who has supported this project. We can''t wait to see our school grounds fully transformed!</p>',
        'uploads/news/grounds_improvement.jpg',
        'Mr. Davies',
        1,
        '2026-01-16 10:00:00'
    );
-- Insert sample newsletters
INSERT INTO newsletters (
        title,
        content,
        is_sent,
        sent_date,
        recipient_count
    )
VALUES (
        'January Newsletter 2026',
        '<h2>Welcome to Our January Newsletter</h2><p>Dear Parents and Guardians,</p><p>We are delighted to share updates from our school. This month has been filled with exciting activities and milestones for our students. Our Grade 4 students completed their winter science project, and the artwork displayed in our hallways is outstanding.</p><p><strong>Upcoming Events:</strong><ul><li>February Sports Day - February 14th</li><li>Parent-Teacher Conferences - February 21-23</li><li>Art Exhibition - February 28th</li></ul></p><p>Best regards,<br>The Pebbles Elementary Team</p>',
        1,
        '2026-01-10 09:00:00',
        150
    ),
    (
        'February Newsletter 2026',
        '<h2>February Newsletter</h2><p>Winter activities are in full swing! Our drama club has been preparing for the spring musical, and rehearsals are going wonderfully. Students are developing confidence and teamwork skills through this collaborative project.</p><p><strong>This Month''s Focus:</strong> Mental Health Awareness. We are incorporating mindfulness activities and stress management techniques into our daily routines.</p><p>We look forward to seeing you at our upcoming parent-teacher conferences!</p>',
        0,
        NULL,
        0
    );
-- Insert sample events
INSERT INTO events (
        event_name,
        event_description,
        event_date,
        event_location,
        featured,
        is_published
    )
VALUES (
        'Sports Day 2026',
        'Annual school sports day featuring various athletic competitions, team races, and field events for all grades. Includes tug-of-war, relay races, long jump, and more. Come cheer on your students!',
        '2026-02-14 09:00:00',
        'School Sports Field',
        1,
        1
    ),
    (
        'Parent-Teacher Conferences',
        'Individual meetings with teachers to discuss student progress, academic performance, and areas for growth. Sign-up sheets will be sent home soon.',
        '2026-02-21 15:00:00',
        'School Building',
        0,
        1
    ),
    (
        'Annual Art Exhibition',
        'Showcase of student artwork throughout the school year. Students will present their favorite pieces and discuss their creative process. Light refreshments will be served.',
        '2026-02-28 18:00:00',
        'School Hall and Corridors',
        0,
        1
    ),
    (
        'Spring Assembly',
        'Celebrate the arrival of spring with performances from our music and drama students. Special recognition for student achievements this term.',
        '2026-03-15 10:00:00',
        'School Auditorium',
        0,
        1
    );
```